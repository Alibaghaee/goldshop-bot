@extends('admin.layouts.dashboard')

@section('title', get_page_title())

@section('middle')

    {!! get_restore_update_current_module_table_tag(isset($data) ? $data : [],isset($model) ? $model : []) !!}

@endsection
