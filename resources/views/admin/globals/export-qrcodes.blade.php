@extends('admin.layouts.dashboard')

@section('title', get_page_title())

@section('middle')
<export-qrcodes :departments="{{ $departments }}" :types="{{ $types }}"></export-qrcodes>
@endsection





