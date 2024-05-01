<?php

namespace App\Listeners;

use App\Models\General\ContactCategory;
use App\Models\General\PanelSms;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpgradeContactCategoriesListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param object $event
     * @return void
     */
    public function handle($event)
    {
        PanelSms::all()->each(function ($panel) {

            $config['username'] = $panel->username;
            $config['password'] = $panel->decrypt_password;
            $config['domain'] = $panel->domain;
            $response = smsGetCatList($config)->getData();
            if ((!(isset($response->error) && $response->error === 'is_soap_fault')) && count($response->response) > 0) {

                collect($response->response)->each(function ($item) use ($panel) {

                    if (!ContactCategory::where('cat_id', $item->id)->first()) {
                        ContactCategory::create([
                            'cat_id' => $item->id,
                            'title' => $item->title,
                            'panel_sms_id' => $panel->id,
                        ]);
                    }
                });

            }
        });
    }
}
