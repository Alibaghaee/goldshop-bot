@extends('staff.modules.dashboard.master')

@section('dashboard-content')

    <hospital-list
            :hospitals="{{ json_encode($hospitals) }}"
    class="block"
    ></hospital-list>


    
@endsection