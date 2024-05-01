<?php

namespace App\Jobs;

use App\Models\General\PanelSms;
use Illuminate\Bus\Queueable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendBlackList implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $groupSms;
    public $response;
    public $config;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($groupSms, $response, $config)
    {

        $this->groupSms = $groupSms;
        $this->response = $response;
        $this->config = $config;
    }


    private function blackSender($blackListSender, $config)
    {
        $nestedConfig = $config;
        $nestedConfig['sender_number'] = $blackListSender->number;

        $nestedConfig['domain'] = $blackListSender->panelSms->domain;
        $nestedConfig['username'] = $blackListSender->panelSms->username;
        $nestedConfig['password'] = $blackListSender->panelSms->decrypt_password;

        $this->groupSms->senderNumber->number = $nestedConfig['sender_number'];
        smsWithCustomConfig($nestedConfig);
        if ($blackListSender->panelSms->type === 'company') {

            $config['deduction_username'] = $config['username'];
            $config['deduction_password'] = $config['password'];
            $config['deduction_domain'] = $config['domain'];
            deductionBlacklist($config);
        }

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if (is_string($this->response) && ((int)$this->response > 100)) {
            sleep(2);
            $this->config['smsid'] = [$this->response];
            $checkDeliver = text_to_array(checkDelivery($this->config));
            if (is_array($checkDeliver) && (!$this->groupSms->senderNumber->type === "black_list")) {

                if (array_key_exists(0, $checkDeliver)) {

                    if (!($checkDeliver[0] == 1)) {

                        $blackListSender = $this->groupSms->senderNumber->panelSms->senderNumbers()->where('type', 'black_list');
                        if (!$blackListSender->exists()) {

                            $finderBlackListSender = PanelSms::where('type', 'owner')->whereHas('senderNumbers', function (Builder $query) {
                                return $query->where('type', 'black_list');
                            });
                            if ($finderBlackListSender->exists()) {
                                $blackListSender = $finderBlackListSender;

                                $this->blackSender($blackListSender->first()->senderNumbers()->where('type', 'black_list')->first(), $this->config);
                            } else {
                                $blackListSender = PanelSms::where('type', 'company')->whereHas('senderNumbers', function (Builder $query) {
                                    return $query->where('type', 'black_list');
                                });

                                $this->blackSender($blackListSender->first()->senderNumbers()->where('type', 'black_list')->first(), $this->config);
                            }
                        } else {

                            $this->blackSender($blackListSender->first(), $this->config);
                        }
                    }
                }
            }
        }

    }
}
