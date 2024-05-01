@extends('admin.layouts.dashboard')

@section('title', get_page_title())

@section('middle')
    
    {!! get_current_module_table_tag(isset($data) ? $data : []) !!}

    <tasks-report></tasks-report>

@endsection