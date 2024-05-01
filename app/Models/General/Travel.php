<?php

namespace App\Models\General;

use App\Filters\Filterable;
use App\Jobs\SendSMSMessageMobile;
use App\Jobs\SendSMSMessageUser;
use App\Models\User;
use App\Traits\Models\Uri;
use App\Traits\Models\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Morilog\Jalali\Jalalian;

class Travel extends Model
{
    use Uri, View, Filterable;

    protected $route_name = 'travels';

    protected $guarded = [];



    protected function casts(): array
    {
        return [
            'webservice_store_time' => 'datetime',
        ];
    }

    public static $PENDING = 'pending';
    public static $CANCELED = 'canceled';
    public static $VERIFY = 'verify';
    public static $EXPIRED = 'expired';

    public static $STATUS_LIST = [
        ['id' => 'pending', 'name' => 'درانتظار'],
        ['id' => 'canceled', 'name' => 'لغوشده'],
        ['id' => 'verify', 'name' => 'تاییدشده'],
        ['id' => 'expired', 'name' => 'منقضی شده'],
    ];


    public static $TRAVEL_REASON_LIST = [
        ['id' => '1', 'name' => 'دیالیز'],
        ['id' => '2', 'name' => 'درمان'],
        ['id' => '3', 'name' => 'اشتغال'],
        ['id' => '4', 'name' => 'آموزش'],
        ['id' => '5', 'name' => 'سایر'],
    ];
    public static $CANCEL_REASON_LIST = [
        ['id' => '1', 'name' => 'علت کنسلی یک'],
        ['id' => '2', 'name' => 'علت کنسلی دو'],
        ['id' => '3', 'name' => 'علت کنسلی سه'],
        ['id' => '4', 'name' => 'علت کنسلی چهار'],
    ];

