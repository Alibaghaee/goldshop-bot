<?php

namespace App\Jobs;

use App\Models\General\SmsTemplate;
use App\Models\General\Travel;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Carbon;

use Morilog\Jalali\Jalalian;

class AnalyzeInbox implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $inbox;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($inbox)
    {

        $this->inbox = $inbox;
    }

    private function checkData($data)
    {
        $noteList = explode('*', $data->note);
        if (count($noteList) === 7) {
            return 'travel';
        } elseif (
            count($noteList) === 2 && to_english_numbers(trim($noteList[1])) === env('CANCEL_TRAVEL_KEY')) {

            return 'cancel_travel';
        } elseif (count($noteList) === 2 && to_english_numbers(trim($noteList[1])) === env('CHARGE_WALLET_INFO_KEY')) {

            return 'wallet_info';
        } elseif (count($noteList) === 1 && to_english_numbers(trim($noteList[0])) === env('GET_USER_SUBSCRIP_CODE_KEY')) {

            return 'get_subscrip_code';
        } elseif (count($noteList) === 1 && to_english_numbers(trim($noteList[0])) === env('GUIDE_INFO_KEY')) {

            return 'guide_info';
        } elseif (count($noteList) === 3 && to_english_numbers(trim($noteList[1])) === env('RECHARGE_WALLET_KEY')) {

            return 'recharge_wallet';
        } elseif (count($noteList) === 1 && to_english_numbers(trim($noteList[0])) === env('GUIDE_TRAVEL_REASON_KEY')) {

            return 'guid_travel_reason_info';
        } elseif (count($noteList) === 1 && to_english_numbers(trim($noteList[0])) === env('GUIDE_CANCEL_REASON_KEY')) {

            return 'guid_cancel_reason_info';
        } else {

            return 'Invalid!!';
        }

    }


    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $this->inbox->each(function ($item) {

            $note = explode('*', $item->note);

            $query = null;
            if (count($note) > 1) {


                $query = User::findWithSubscripCode(to_english_numbers(trim($note[0])));


            } elseif (
                count($note) === 1 &&
                (
                    to_english_numbers(trim($note[0])) === env('GUIDE_INFO_KEY') ||
                    to_english_numbers(trim($note[0])) === env('GET_USER_SUBSCRIP_CODE_KEY') ||
                    to_english_numbers(trim($note[0])) === env('GUIDE_TRAVEL_REASON_KEY')
                )
            ) {
                {

                    $query = User::findWithNumber($item->sender_number);
                }
            }


            if ((!is_null($query)) && optional($query)->exists()) {

                switch ($this->checkData($item)) {
                    case 'travel':
//                        if (Travel::checkHolyDaye()) {
//
//                            Travel::holyDaye($item, $query->first());
//                        } else {
//
//                            Travel::storeTravel($item, $query->first());
//                        }
                        Travel::storeTravel($item, $query->first());
                        break;
                    case 'cancel_travel':

                        Travel::cancelTravel($item, $query->first());
                        break;
                    case 'recharge_wallet':

                        Travel::rechargeWallet($item, $query->first());
                        break;
                    case 'wallet_info':

                        Travel::chargeWalletInfo($item, $query->first());
                        break;
                    case 'get_subscrip_code':

                        Travel::getSubscripCode($item, $query->first());
                        break;
                    case 'guid_travel_reason_info':

                        Travel::getTravelReasonCode($item, $query->first());
                        break;
                    case 'guid_cancel_reason_info':

                        Travel::getCancelReasonCode($item, $query->first());
                        break;
                    case 'guide_info':
                    default :
                        Travel::guideInfo($item, $query->first());
                        break;
                }
            }


        });
    }


}
