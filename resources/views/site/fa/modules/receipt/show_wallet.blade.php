@extends(getSiteBladePath('layouts.master'))

@section('title', 'رسید')

@section('content')

    <div class="text-purple-darkest leading-loose h-full flex items-center">
        <div class="container py-16">
            <div class="w-full md:max-w-md mx-auto bg-white rounded shadow-md">

            <div class="w-full p-8 rounded-lg">
                <div class="leading-loose text-grey-darkset px-4">
                    <div class="font-bold text-xl bg-grey-lighter rounded p-2 px-4 -mx-4 mb-2">
                        <svg class="fill-current w-6 h-6 align-text-top" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1600 1405q0 120-73 189.5t-194 69.5H459q-121 0-194-69.5T192 1405q0-53 3.5-103.5t14-109T236 1084t43-97.5 62-81 85.5-53.5T538 832q9 0 42 21.5t74.5 48 108 48T896 971t133.5-21.5 108-48 74.5-48 42-21.5q61 0 111.5 20t85.5 53.5 62 81 43 97.5 26.5 108.5 14 109 3.5 103.5zm-320-893q0 159-112.5 271.5T896 896 624.5 783.5 512 512t112.5-271.5T896 128t271.5 112.5T1280 512z"/></svg>
                        مشخصات کاربر:
                    </div>
                    <div>کد اشتراک: {{ optional($payment->user)->subscrip_code }}</div>



                    <div class="font-bold text-xl bg-grey-lighter rounded p-2 px-4 -mx-4 mb-2 mt-6">
                        <svg class="fill-current w-6 h-6 align-text-top" viewBox="0 0 2240 2240" xmlns="http://www.w3.org/2000/svg"><path d="M1920 512q66 0 113 47t47 113v1216q0 66-47 113t-113 47H320q-66 0-113-47t-47-113V672q0-66 47-113t113-47h1600zM320 640q-13 0-22.5 9.5T288 672v224h1664V672q0-13-9.5-22.5T1920 640H320zm1600 1280q13 0 22.5-9.5t9.5-22.5v-608H288v608q0 13 9.5 22.5t22.5 9.5h1600zM416 1792v-128h256v128H416zm384 0v-128h384v128H800z"/></svg>
                        اطلاعات پرداخت:
                    </div>

                       <div>عنوان: {{ $payment->title }}</div>
                       <div>شرح پرداخت: {{ $payment->description }}</div>

                       <div>مبلغ پرداخت شده: {{ number_format($payment->price) }} ریال</div>
                       <div>کد پیگیری تراکنش: {{ $payment->tracking_code }}</div>
                       <div>تاریخ پرداخت: <span class="dir-ltr inline-block">{{ $payment->created_at_fa }}</span></div>
                       <br>
                </div>
            </div>

          </div>
      </div>

    </div>
    <flash message="{{ session('flash') }}" level_name="{{ session('level') }}"></flash>
@endsection

