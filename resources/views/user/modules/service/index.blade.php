@extends('user.modules.dashboard.master')

@section('dashboard-content')    
    
    <services :services="{{ json_encode($services) }}"></services>
    
@endsection