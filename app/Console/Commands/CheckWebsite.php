<?php

namespace App\Console\Commands;

use App\Contracts\Constants;
use App\Events\SendMailGroup;
use App\Repositories\AlertMethodAlertGroupRepository;
use App\Repositories\MonitorRepository;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class CheckWebsite extends Command
{
    public $website;

    protected $monitorRepository;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:CheckWebsite';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command Check Website Status';

    /**
     * Create a new command instance.
     *
     */
    public function __construct($website)
    {
        parent::__construct();

        $this->website = $website;
        $this->check($this->website);
    }

    /**
     * check request sensitivity
     * @param $website
     * @return array
     */
    public function check($website)
    {
        $statusWebsite = $this->checkStatusWebsite($website->url);
        if ($statusWebsite['success'] === Constants::CHECK_FAILED) {
            for ($i = 0; $i < $website->sensitivity; $i++) {
                $statusWebsite = $this->checkStatusWebsite($website->url);
                if ($statusWebsite['success'] === Constants::CHECK_SUCCESS) {
                    break;
                } else {
                    sleep(Constants::TIME_DELAY_SENSITIVITY);
                }
            }
        }

        $this->updateMonitorAndSendMailGroup($website, $statusWebsite);
    }

    /**
     * check status website with url
     * @param $url
     * @return bool
     */
    public function checkStatusWebsite(string $url)
    {
        $date =  \date('Y-m-d H:i:s');
        try {
            $client = new \GuzzleHttp\Client(['http_errors' => false]);

            //check time before request
            $timeBefore = microtime(true);
            $response = $client->request('HEAD', $url);
            //check time after request
            $timeAfter = microtime(true);
            $status = $response->getStatusCode();

            if ($status >= 200 && $status < 400) {
                return ['success' => Constants::CHECK_SUCCESS, 'time_request'
                => ($timeAfter - $timeBefore), 'created_at' => $date];
            }
        } catch (ClientException $e) {
            Log::info("client error" . $e);
            return ['success' => Constants::CHECK_FAILED, 'time_request' => 0, 'created_at' => $date];
        } catch (RequestException $e) {
            Log::info("Server error" . $e);
            return ['success' => Constants::CHECK_FAILED, 'time_request' => 0, 'created_at' => $date];
        } catch (\Exception $e) {
            //do some thing here
            Log::info("error" . $e);
            return ['success' => Constants::CHECK_FAILED, 'time_request' => 0, 'created_at' => $date];
        }
        return ['success' => Constants::CHECK_FAILED, 'time_request' => 0, 'created_at' => $date];
    }

    /**
     * update monitor and send mail group
     *
     * @param array $website
     * @param array $statusWebsite
     */
    private function updateMonitorAndSendMailGroup($website, $statusWebsite)
    {
        $monitor = app(MonitorRepository::class)->findByWebsiteId($website->id);
        $result = $monitor->result;
        //update monitor
        $monitor['result'] = $statusWebsite['success'];
        $monitor->save();

        try {
            // Set data monitor redis
            $key = "statistic_{$website->id}";
            $redis = Redis::connection();
            $redis->rpush($key, json_encode($statusWebsite));

            $listLength = $redis->llen($key);
            // Get list redis last
            Log::info('List Monitor / ' . $website->id . '/' .$listLength.'/'. json_encode($redis
                    ->lrange($key, $listLength - Constants::LIMIT_LIST_REDIS, $listLength)));
            if ($listLength > Constants::LIMIT_LIST_REDIS) {
                $redis->ltrim($key, $listLength - Constants::LIMIT_LIST_REDIS, $listLength);
            }
        } catch (Exception $e) {
            Log::info("error Redis" . $e);
        }

        //website result change => send mesage
        if ($monitor['result'] != $result) {
            //send mail to group
            $this->sendMailGroup($monitor->alertGroup->id, $website, $monitor['result']);
        }
    }

    /**
     * send mail to group
     *
     * @param string $group_id
     * @param array $website
     * @param integer $checkStatus
     */
    private function sendMailGroup($group_id, $website, $checkStatus)
    {
        $listMethods = app(AlertMethodAlertGroupRepository::class)->getListEmail($group_id);
        //get list email to send
        $data = [];
        $data['url'] = $website->url;
        $data['name'] = $website->name;
        $data['email'] = [];
        $data['status'] = $checkStatus;

        foreach ($listMethods as $value) {
            if (!empty($value->email)) {
                array_push($data['email'], $value->email);
            }
        }
        Log::info('check alert' . json_encode($data));

        //event send list mail group
        if (!empty($data['email'])) {
            event(new SendMailGroup($data));
        }
    }
}
