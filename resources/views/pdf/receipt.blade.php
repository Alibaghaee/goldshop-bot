<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>رسید پرداخت</title>
    <style>
        @page {
            header: page-header;
            footer: page-footer;
        }
        table,tr,th,td{
            font-family: fa;
        }
        .header, .footer{
            font-size: 12px;
            text-align: left;
        }
        body{
            font-family: fa;
            direction: rtl;
        }

    </style>
</head>

<body>
    {{-- for header : --}}
    {{-- <htmlpageheader name="page-header">
        <div class="header">{PAGENO} از {nb}</div>
    </htmlpageheader> --}}

    {{-- for footer : --}}
    <htmlpagefooter name="page-footer">
        <div class="footer">{PAGENO} از {nb}</div>
    </htmlpagefooter>

    <div>
        <div class="leading-loose text-grey-darkset">
            <div style="font-size: 20px; font-weight: 700;">مشخصات داوطلب:</div>
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

            <br>
            <div style="font-size: 20px; font-weight: 700;">پرداخت:</div>
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

            <br>
            <br>

            {{-- add this desriptions to payment description field --}}
            <div class="my-8" style="font-size: 20px; font-weight: 700;">
                @if($user->payablePrice($payment->package_id) > 0)
                {!! $payment->package->pre_payment_message !!}
                @else
                {!! $payment->package->full_payment_message !!}
                @endif
            </div>
        </div>
    </div>

    {{-- for page break --}}
    {{-- <pagebreak></pagebreak> --}}
</body>
</html>