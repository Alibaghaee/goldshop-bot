@extends('admin.layouts.dashboard')

@section('title', get_page_title())

@section('middle')

    <div class="bg-purple-darker py-2 px-4 text-center mb-8 rounded text-white text-xl ">
        {{ $report->title }}
    </div>

    @if ($report->chart_type == 3)
        @include('admin.modules.reports.charts.pie_chart')
    @endif

    @if ($report->chart_type == 2)
        @include('admin.modules.reports.charts.hour_bar_chart',[
            'labels' =>collect($report->result)->pluck('_id.hour')->toArray(),
            'data' => collect($report->result)->pluck('count')->toArray(),
        ])
        @include('admin.modules.reports.charts.pie_chart', [
             'labels' =>collect($report->result)->pluck('_id.hour')->toArray(),
            'data' => collect($report->result)->pluck('count')->toArray(),
        ])
    @endif


    @if ($report->chart_type == 1)
        <div class="flex flex-wrap w-full py-2 px-4 bg-grey rounded mb-8 flex-row-reverse justify-between">
            @foreach ($report->result as $item)
                <div class="flex flex-wrap flex-row-reverse w-1/6 justify-center">
                    <div class="bg-white text-grey-darkest rounded px-3 mr-2">{{ $item['index'] }}</div>
                    <div class="bg-grey-darkest text-white rounded px-3">{{ number_format($item['data_sum']) }}</div>
                </div>
            @endforeach
            <div class="flex flex-wrap flex-row-reverse w-1/6 justify-center">
                <div class="bg-yellow-dark text-grey-darkest rounded px-3 mr-2">جمع کل</div>
                <div class="bg-blue text-white rounded px-3">{{ number_format(collect($report->result)->sum('data_sum')) }}
                </div>
            </div>
        </div>

        @include('admin.modules.reports.charts.bar_chart_2')
        @include('admin.modules.reports.charts.pie_chart', [
            'labels' => collect($report->result)->pluck('index')->toArray(),
            'data' => collect($report->result)->pluck('data_sum')->toArray(),
        ])
    @endif
    {{-- @include('admin.modules.reports.charts.pie_chart') --}}

@endsection
