<?php

namespace App\Listeners;

use App\Models\General\ContactCategory;
use App\Models\General\ContactNumber;
use App\Models\General\PanelSms;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpgradeContactNumbersListener
{

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

            ContactCategory::all()->each(function ($contactCategory) use ($config, $panel) {
                $config['catId'] = $contactCategory->cat_id;

                $response = smsGetNumberInCat($config)->getData();


                if ((!(isset($response->error) && $response->error === 'is_soap_fault')) && count($response->response) > 0) {

                    collect($response->response)->each(function ($item) use ($contactCategory, $panel) {


                        if (!ContactNumber::where('mobile', str_replace("+98", "0", $item->number))
                            ->where('contact_category_id', $contactCategory->id)
                            ->whereHas('contactCategory', function (Builder $query) use ($panel) {
                                $query->where('panel_sms_id', $panel->id);
                            })->first()) {

                            ContactNumber::create([
                                'name' => $item->fullname,
                                'en_name' => $item->fullname_en,
                                'number' => $item->number,
                                'gender_with_id' => $item->gender,
                                'contact_category_id' => $contactCategory->id,
                            ]);
                        }
                    });

                }
            });


        });
    }
}
