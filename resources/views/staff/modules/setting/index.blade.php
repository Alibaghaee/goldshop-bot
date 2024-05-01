@extends('staff.modules.dashboard.master')

@section('dashboard-content')    
    
    <settings 
    :languages="{{ json_encode($languages) }}" 
    :user="{{ json_encode($user) }}"
    :types="{{ json_encode($types) }}" 
    class="hidden md:block"
    ></settings>

    <settings-mobile 
    :languages="{{ json_encode($languages) }}" 
    :user="{{ json_encode($user) }}"
    :types="{{ json_encode($types) }}" 
    class="md:hidden"
    ></settings-mobile>
    
@endsection