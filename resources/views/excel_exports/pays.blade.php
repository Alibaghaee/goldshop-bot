<table>
    <thead>
        <tr>
            <th style="text-align: center; background-color: #dae1e7; width: 18px; height: 30px; vertical-align: center;"><strong>شناسه پرداخت</strong></th>
            <th style="text-align: center; background-color: #dae1e7; width: 18px; height: 30px; vertical-align: center;"><strong>نام</strong></th>
            <th style="text-align: center; background-color: #dae1e7; width: 18px; height: 30px; vertical-align: center;"><strong>نام خانوادگی</strong></th>
            <th style="text-align: center; background-color: #dae1e7; width: 18px; height: 30px; vertical-align: center;"><strong>کد ملی</strong></th>
            <th style="text-align: center; background-color: #dae1e7; width: 25px; height: 30px; vertical-align: center;"><strong>تلفن همراه</strong></th>
            <th style="text-align: center; background-color: #dae1e7; width: 18px; height: 30px; vertical-align: center;"><strong>تلفن ثابت</strong></th>
            <th style="text-align: center; background-color: #dae1e7; width: 18px; height: 30px; vertical-align: center;"><strong>تلفن تماس ضروری</strong></th>
            <th style="text-align: center; background-color: #dae1e7; width: 18px; height: 30px; vertical-align: center;"><strong>مقطع تحصیلی</strong></th>
            <th style="text-align: center; background-color: #dae1e7; width: 18px; height: 30px; vertical-align: center;"><strong>رشته تحصیلی</strong></th>
            <th style="text-align: center; background-color: #dae1e7; width: 25px; height: 30px; vertical-align: center;"><strong>استان</strong></th>
            <th style="text-align: center; background-color: #dae1e7; width: 25px; height: 30px; vertical-align: center;"><strong>شهر</strong></th>
            <th style="text-align: center; background-color: #dae1e7; width: 18px; height: 30px; vertical-align: center;"><strong>جنسیت</strong></th>
            <th style="text-align: center; background-color: #dae1e7; width: 18px; height: 30px; vertical-align: center;"><strong>موضوع پرداخت</strong></th>
            <th style="text-align: center; background-color: #dae1e7; width: 18px; height: 30px; vertical-align: center;"><strong>تاریخ تراکنش</strong></th>
            <th style="text-align: center; background-color: #dae1e7; width: 18px; height: 30px; vertical-align: center;"><strong>مبلغ تراکنش (ریال)</strong></th>
            <th style="text-align: center; background-color: #dae1e7; width: 18px; height: 30px; vertical-align: center;"><strong>کد پیگیری تراکنش</strong></th>
            <th style="text-align: center; background-color: #dae1e7; width: 18px; height: 30px; vertical-align: center;"><strong>شناسه تراکنش</strong></th>
            <th style="text-align: center; background-color: #dae1e7; width: 18px; height: 30px; vertical-align: center;"><strong>شناسه ارجاع تراکنش</strong></th>
            <th style="text-align: center; background-color: #dae1e7; width: 18px; height: 30px; vertical-align: center;"><strong>شماره کارت تراکنش</strong></th>
            <th style="text-align: center; background-color: #dae1e7; width: 18px; height: 30px; vertical-align: center;"><strong>شرح پرداخت</strong></th>
            <th style="text-align: center; background-color: #dae1e7; width: 18px; height: 30px; vertical-align: center;"><strong>وضعیت تراکنش</strong></th>
        </tr>
    </thead>
    <tbody>
    @foreach($pays as $pay)
        <tr>
            <td style="height: 30px; vertical-align: center; text-align: center;">{{ $pay->id }}</td>
            <td style="height: 30px; vertical-align: center; text-align: center;">{{ $pay->name }}</td>
            <td style="height: 30px; vertical-align: center; text-align: center;">{{ $pay->family }}</td>
            <td style="height: 30px; vertical-align: center; text-align: center;">{{ $pay->national_code }}</td>
            <td style="height: 30px; vertical-align: center; text-align: center;">{{ $pay->mobile }}</td>
            <td style="height: 30px; vertical-align: center; text-align: center;">{{ $pay->phone }}</td>
            <td style="height: 30px; vertical-align: center; text-align: center;">{{ $pay->emergency_mobile }}</td>
            <td style="height: 30px; vertical-align: center; text-align: center;">{{ $pay->grade_title }}</td>
            <td style="height: 30px; vertical-align: center; text-align: center;">{{ $pay->field_of_study_title }}</td>
            <td style="height: 30px; vertical-align: center; text-align: center;">{{ optional($pay->province)->name }}</td>
            <td style="height: 30px; vertical-align: center; text-align: center;">{{ optional($pay->city)->name }}</td>
            <td style="height: 30px; vertical-align: center; text-align: center;">{{ $pay->gender_title }}</td>
            <td style="height: 30px; vertical-align: center; text-align: center;">{{ $pay->payment_subject_title }}</td>
            <td style="height: 30px; vertical-align: center; text-align: center;">{{ $pay->created_at_fa }}</td>
            <td style="height: 30px; vertical-align: center; text-align: center;">{{ $pay->price }}</td>
            <td style="height: 30px; vertical-align: center; text-align: center;">{{ $pay->tracking_code }}</td>
            <td style="height: 30px; vertical-align: center; text-align: center;">{{ $pay->transaction_id }}</td>
            <td style="height: 30px; vertical-align: center; text-align: center;">{{ $pay->refrence_id }}</td>
            <td style="height: 30px; vertical-align: center; text-align: center;">{{ $pay->card_number }}</td>
            <td style="height: 30px; vertical-align: center; text-align: center;">{{ $pay->description }}</td>
            <td style="height: 30px; vertical-align: center; text-align: center; background-color: {{ $pay->payed == 0 ? '#f66d9b' : '#38c172' }};">{{ $pay->payed_title }}</td>
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
                <strong>{{ $pays->count() }}</strong>
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
        @if($key == 'name')
            <tr>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">نام</td>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">{{ $item }}</td>
            </tr>
        @endif
        @if($key == 'family')
            <tr>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">نام خانوادگی</td>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">{{ $item }}</td>
            </tr>
        @endif
        @if($key == 'national_code')
            <tr>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">کد ملی</td>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">{{ $item }}</td>
            </tr>
        @endif
        @if($key == 'mobile')
            <tr>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">موبایل</td>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">{{ $item }}</td>
            </tr>
        @endif
        @if($key == 'phone')
            <tr>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">تلفن</td>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">{{ $item }}</td>
            </tr>
        @endif
        @if($key == 'emergency_mobile')
            <tr>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">تلفن تماس ضروری</td>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">{{ $item }}</td>
            </tr>
        @endif
        @if($key == 'grade')
            <tr>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">مقطع تحصیلی </td>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">{{ json_decode($item)->name }}</td>
            </tr>
        @endif
        @if($key == 'field_of_study')
            <tr>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">رشته تحصیلی </td>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">{{ json_decode($item)->name }}</td>
            </tr>
        @endif
        @if($key == 'province')
            <tr>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">استان </td>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">{{ json_decode($item)->name }}</td>
            </tr>
        @endif
        @if($key == 'city')
            <tr>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">شهر </td>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">{{ json_decode($item)->name }}</td>
            </tr>
        @endif
        @if($key == 'gender')
            <tr>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">جنسیت </td>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">{{ json_decode($item)->name }}</td>
            </tr>
        @endif
        @if($key == 'payment_subject')
            <tr>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">موضوع پرداخت </td>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">{{ json_decode($item)->name }}</td>
            </tr>
        @endif
        @if($key == 'price')
            <tr>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">مبلغ</td>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">{{ $item }}</td>
            </tr>
        @endif
        @if($key == 'tracking_code')
            <tr>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">کد پیگیری</td>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">{{ $item }}</td>
            </tr>
        @endif
        @if($key == 'transaction_id')
            <tr>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">شناسه تراکنش</td>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">{{ $item }}</td>
            </tr>
        @endif
        @if($key == 'card_number')
            <tr>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">شماره کارت</td>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">{{ $item }}</td>
            </tr>
        @endif
        @if($key == 'description')
            <tr>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">شرح پرداخت</td>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">{{ $item }}</td>
            </tr>
        @endif
        @if($key == 'payed')
            <tr>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">وضعیت پرداخت کل</td>
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