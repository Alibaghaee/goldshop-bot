<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>QR Codes</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@100..900&display=swap" rel="stylesheet">
    <style>

        html {
            -webkit-print-color-adjust: exact;
        }

        /* Webfont: Lato-Regular */
        {{--@font-face {--}}
        {{--    font-family: 'LatoWeb';--}}
        {{--    src: url({{url('fonts/Lato-Regular.eot')}}); /* IE9 Compat Modes */--}}
        {{--    src: url({{url('fonts/Lato-Regular.eot?#iefix')}}) format('embedded-opentype'), /* IE6-IE8 */ url({{url('fonts/Lato-Regular.woff2')}}) format('woff2'), /* Modern Browsers */ url({{url('fonts/Lato-Regular.woff')}}) format('woff'), /* Modern Browsers */ url({{url('fonts/Lato-Regular.ttf')}}) format('truetype');--}}
        {{--    font-style: normal;--}}
        {{--    font-weight: normal;--}}
        {{--    text-rendering: optimizeLegibility;--}}
        {{--}--}}

        {{--/* Webfont: Lato-Black */--}}
        {{--@font-face {--}}
        {{--    font-family: 'LatoWebBlack';--}}
        {{--    src: url({{url('fonts/Lato-Black.eot')}}); /* IE9 Compat Modes */--}}
        {{--    src: url({{url('fonts/Lato-Black.eot?#iefix')}}) format('embedded-opentype'), /* IE6-IE8 */ url({{url('fonts/Lato-Black.woff2')}}) format('woff2'), /* Modern Browsers */ url({{url('fonts/Lato-Black.woff')}}) format('woff'), /* Modern Browsers */ url({{url('fonts/Lato-Black.ttf')}}) format('truetype');--}}
        {{--    font-style: normal;--}}
        {{--    font-weight: normal;--}}
        {{--    text-rendering: optimizeLegibility;--}}
        {{--}--}}

        html {
            margin: 0;
            padding: 0;
        }

        body {
            font-family: "Vazirmatn", sans-serif;
            font-style: normal;
            margin: 0 0 0 0;
            padding: 0 0 0 0;
            height: 297mm;
            width: 210mm;
        }

        .main {
            position: relative;
            height: 297mm;
            width: 210mm;
        }

        .svg {
            fill: {{$qrcode['bg_color']}} ;
        }

    </style>

</head>
<body>

