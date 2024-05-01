@extends('admin.layouts.dashboard')

@section('title', get_page_title())

@section('middle')

    {!! get_current_module_table_tag(isset($data) ? $data : [],new \App\Models\User(),true,'news-letter-users-table','ایجاد خبر نامه کاربران') !!}


    <news-letter-users-send-form action_url="{{ $model->store_uri }}"></news-letter-users-send-form>
@endsection







