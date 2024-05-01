<?php

namespace App\Listeners;

use App\Events\CreateContactCategoryEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreateContactCategoryListener
{


    /**
     * Handle the event.
     *
     * @param CreateContactCategoryEvent $event
     * @return void
     */
    public function handle($event)
    {
        $config['username'] = $event->contactCategory->panelSms->username;
        $config['password'] = $event->contactCategory->panelSms->decrypt_password;
        $config['domain'] = $event->contactCategory->panelSms->domain;
        $config['title'] = $event->contactCategory->title;


        try {

            $response = addContactCategory($config)->getData();
            if ((!(isset($response->error) && $response->error === 'is_soap_fault')) && count($response->response) > 0) {

                $event->contactCategory->cat_id = $response->response[0];
                $event->contactCategory->save();
            }
        } catch (\Exception $e) {

            $event->contactCategory->delete();
        }
    }
}
