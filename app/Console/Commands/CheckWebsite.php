<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
use App\Contracts\Constants;
use App\Events\SendMailGroup;
use App\Repositories\AlertMethodAlertGroupRepository;
use App\Repositories\MonitorRepository;

class CheckWebsite extends Command
{
    /**
     * @var object
     */
    protected $website;

    /**
     * @var MonitorRepository
     */
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
     * @param object $website
     */
    public function __construct($website)
    {
        parent::__construct();

        $this->website = $website;
        $this->check($this->website);
    }

    /**
     * Check Status of an Website.
     *
     * @param object $website
     */
    public function check(object $website)
    {
        $status = $this->getWebsiteStatus($website->url);
        if ($status['success'] === Constants::STATUS_FAILED) {
            for ($i = 0; $i < $website->sensitivity; ++$i) {
                $status = $this->getWebsiteStatus($website->url);
                if ($status['success'] === Constants::STATUS_SUCCESS) {
                    break;
                }
                sleep(Constants::DELAYED_INTERVAL);
            }
        }

        $this->updateMonitorAndSendMailGroup($website, $status);
    }

    /**
     * Get website status by its url.
     *
     * @param string $url
     *
     * @return array
     */
    public function getWebsiteStatus(string $url)
    {
        $date = \date('Y-m-d H:i:s');
        try {
            $client = new \GuzzleHttp\Client(['http_errors' => false]);

            $startTime = microtime(true);
            $response = $client->request('HEAD', $url);
            $endTime = microtime(true);
            $status = $response->getStatusCode();

            if ($status >= 200 && $status < 400) {
                return [
                    'success' => Constants::STATUS_SUCCESS,
                    'time_request' => $endTime - $startTime,
                    'created_at' => $date,
                ];
            }
        } catch (ClientException $e) {
            Log::error('Client Exception: '.$e->getMessage());

            return ['success' => Constants::STATUS_FAILED, 'time_request' => 0, 'created_at' => $date];
        } catch (RequestException $e) {
            Log::error('Request Exception: '.$e->getMessage());

            return ['success' => Constants::STATUS_FAILED, 'time_request' => 0, 'created_at' => $date];
        } catch (\Exception $e) {
            Log::error('Exception: '.$e->getMessage());

            return ['success' => Constants::STATUS_FAILED, 'time_request' => 0, 'created_at' => $date];
        }

        return ['success' => Constants::STATUS_FAILED, 'time_request' => 0, 'created_at' => $date];
    }

    /**
     * Update Monitor and Send Email to Alert Group.
     *
     * @param object $website
     * @param array $status
     */
    private function updateMonitorAndSendMailGroup(object $website, array $status)
    {
        $monitor = app(MonitorRepository::class)->findByWebsiteId($website->id);
        $result = $monitor->result;
        $monitor['result'] = $status['success'];
        $monitor->save();

        try {
            // Set data monitor redis
            $key = "statistics_{$website->id}";
            $redis = Redis::connection();
            $redis->rpush($key, json_encode($status));
            $listLength = $redis->llen($key);
            if ($listLength > Constants::NUMBER_OF_MILESTONES) {
                $redis->ltrim($key, $listLength - Constants::NUMBER_OF_MILESTONES, $listLength);
            }
        } catch (\Exception $e) {
            Log::error('Exception: '.$e->getMessage());
        }

        // Send email if the status is changed
        if ($monitor['result'] !== $result) {
            $this->sendMailGroup($monitor->alertGroup->id, $website, $monitor['result']);
        }
    }

    /**
     * Send mail to an Alert Group.
     *
     * @param string $groupId
     * @param object  $website
     * @param int    $status
     */
    private function sendMailGroup(string $groupId, object $website, int $status)
    {
        $listMethods = app(AlertMethodAlertGroupRepository::class)->getListEmail($groupId);

        $data = [];
        $data['url'] = $website->url;
        $data['name'] = $website->name;
        $data['email'] = [];
        $data['status'] = $status;

        foreach ($listMethods as $value) {
            if (!empty($value->email)) {
                array_push($data['email'], $value->email);
            }
        }

        if (!empty($data['email'])) {
            event(new SendMailGroup($data));
        }
    }
}
