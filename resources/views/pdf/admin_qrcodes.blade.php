<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta charset="utf-8">
    <title>QR Codes</title>
    <style>
        @font-face {
            font-family: "iranSans";
            font-style: normal;
            font-weight: 200;
            src: url("fonts/Sans4fran3.eot") format("eot"),
            url("fonts/Sans4fran3.ttf") format("ttf"),
            url("fonts/Sansa4fran3.woff") format("woff");
        }

        body{
            font-family:  "iranSans", sans-serif, serif;
            font-size: 13px;
        }
        .img-w {
            width: 14.5rem;
        }
        .img-m {
          margin-top: 3px;
          margin-bottom: 3px;
        }
        @page{
            margin: 0;
        }
    </style>


</head>
<body>
    <table>
        @foreach($admins->chunk(3) as $admins_chunk)
            <tr>
                @foreach($admins_chunk as $admin)
                <td style="text-align: center; padding-bottom: 15px;">
                    <img class="mg-m" style="width: 70mm; height: 67.7mm;" src="{{ $admin->qrcode_base64 }}">
                    <div style="padding-top: 0px;">{{ $admin->fullname }}</div>
                </td>
                @endforeach
            </tr>
        @endforeach
    </table>
</body>
</html>