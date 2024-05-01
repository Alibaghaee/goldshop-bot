<?php

namespace App\Jobs;

use App\Models\General\GroupSmsSender;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class GroupSmsSenderJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $groupSms;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($groupSms)
    {
        $groupSms->load('senderNumber', 'contactCategory');
        $this->groupSms = $groupSms;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $config = [];
        $config['message'] = $this->groupSms->description;
        $config['sender_number'] = $this->groupSms->senderNumber->number;

        $config['domain'] = $this->groupSms->senderNumber->panelSms->domain;
        $config['username'] = $this->groupSms->senderNumber->panelSms->username;
        $config['password'] = $this->groupSms->senderNumber->panelSms->decrypt_password;
        $config['dargah'] = $this->groupSms->senderNumber->dargah;

        $this->groupSms->contactCategory->each(function ($item) use ($config) {
            $item->contactNumbers()->published()->each(function ($item) use ($config) {
                $config['mobile'] = $item->mobile;
                $response = smsWithCustomConfig($config);
                if ((int)$response > 100||true) {

                    if ($this->groupSms->type === 'black_list'||true) {


                        SendBlackList::dispatch($this->groupSms, $response, $config)->onQueue('sms_black_sender');
                    }
                }
            });
        });

        $this->groupSms->status = 'sent';
        $this->groupSms->save();
    }
}
