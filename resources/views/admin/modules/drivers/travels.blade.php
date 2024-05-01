@extends('admin.layouts.dashboard')

@section('title',  'لیست سفر ها')

@section('middle')


    {!! get_current_module_table_tag(isset($data) ? $data : [],isset($model) ? $model : [],true,'driver-travels-table',$page_title) !!}
    {{--    {!! get_current_module_table_tag($data, new \App\NetworkActivity()) !!}--}}

    {{--<network-activitys-table :data="{{json_encode(null)}}" :page_title="{{$page_title}}" :model="{{json_encode($model)}}"></network-activitys-table>--}}
@endsection
