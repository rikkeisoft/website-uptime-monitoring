<?php

namespace App\Console\Commands;

use App\Contracts\DBTable;
use App\Events\SendMailGroup;
use App\Models\AlertMethodAlertGroup;
use App\Models\Monitor;
use App\Models\Website;
use App\Repositories\MonitorRepository;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

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
        $headers = get_headers($url);

        if (substr($headers[0], 9, 3) < 400) {
            return true;
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
        $check = 2;

        if ($this->checkStatusWebsite($website->url)) {
            $check = 1;
        } else {
            for ($i = 0; $i < $website->sensitivity; $i++) {
                if ($this->checkStatusWebsite($website->url)) {
                    $check = 1;
                    break;
                } else {
                    sleep(10);
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
            $data['status'] = $check == 2?'Down':'Up';

            foreach ($listmethods as $value) {
                array_push($data['email'], $value->email);
            }
            Log::info('check alert'.json_encode($data));

            //event send list mail group
            event(new SendMailGroup($data));
        }
    }
}
