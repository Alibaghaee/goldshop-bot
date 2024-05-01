@extends('staff.modules.home.master')

@section('title', $title ?? '')

@section('home-master-content')  
    
    <faq :data="{{ json_encode($faq) }}"></faq>
    
@endsection

<script src="https://cdnjs.cloudflare.com/ajax/libs/velocity/1.2.3/velocity.min.js"></script>
