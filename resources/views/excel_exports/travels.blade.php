<table>
    <thead>
    <tr>
        <th style="text-align: center; background-color: #dae1e7; width: 120px; height: 30px; vertical-align: center;">
            <strong>#</strong></th>
        <th style="text-align: center; background-color: #dae1e7; width: 120px; height: 30px; vertical-align: center;">
            <strong>تاریخ درخواست</strong></th>
        <th style="text-align: center; background-color: #dae1e7; width: 120px; height: 30px; vertical-align: center;">
            <strong>ساعت رفت</strong></th>
        <th style="text-align: center; background-color: #dae1e7; width: 120px; height: 30px; vertical-align: center;">
            <strong>ساعت برگشت</strong></th>
        <th style="text-align: center; background-color: #dae1e7; width: 120px; height: 30px; vertical-align: center;">
            <strong>آدرس مبدا</strong></th>
        <th style="text-align: center; background-color: #dae1e7; width: 120px; height: 30px; vertical-align: center;">
            <strong>آدرس مقصد</strong></th>
        <th style="text-align: center; background-color: #dae1e7; width: 120px; height: 30px; vertical-align: center;">
            <strong>همراه</strong></th>

        <th style="text-align: center; background-color: #dae1e7; width: 120px; height: 30px; vertical-align: center;">
            <strong>علت</strong></th>

        <th style="text-align: center; background-color: #dae1e7; width: 120px; height: 30px; vertical-align: center;">
            <strong>کدپیگیری</strong></th>

        <th style="text-align: center; background-color: #dae1e7; width: 120px; height: 30px; vertical-align: center;">
            <strong>وضعیت</strong></th>
        <th style="text-align: center; background-color: #dae1e7; width: 120px; height: 30px; vertical-align: center;">
            <strong>کداشتراک</strong></th>
        <th style="text-align: center; background-color: #dae1e7; width: 120px; height: 30px; vertical-align: center;">
            <strong>نام نام خانوادگی مشترک </strong></th>

        <th style="text-align: center; background-color: #dae1e7; width: 120px; height: 30px; vertical-align: center;">
            <strong>موبایل مشترک </strong></th>
        <th style="text-align: center; background-color: #dae1e7; width: 120px; height: 30px; vertical-align: center;">
            <strong> نام نام خانوادگی راننده</strong></th>
        <th style="text-align: center; background-color: #dae1e7; width: 120px; height: 30px; vertical-align: center;">
            <strong> موبایل راننده</strong></th>
    </tr>
    </thead>
    <tbody>
    @foreach($travels as $travel)
        <tr>
            <td style="height: 30px; vertical-align: center; text-align: center;">
                {{ $travel->id }}
            </td>
            <td style="height: 30px; vertical-align: center; text-align: center;">
                {{ $travel->webservice_store_time_fa }}
            </td>
            <td style="height: 30px; vertical-align: center; text-align: center;">
                {{ $travel->beginning_time }}
            </td>
            <td style="height: 30px; vertical-align: center; text-align: center;">
                {{ $travel->time_return }}
            </td>

            <td style="height: 30px; vertical-align: center; text-align: center;">
                {{ $travel->beginning }}
            </td>
            <td style="height: 30px; vertical-align: center; text-align: center;">
                {{ $travel->destination }}
            </td>
            <td style="height: 30px; vertical-align: center; text-align: center;">
                {{ $travel->accompanying_person }}
            </td>
            <td style="height: 30px; vertical-align: center; text-align: center;">
                {{ $travel->reason }}
            </td>
            <td style="height: 30px; vertical-align: center; text-align: center;">
                {{ $travel->tracking_code }}
            </td>
            <td style="height: 30px; vertical-align: center; text-align: center;">
                {{ $travel->status_fa }}
            </td>

            <td style="height: 30px; vertical-align: center; text-align: center;">
                {{ optional($travel->user)->subscrip_code }}
            </td>

            <td style="height: 30px; vertical-align: center; text-align: center;">
                {{ optional($travel->user)->fullname }}
            </td>

            <td style="height: 30px; vertical-align: center; text-align: center;">
                {{ optional($travel->user)->mobile .' '.optional($travel->user)->second_mobile  }}
            </td>

            <td style="height: 30px; vertical-align: center; text-align: center;">
                {{ optional($travel->driver)->full_name }}
            </td>
            <td style="height: 30px; vertical-align: center; text-align: center;">
                {{ optional($travel->driver)->mobile }}
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
            <strong>{{ $travels->count() }}</strong>
        </td>
    </tr>


    {{-- Filter Section --}}
    <tr>
        <td style="height: 40px;"></td>
    </tr>

    @if(count(array_filter(request()->all())))
        <tr>
            <td colspan="2"
                style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">فیلترهای
                اعمال شده
            </td>
        </tr>
    @endif

    @foreach(array_filter(request()->all()) as $key => $item)
        @if($key == 'beginning')
            <tr>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">مبدا
                </td>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">{{ $item }}</td>
            </tr>
        @endif
        @if($key == 'beginning_time_from')
            <tr>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">تاریخ
                    رفت از
                </td>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">{{ $item }}</td>
            </tr>
        @endif
        @if($key == 'beginning_time_to')
            <tr>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">تاریخ
                    رفت تا
                </td>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">{{ $item }}</td>
            </tr>
        @endif

        @if($key == 'destination')
            <tr>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">مقصد
                </td>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">{{ $item }}</td>
            </tr>
        @endif
        @if($key == 'time_return_from')
            <tr>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">تاریخ
                    برگشت از
                </td>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">{{ $item }}</td>
            </tr>
        @endif
        @if($key == 'time_return_to')
            <tr>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">تاریخ
                    برگشت تا
                </td>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">{{ $item }}</td>
            </tr>
        @endif

        @if($key == 'reason')
            <tr>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">علت
                </td>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">{{json_decode($item)->name  }}</td>
            </tr>
        @endif
        @if($key == 'status')
            <tr>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">وضعیت
                </td>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">{{ json_decode($item)->name }}</td>
            </tr>
        @endif

        @if($key == 'subscrip_code')
            <tr>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">
                    کداشتراک
                </td>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">{{ $item }}</td>
            </tr>
        @endif

        @if($key == 'username')
            <tr>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">نام
                    کاربر
                </td>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">{{ $item }}</td>
            </tr>
        @endif
        @if($key == 'drivername')
            <tr>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">نام
                    راننده
                </td>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">{{ $item }}</td>
            </tr>
        @endif


    @endforeach


    </tbody>
</table>
