@extends('staff.modules.dashboard.master')

@section('dashboard-content')    
    
    <rooms 
    :rooms="{{ json_encode($rooms) }}" 
    :active_rooms="{{ json_encode($active_rooms) }}"
    ></rooms>
    
@endsection