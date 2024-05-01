<?php

namespace App\Listeners;

use App\Events\CreateContactNumberEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreateContactNumberListener
{


    /**
     * Handle the event.
     *
     * @param CreateContactNumberEvent $event
     * @return void
     */
    public function handle($event)
    {
        $config['username'] = $event->contactNumber->contactCategory->panelSms->username;
        $config['password'] = $event->contactNumber->contactCategory->panelSms->decrypt_password;
        $config['domain'] = $event->contactNumber->contactCategory->panelSms->domain;
        $config['catId'] = $event->contactNumber->contactCategory->cat_id;
        $config['fullName'] = $event->contactNumber->name;
        $config['mobile'] = $event->contactNumber->mobile;

        try {

            $response = addMobileToGroup($config);

            if (!$response == 'success') {

                $event->contactNumber->delete();
            }
        } catch (\Exception $e) {

            $event->contactNumber->delete();
        }
    }
}
