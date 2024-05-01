@extends('staff.modules.dashboard.master')

@section('dashboard-content')

    <hospital-list
            :languages="{{ json_encode($hospitals) }}"
    class="block"
    ></hospital-list>


    
@endsection