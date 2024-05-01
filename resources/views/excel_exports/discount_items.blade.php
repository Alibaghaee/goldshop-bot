<table>
    <thead>
        <tr>
            <th style="text-align: center; background-color: #dae1e7; width: 120px; height: 30px; vertical-align: center;"><strong>کد</strong></th>
            <th style="text-align: center; background-color: #dae1e7; width: 120px; height: 30px; vertical-align: center;"><strong>وضعیت کد</strong></th>
        </tr>
    </thead>
    <tbody>
    @foreach($discount_items as $discount_item)
        <tr>
            <td style="height: 30px; vertical-align: center; text-align: center;"> 
                {{ $discount_item->code }}
            </td>
            <td style="height: 30px; vertical-align: center; text-align: center;">
                {{ $discount_item->is_over_max_uses ? 'غیر معتبر' : 'معتبر' }}
            </td>
        </tr>
    @endforeach
        
        {{-- Filter Section --}}
        <tr>
            <td style="height: 40px;"></td>
        </tr>

        @if(count(array_filter(request()->all())))
            <tr>
                <td colspan="2" style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">فیلترهای اعمال شده:</td>
            </tr>
        @endif

        @foreach(array_filter(request()->all()) as $key => $item)
        @if($key == 'code')
            <tr>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">کد تخفیف:</td>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">{{ $item }}</td>
            </tr>
        @endif
        @if($key == 'valid')
            <tr>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">وضعیت کد:</td>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">{{ $item }}</td>
            </tr>
        @endif
        @endforeach



    </tbody>
</table>