    public static $ACCOMPANYING_PERSON_LIST = [
        ['id' => '1', 'name' => 'دارد'],
        ['id' => '2', 'name' => 'ندارد'],
    ];


    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->setAttribute('tracking_code', (string)random_int(100000, 999999));
        });
    }

    public static function reasonGuid(string $mode)
    {
        $result = '';
        if ($mode === 'travel') {
            $list = collect(self::$TRAVEL_REASON_LIST);

        } elseif ($mode === 'cancel') {

            $list = collect(self::$CANCEL_REASON_LIST);

        } else {

            return $result;
        }
        foreach ($list as $item) {


            $result = ' ' . $result . $item['id'] . ' : ' . $item['name'] . ' , ';
        }

        return $result;
    }


    public function getCreatedAtFaAttribute()
    {
        return Jalalian::fromDateTime($this->created_at)->format('Y/m/d H:i');
    }

    public function getWebserviceStoreTimeFaAttribute()
    {
        return Jalalian::fromDateTime($this->webservice_store_time)->format('Y/m/d H:i');
    }


    public function getBeginningTimeFaAttribute()
    {
        return Jalalian::fromDateTime($this->beginning_time)->format('Y/m/d H:i');
    }

    public function getTimeReturnFaAttribute()
    {
        return Jalalian::fromDateTime($this->time_return)->format('Y/m/d H:i');
    }

    public function getStatusFaAttribute()
    {

        return collect(self::$STATUS_LIST)
            ->where('id', $this->getAttribute('status'))
            ->first()['name'];
    }


    public static function transReason(string $code, string $mode)
    {
        if ($mode === 'travel') {

            if (collect(self::$TRAVEL_REASON_LIST)
                    ->where('id', $code)->count() > 0) {

                return collect(self::$TRAVEL_REASON_LIST)
                    ->where('id', $code)
                    ->first()['name'];
            }
            return 'undefined';
        } elseif ($mode === 'cancel') {

            if (collect(self::$CANCEL_REASON_LIST)
                    ->where('id', $code)->count() > 0) {

                return collect(self::$CANCEL_REASON_LIST)
                    ->where('id', $code)
                    ->first()['name'];
            }
            return 'undefined';

        } else {

            return 'undefined';
        }

    }


    public static function transByTitleReason(string $title, string $mode)
    {
        if ($mode === 'travel') {

            if (collect(self::$TRAVEL_REASON_LIST)
                    ->where('name', $title)->count() > 0) {

                return collect(self::$TRAVEL_REASON_LIST)
                    ->where('name', $title)
                    ->first()['id'];
            }
            return 'undefined';
        } elseif ($mode === 'cancel') {

            if (collect(self::$CANCEL_REASON_LIST)
                    ->where('name', $title)->count() > 0) {

                return collect(self::$CANCEL_REASON_LIST)
                    ->where('name', $title)
                    ->first()['id'];
            }
            return 'undefined';

        } elseif ($mode === 'accompanying_person') {

            if (collect(self::$ACCOMPANYING_PERSON_LIST)
                    ->where('name', $title)->count() > 0) {

                return collect(self::$ACCOMPANYING_PERSON_LIST)
                    ->where('name', $title)
                    ->first()['id'];
            }
            return 'undefined';

        } else {

            return 'undefined';
        }

    }


    /**
     *Cancel Travel.
     * @param User $user
     * @return void
     **/
    public static function cancel(User $user, string $reason = null)
    {
        $message = SmsTemplate::getMessageWithTag(SmsTemplate::$CANCELED, 'درخواست سفر  شما با موفقیت لغو گردید.');

        $travels = self::query()
            ->where('status', 'like', '%' . self::$PENDING . '%')
            ->where('user_id', $user->id);
        if ($travels->count() > 0) {

            $travels->get()->each(function (Travel $item) use ($user, $message, $reason) {

//                (Carbon::now()->format('H:i') >= Carbon::parse('17:00')->format('H:i')) ||
//                (Carbon::now()->format('H:i') <= Carbon::parse('5:00')->format('H:i')))
                if ($item->webservice_store_time < Carbon::now()->addDay()) {

                    if (is_null($reason)) {

                        $item->changeToCanceled();
                    } else {

                        $item->changeToCanceledWithReason($reason);
                    }

                    SendSMSMessageUser::dispatch($user, $message)->onQueue('send_message_user');
                } else {
                    $message = SmsTemplate::getMessageWithTag(SmsTemplate::$NOT_CANCEL, 'درخواست سفر  شما لغو نگردید, در حال حاضر درخواست شما مورد تایید نمی باشد.');

                    SendSMSMessageUser::dispatch($user, $message)->onQueue('send_message_user');
                }
            });
        }
    }


    public function changeToCanceled()
    {
        $this->status = self::$CANCELED;
        $this->save();
    }

    public function changeToCanceledWithReason($reason)
    {
        $this->status = self::$CANCELED;
        $this->reason = $reason;
        $this->save();
    }


    /**
     * Define an inverse one-to-many relationship to User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Define an inverse one-to-many relationship to Driver.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    public function checkHasUserWalletCharge(int $amount)
    {
        return (int)$this->user->wallet >= $amount;
    }


    public static function storeTravel($item, User $user)
    {

        /*store travel*/
        //        کداشتراک*مبدا*ساعت رفت*مقصد*ساعت بازگشت*دارد*علت
        $list = explode('*', $item->note);


        $reason = Travel::transReason((string)to_english_numbers($list[6]), 'travel');

        if ($reason === 'undefined') {


            $message = SmsTemplate::getMessageWithTag(SmsTemplate::$REASON_TRAVEL, 'کد علت سفر اشتباه است با ارسال عدد 01000 از لیست علت سفرها مطلع شوید.');
            SendSMSMessageMobile::dispatch($item->sender_number, $message)->onQueue('send_message_user');
        } elseif (!User::accompanyingPersonCond(trim($list[5]))) {


            $message = SmsTemplate::getMessageWithTag(SmsTemplate::$SYMBOLE_SYNTAX, 'مشترک گرامی الگوی شما اشتباه می باشد.لطفا طبق لینک راهنما درخواست خود را ارسال کنید.');

            SendSMSMessageMobile::dispatch($item->sender_number, $message)->onQueue('send_message_user');
        } else {

            $beginningTime = Carbon::createFromTimestamp($item->date)->addHours(48)->format('Y-m-d') . ' ' . trim(to_english_numbers($list[2]));
            $timeReturn = Carbon::createFromTimestamp($item->date)->addHours(48)->format('Y-m-d') . ' ' . trim(to_english_numbers($list[4]));

            \DB::table('travel')
                ->where('status', 'pending')
                ->where('beginning', $list[1])
                ->where('beginning_time', $beginningTime)
                ->where('destination', $list[3])
                ->where('time_return', $timeReturn)
                ->where('accompanying_person', $list[5])
                ->where('reason', $reason)
                ->where('user_id', $user->id)
                ->delete();


            $travel = Travel::create([
                'beginning' => $list[1],
                'beginning_time' => $beginningTime,
                'destination' => $list[3],
                'time_return' => $timeReturn,
                'accompanying_person' => $list[5],
                'reason' => $reason,
                'user_id' => $user->id,
                'webservice_store_time' => $item->date,
            ]);

            $message = SmsTemplate::getMessageWithTag(SmsTemplate::$STORE_TRAVEL, ' مشترک گرامی پیامک درخواست سفر شما دریافت گردید و نتیجه آن تا 24 ساعت دیگر اعلام میگردد.');

            $message = $message . ' ' . 'کدپیگیری:' . $travel->tracking_code;
            SendSMSMessageMobile::dispatch($item->sender_number, $message)->onQueue('send_message_user');

            if (!$travel->checkHasUserWalletCharge((int)env('TRAVEL_TICKET_AMOUNT'))) {

                $message = SmsTemplate::getMessageWithTag(SmsTemplate::$WARNING_WALLET_CHARCH, 'مشترک گرامی میزان موجودی شما برای این درخواست کافی نمی باشد.لطفا طبق لینک راهنما کیف پول خود را شارژ کنید.');
                SendSMSMessageMobile::dispatch($item->sender_number, $message)->onQueue('send_message_user');
            }
        }
    }

    public static function cancelTravel($item, User $user)
    {
        /* check if valid cancel request.*/
//        $list = explode('#', explode('*', $item->note)[2]);
//        if (count($list) >= 2) {
//
//
//            $reason = Travel::transReason((string)to_english_numbers($list[0]), 'travel');
//            if ($reason === 'undefined') {
//
//
//                $message = 'کد علت لغو سفر اشتباه است لطفا با ارسال ' . env('GUIDE_CANCEL_REASON_KEY') . ' از لیست علت لغو سفرها مطلع شوید. ';
        //                SendSMSMessageMobile::dispatch($item->sender_number, $message)->onQueue('send_message_user');
//            } else {
//
//
//                Travel::cancel($user, $reason);
//            }
//        }

        Travel::cancel($user);
    }


    public static function rechargeWallet($item, User $user)
    {
        /* recharge wallet. */
//        2323*2*1000

//                send purchase link

        $user->sendPurchaseLink($item);
    }


    public static function chargeWalletInfo($item, User $user)
    {
        $message = SmsTemplate::getMessageWithTag(SmsTemplate::$WALLET_BALANCE, 'مشترک گرامی میزان شارژ کیف پول شما برابر است با: ');

        $message = $message . $user->wallet;
        SendSMSMessageMobile::dispatch($item->sender_number, $message)->onQueue('send_message_user');
    }

    public static function getSubscripCode($item, User $user)
    {
        $message = SmsTemplate::getMessageWithTag(SmsTemplate::$GET_SUBSCRIP_CODE, 'مشترک گرامی کداشتراک شما برابر است با: ');

        $message = $message . $user->subscrip_code;
        SendSMSMessageMobile::dispatch($item->sender_number, $message)->onQueue('send_message_user');
    }


    public static function getTravelReasonCode($item, User $user)
    {

        $message = Travel::reasonGuid('travel');
        SendSMSMessageMobile::dispatch($item->sender_number, $message)
            ->onQueue('send_message_user');
    }


    public static function getCancelReasonCode($item, User $user)
    {
        $message = Travel::reasonGuid('cancel');

        SendSMSMessageMobile::dispatch($item->sender_number, $message)->onQueue('send_message_user');
    }


    public static function guideInfo($item, User $user)
    {
        $message = SmsTemplate::getMessageWithTag(SmsTemplate::$GUIDE_INFO, "مشترک گرامی برای دریافت الگو ها و راهنمایی ها لطفا به لینک زیر مراجعه کنید:  ");

        SendSMSMessageMobile::dispatch($item->sender_number, $message)->onQueue('send_message_user');
    }

    public static function holyDaye($item, User $user)
    {
        $message = SmsTemplate::getMessageWithTag(SmsTemplate::$HOLY_DAY_ERROR, 'مشترک گرامی تاریخ سفر شما در روز تعطیل قرار گرفته و ثبت نمیشود.لطفا بعدا تلاش کنید.');

        SendSMSMessageMobile::dispatch($item->sender_number, $message)->onQueue('send_message_user');
    }

    public static function checkHolyDaye()
    {
        $endpoint = "https://persiancalapi.ir/jalali/";
        $filter = Jalalian::fromDateTime(now()->addHours(48)->format('Y/m/d'))->format('Y/m/d');
        $ch = curl_init();

        $url = $endpoint . $filter;
        $getUrl = $url;
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $getUrl);
        curl_setopt($ch, CURLOPT_TIMEOUT, 80);
        $response = curl_exec($ch);

        if (curl_error($ch)) {
            \Log::info('persiancalapi Request Error:' . curl_error($ch));
        } else {
            return json_decode($response)->is_holiday;
        }
        curl_close($ch);
    }


    public function getStatusFaClassAttribute()
    {
        if ($this->status === self::$CANCELED) {

            return 'text-center text-red';
        } elseif ($this->status === self::$PENDING) {

            return 'text-center text-yellow';
        } elseif ($this->status === self::$VERIFY) {

            return 'text-center text-green';
        }
    }

// {{dont_delete_this_comment}}
}
