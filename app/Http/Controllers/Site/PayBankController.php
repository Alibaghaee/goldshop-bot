<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\General\Pay;
use Illuminate\Http\Request;

class PayBankController extends Controller
{
    public function request(Request $request)
    {
        try {

            $gate = setting(9, 'mellat');
            $pay  = Pay::where('payed', false)->where('id', $request->id)->firstOrFail();

            $gateway = \Gateway::make($gate);

            $gateway->setCallback(url('/fa/pay/bank/response')); // You can also change the callback

            if ($gate == 'payping') {
                $gateway->price($pay->price / 10)->ready();
            } else {
                $gateway->price($pay->price)->ready();
            }

            $refId   = $gateway->refId(); // شماره ارجاع بانک
            $transID = $gateway->transactionId(); // شماره تراکنش

            $pay->update([
                'transaction_id' => $transID,
                'refrence_id'    => $refId,
            ]);

            return $gateway->redirect();

        } catch (\Exception $e) {

            echo $e->getMessage();
        }
    }

    public function response(Request $request)
    {
        try {
            $gateway      = \Gateway::verify();
            $trackingCode = $gateway->trackingCode();
            $refId        = $gateway->refId();
            $cardNumber   = $gateway->cardNumber();

            $pay = Pay::where('refrence_id', $refId)->first();

            $pay->update([
                'tracking_code' => $trackingCode,
                'card_number'   => $cardNumber,
                'payed'         => true,
            ]);

            $request->session()->put('pay_id', $pay->id);

            // تراکنش با موفقیت سمت بانک تایید گردید
            // در این مرحله عملیات خرید کاربر را تکمیل میکنیم

            flash_message('عملیات پرداخت با موفقیت انجام شد.');

            $message = $pay->fullname_prepend . ' ' . $pay->fullname .
            "\nپرداخت شما باموضوع: " . $pay->payment_subject_title .
            "\nو شرح پرداخت: " . $pay->description .
            "\nبا کد پیگیری: " . $pay->tracking_code .
            "\nبا موفقیت انجام شد
";

            sms($pay->mobile, $message);
            sms($pay->emergency_mobile, $message);

            return redirect('/fa/pay/receipt');

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
}
