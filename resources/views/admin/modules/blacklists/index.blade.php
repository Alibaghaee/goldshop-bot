@extends('admin.layouts.dashboard')

@section('title', get_page_title())

@section('middle')

    <div class="flex flex-wrap -mx-2">
        <div class="w-full md:w-1/3 mb-3 text-center px-2">
            <div class="w-full flex flex-wrap justify-between bg-grey-lighter rounded p-4">
                <div class="w-full sm:w-1/2 md:w-auto">تعداد صفحات پیامک امروز</div>
                <div class="w-full sm:w-1/2 md:w-auto">کل: {{ number_format($statistics['today_total_note_parts']) }}</div>
                <div class="w-full sm:w-1/2 md:w-auto">ارجاع: {{ number_format($statistics['today_reffer_note_parts']) }}</div>
                <div class="w-full sm:w-1/2 md:w-auto">خروجی: {{ number_format($statistics['today_export_note_parts']) }}</div>
                <div>
                </div>
            </div>
        </div>
        <div class="w-full md:w-1/3 mb-4 text-center px-2">
            <div class="w-full flex flex-wrap justify-between bg-grey-lighter rounded p-4">
                <div class="w-full sm:w-1/2 md:w-auto">تعداد دریافت کنندگان امروز</div>
                <div class="w-full sm:w-1/2 md:w-auto">کل: {{ number_format($statistics['today_receivers_count']) }}</div>
                <div class="w-full sm:w-1/2 md:w-auto">ارجاع: {{ number_format($statistics['today_reffer_receivers_count']) }}</div>
                <div class="w-full sm:w-1/2 md:w-auto">خروجی: {{ number_format($statistics['today_export_receivers_count']) }}</div>
            </div>
        </div>
        <div class="w-full md:w-1/3 mb-4 text-center px-2 opacity-50">
            <div class="w-full flex flex-wrap justify-between bg-grey-lighter rounded p-4">
                <div class="w-full sm:w-1/2 md:w-auto">تعداد صفحات پیامک قابل ارسال</div>
                <div class="w-full sm:w-1/2 md:w-auto">کل: {{ number_format($statistics['total_queue_note_parts'] + $statistics['total_lack_of_cash_note_parts']) }}</div>
                <div class="w-full sm:w-1/2 md:w-auto">در صف: {{ number_format($statistics['total_queue_note_parts']) }}</div>
                <div class="w-full sm:w-1/2 md:w-auto">کمبود شارژ: {{ number_format($statistics['total_lack_of_cash_note_parts']) }}</div>
            </div>
        </div>
        

    </div>
    

    {!! get_current_module_table_tag(isset($data) ? $data : []) !!}

@endsection