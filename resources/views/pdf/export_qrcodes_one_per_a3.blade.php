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


        {{--/* Webfont: Lato-Regular */@font-face {--}}
        {{--    font-family: 'LatoWeb' ;--}}
        {{--    src: url({{url('fonts/Lato-Regular.eot')}}); /* IE9 Compat Modes */--}}
        {{--    src: url({{url('fonts/Lato-Regular.eot?#iefix')}}) format('embedded-opentype'), /* IE6-IE8 */--}}
        {{--    url({{url('fonts/Lato-Regular.woff2')}}) format('woff2'), /* Modern Browsers */--}}
        {{--    url({{url('fonts/Lato-Regular.woff')}}) format('woff'), /* Modern Browsers */--}}
        {{--    url({{url('fonts/Lato-Regular.ttf')}}) format('truetype');--}}
        {{--    font-style: normal;--}}
        {{--    font-weight: normal;--}}
        {{--    text-rendering: optimizeLegibility;--}}
        {{--}--}}
        {{--/* Webfont: Lato-Black */@font-face {--}}
        {{--    font-family: 'LatoWebBlack';--}}
        {{--    src: url({{url('fonts/Lato-Black.eot')}}); /* IE9 Compat Modes */--}}
        {{--    src: url({{url('fonts/Lato-Black.eot?#iefix')}}) format('embedded-opentype'), /* IE6-IE8 */--}}
        {{--    url({{url('fonts/Lato-Black.woff2')}}) format('woff2'), /* Modern Browsers */--}}
        {{--    url({{url('fonts/Lato-Black.woff')}}) format('woff'), /* Modern Browsers */--}}
        {{--    url({{url('fonts/Lato-Black.ttf')}}) format('truetype');--}}
        {{--    font-style: normal;--}}
        {{--    font-weight: normal;--}}
        {{--    text-rendering: optimizeLegibility;--}}
        {{--}--}}
        .title {
            font-family: "Vazirmatn", sans-serif;
            font-style: normal;
        }

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
            width: 420mm;
        }

        .main {
            position: relative;
            height: 297mm;
            width: 420mm;
        }
    </style>

