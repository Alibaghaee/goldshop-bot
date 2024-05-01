@extends(getSiteBladePath('layouts.master'))

@section('title', 'رسید')

@section('content')
    
    <div class="h-full w-full relative my-8">
      <div class="container h-full flex items-center justify-center relative z-20">

          <div class="w-full flex flex-wrap rounded-lg flex-row-reverse">

            <div class="w-full p-8 rounded-lg" style="background-color: rgb(255 255 255 / 96.5%);">
                    <div class="leading-loose text-grey-darkset">
                        <div class="font-bold text-xl">مشخصات داوطلب:</div>
                        <div>نام: {{ $pay->name }}</div>
                        <div>نام خانوادگی: {{ $pay->family }}</div>
                        <div>موبایل: {{ $pay->mobile }}</div>
                        <div>تلفن: {{ $pay->phone }}</div>
                        <div>تلفن همراه یکی از بستگان: {{ $pay->emergency_mobile }}</div>
                        <div>کد ملی: {{ $pay->national_code }}</div>
                        <div>جنسیت: {{ $pay->gender_title }}</div>
                        <div>استان: {{ $pay->province->name }}</div>
                        <div>شهر: {{ $pay->city->name }}</div>

                        <div class="font-bold pt-8 text-xl">پرداخت:</div>
                        <div>عنوان: {{ $pay->payment_subject_title }}</div>
                       <div>شرح پرداخت: {{ $pay->description }}</div>
                       <div>مبلغ: {{ number_format($pay->price) }} ریال</div>
                       <div>کد پیگیری: {{ $pay->tracking_code }}</div>
                       <div>تاریخ پرداخت: <span>{{ $pay->created_at_fa }}</span></div>
                       <br>
                    </div>

                    <a class="bg-teal rounded-full border-2 border-grey-lightest px-8 py-3 no-underline text-center inline-block text-xl text-grey-lightest hover:bg-white hover:text-teal hover:border-teal mt-6" href="/fa/pay/pdf">
                        دانلود PDF
                    </a>
            </div>

          </div>
      </div>
    </div>


@endsection


