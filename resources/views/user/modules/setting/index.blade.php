@extends('user.modules.dashboard.master')

@section('dashboard-content')

    <user-settings
    :languages="{{ json_encode($languages) }}"
    :user="{{ json_encode($user) }}"
    class="hidden md:block"
    ></user-settings>

    <user-settings-mobile
    :languages="{{ json_encode($languages) }}"
    :user="{{ json_encode($user) }}"
    class="md:hidden"
    ></user-settings-mobile>
    
@endsection