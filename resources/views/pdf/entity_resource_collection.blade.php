<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Collection</title>
    <style>
        body{
            font-family: sans-serif;
            font-size: 13px;
            margin: 0;
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
    @foreach($entities->chunk(3) as $entities_chunk)
        <tr>
            @foreach($entities_chunk as $entity)
                <td style="text-align: center; padding-bottom: 15px">
                     <div style="padding-top: 0;">@lang('Code'): {{ $entity->bed_id }}</div>
                    <div style="padding-top: 0px;">{{ $entity->department_title . ', ' . $entity->room_title . ', ' . $entity->title }}</div>
                    <div style="padding-top: 1px;">
                        <a href="{{ $entity->request_data }}">{{ $entity->request_data }}</a>
                    </div>
                </td>
            @endforeach
        </tr>
    @endforeach
</table>
</body>
</html>