</head>
<body>
@foreach($entities as $entity)
    <div class="main">
        <div style="color: #5BA2FA;height: 13mm;position: absolute;top: 7mm;left: 18mm;"><p
                    style="text-align: left;font-size: 6.2mm;line-height: 6mm">DIE
                DIGITALE {{$qrcode['back_title']}}</p></div>
        <div style="color: #1A202C;height: 19mm;position: absolute;top: 18mm;width: 65mm;left: 18mm;"><p
                    style="text-align: left;font-size: 19mm;line-height: 19mm;margin: 0">HELPCHAT</p></div>
        <div style="top: 33mm;left: 18mm; width:280mm; position: absolute;z-index: 5;"><p class="title"
                                                                                          style="text-align: left;font-size: 7mm;color: #203864;">
                {{$qrcode['front_txt_big']}}
            </p>
        </div>

        <img style="width: 70mm;top: 12mm;right: 20mm;position: absolute;"
             src="@if(file_exists(public_path($qrcode['logo_a3_top']))) {{  'data:'.mime_content_type(public_path($qrcode['logo_a3_top'])).';base64, ' .base64_encode(file_get_contents(public_path($qrcode['logo_a3_top'])))   }} @endif  ">

        <img style="width: 211mm;top: 55mm;left: 120mm;position: absolute;" src="{{ $entity->qrcode_base64 }}">
        <img style="height: 211mm; position: absolute;bottom: 0; right: 0"
             src="@if(file_exists(public_path($qrcode['nurse_a3']))) {{  'data:'.mime_content_type(public_path($qrcode['nurse_a3'])).';base64, ' .base64_encode(file_get_contents(public_path($qrcode['nurse_a3'])))   }} @endif ">
        <img style="width: 40mm;bottom: 15mm;left: 25mm; position: absolute;"
             src="@if(file_exists(public_path($qrcode['logo_a3']))) {{  'data:'.mime_content_type(public_path($qrcode['logo_a3'])).';base64, ' .base64_encode(file_get_contents(public_path($qrcode['logo_a3'])))   }} @endif  ">


        <div style="top: 70mm;left: 8mm;width:120mm;position: absolute;color: #5BA2FA;">
            <ul style="list-style-type: none;">
                <li style="margin-bottom: 10mm;">
                    <img style="height: 8mm;"
                         src="@if(file_exists(public_path("/image/qrcode/camera.png"))) {{  'data:'.mime_content_type(public_path("/image/qrcode/camera.png")).';base64, ' .base64_encode(file_get_contents(public_path("/image/qrcode/camera.png")))   }} @endif  ">
                    <span style="display:inline-block; line-height: 7mm; font-size: 6mm;margin-left: 2mm; ">Foto App öffnen</span>
                </li>
                <li style="margin-bottom: 10mm;">
                    <img style="width: 8mm;"
                         src="@if(file_exists(public_path("/image/qrcode/qrcode.png"))) {{  'data:'.mime_content_type(public_path("/image/qrcode/qrcode.png")).';base64, ' .base64_encode(file_get_contents(public_path("/image/qrcode/qrcode.png")))   }} @endif  ">
                    <span style="display:inline-block; line-height: 8mm; font-size: 6mm;margin-left: 2mm;">QR Code scannen</span>
                </li>
                <li style="margin-bottom: 10mm;">
                    <img style="width: 8mm;"
                         src="@if(file_exists(public_path("/image/qrcode/link.png"))) {{  'data:'.mime_content_type(public_path("/image/qrcode/link.png")).';base64, ' .base64_encode(file_get_contents(public_path("/image/qrcode/link.png")))   }} @endif  ">
                    <span style="display:inline-block; line-height: 8mm; font-size: 6mm;margin-left: 2mm;">Link folgen</span>
                </li>
                <li style="margin-bottom: 10mm;">
                    <img style="width: 8mm;"
                         src="@if(file_exists(public_path("/image/qrcode/checked.png"))) {{  'data:'.mime_content_type(public_path("/image/qrcode/checked.png")).';base64, ' .base64_encode(file_get_contents(public_path("/image/qrcode/checked.png")))   }} @endif  ">
                    <span style="display:inline-block; line-height: 6mm; font-size: 6mm;margin-left: 2mm;">Datenschutzhinweise akzeptieren</span>
                </li>
                <li style="margin-bottom: 10mm;">
                    <img style="width: 8mm;"
                         src="@if(file_exists(public_path("/image/qrcode/cellphone.png"))) {{  'data:'.mime_content_type(public_path("/image/qrcode/cellphone.png")).';base64, ' .base64_encode(file_get_contents(public_path("/image/qrcode/cellphone.png")))   }} @endif  ">
                    <span style="display:inline-block; line-height: 16mm; font-size: 6mm;margin-left: 2mm;">Digitale Klingel nutzen</span>
                </li>
            </ul>
        </div>
        <div style="top: 190mm;left: 8mm;width:110mm;position: absolute;color: #7F7F7F;">
            <ul style="list-style-type: none;">
                <li style="margin-bottom: 10mm;">
                    <span style="text-align: center;font-size: 6mm;">Alternativ manuell eingeben:</span>
                </li>
                <li style="margin-bottom: 10mm;">
                    <img style="width: 7mm;"
                         src="@if(file_exists(public_path("/image/qrcode/web.svg"))) {{  'data:'.mime_content_type(public_path("/image/qrcode/web.svg")).';base64, ' .base64_encode(file_get_contents(public_path("/image/qrcode/web.svg")))   }} @endif  ">
                    <span style="display:inline-block; text-align: center;font-size: 6mm;">{{ $entity->hospital->domain }}</span>
                </li>
                <li style="margin-bottom: 10mm;">
                    <img style="width: 7mm;"
                         src="@if(file_exists(public_path("/image/qrcode/lockA4.svg"))) {{  'data:'.mime_content_type(public_path("/image/qrcode/lockA4.svg")).';base64, ' .base64_encode(file_get_contents(public_path("/image/qrcode/lockA4.svg")))   }} @endif  ">
                    <span style="display:inline-block; text-align: center;font-size: 6mm;">{{ $entity->bed_id }} (PIN)</span>
                </li>
            </ul>
        </div>

        <div style="width: 420mm;bottom: 35mm;position: absolute; text-align: center;color: black; font-size: 8mm; ">
            Station: {{ $entity->department_title }}

            Zimmer: {{ $entity->room_title }}

            Bett: {{ $entity->title }}
        </div>

    </div>
@endforeach
</body>
</html>
