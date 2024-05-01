<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\RefundUserResource;
use App\Rules\Iban;
use App\Rules\NationalCode;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class RefundController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $request->session()->forget('code');
            $request->session()->forget('user_id');
            auth()->logout();
            return $next($request);
        })->only(['index']);
    }

    public function index(Request $request)
    {
        $descriptions = [
            'one'   => setting('28'),
            'two'   => setting('29'),
            'three' => setting('30'),
        ];

        return view(getSiteBladePath('modules.refund.index'), compact('descriptions'));
    }

    public function checkNationalCode(Request $request)
    {
        $request->merge([
            'national_code' => toLatinDigits($request->get('national_code')),
        ]);

        $request->validate([
            'national_code' => ['required', 'exists:users', 'numeric', new NationalCode],
        ], ['exists' => 'چنین کد ملی قبلا ثبت نام نکرده است.']);

        if (!User::isRegisteredIban($request->national_code)) {
            throw ValidationException::withMessages([
                'national_code' => 'این کد ملی شماره حساب (شبا) خود را جهت عودت وجه قبلا ثبت کرده است.',
            ])->status(429);
        }
        if (User::isSupplementary($request->national_code)) {
            throw ValidationException::withMessages([
                'national_code' => 'شما داوطلب رزروی نیستید و داوطلب ثبت نام قطعی یا تکمیلی هستید و امکان عودت وجه برای شما وجود ندارد.',
            ])->status(429);
        }

        if (User::hasNotPayment($request->national_code)) {
            throw ValidationException::withMessages([
                'national_code' => 'شما داوطلب رزروی نیستید و پیش پرداخت نداشته اید.',
            ])->status(429);
        }

        $user = User::isAllowedToUpdateIban($request->national_code);

        if (!$user) {
            throw ValidationException::withMessages([
                'national_code' => 'کاربر گرامی شما مجاز به این عملیات نمی باشید.',
            ])->status(429);
        }

        session()->put('user_id', $user->id);

        return new RefundUserResource($user);
    }

    public function requestCode(Request $request)
    {
        $user = User::findOrFail(session('user_id'));

        $code = mt_rand(0, 99999999);
        session()->put('code', $code);
        $note = 'کد: ' . $code;
        sms($user->mobile, $note);
        sms($user->emergency_mobile, $note);
    }

    public function checkCode(Request $request)
    {
        $request->merge([
            'code' => toLatinDigits($request->get('code')),
        ]);

        $code = session('code');

        $request->validate([
            'code' => 'required|in:' . $code,
        ], ['code.in' => 'کد وارد شده صحیح نمی باشد.']);

        auth()->loginUsingId(session('user_id'));

        return;
    }

    public function setIban(Request $request)
    {
        $request->merge([
            'iban' => 'IR' . toLatinDigits($request->get('iban')),
        ]);

        $request->validate([
            'iban'                => ['required', 'unique:users,iban', new Iban],
            'account_owner'       => 'required|string',
            'family_relationship' => 'required|string',
            'bank_name'           => 'required|string',
        ]);

        $user = User::isAllowedToUpdateIban(auth()->user()->national_code);

        if (!$user) {
            flash_message('کاربر گرامی شما مجاز به این عملیات نمی باشید.', 'error');
            return response(['redirect' => route('refund.index')]);
        }

        $iban_meta = [
            'account_owner'       => $request->account_owner,
            'family_relationship' => $request->family_relationship,
            'bank_name'           => $request->bank_name,
        ];

        auth()->user()->update([
            'iban'      => $request->iban,
            'iban_meta' => $iban_meta,
        ]);

        // success_flash();
        // return response(['redirect' => route('refund.index')]);
    }

    public function checkIban(Request $request)
    {
        $request->merge([
            'iban' => 'IR' . toLatinDigits($request->get('iban')),
        ]);

        $request->validate([
            'iban' => ['required', 'unique:users,iban', new Iban],
        ]);

        return $this->checkIbanByApi($request->iban);
    }

    private function checkIbanByApi($iban)
    {
        if (user_sms_panel_credit() < 10000) {
            return 'Not Enough Credit.';
        }

        $curl     = curl_init();
        $track_id = round(microtime(true)*1000);

        $end_point = 'https://apibeta.finnotech.ir/oak/v2/clients/rahbank1400/ibanInquiry?trackId=' . $track_id . '&iban=' . $iban;

        $token = 'eyJhbGciOiJSUzI1NiIsInR5cCI6IkpXVCJ9.eyJ0b2tlbklkIjoiYTg1YjQwYzEtZDIzNC00ZTFkLWE3NjktMjE4YWM4NzY4NzcxIiwicmVmcmVzaFRva2VuIjoiVW1zYUtkZ3Y3dnFGVUJKd0UzT2tTc1lNb3FZZGV0MVZ0OFVPajFhTTlDbjhkeHVQdXBzdWg5M3hLOXNqZzlpZXRjaG9OZHhZWnZNUjNNMWZTSWtJYkxXZFdHQUJsTG01NDBCVG1vbXVhaWpnaHpLdGMwVFhVU1ZCZVdtUTFwVEJwbWFIYnRZUzlXbHFtdEpwdXZ6SkRiZDhQS0dDWGhBTmR2SzU1cE0zYndhM09HZ0c0TWw4NUNvcUJnNFhTdkRMaHl4bUVXNHhXdjFFbUhqeHpnWVhMZHJoTGVGZFpnQXZhTjFYaXdVdlhuSXYxY3BYN2FiWUxDdkpnVE5nSVBSeSIsImNyZWF0aW9uRGF0ZSI6IjE0MDAwNTIwMTg0MDMxIiwibGlmZVRpbWUiOjg2NDAwMDAwMCwiY2xpZW50SWQiOiJyYWhiYW5rMTQwMCIsInVzZXJJZCI6IjYxNzkyNjMzMTAiLCJhY3RpdmUiOnRydWUsInNjb3BlcyI6WyJvYWs6aWJhbi1pbnF1aXJ5OmdldCJdLCJ0eXBlIjoiQ0xJRU5ULUNSRURFTlRJQUwiLCJjbGllbnRJbmZvIjoiZ3lNR29ZTVF0RHlscEZUSjdUUEZxME5aZmpDVlpxdHVvc004eitOWDEzaC9YemtGSEp1TGFZT2hGUlVSNHdKTCIsImJhbmsiOiIwNjIiLCJpYXQiOjE2Mjg2OTEwMzEsImV4cCI6MTYyOTU1NTAzMX0.mPTw-LV1K1_4MQXibQdf21FAuybjiqDvyXDN7IJqpZQ5TOWoR2ssj4fewTOE8PhPe3ZMJk_99skdqgQZqKLbf_EVzAoREO-2z6sSXliBtWGOCmIWbWVEKd0H2wrApg-QSeKohNpsv6nEogoFaahLqWLmucTZw-9N1vLC_5VPYxk9855KP3gNQBtd-vNbptWauO2hUktYnLROp5slzsBiOX35zZWrVal52qDF97diNmQ_uGQZZy3XVLr5YSzVVJyRRJpjXdnmQoO1tZGwwD8OmARMzOA28Mf7ZBFjmTTTr48vxxIHfHrBstlucBE5SaadyDhlL2hGyQuwpNqa_XiaAA';

        curl_setopt_array($curl, [
            CURLOPT_URL            => $end_point,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING       => '',
            CURLOPT_MAXREDIRS      => 10,
            CURLOPT_TIMEOUT        => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST  => 'GET',
            CURLOPT_HTTPHEADER     => ['Authorization: Bearer ' . $token],
        ]);

        $response = curl_exec($curl);

        curl_close($curl);

        // reduce service price from sms account
        cost_deduction();

        return $response;
    }

}
