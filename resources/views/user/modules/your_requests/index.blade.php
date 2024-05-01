@extends('user.modules.dashboard.master')

@section('dashboard-content')    
    
    <your-requests :request_items="{{ json_encode($request_items) }}"></your-requests>
    
@endsection