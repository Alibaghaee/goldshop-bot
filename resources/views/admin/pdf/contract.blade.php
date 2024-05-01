<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $contract->title }}</title>
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
        {!! $contract->body_tag_replaced !!}
    </div>

    {{-- for page break --}}
    {{-- <pagebreak></pagebreak> --}}
</body>
</html>