<?php

namespace App\Listeners;

use App\Events\UpgradeSenderNumberEvent;
use App\Models\General\ContactCategory;
use App\Models\General\PanelSms;
use App\Models\General\SenderNumber;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpgradeSenderNumberListener
{


    /**
     * Handle the event.
     *
     * @param UpgradeSenderNumberEvent $event
     * @return void
     */
    public function handle($event)
    {


        PanelSms::all()->each(function ($panel) {

            $config['username'] = $panel->username;
            $config['password'] = $panel->decrypt_password;
            $config['domain'] = $panel->domain;
            $response = getSenderNumber($config)->getData();

            if ((!(isset($response->error) && $response->error === 'is_soap_fault')) && count($response->response) > 0) {

                collect($response->response)->each(function ($item) use ($panel) {

                    if ((!SenderNumber::where('number', $item->number)->first()) && ($item->kind === 'user')) {

                        SenderNumber::create([
                            'number' => $item->number,
                            'panel_sms_id' => $panel->id,
                        ]);
                    }
                });

            }
        });
    }
}
