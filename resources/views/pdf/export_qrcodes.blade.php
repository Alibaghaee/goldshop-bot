<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1, maximum-scale=1, viewport-fit=cover, shrink-to-fit=no">

    <title>QR Codes</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@100..900&display=swap" rel="stylesheet">
    <style type="text/css">
        html {
            -webkit-print-color-adjust: exact;
        }

        html {
            margin: 0;
            padding: 0;
        }

        body {

            margin: 0 0 0 0;
            padding: 0 0 0 0;
            width: 297mm;
            height: 210mm;
        }

        .main { position: relative;  width: 297mm; height: 210mm;}

        .one {position: absolute; background: {{$qrcode['bg_color']}}; width: 85mm; height: 150mm; top: 20mm; left: 10mm;}

        .two {position: absolute; background: {{$qrcode['bg_color']}}; width: 85mm; height: 150mm; top: 20mm; left: 105mm;}

        .three {position: absolute; background: {{$qrcode['bg_color']}}; width: 85mm; height: 150mm; top: 20mm; left: 200mm;}




    </style>

    <style type="text/css">
        /** { font-family: 'DejaVu Sans',serif; }*/
        /*@font-face {*/
        /*    font-family: Nazanin, sans-serif;*/
        /*    font-style: normal;*/
        /*    font-weight: normal;*/
        /*    src: url('http://localhost:8000/fonts/nazanin/B-NAZANIN.TTF') format('truetype');*/
        /*}*/
        body {
            margin: 0;
            padding: 0;
            width: 100%;
            font-family: "Vazirmatn", sans-serif;
            /*font-optical-sizing: auto;*/


        }
    </style>
</head>
<body>
@php
    $classes[1] = new stdClass();
    $classes[2] = new stdClass();
    $classes[3] = new stdClass();
    $classes[1]->front = 'one';
    $classes[1]->back = 'three';
    $classes[2]->front = 'two';
    $classes[2]->back = 'two';
    $classes[3]->front = 'three';
    $classes[3]->back = 'one';

@endphp


@foreach($entities->chunk(3) as $entities_chunk)
    @php
        $i =0;
    @endphp
    <div class="main">
        @foreach($entities_chunk as $entity)
            @php
                $i++;
            @endphp
            <div class="{{$classes[$i]->front}}">
                <div style="background-color: #322f91;color: whitesmoke;height: 15mm;position: absolute;top: 10mm;width: 65mm;"> <p class="title" style="text-align: center;font-size: 5mm;line-height: 9mm;margin: 0">{{$qrcode['front_title']}} </p></div>
                <div style="background-color: whitesmoke;color: #322f91;height: 15mm;position: absolute;top: 24mm;width: 65mm;left: 10mm;"> <p class="title" style="text-align: center;font-size: 10mm;line-height: 11mm;margin: 0">HELPCHAT</p></div>
                <img  style="width: 50mm;top: 45mm;left: 12mm;position: absolute;" src="{{ $entity->qrcode_base64 }}">
                <img  style="width: 50mm; position: absolute;bottom: 0; right: 0" src="@if(file_exists(public_path($qrcode['nurse']))) {{ 'data:'. mime_content_type(public_path($qrcode['nurse'])).';base64, ' .base64_encode(file_get_contents(public_path($qrcode['nurse'])))  }} @endif ">
                <img  style="width: 15mm;bottom: 2mm;left: 25mm; position: absolute;" src="@if(file_exists(public_path($qrcode['logo']))) {{ 'data:'. mime_content_type(public_path($qrcode['logo'])).';base64, ' .base64_encode(file_get_contents(public_path($qrcode['logo'])))  }} @endif  ">
                <div style="top: 95mm;left: 12mm;width:30mm;position: absolute;"><p style="text-align: left;font-size: 4mm;color: whitesmoke;">
                        {{$qrcode['front_txt']}}                        </p>
                </div>
            </div>
        @endforeach
    </div>
    @php
        $i =0;
    @endphp
    <div class="main">
        @foreach($entities_chunk as $entity)
            @php
                $i++;
            @endphp
            <div class="{{$classes[$i]->back}}">
                <div style="background-color: whitesmoke;color: #322f91;height: 13mm;position: absolute;top: 13mm;width: 55mm;left: 15mm;z-index: 5"> <p class="title" style="text-align: center;font-size: 5mm;line-height: 4mm">DIE DIGITALE</p></div>
                <div style="background-color: #322f91;color: whitesmoke;height: 15mm;position: absolute;top: 24mm;width: 75mm;"> <p class="title" style="text-align: center;font-size: 5mm">{{$qrcode['back_title']}}</p></div>
                <img  style="width: 10mm;top: 40mm;left: 20mm; position: absolute;" src="@if(file_exists(public_path("/image/qrcode/bed.svg"))) {{ 'data:'. mime_content_type(public_path("/image/qrcode/bed.svg")).';base64, ' .base64_encode(file_get_contents(public_path("/image/qrcode/bed.svg")))  }} @endif  ">
                <div style="top: 37mm;height:5mm;left: 32mm;position: absolute;"><p style="text-align: center;font-size: 4.5mm;color: whitesmoke;">{{ $entity->room_title . ', ' . $entity->title }}</p></div>
                <img  style="width: 45mm;top: 50mm;left: 20mm;position: absolute;" src="{{ $entity->qrcode_base64 }}">
                <img  style="width: 7mm;top: 96mm;left: 18mm; position: absolute;" src="@if(file_exists(public_path("/image/qrcode/lock.svg"))) {{ 'data:'. mime_content_type(public_path("/image/qrcode/lock.svg")).';base64, ' .base64_encode(file_get_contents(public_path("/image/qrcode/lock.svg")))  }} @endif  ">
                <div style="top: 91mm;height:5mm;left: 26mm;position: absolute;"><p style="text-align: center;font-size: 4.5mm;color: whitesmoke;">{{ $entity->bed_id }} (PIN)</p></div>
                <div style="top: 102mm;left: 12mm;width:65mm;position: absolute;"><p style="text-align: left;font-size: 3.5mm;color: whitesmoke;">
                        @php
                            $qrcode['back_txt'] = str_replace('$domain',$entity->hospital->domain,$qrcode['back_txt']);
                        @endphp
                        {!! $qrcode['back_txt'] !!}
                    </p></div>
                <img  style="width: 15mm;bottom: 2mm;left: 35mm; position: absolute;" src="@if(file_exists(public_path($qrcode['logo']))) {{ 'data:'. mime_content_type(public_path($qrcode['logo'])).';base64, ' .base64_encode(file_get_contents(public_path($qrcode['logo'])))  }} @endif  ">
            </div>
        @endforeach
    </div>
{{--            @break--}}
@endforeach
</body>

</html>
