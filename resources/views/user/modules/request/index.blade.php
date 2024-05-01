@extends('patient.modules.dashboard.master')

@section('dashboard-content')    
    
    <requests :request_items="{{ json_encode($request_items) }}" is_all="{{ $is_all }}"></requests>
    
@endsection