@foreach($entities as $entity)
    <div class="main">
        <div style="color:#5BA2FA;height: 13mm;position: absolute;top: 9mm;left: 25mm;"><p
                    style="text-align: left;font-size: 5.5mm;line-height: 5mm">DIE
                DIGITALE {{$qrcode['back_title']}}</p></div>
        <div style="color: #1A202C;height: 15mm;position: absolute;top: 18mm;width: 65mm;left: 25mm;"><p
                    style="text-align: left;font-size: 17mm;line-height: 17mm;margin: 0">
                HELPCHAT</p></div>
        <div style="top: 38mm;left: 25mm; width:160mm; position: absolute;z-index: 5;"><p
                    style="text-align: left;font-size: 18px;color: #203864;">
                {{$qrcode['front_txt_big']}}                        </p>
        </div>

        <div style="width: 40mm;top: 5mm;right: 25mm;position: absolute; text-align: left;color: #7F7F7F; font-size: 4mm">
            <img style="width: 40mm;max-height: 20mm"
                 src=" @if(file_exists(public_path($qrcode['logo_a3_top']))) {{  'data:'.mime_content_type(public_path($qrcode['logo_a3_top'])).';base64, ' .base64_encode(file_get_contents(public_path($qrcode['logo_a3_top'])))   }} @endif">
            Station: {{ $entity->department_title }}
            <br/>
            Zimmer: {{ $entity->room_title }}
            <br/>
            Bett: {{ $entity->title }}
        </div>

        <div style="top: 38mm;height:5mm;left: 32mm;position: absolute;"><p
                    style="text-align: center;font-size: 5mm;color: whitesmoke;">{{ $entity->room_title . ', ' . $entity->title }}</p>
        </div>

        <img style="width: 190mm;top: 45mm;left: 10mm;position: absolute;" src="{{ $entity->qrcode_base64 }}">
        <img style="width: 60mm; position: absolute;bottom: 0; right: 0"
             src="@if(file_exists(public_path($qrcode['nurse_a3']))) {{  'data:'.mime_content_type(public_path($qrcode['nurse_a3'])).';base64, ' .base64_encode(file_get_contents(public_path($qrcode['nurse_a3'])))   }} @endif ">
        <img style="width: 30mm;bottom: 5mm;left: 90mm; position: absolute;"
             src="@if(file_exists(public_path($qrcode['logo_a3']))) {{  'data:'.mime_content_type(public_path($qrcode['logo_a3'])).';base64, ' .base64_encode(file_get_contents(public_path($qrcode['logo_a3'])))   }} @endif ">


        <div style="top: 220mm;left: 16mm;width:85mm;position: absolute;color: #5BA2FA;">
            <ul style="list-style-type: none;">
                <li style="margin-bottom: 3mm;">LOGIN VIA QR-CODE:</li>
                <li style="margin-bottom: 3mm;">
                    <img style="width: 7mm;"
                         src="@if(file_exists(public_path("/image/qrcode/qrcode.png"))) {{  'data:'.mime_content_type(public_path("/image/qrcode/qrcode.png")).';base64, ' .base64_encode(file_get_contents(public_path("/image/qrcode/qrcode.png")))   }} @endif ">
                    <span style="display:inline-block; line-height: 7mm; font-size: 4mm;">QR Code scannen</span>
                </li>
                <li style="margin-bottom: 3mm;">
                    <img style="width: 7mm;"
                         src="@if(file_exists(public_path("/image/qrcode/link.png"))) {{  'data:'.mime_content_type(public_path("/image/qrcode/link.png")).';base64, ' .base64_encode(file_get_contents(public_path("/image/qrcode/link.png")))   }} @endif ">
                    <span style="display:inline-block; line-height: 7mm; font-size: 4mm;">Link folgen</span>
                </li>
            </ul>
        </div>
        <div style="top: 220mm;left: 90mm;width:65mm;position: absolute;color: #7F7F7F;">

            <ul style="list-style-type: none;">
                <li style="margin-bottom: 3mm;">LOGIN VIA BROWSER:</li>
                <li style="margin-bottom: 3mm;">
                    <img style="width: 7mm;"
                         src="@if(file_exists(public_path("/image/qrcode/web.svg"))) {{  'data:'.mime_content_type(public_path("/image/qrcode/web.svg")).';base64, ' .base64_encode(file_get_contents(public_path("/image/qrcode/web.svg")))   }} @endif ">
                    <span style="display:inline-block; text-align: center;font-size: 4mm;"> Browser öffnen </span>
                </li>
                <li style="margin-bottom: 3mm;">
                    <img style="width: 7mm;"
                         src="@if(file_exists(public_path("/image/qrcode/keyboard.svg"))) {{  'data:'.mime_content_type(public_path("/image/qrcode/keyboard.svg")).';base64, ' .base64_encode(file_get_contents(public_path("/image/qrcode/keyboard.svg")))   }} @endif ">
                    <span style="display:inline-block; text-align: center;font-size: 4mm;">{{ $entity->hospital->domain }}</span>
                </li>
                <li style="margin-bottom: 3mm;">
                    <img style="width: 7mm;"
                         src="@if(file_exists(public_path("/image/qrcode/lockA4.svg"))) {{  'data:'.mime_content_type(public_path("/image/qrcode/lockA4.svg")).';base64, ' .base64_encode(file_get_contents(public_path("/image/qrcode/lockA4.svg")))   }} @endif ">
                    <span style="display:inline-block; text-align: center;font-size: 4mm;">{{ $entity->bed_id }} (PIN)</span>
                </li>
            </ul>
        </div>

    </div>
@endforeach
</body>
</html>
