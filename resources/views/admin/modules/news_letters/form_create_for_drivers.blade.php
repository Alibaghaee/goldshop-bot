@extends('admin.layouts.dashboard')

@section('title', get_page_title())

@section('middle')
    {!! get_current_module_table_tag(isset($data) ? $data : [],new \App\Models\General\Driver(),true,'news-letter-drivers-table','ایجاد خبر نامه رانندگان') !!}


    <news-letter-drivers-send-form action_url="{{ $model->store_uri }}"></news-letter-drivers-send-form>
@endsection
