<table>
    <thead>
    <tr>
        <th style="text-align: center; background-color: #dae1e7; width: 18px; height: 30px; vertical-align: center;">
            <strong>شماره سفارش</strong></th>
        <th style="text-align: center; background-color: #dae1e7; width: 18px; height: 30px; vertical-align: center;">
            <strong>شماره کاربر</strong></th>
        <th style="text-align: center; background-color: #dae1e7; width: 18px; height: 30px; vertical-align: center;">
            <strong>نام و نام خانوادگی</strong></th>
        <th style="text-align: center; background-color: #dae1e7; width: 18px; height: 30px; vertical-align: center;">
            <strong>نوع معامله</strong></th>
        <th style="text-align: center; background-color: #dae1e7; width: 18px; height: 30px; vertical-align: center;">
            <strong>جنس معامله</strong></th>
        <th style="text-align: center; background-color: #dae1e7; width: 18px; height: 30px; vertical-align: center;">
            <strong>قیمت</strong></th>
        <th style="text-align: center; background-color: #dae1e7; width: 18px; height: 30px; vertical-align: center;">
            <strong>تعداد</strong></th>
        <th style="text-align: center; background-color: #dae1e7; width: 18px; height: 30px; vertical-align: center;">
            <strong>وزن</strong></th>
        <th style="text-align: center; background-color: #dae1e7; width: 18px; height: 30px; vertical-align: center;">
            <strong>تاریخ</strong></th>


    </tr>
    </thead>
    <tbody>
    @foreach($orders as $order)
        <tr>
            <td style="height: 30px; vertical-align: center; text-align: center;">
                {{ $order->id  }}
            </td>
            <td style="height: 30px; vertical-align: center; text-align: center;">
                {{ $order?->user->mobile ?? '-' }}
            </td>
            <td style="height: 30px; vertical-align: center; text-align: center;">
                {{ $order?->user->name ?? '-' }}
            </td>
            <td style="height: 30px; vertical-align: center; text-align: center;">
                {{ $order->type_fa ?? '-'}}
            </td>
            <td style="height: 30px; vertical-align: center; text-align: center;">
                {{ $order->item_fa ?? '-'}}
            </td>

            <td style="height: 30px; vertical-align: center; text-align: center;">
                {{ $order->price_be ?? '-'}}
            </td>

            <td style="height: 30px; vertical-align: center; text-align: center;">
                {{ $order->count ?? '-'}}
            </td>
            <td style="height: 30px; vertical-align: center; text-align: center;">
                {{ $order->weight ?? '-'}}
            </td>

            <td style="height: 30px; vertical-align: center; text-align: center;">
                {{ $order->created_at_fa }}
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
            <strong>{{ $orders?->count() }}</strong>
        </td>
    </tr>


    </tbody>
</table>
