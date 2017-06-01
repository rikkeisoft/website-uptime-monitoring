<?php

namespace App\Console\Commands;

use App\Contracts\Constants;
use App\Contracts\DBTable;
use App\Events\SendMailGroup;
use App\Models\AlertMethodAlertGroup;
use App\Models\Monitor;
use App\Models\Website;
use App\Repositories\MonitorRepository;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Mockery\CountValidator\Exception;

class checkWebsite extends Command
{
    public $website;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:name';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct($website)
    {
        parent::__construct();

        $this->website = $website;

        $this->checkSensitivity($this->website);
    }

    /**
     * check status website with url
     * @param $url
     * @return bool
     */
    public function checkStatusWebsite($url)
    {

        try {
            $client = new \GuzzleHttp\Client(['http_errors' => false]);
            $res = $client->request('GET', $url);
            $status = $res->getStatusCode();

            //Log::info('check alert'.json_encode([$status, $url]));

            if ($status < 400) {
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
     * check request sensitivity
     * @param $website
     * @return array
     */
    public function checkSensitivity($website)
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
        $monitor = Monitor::where('website_id', $website->id)->first();
        //website down => send mesage
        if ($check != $monitor->result) {
            //update monitor
            $monitor['result'] = $check;
            $monitor->save();

            $listmethods = AlertMethodAlertGroup::where('alert_group_id', $monitor->alertGroup->id)
                ->leftJoin(
                    DBTable::ALERT_METHOD,
                    DBTable::ALERT_METHOD_ALERT_GROUP.'.alert_method_id',
                    '=',
                    DBTable::ALERT_METHOD.'.id'
                )
                ->select([
                    DBTable::ALERT_METHOD.'.email',
                ])
                ->get();

            //get list email to send
            $data = [];
            $data['url'] = $website->url;
            $data['name'] = $website->name;
            $data['email'] = [];
            $data['status'] = $check == Constants::CHECK_FAILED?'Down':'Up';

            foreach ($listmethods as $value) {
                array_push($data['email'], $value->email);
            }

            Log::info('check alert'.json_encode($data));

            //event send list mail group
            event(new SendMailGroup($data));
        }
    }
}
