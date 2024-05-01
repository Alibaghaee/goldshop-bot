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
            <div>نام: {{ $pay->name }}</div>
            <div>نام خانوادگی: {{ $pay->family }}</div>
            <div>موبایل: {{ $pay->mobile }}</div>
            <div>تلفن: {{ $pay->phone }}</div>
            <div>تلفن همراه یکی از بستگان: {{ $pay->emergency_mobile }}</div>
            <div>کد ملی: {{ $pay->national_code }}</div>
            <div>جنسیت: {{ $pay->gender_title }}</div>
            <div>مقطع تحصیلی: {{ $pay->grade_title }}</div>
            <div>رشته تحصیلی: {{ $pay->field_of_study_title }}</div>
            <div>استان: {{ $pay->province->name }}</div>
            <div>شهر: {{ $pay->city->name }}</div>

            <br>
            <div style="font-size: 20px; font-weight: 700;">پرداخت:</div>
            <div>عنوان: {{ $pay->payment_subject_title }}</div>
            <div>شرح پرداخت: {{ $pay->description }}</div>
            <div>مبلغ: {{ number_format($pay->price) }} ریال</div>
            <div>کد پیگیری: {{ $pay->tracking_code }}</div>
            <div>تاریخ پرداخت: <span>{{ $pay->created_at_fa }}</span></div>
            <br>

            <br>
            <br>
        </div>
    </div>

    {{-- for page break --}}
    {{-- <pagebreak></pagebreak> --}}
</body>
</html>