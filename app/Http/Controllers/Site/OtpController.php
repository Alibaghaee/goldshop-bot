<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Rules\Mobile;
use App\Rules\NationalCode;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OtpController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('guest');
        $this->middleware('guest:admin');
    }

    public function showRequestForm(Request $request)
    {
        return view(getSiteBladePath('modules.otp.show'));
    }

    public function sendOtp(Request $request)
    {

        $request->merge([
            'subscrip_code' => to_english_numbers($request->input('subscrip_code', '0')),
        ]);

        $request->validate([
            'subscrip_code' => ['required'], /////new NationalCode
        ]);

        $user = User::where('subscrip_code', $request->subscrip_code)->first();

        if ($user) {
            $this->sendOtpMessage($user);
        }

        flash_message('در صورت معتبر بودن، کد یکبار مصرف ارسال خواهد شد.');

        return response([
            'redirect' => route('otp.login', app()->getLocale()),
        ]);
    }

    public function showOtpLoginForm(Request $request)
    {
        return view(getSiteBladePath('modules.otp.login'));
    }

    public function showRequestActiveMobileForm(Request $request)
    {

        if (auth()->guard('web')->check()) {
            $this->sendOtpMessage(auth()->guard('web')->user());
        }

        flash_message(' کد یکبار مصرف به شماره موبایل شما ارسال خواهد شد.');

        return view(getSiteBladePath('modules.otp.active_mobile'));
    }

    public function otpLogin(Request $request)
    {
        $request->validate([
            'code' => 'required|in:' . session('otp_code'),
        ]);

        $user = User::where('subscrip_code', session('otp_subscrip_code'))->firstOrFail();

        $request->session()->invalidate();
        Auth::login($user);

        return response([
            'redirect' => route('home.index', app()->getLocale()),
        ]);
    }

    public function otpActiveMobile(Request $request)
    {
        $request->validate([
            'code' => 'required|in:' . session('otp_code'),
        ]);

        auth()->guard('web')->user()->update(['active_mobile' => true]);

        return response([
            'redirect' => route('home.index', app()->getLocale()),
        ]);
    }

    public function username()
    {
        return 'subscrip_code';
    }

    protected function sendOtpMessage($user)
    {
        $otp_code = random_int(100000, 999999);
        $message = 'کد یکبار مصرف : ' . $otp_code;

        session()->put('otp_subscrip_code', $user->subscrip_code);
        session()->put('otp_code', $otp_code);

        sms($user->mobile, $message);
//        sms($user->second_mobile, $message);

        return true;
    }
}
