@extends('admin.layouts.dashboard')

@section('title', get_page_title())

@section('middle')

    {!! get_current_module_table_tag(isset($data) ? $data : [],new \App\Models\General\ContactNumber(),true,'single-send-sms-contact-numbers-table','ارسال تکی به مخاطبان') !!}


    <single-send-sms-contact-numbers-send-form
        action_url="{{ $model->store_uri }}"
        :type="{{json_encode($type)}}"

        :sender_numbers="{{$senderNumbers}}"
        :sender_numbers_without_type="{{$senderNumbersWithoutType}}"
    ></single-send-sms-contact-numbers-send-form>

@endsection

