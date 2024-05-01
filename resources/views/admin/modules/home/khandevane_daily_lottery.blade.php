<div class="rhc-title font-bold">لیست قرعه کشی 10 جایزه 1 میلیون تومانی خنداوانه</div>
<div class="flex justify-center mx-auto">
    <div class="flex flex-col w-full">
        <div class="w-full">
            <div class="border-b border-gray-200 shadow">
                <table>
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-center">
                                شناسه
                            </th>
                            <th class="px-6 py-4 text-center">
                                عنوان
                            </th>
                            <th class="px-6 py-4 text-center">
                                تاریخ
                            </th>
                            <th class="px-6 py-4 text-center">
                                خروجی شرکت کنندگان
                            </th>
                            <th class="px-6 py-4 text-center">
                                قرعه کشی
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @foreach($records as $record)
                        <tr class="whitespace-nowrap">
                            <td class="px-6 py-4 text-center">
                                {{ $record['id'] }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                مسابقه شماره {{ $record['id'] }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                {{ $record['date'] }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                <a href="http://lottery.rahco.ir/files/lottery/ten-million/{{ $record['id'] }}.xlsx" target="_blank" class="rhc-btn rhc-action-btn">دانلود</a>
                            </td> 
                            <td class="px-6 py-4 text-center">
                                <a href="http://lottery.rahco.ir/index{{ $record['id'] }}.html" target="_blank" class="rhc-btn rhc-action-btn">قرعه کشی</a>
                            </td> 
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>