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
                        مشخصات داوطلب:
                    </div>
                    <div>نام: {{ $user->name }}</div>
                    <div>نام خانوادگی: {{ $user->family }}</div>
                    <div>موبایل: {{ $user->mobile }}</div>
                    <div>تلفن: {{ $user->phone }}</div>
                    <div>تلفن همراه یکی از بستگان: {{ $user->emergency_mobile }}</div>
                    <div>کد ملی: {{ $user->national_code }}</div>
                    <div>جنسیت: {{ $user->gender_title }}</div>
                    <div>مقطع تحصیلی: {{ $user->grade_title }}</div>
                    {{-- <div>رشته اصلی داوطلب در کنکور سراسری: {{ $user->field_title }}</div> --}}
                    <div>رشته تحصیلی: {{ $user->field_of_study_title }}</div>
                    {{-- <div>کد پستی: {{ $user->postal_code }}</div> --}}
                    <div>استان: {{ $user->province->name }}</div>
                    <div>شهر: {{ $user->city->name }}</div>
                    {{-- <div>آدرس: {{ $user->address }}</div> --}}

                    <div class="font-bold text-xl bg-grey-lighter rounded p-2 px-4 -mx-4 mb-2 mt-6">
                        <svg class="fill-current w-6 h-6 align-text-top" viewBox="0 0 2240 2240" xmlns="http://www.w3.org/2000/svg"><path d="M1920 512q66 0 113 47t47 113v1216q0 66-47 113t-113 47H320q-66 0-113-47t-47-113V672q0-66 47-113t113-47h1600zM320 640q-13 0-22.5 9.5T288 672v224h1664V672q0-13-9.5-22.5T1920 640H320zm1600 1280q13 0 22.5-9.5t9.5-22.5v-608H288v608q0 13 9.5 22.5t22.5 9.5h1600zM416 1792v-128h256v128H416zm384 0v-128h384v128H800z"/></svg>
                        اطلاعات پرداخت:
                    </div>
                    @foreach($payments as $payment)
                       <div>محصول: {{ $payment->title }}</div>
                       <div>شرح پرداخت: {{ $payment->description }}</div>
                       <div>کل مبلغ پکیج: {{ number_format($payment->package->price) }}</div>
                       <div>مبلغ پرداخت شده: {{ number_format($payment->price) }} ریال</div>
                       <div>کد پیگیری تراکنش: {{ $payment->tracking_code }}</div>
                       <div>تاریخ پرداخت: <span class="dir-ltr inline-block">{{ $payment->created_at_fa }}</span></div>
                       <br>
                    @endforeach
                   <div>مبلغ باقیمانده (بدهکاری شما): {{ number_format($user->payablePrice($payment->package_id)) }} ریال</div>
                </div>

                {{-- add this desriptions to payment description field --}}
                <div class="my-8 leading-loose font-bold text-xl">
                    @if($user->payablePrice($payment->package_id) > 0)
                    {!! $payment->package->pre_payment_message !!}
                    @else
                    {!! $payment->package->full_payment_message !!}
                    @endif
                </div>

                <div class="flex justify-end">
                    <a class="no-underline bg-green-light hover:bg-green rounded py-2 px-6 text-white cursor-pointer h-12 items-center justify-center text-center" href="/fa/registration/pdf/{{ $payment->package_id }}">
                    <svg class="fill-current w-6 h-6 align-text-top" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1596 380q28 28 48 76t20 88v1152q0 40-28 68t-68 28H224q-40 0-68-28t-28-68V96q0-40 28-68t68-28h896q40 0 88 20t76 48zm-444-244v376h376q-10-29-22-41l-313-313q-12-12-41-22zm384 1528V640h-416q-40 0-68-28t-28-68V128H256v1536h1280zm-514-593q33 26 84 56 59-7 117-7 147 0 177 49 16 22 2 52 0 1-1 2l-2 2v1q-6 38-71 38-48 0-115-20t-130-53q-221 24-392 83-153 262-242 262-15 0-28-7l-24-12q-1-1-6-5-10-10-6-36 9-40 56-91.5t132-96.5q14-9 23 6 2 2 2 4 52-85 107-197 68-136 104-262-24-82-30.5-159.5T785 552q11-40 42-40h22q23 0 35 15 18 21 9 68-2 6-4 8 1 3 1 8v30q-2 123-14 192 55 164 146 238zm-576 411q52-24 137-158-51 40-87.5 84t-49.5 74zm398-920q-15 42-2 132 1-7 7-44 0-3 7-43 1-4 4-8-1-1-1-2t-.5-1.5-.5-1.5q-1-22-13-36 0 1-1 2v2zm-124 661q135-54 284-81-2-1-13-9.5t-16-13.5q-76-67-127-176-27 86-83 197-30 56-45 83zm646-16q-24-24-140-24 76 28 124 28 14 0 18-1 0-1-2-3z"/></svg>
                    دانلود PDF
                </a>
                </div>
            </div>

          </div>
      </div>
    </div>


@endsection


