<?php

namespace App\Http\Controllers;

use App\Helpers\DiscountCode;
use App\Jobs\SendSMSMessageUser;
use App\Models\General\Purchase;
use App\Models\General\SmsTemplate;
use App\Models\User;
use App\WalletActionLog;
use Illuminate\Http\Request;

class WalletController extends Controller
{

    public function getPurchase(string $uuid)
    {

        $wallet = WalletActionLog::where('uuid', $uuid)->where('status', 'open')->firstOrFail();


        return view('site.fa.modules.purchases.verify', compact('wallet'));
    }

    public function purchase(WalletActionLog $wallet)
    {

        try {

            $gate = setting(9, 'mellat');
            $payment = Purchase::make();

            $gateway = \Gateway::make($gate);

            $gateway->setCallback(url('/fa/bank/response/wallet')); // You can also change the callback

//            if ($gate == 'payping') {
//                $gateway->price($payment->price / 10)->ready();
//            } else {
//                $gateway->price($payment->price)->ready();
//            }
            $gateway->price((int)$wallet->amount)->ready();
            $refId = $gateway->refId(); // شماره ارجاع بانک
            $transID = $gateway->transactionId(); // شماره تراکنش


            $payment->user_id = $wallet->user->id;
            $payment->price = (int)$wallet->amount;
            $payment->transaction_id = $transID;
            $payment->refrence_id = $refId;
            $payment->type = 2;
            $payment->saveOrFail();

            return $gateway->redirect();

        } catch (\Exception $e) {

            if ($e->getMessage() == 'مبلغ نامعتبر است #25') {
                flash_message('کد تخفیف برای پیش پرداخت معتبر نمی باشد.', 'error');
            } else {
                flash_message($e->getMessage(), 'error');
            }
            return redirect()->back();
        }
    }


    public function response()
    {
        try {
            $gateway = \Gateway::verify();
            $trackingCode = $gateway->trackingCode();
            $refId = $gateway->refId();
            $cardNumber = $gateway->cardNumber();

            $payment = Purchase::where('refrence_id', $refId)->first();

            $payment->update([
                'tracking_code' => $trackingCode,
                'card_number' => $cardNumber,
                'payed' => true,
            ]);

            // تراکنش با موفقیت سمت بانک تایید گردید
            // در این مرحله عملیات خرید کاربر را تکمیل میکنیم

            flash_message('عملیات پرداخت با موفقیت انجام شد.');

            $user = User::findOrFail($payment->user_id);

            $user->depositWallet((int)$payment->price);


            $message = SmsTemplate::getMessageWithTag(SmsTemplate::$WALLET_CHARCH, 'مشترگ گرامی کیف پول شما با موفقیت شارژ شد . میزان اعتبار شما : ');
            $message = $message . $user->wallet;


            SendSMSMessageUser::dispatch($user, $message)->onQueue('send_message_user');

            return redirect('/fa/users/users/wallet/receipt/' . $payment->id);

        } catch (\Larabookir\Gateway\Exceptions\RetryException $e) {

            // تراکنش قبلا سمت بانک تاییده شده است و
            // کاربر احتمالا صفحه را مجددا رفرش کرده است
            // لذا تنها فاکتور خرید قبل را مجدد به کاربر نمایش میدهیم

            flash_message($e->getMessage(), 'error');
            return redirect('/fa/users/users/wallet/receipt/error');

        } catch (\Exception $e) {

            // نمایش خطای بانک
            flash_message($e->getMessage(), 'error');
            return redirect('/fa/users/users/wallet/receipt/error');
        }
    }

    public function receipt(Purchase $purchase)
    {
        if (!($purchase->exists && $purchase->payed)) {

            flash_message('رسید پرداخت موفق پیدا نشد!!', 'error');
            return redirect('/fa/users/users/wallet/receipt/error');
        }
        $payment = $purchase->load('user');


        return view('site.fa.modules.receipt.show_wallet', compact('payment'));
    }

    public function receiptError()
    {

        return view('site.fa.modules.receipt.error');
    }
}
