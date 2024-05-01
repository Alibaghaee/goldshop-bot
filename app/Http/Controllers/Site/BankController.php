<?php

namespace App\Http\Controllers\Site;

use App\Helpers\DiscountCode;
use App\Http\Controllers\Controller;
use App\Models\General\Purchase;
use App\Models\User;
use Illuminate\Http\Request;

class BankController extends Controller
{
    public function request(Request $request)
    {
        try {
            $gate    = setting(9, 'mellat');
            $payment = Purchase::where('payed', false)->where('id', $request->id)->first();

            if (!$payment) {
                return redirect('/');
            }

            $gateway = \Gateway::make($gate);

            $gateway->setCallback(url('/fa/bank/response')); // You can also change the callback

            if ($gate == 'payping') {
                $gateway->price($payment->price / 10)->ready();
            } else {
                $gateway->price($payment->price)->ready();
            }

            $refId   = $gateway->refId(); // شماره ارجاع بانک
            $transID = $gateway->transactionId(); // شماره تراکنش

            $payment->update([
                'transaction_id' => $transID,
                'refrence_id'    => $refId,
            ]);

            return $gateway->redirect();

        } catch (\Exception $e) {

            if ($e->getMessage() == 'مبلغ نامعتبر است #25') {
                flash_message('کد تخفیف برای پیش پرداخت معتبر نمی باشد.', 'error');
            }else{
                flash_message($e->getMessage(), 'error');
            }
            return redirect()->back();
        }
    }

    public function response()
    {
        try {
            $gateway      = \Gateway::verify();
            $trackingCode = $gateway->trackingCode();
            $refId        = $gateway->refId();
            $cardNumber   = $gateway->cardNumber();

            $payment = Purchase::where('refrence_id', $refId)->first();

            $payment->update([
                'tracking_code' => $trackingCode,
                'card_number'   => $cardNumber,
                'payed'         => true,
            ]);


            // $payment->update([
            //     'discount_item_id' => applyDiscountCode(),
            // ]);

            if ($payment->discountItem) {
                (new DiscountCode)->apply($payment->discountItem->code);
            }

            // تراکنش با موفقیت سمت بانک تایید گردید
            // در این مرحله عملیات خرید کاربر را تکمیل میکنیم

            flash_message('عملیات پرداخت با موفقیت انجام شد.');

            $user = User::findOrFail($payment->user_id);
            $user->packages()->attach($payment->package_id);

            // $user_data = session('user_data');
            // $mobile    = Arr::get($user_data, 'mobile', '1');
            // $password  = Arr::get($user_data, 'password', '1');

            $random_password = random_int(100000, 999999);
            $user->update(['password' => bcrypt($random_password)]);

            if ($user->payablePrice($payment->package_id) > 0) {
                $this->sendPrePaymentMessage($user, $random_password);
            }else{
                $this->sendFullPaymentMessage($user, $random_password);
            }


            return redirect('/fa/registration/receipt/' . $payment->id);

        } catch (\Larabookir\Gateway\Exceptions\RetryException $e) {

            // تراکنش قبلا سمت بانک تاییده شده است و
            // کاربر احتمالا صفحه را مجددا رفرش کرده است
            // لذا تنها فاکتور خرید قبل را مجدد به کاربر نمایش میدهیم

            flash_message($e->getMessage(), 'error');
            return redirect('/fa');

        } catch (\Exception $e) {

            // نمایش خطای بانک
            flash_message($e->getMessage(), 'error');
            return redirect('/fa');
        }

    }

    protected function sendPrePaymentMessage($user, $password)
    {
        $message = $this->prePaymentMessage($user, $password);

        sms($user->mobile, $message);
        sms($user->emergency_mobile, $message);
    }

    protected function prePaymentMessage($user, $password)
    {
        $link = route('login', app()->getLocale());

        $message = "سلام\n" .
        $user->fullname_prepend . ' ' . $user->fullname .
        "\nرزرو و پیش ثبت نام شما با موفقیت انجام شد\nبه دلیل محدودیت ظرفیت محصول، در اولین فرصت اقدام به پرداخت باقیمانده شهریه خود نمایید\nدر صورت عدم پرداخت به موقع شهریه موسسه هیچ مسئولیتی در قبال تکمیل ظرفیت و اتمام محصول ندارد\nجهت ورود به پنل کاربری شخصی خود به لینک زیر مراجعه کنید\nلینک:\n"
        . $link .
        "\nنام کاربری: " . $user->national_code .
        "\nرمز عبور:" . $password .
        "\n\nبنیاد علمی و آموزشی شفیعی";

        return $message;
    }

    protected function sendFullPaymentMessage($user, $password)
    {
        $message = $this->fullPaymentMessage($user, $password);

        sms($user->mobile, $message);
        sms($user->emergency_mobile, $message);
    }

    protected function fullPaymentMessage($user, $password)
    {
        $link = route('login', app()->getLocale());

        $message = "سلام\n" .
        $user->fullname_prepend . ' ' . $user->fullname .
        "\nثبت نام قطعی شما با موفقیت انجام شد\nجهت مشاهده فیلم های آموزشی خود به لینک زیر مراجعه کنید\nلینک:\n"
        . $link .
        "\nنام کاربری: " . $user->national_code .
        "\nرمز عبور:" . $password .
        "\n\nبنیاد علمی و آموزشی شفیعی";

        return $message;
    }
}
