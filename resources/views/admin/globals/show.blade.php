@extends('admin.layouts.dashboard')

@section('title', get_page_title())

@section('middle')

  <div class="w-full">
    <div class="rhc-title pt-4">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="fill-current w-6 h-6 mr-2">
        <path d="M448 224H288V64h-64v160H64v64h160v160h64V288h160z"></path>
      </svg>
      
      <div>{{ get_page_title() }}</div></div> 

      <div>
        @include($model->show_path)
      </div>
  </div>

@endsection
