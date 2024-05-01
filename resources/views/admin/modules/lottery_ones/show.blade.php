@extends('admin.layouts.master')

@section('title', get_page_title())

@section('content')

    <div class="flex flex-wrap h-full" id="app" v-cloak>

        <lottery-one :lottery="{{ $lottery }}"></lottery-one>

    </div>

@endsection
