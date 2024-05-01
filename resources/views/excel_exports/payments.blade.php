<table>
    <thead>
        <tr>
            <th style="text-align: center; background-color: #dae1e7; width: 18px; height: 30px; vertical-align: center;"><strong>شناسه پرداخت</strong></th>
            <th style="text-align: center; background-color: #dae1e7; width: 18px; height: 30px; vertical-align: center;"><strong>عنوان تراکنش</strong></th>
            <th style="text-align: center; background-color: #dae1e7; width: 18px; height: 30px; vertical-align: center;"><strong>توضیح تراکنش</strong></th>
            <th style="text-align: center; background-color: #dae1e7; width: 18px; height: 30px; vertical-align: center;"><strong>مبلغ تراکنش (ریال)</strong></th>
            <th style="text-align: center; background-color: #dae1e7; width: 18px; height: 30px; vertical-align: center;"><strong>وضعیت تراکنش</strong></th>
            <th style="text-align: center; background-color: #dae1e7; width: 18px; height: 30px; vertical-align: center;"><strong>شناسه تراکنش</strong></th>
            <th style="text-align: center; background-color: #dae1e7; width: 18px; height: 30px; vertical-align: center;"><strong>شناسه ارجاع تراکنش</strong></th>
            <th style="text-align: center; background-color: #dae1e7; width: 18px; height: 30px; vertical-align: center;"><strong>کد پیگیری تراکنش</strong></th>
            <th style="text-align: center; background-color: #dae1e7; width: 18px; height: 30px; vertical-align: center;"><strong>شماره کارت تراکنش</strong></th>
            <th style="text-align: center; background-color: #dae1e7; width: 18px; height: 30px; vertical-align: center;"><strong>تاریخ تراکنش</strong></th>
            <th style="text-align: center; background-color: #dae1e7; width: 18px; height: 30px; vertical-align: center;"><strong>شناسه کاربر</strong></th>
            <th style="text-align: center; background-color: #dae1e7; width: 18px; height: 30px; vertical-align: center;"><strong>نام</strong></th>
            <th style="text-align: center; background-color: #dae1e7; width: 18px; height: 30px; vertical-align: center;"><strong>نام خانوادگی</strong></th>
            <th style="text-align: center; background-color: #dae1e7; width: 18px; height: 30px; vertical-align: center;"><strong>کد ملی</strong></th>
            <th style="text-align: center; background-color: #dae1e7; width: 25px; height: 30px; vertical-align: center;"><strong>تلفن همراه</strong></th>
            <th style="text-align: center; background-color: #dae1e7; width: 18px; height: 30px; vertical-align: center;"><strong>تلفن ثابت</strong></th>
            <th style="text-align: center; background-color: #dae1e7; width: 18px; height: 30px; vertical-align: center;"><strong>تلفن تماس ضروری</strong></th>
            <th style="text-align: center; background-color: #dae1e7; width: 18px; height: 30px; vertical-align: center;"><strong>جنسیت</strong></th>
            <th style="text-align: center; background-color: #dae1e7; width: 18px; height: 30px; vertical-align: center;"><strong>مقطع تحصیلی</strong></th>
            <th style="text-align: center; background-color: #dae1e7; width: 18px; height: 30px; vertical-align: center;"><strong>رشته تحصیلی</strong></th>
            <th style="text-align: center; background-color: #dae1e7; width: 18px; height: 30px; vertical-align: center;"><strong>رشته اصلی در کنکورسراسری</strong></th>
            <th style="text-align: center; background-color: #dae1e7; width: 25px; height: 30px; vertical-align: center;"><strong>استان</strong></th>
            <th style="text-align: center; background-color: #dae1e7; width: 25px; height: 30px; vertical-align: center;"><strong>شهر</strong></th>
            <th style="text-align: center; background-color: #dae1e7; width: 18px; height: 30px; vertical-align: center;"><strong>تاریخ ثبت کاربر</strong></th>
            <th style="text-align: center; background-color: #dae1e7; width: 18px; height: 30px; vertical-align: center;"><strong>آدرس</strong></th>
        </tr>
    </thead>
    <tbody>
    @foreach($payments as $payment)
        <tr>
            <td style="height: 30px; vertical-align: center; text-align: center;"> 
                {{ $payment->id }}
            </td>
            <td style="height: 30px; vertical-align: center; text-align: center;"> 
                {{ $payment->title }}
            </td>
            <td style="height: 30px; vertical-align: center; text-align: center;"> 
                {{ $payment->description }}
            </td>
            <td style="height: 30px; vertical-align: center; text-align: center;"> 
                {{ $payment->price }}
            </td>
            @if($payment->payed == 0)
            <td style="height: 30px; vertical-align: center; text-align: center; background-color: #f66d9b;"> 
                {{ $payment->payed_title }}
            </td>
            @else
            <td style="height: 30px; vertical-align: center; text-align: center; background-color: #38c172;"> 
                {{ $payment->payed_title }}
            </td>
            @endif
            <td style="height: 30px; vertical-align: center; text-align: center;"> 
                {{ $payment->transaction_id }}
            </td>
            <td style="height: 30px; vertical-align: center; text-align: center;"> 
                {{ $payment->refrence_id }}
            </td>
            <td style="height: 30px; vertical-align: center; text-align: center;"> 
                {{ $payment->tracking_code }}
            </td>
            <td style="height: 30px; vertical-align: center; text-align: center;"> 
                {{ $payment->card_number }}
            </td>
            <td style="height: 30px; vertical-align: center; text-align: center;"> 
                {{ $payment->created_at_fa }}
            </td>

            <td style="height: 30px; vertical-align: center; text-align: center;"> 
                {{ optional($payment->user)->id }}
            </td>
            <td style="height: 30px; vertical-align: center; text-align: center;">
                {{ optional($payment->user)->name }}
            </td>
            <td style="height: 30px; vertical-align: center; text-align: center;">
                {{ optional($payment->user)->family }}
            </td>
            <td style="height: 30px; vertical-align: center; text-align: center;"> 
                {{ optional($payment->user)->national_code }}
            </td>
            <td style="height: 30px; vertical-align: center; text-align: center;">
                {{ optional($payment->user)->mobile }}
            </td>
            <td style="height: 30px; vertical-align: center; text-align: center;">
                {{ optional($payment->user)->phone }}
            </td>
            <td style="height: 30px; vertical-align: center; text-align: center;">
                {{ optional($payment->user)->emergency_mobile }}
            </td>
            <td style="height: 30px; vertical-align: center; text-align: center;"> 
                {{ optional($payment->user)->gender_title }}
            </td>
            <td style="height: 30px; vertical-align: center; text-align: center;">
                {{ optional($payment->user)->grade_title }}
            </td>
            <td style="height: 30px; vertical-align: center; text-align: center;">
                {{ optional($payment->user)->field_of_study_title }}
            </td>
            <td style="height: 30px; vertical-align: center; text-align: center;">
                {{ optional($payment->user)->field_title }}
            </td>
            <td style="height: 30px; vertical-align: center; text-align: center;">
                {{ optional(optional($payment->user)->province)->name }}
            </td>
            <td style="height: 30px; vertical-align: center; text-align: center;">
                {{ optional(optional($payment->user)->city)->name }}
            </td>
            <td style="height: 30px; vertical-align: center; text-align: center;">
                {{ optional($payment->user)->created_at_fa }}
            </td>
            <td style="height: 30px; vertical-align: center; text-align: center;">
                {{ optional($payment->user)->address }}
            </td>
        </tr>
    @endforeach
        
        {{-- Summery Section --}}
        <tr>
            <td style="height: 40px;"></td>
        </tr>
        
        <tr>
            <td style="background-color: #dae1e7; height: 40px; vertical-align: center; text-align: center;">
                <strong>تعداد </strong>
            </td>
            <td style="background-color: #dae1e7; height: 40px; vertical-align: center; text-align: center;">
                <strong>{{ $payments->count() }}</strong>
            </td>
        </tr>


        

        {{-- Filter Section --}}
        <tr>
            <td style="height: 40px;"></td>
        </tr>

        @if(count(array_filter(request()->all())))
            <tr>
                <td colspan="2" style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">فیلترهای اعمال شده</td>
            </tr>
        @endif

        @foreach(array_filter(request()->all()) as $key => $item)
        @if($key == 'title')
            <tr>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">عنوان</td>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">{{ $item }}</td>
            </tr>
        @endif
        @if($key == 'description')
            <tr>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">توضیحات</td>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">{{ $item }}</td>
            </tr>
        @endif
        @if($key == 'price')
            <tr>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">مبلغ</td>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">{{ $item }}</td>
            </tr>
        @endif
        @if($key == 'user')
            <tr>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">پرداخت کننده</td>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">{{ json_decode($item)->name }}</td>
            </tr>
        @endif
        @if($key == 'tracking_code')
            <tr>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">کد پیگیری</td>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">{{ $item }}</td>
            </tr>
        @endif
        @if($key == 'card_number')
            <tr>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">شماره کارت</td>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">{{ $item }}</td>
            </tr>
        @endif
        @if($key == 'payed')
            <tr>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">وضعیت پرداخت</td>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">{{ $item }}</td>
            </tr>
        @endif
        @if($key == 'created_at_min')
            <tr>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">از تاریخ</td>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">
                    {{ Morilog\Jalali\Jalalian::fromDateTime($item)->format('Y/m/d') }}
                </td>
            </tr>
        @endif
        @if($key == 'created_at_max')
            <tr>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">تا تاریخ</td>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">
                    {{ Morilog\Jalali\Jalalian::fromDateTime($item)->format('Y/m/d') }}
                </td>
            </tr>
        @endif
        @endforeach



    </tbody>
</table>