<table>
    <thead>
        <tr>
            <th style="text-align: center; background-color: #dae1e7; width: 220px; height: 30px; vertical-align: center;"><strong>شناسه</strong></th>
            <th style="text-align: center; background-color: #dae1e7; width: 150px; height: 30px; vertical-align: center;"><strong>موبایل</strong></th>
            <th style="text-align: center; background-color: #dae1e7; width: 150px; height: 30px; vertical-align: center;"><strong>متن پیامک</strong></th>
            <th style="text-align: center; background-color: #dae1e7; width: 150px; height: 30px; vertical-align: center;"><strong>سر شماره</strong></th>
            <th style="text-align: center; background-color: #dae1e7; width: 150px; height: 30px; vertical-align: center;"><strong>شناسه پیامک</strong></th>
            <th style="text-align: center; background-color: #dae1e7; width: 150px; height: 30px; vertical-align: center;"><strong>وضعیت پیامک</strong></th>
            <th style="text-align: center; background-color: #dae1e7; width: 150px; height: 30px; vertical-align: center;"><strong>وضعیت کد</strong></th>
            {{-- <th style="text-align: center; background-color: #dae1e7; width: 150px; height: 30px; vertical-align: center;"><strong>محصول</strong></th> --}}
            {{-- <th style="text-align: center; background-color: #dae1e7; width: 150px; height: 30px; vertical-align: center;"><strong>دسته محصول</strong></th> --}}
            {{-- <th style="text-align: center; background-color: #dae1e7; width: 150px; height: 30px; vertical-align: center;"><strong>وضعیت حذف</strong></th> --}}
            <th style="text-align: center; background-color: #dae1e7; width: 150px; height: 30px; vertical-align: center;"><strong>تاریخ ایجاد</strong></th>
            <th style="text-align: center; background-color: #dae1e7; width: 150px; height: 30px; vertical-align: center;"><strong>تاریخ به روز رسانی</strong></th>
        </tr>
    </thead>
    <tbody>
    @foreach($sms_receives as $sms_receive)
        <tr>
            <td style="height: 30px; vertical-align: center; text-align: center;"> 
                {{ $sms_receive->id }}
            </td>
            <td style="height: 30px; vertical-align: center; text-align: center;"> 
                {{ $sms_receive->sender }}
            </td>
            <td style="height: 30px; vertical-align: center; text-align: center;"> 
                {{ $sms_receive->note }}
            </td>
            <td style="height: 30px; vertical-align: center; text-align: center;"> 
                {{ $sms_receive->receiver }}
            </td>
            <td style="height: 30px; vertical-align: center; text-align: center;"> 
                {{ $sms_receive->sms_id }}
            </td>
            <td style="height: 30px; vertical-align: center; text-align: center;"> 
                {{ $sms_receive->status_title }}
            </td>
            <td style="height: 30px; vertical-align: center; text-align: center;"> 
                {{ $sms_receive->code_state_title }}
            </td>
            {{-- <td style="height: 30px; vertical-align: center; text-align: center;"> 
                {{ $sms_receive->product }}
            </td> --}}
            {{-- <td style="height: 30px; vertical-align: center; text-align: center;"> 
                {{ $sms_receive->product_catgory }}
            </td> --}}
            {{-- <td style="height: 30px; vertical-align: center; text-align: center;"> 
                {{ $sms_receive->ignored }}
            </td> --}}
            <td style="height: 30px; vertical-align: center; text-align: center;"> 
                {{ $sms_receive->created_at_fa }}
            </td>
            <td style="height: 30px; vertical-align: center; text-align: center;"> 
                {{ $sms_receive->updated_at_fa }}
            </td>
            
        </tr>
        
    @endforeach
 

        {{-- Filter Section --}}
        <tr>
            <td style="height: 40px;"></td>
        </tr>

        @if(count(array_filter(request()->all())))
            <tr>
                <td colspan="2" style="background-color: #f2d024; width: 150px; height: 40px; vertical-align: center; text-align: center;">فیلترهای اعمال شده</td>
            </tr>
        @endif

        @foreach(array_filter(request()->all()) as $key => $item)
        @if($key == 'id')
            <tr>
                <td style="background-color: #f2d024; width: 150px; height: 40px; vertical-align: center; text-align: center;">شناسه</td>
                <td style="background-color: #f2d024; width: 150px; height: 40px; vertical-align: center; text-align: center;">{{ $item }}</td>
            </tr>
        @endif
        @if($key == 'note')
            <tr>
                <td style="background-color: #f2d024; width: 150px; height: 40px; vertical-align: center; text-align: center;">متن پیامک</td>
                <td style="background-color: #f2d024; width: 150px; height: 40px; vertical-align: center; text-align: center;">{{ $item }}</td>
            </tr>
        @endif
        @if($key == 'sender')
            <tr>
                <td style="background-color: #f2d024; width: 150px; height: 40px; vertical-align: center; text-align: center;">موبایل</td>
                <td style="background-color: #f2d024; width: 150px; height: 40px; vertical-align: center; text-align: center;">{{ $item }}</td>
            </tr>
        @endif
        @if($key == 'receiver')
            <tr>
                <td style="background-color: #f2d024; width: 150px; height: 40px; vertical-align: center; text-align: center;">سر شماره</td>
                <td style="background-color: #f2d024; width: 150px; height: 40px; vertical-align: center; text-align: center;">{{ $item }}</td>
            </tr>
        @endif
        @if($key == 'sms_id')
            <tr>
                <td style="background-color: #f2d024; width: 150px; height: 40px; vertical-align: center; text-align: center;">شناسه پیامک</td>
                <td style="background-color: #f2d024; width: 150px; height: 40px; vertical-align: center; text-align: center;">{{ $item }}</td>
            </tr>
        @endif
        @if($key == 'status')
            <tr>
                <td style="background-color: #f2d024; width: 150px; height: 40px; vertical-align: center; text-align: center;">وضعیت پیامک</td>
                <td style="background-color: #f2d024; width: 150px; height: 40px; vertical-align: center; text-align: center;">{{ $item }}</td>
            </tr>
        @endif
        @if($key == 'code_state')
            <tr>
                <td style="background-color: #f2d024; width: 150px; height: 40px; vertical-align: center; text-align: center;">وضعیت کد</td>
                <td style="background-color: #f2d024; width: 150px; height: 40px; vertical-align: center; text-align: center;">{{ $item }}</td>
            </tr>
        @endif
        @if($key == 'product')
            <tr>
                <td style="background-color: #f2d024; width: 150px; height: 40px; vertical-align: center; text-align: center;">محصول</td>
                <td style="background-color: #f2d024; width: 150px; height: 40px; vertical-align: center; text-align: center;">{{ $item }}</td>
            </tr>
        @endif
        @if($key == 'product_catgory')
            <tr>
                <td style="background-color: #f2d024; width: 150px; height: 40px; vertical-align: center; text-align: center;">دسته محصول</td>
                <td style="background-color: #f2d024; width: 150px; height: 40px; vertical-align: center; text-align: center;">{{ $item }}</td>
            </tr>
        @endif
        @if($key == 'ignored')
            <tr>
                <td style="background-color: #f2d024; width: 150px; height: 40px; vertical-align: center; text-align: center;">وضعیت حذف</td>
                <td style="background-color: #f2d024; width: 150px; height: 40px; vertical-align: center; text-align: center;">{{ $item }}</td>
            </tr>
        @endif
        @if($key == 'created_at_min')
            <tr>
                <td style="background-color: #f2d024; width: 150px; height: 40px; vertical-align: center; text-align: center;">تاریخ از</td>
                <td style="background-color: #f2d024; width: 150px; height: 40px; vertical-align: center; text-align: center;">
                    {{ $item ? \Morilog\Jalali\Jalalian::fromDateTime($item)->format('Y/m/d H:i:s') : '' }}
                </td>
            </tr>
        @endif
        @if($key == 'created_at_max')
            <tr>
                <td style="background-color: #f2d024; width: 150px; height: 40px; vertical-align: center; text-align: center;">تاریخ تا</td>
                <td style="background-color: #f2d024; width: 150px; height: 40px; vertical-align: center; text-align: center;">
                    {{ $item ? \Morilog\Jalali\Jalalian::fromDateTime($item)->format('Y/m/d H:i:s') : '' }}
                </td>
            </tr>
        @endif
        
        @endforeach



    </tbody>
</table>