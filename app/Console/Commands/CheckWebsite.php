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
     * @return void
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
        //1: Success, 2: Failed
        $check = Constants::CHECK_FAILED;

        if ($this->checkStatusWebsite($website->url)) {
            $check = Constants::CHECK_SUCCESS;
        } else {
            for ($i = 0; $i < $website->sensitivity; $i++) {
                if ($this->checkStatusWebsite($website->url)) {
                    $check = Constants::CHECK_SUCCESS;
                    break;
                } else {
                    sleep(Constants::TIME_DELAY_SENSITIVITY);
                }
            }
        }
        $this->updateMonitorAndSendMailGroup($website, $check);
    }
    /**
     * check status website with url
     * @param $url
     * @return bool
     */
    public function checkStatusWebsite(string $url)
    {
        try {
            $client = new \GuzzleHttp\Client(['http_errors' => false]);
            $res = $client->request('HEAD', $url);
            $status = $res->getStatusCode();
            if ($status >= 200 && $status < 400) {
                return true;
            }
        } catch (ClientException $e) {
            Log::info("client error" . $e);
            return false;
        } catch (RequestException $e) {
            Log::info("Server error" . $e);
            return false;
        } catch (\Exception $e) {
            //do some thing here
            Log::info("error" . $e);
            return false;
        }
        return false;
    }
    /**
     * update monitor and send mail group
     *
     * @param array $website
     * @param integer $checkStatus
     */
    private function updateMonitorAndSendMailGroup($website, $checkStatus)
    {
        $monitor = app(MonitorRepository::class)->findByWebsiteId($website->id);
        $result = $monitor->result;
        //update monitor
        $monitor['result'] = $checkStatus;
        $monitor->save();

        //website result change => send mesage
        if ($checkStatus != $result) {
            //send mail to group
            $this->sendMailGroup($monitor->alertGroup->id, $website, $checkStatus);
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
        Log::info('check alert'.json_encode($data));

        //event send list mail group
        if (!empty($data['email'])) {
            event(new SendMailGroup($data));
        }
    }
}
