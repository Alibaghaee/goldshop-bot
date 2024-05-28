<table>
    <thead>
        <tr>
            <th style="text-align: center; background-color: #dae1e7; width: 18px; height: 30px; vertical-align: center;"><strong>شماره کاربر</strong></th>
            <th style="text-align: center; background-color: #dae1e7; width: 18px; height: 30px; vertical-align: center;"><strong>نام و نام خانوادگی</strong></th>
            <th style="text-align: center; background-color: #dae1e7; width: 18px; height: 30px; vertical-align: center;"><strong>نوع معامله</strong></th>
            <th style="text-align: center; background-color: #dae1e7; width: 18px; height: 30px; vertical-align: center;"><strong>جنس معامله</strong></th>
            <th style="text-align: center; background-color: #dae1e7; width: 18px; height: 30px; vertical-align: center;"><strong>قیمت</strong></th>
            <th style="text-align: center; background-color: #dae1e7; width: 18px; height: 30px; vertical-align: center;"><strong>تعداد</strong></th>
            <th style="text-align: center; background-color: #dae1e7; width: 18px; height: 30px; vertical-align: center;"><strong>وزن</strong></th>
            <th style="text-align: center; background-color: #dae1e7; width: 18px; height: 30px; vertical-align: center;"><strong>تاریخ</strong></th>


        </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr>
            <td style="height: 30px; vertical-align: center; text-align: center;">
                {{ $user->id }}
            </td>
            <td style="height: 30px; vertical-align: center; text-align: center;">
                {{ $user->subscrip_code }}
            </td>
            <td style="height: 30px; vertical-align: center; text-align: center;">
                {{ $user->name }}
            </td>
            <td style="height: 30px; vertical-align: center; text-align: center;">
                {{ $user->family }}
            </td>

            <td style="height: 30px; vertical-align: center; text-align: center;">
                {{ $user->mobile }}
            </td>

            <td style="height: 30px; vertical-align: center; text-align: center;">
                {{ $user->second_mobile }}
            </td>
            <td style="height: 30px; vertical-align: center; text-align: center;">
                {{ $user->gender_title }}
            </td>

            <td style="height: 30px; vertical-align: center; text-align: center;">
                {{ optional($user->province)->name }}
            </td>
            <td style="height: 30px; vertical-align: center; text-align: center;">
                {{ optional($user->city)->name }}
            </td>
            <td style="height: 30px; vertical-align: center; text-align: center;">
                {{ $user->total_purchases_price }}
            </td>
            <td style="height: 30px; vertical-align: center; text-align: center;">
                {{ $user->last_successful_tracking_code }}
            </td>
            <td style="height: 30px; vertical-align: center; text-align: center;">
                {{ $user->created_at_fa }}
            </td>
            <td style="height: 30px; vertical-align: center; text-align: center;">
                {{ $user->updated_at_fa }}
            </td>
            <td style="height: 30px; vertical-align: center; text-align: center;">
                {{ $user->address }}
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
                <strong>{{ $users->count() }}</strong>
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
        @if($key == 'payment_filters_status')
            <tr>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">وضعیت پرداخت</td>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">{{ json_decode($item)->name }}</td>
            </tr>
        @endif
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
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">تلفن همراه</td>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">{{ $item }}</td>
            </tr>
        @endif
        @if($key == 'phone')
            <tr>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">تلفن ثابت</td>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">{{ $item }}</td>
            </tr>
        @endif
        @if($key == 'emergency_mobile')
            <tr>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">تلفن تماس ضروری</td>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">{{ $item }}</td>
            </tr>
        @endif
        @if($key == 'gender')
            <tr>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">جنسیت</td>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">{{ json_decode($item)->name }}</td>
            </tr>
        @endif
        @if($key == 'grade')
            <tr>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">مقطع تحصیلی</td>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">{{ json_decode($item)->name }}</td>
            </tr>
        @endif
        @if($key == 'field_of_study')
            <tr>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">رشته تحصیلی</td>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">{{ json_decode($item)->name }}</td>
            </tr>
        @endif
        @if($key == 'field')
            <tr>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">رشته تحصیلی</td>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">{{ json_decode($item)->name }}</td>
            </tr>
        @endif
        @if($key == 'province')
            <tr>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">استان</td>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">{{ json_decode($item)->name }}</td>
            </tr>
        @endif
        @if($key == 'city')
            <tr>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">شهر</td>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">{{ json_decode($item)->name }}</td>
            </tr>
        @endif
        @if($key == 'created_at_min')
            <tr>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">تاریخ ثبت کاربر از</td>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">
                    {{ Morilog\Jalali\Jalalian::fromDateTime($item)->format('Y/m/d') }}
                </td>
            </tr>
        @endif
        @if($key == 'created_at_max')
            <tr>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">تاریخ ثبت کاربر تا</td>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">
                    {{ Morilog\Jalali\Jalalian::fromDateTime($item)->format('Y/m/d') }}
                </td>
            </tr>
        @endif
        @if($key == 'payment_filters_status')
            <tr>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">وضعیت پرداخت</td>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">{{ json_decode($item)->name }}</td>
            </tr>
        @endif
        @if($key == 'payment_created_at_min')
            <tr>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">تاریخ تراکنش از</td>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">
                    {{ Morilog\Jalali\Jalalian::fromDateTime($item)->format('Y/m/d') }}
                </td>
            </tr>
        @endif
        @if($key == 'payment_created_at_max')
            <tr>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">تاریخ تراکنش تا</td>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">
                    {{ Morilog\Jalali\Jalalian::fromDateTime($item)->format('Y/m/d') }}
                </td>
            </tr>
        @endif
        @endforeach



    </tbody>
</table>
