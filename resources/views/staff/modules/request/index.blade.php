@extends('staff.modules.dashboard.master')

@section('dashboard-content')

    <requests
    :request_items="{{ json_encode($request_items) }}"
    is_all="{{ $is_all }}"
    :active_entities_id="{{ json_encode($active_entities_id ?? []) }}"
    :available_beds_id="{{ json_encode($available_beds_id ?? []) }}"
    refreshed="{{ $refreshed }}"
    is_desktop="{{ $is_desktop }}"
    browser="{{ $browser }}"
    ></requests>

@endsection
