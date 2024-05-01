<table>
    <thead>
        <tr>
            <th style="text-align: center; background-color: #dae1e7; width: 18px; height: 30px; vertical-align: center;"><strong>شناسه</strong></th>
            <th style="text-align: center; background-color: #dae1e7; width: 18px; height: 30px; vertical-align: center;"><strong>ایجاد کننده</strong></th>
            <th style="text-align: center; background-color: #dae1e7; width: 18px; height: 30px; vertical-align: center;"><strong>دریافت کننده</strong></th>
            <th style="text-align: center; background-color: #dae1e7; width: 25px; height: 30px; vertical-align: center;"><strong>وظیفه</strong></th>
            <th style="text-align: center; background-color: #dae1e7; width: 18px; height: 30px; vertical-align: center;"><strong>تاریخ</strong></th>
            <th style="text-align: center; background-color: #dae1e7; width: 18px; height: 30px; vertical-align: center;"><strong>مهلت</strong></th>
            <th style="text-align: center; background-color: #dae1e7; width: 18px; height: 30px; vertical-align: center;"><strong>وضعیت گزارش</strong></th>
            <th style="text-align: center; background-color: #dae1e7; width: 18px; height: 30px; vertical-align: center;"><strong>زمان گزارش</strong></th>
            <th style="text-align: center; background-color: #dae1e7; width: 25px; height: 30px; vertical-align: center;"><strong>گزارش فعالیت</strong></th>
            <th style="text-align: center; background-color: #dae1e7; width: 18px; height: 30px; vertical-align: center;"><strong>وضعیت انجام کار</strong></th>
        </tr>
    </thead>
    <tbody>
    @foreach($tasks as $task)
        <tr>
            <td style="height: 30px; vertical-align: center; text-align: center;"> 
                {{ $task->id }}
            </td>
            <td style="height: 30px; vertical-align: center; text-align: center;">
                {{ $task->creator->fullname }}
            </td>
            <td style="height: 30px; vertical-align: center; text-align: center;">
                {{ $task->receiver->fullname }}
            </td>
            <td style="height: 30px; vertical-align: center;"> 
                {{ $task->description }}
            </td>
            <td style="height: 30px; vertical-align: center; text-align: center;">
                {{ $task->start_date_fa }}
            </td>
            <td style="height: 30px; vertical-align: center; text-align: center;">
                {{ $task->deadline_fa }}
            </td>
            <td style="height: 30px; vertical-align: center; text-align: center;
                @if($task->report_status == 'عدم ارسال')
                    background-color: #f66d9b;
                @elseif($task->report_status == 'با تاخیر')
                    background-color: #0ba2d4;
                @elseif($task->report_status == 'به موقع')
                    background-color: #38c172;
                @endif
                ">
                {{ $task->report_status }}
            </td>
            <td style="height: 30px; vertical-align: center; text-align: center;">
                {{ $task->reported_at_fa }}
            </td>
            <td style="height: 30px; vertical-align: center;"> 
                {{ $task->report_description }}
            </td>
            <td style="height: 30px; vertical-align: center; text-align: center;
                @if($task->status_title == 'انجام نشده')
                    background-color: #f66d9b;
                @elseif($task->status_title == 'در حال انجام')
                    background-color: #0ba2d4;
                @elseif($task->status_title == 'انجام شده')
                    background-color: #38c172;
                @endif
                ">
                {{ $task->status_title }}
            </td>
        </tr>
    @endforeach
        
        {{-- Summery Section --}}
        <tr>
            <td style="height: 40px;"></td>
        </tr>
        
        <tr>
            <td style="background-color: #dae1e7; height: 40px; vertical-align: center; text-align: center;">
                <strong>تعداد کارهای محوله</strong>
            </td>
            <td style="background-color: #dae1e7; height: 40px; vertical-align: center; text-align: center;">
                <strong>{{ $tasks->count() }}</strong>
            </td>
        </tr>
        <tr>
            <td style="background-color: #38c172; height: 40px; vertical-align: center; text-align: center;">
                <strong>تعداد کارهای انجام شده</strong>
            </td>
            <td style="background-color: #38c172; height: 40px; vertical-align: center; text-align: center;">
                <strong>{{ $tasks->where('status_title', 'انجام شده')->count() }}</strong>
            </td>
        </tr>
        <tr>
            <td style="background-color: #0ba2d4; height: 40px; vertical-align: center; text-align: center;">
                <strong>تعداد کارهای در حال انجام</strong>
            </td>
            <td style="background-color: #0ba2d4; height: 40px; vertical-align: center; text-align: center;">
                <strong>{{ $tasks->where('status_title', 'در حال انجام')->count() }}</strong>
            </td>
        </tr>
        <tr>
            <td style="background-color: #f66d9b; height: 40px; vertical-align: center; text-align: center;">
                <strong>تعداد کارهای انجام نشده</strong>
            </td>
            <td style="background-color: #f66d9b; height: 40px; vertical-align: center; text-align: center;">
                <strong>{{ $tasks->where('status_title', 'انجام نشده')->count() }}</strong>
            </td>
        </tr>


        

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
        @if($key == 'description')
            <tr>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">وظیفه:</td>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">{{ $item }}</td>
            </tr>
        @endif
        @if($key == 'report_description')
            <tr>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">گزارش فعالیت:</td>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">{{ $item }}</td>
            </tr>
        @endif
        @if($key == 'creator_admin')
            <tr>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">ایجاد کننده:</td>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">{{ json_decode($item)->name }}</td>
            </tr>
        @endif
        @if($key == 'assigned_to_admin')
            <tr>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">دریافت کننده کننده:</td>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">{{ json_decode($item)->name }}</td>
            </tr>
        @endif
        @if($key == 'report_status')
            <tr>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">وضعیت گزارش:</td>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">{{ json_decode($item)->name }}</td>
            </tr>
        @endif
        @if($key == 'status')
            <tr>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">وضعیت انجام کار:</td>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">{{ json_decode($item)->name }}</td>
            </tr>
        @endif
        @if($key == 'start_date_min')
            <tr>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">از تاریخ:</td>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">
                    {{ Morilog\Jalali\Jalalian::fromDateTime($item)->format('Y/m/d') }}
                </td>
            </tr>
        @endif
        @if($key == 'start_date_max')
            <tr>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">تا تاریخ:</td>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">
                    {{ Morilog\Jalali\Jalalian::fromDateTime($item)->format('Y/m/d') }}
                </td>
            </tr>
        @endif
        @if($key == 'deadline_min')
            <tr>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">تاریخ مهلت از:</td>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">
                    {{ Morilog\Jalali\Jalalian::fromDateTime($item)->format('Y/m/d') }}
                </td>
            </tr>
        @endif
        @if($key == 'deadline_max')
            <tr>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">تاریخ مهلت تا:</td>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">
                    {{ Morilog\Jalali\Jalalian::fromDateTime($item)->format('Y/m/d') }}
                </td>
            </tr>
        @endif
        @if($key == 'reported_at_min')
            <tr>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">تاریخ گزارش از:</td>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">
                    {{ Morilog\Jalali\Jalalian::fromDateTime($item)->format('Y/m/d') }}
                </td>
            </tr>
        @endif
        @if($key == 'reported_at_max')
            <tr>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">تاریخ گزارش تا:</td>
                <td style="background-color: #f2d024; height: 40px; vertical-align: center; text-align: center;">
                    {{ Morilog\Jalali\Jalalian::fromDateTime($item)->format('Y/m/d') }}
                </td>
            </tr>
        @endif
        @endforeach



    </tbody>
</table>