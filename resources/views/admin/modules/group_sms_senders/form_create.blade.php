@extends('admin.layouts.dashboard')

@section('title', get_page_title())

@section('middle')

    {!! get_current_module_table_tag(isset($data) ? $data : [],new \App\Models\General\ContactCategory(),true,'group-send-sms-contact-category-table','ارسال گروهی') !!}


    <group-send-sms-contact-category-send-form
        action_url="{{ $model->store_uri }}"
        :type="{{json_encode($type)}}"

        :sender_numbers="{{$senderNumbers}}"
        :sender_numbers_without_type="{{$senderNumbersWithoutType}}"
    ></group-send-sms-contact-category-send-form>

@endsection

