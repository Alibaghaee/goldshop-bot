@extends('errors::layout')

@section('title', __('Unauthorized Action'))

@section('message')
  <h1 data-h1="400">400</h1>
  <p>@lang('Bad Request')</p>
@endsection
