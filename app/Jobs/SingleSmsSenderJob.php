<?php

namespace App\Jobs;

use App\Models\General\PanelSms;
use App\Models\General\SingleSmsSender;
use Illuminate\Bus\Queueable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SingleSmsSenderJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $singleSms;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($singleSms)
    {
        $singleSms->load('senderNumber', 'contactNumber');
        $this->singleSms = $singleSms;
    }


    private function blackSender($blackListSender, $config)
    {
        $nestedConfig = $config;
        $nestedConfig['sender_number'] = $blackListSender->number;

        $nestedConfig['domain'] = $blackListSender->panelSms->domain;
        $nestedConfig['username'] = $blackListSender->panelSms->username;
        $nestedConfig['password'] = $blackListSender->panelSms->decrypt_password;

        $this->singleSms->senderNumber->number = $nestedConfig['sender_number'];
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
        $config = [];
        $config['message'] = $this->singleSms->description;
        $config['sender_number'] = $this->singleSms->senderNumber->number;
        $config['mobile'] = $this->singleSms->contactNumber->mobile;
        $config['domain'] = $this->singleSms->senderNumber->panelSms->domain;
        $config['username'] = $this->singleSms->senderNumber->panelSms->username;
        $config['password'] = $this->singleSms->senderNumber->panelSms->decrypt_password;
        $config['dargah'] = $this->singleSms->senderNumber->dargah;


        $response = smsWithCustomConfig($config);
        $this->singleSms->response = $response;

        if ((int)$response > 100) {

            $this->singleSms->status = 'sent';

            if ($this->singleSms->type === 'black_list') {

                if (is_string($response) && ((int)$response > 100)) {
                    sleep(2);
                    $config['smsid'] = [$response];
                    $checkDeliver = text_to_array(checkDelivery($config));
                    if (is_array($checkDeliver) && (!$this->singleSms->senderNumber->type === "black_list")) {

                        if (array_key_exists(0, $checkDeliver)) {

                            if (!($checkDeliver[0] == 1)) {

                                $blackListSender = $this->singleSms->senderNumber->panelSms->senderNumbers()->where('type', 'black_list');
                                if (!$blackListSender->exists()) {

                                    $finderBlackListSender = PanelSms::where('type', 'owner')->whereHas('senderNumbers', function (Builder $query) {
                                        return $query->where('type', 'black_list');
                                    });
                                    if ($finderBlackListSender->exists()) {
                                        $blackListSender = $finderBlackListSender;

                                        $this->blackSender($blackListSender->first()->senderNumbers()->where('type', 'black_list')->first(), $config);
                                    } else {
                                        $blackListSender = PanelSms::where('type', 'company')->whereHas('senderNumbers', function (Builder $query) {
                                            return $query->where('type', 'black_list');
                                        });

                                        $this->blackSender($blackListSender->first()->senderNumbers()->where('type', 'black_list')->first(), $config);
                                    }
                                } else {

                                    $this->blackSender($blackListSender->first(), $config);
                                }
                            }
                        }
                    }
                }
            }

        } else {
            $this->singleSms->status = 'not_sended';
        }

        $this->singleSms->save();
    }
}
