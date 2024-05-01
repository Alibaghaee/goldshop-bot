@extends('staff.modules.home.master')

@section('title', $title ?? '')

@section('home-master-content')
    <div class="h-full flex flex-col h-full justify-center">
        <h2 class="text-3xl font-normal mb-6">{{ $content->title }}</h2>
        @if($content->image)
            <div class="float-left">
                <img src="{{ $content->image }}" alt="{{ $content->title }}" class="max-w-full mb-3 rounded">
            </div>
        @endif
        <div class="text-grey-lightest">
            {!! $content->body !!}
        </div>
        @if($content->file)
            <div class="mt-8">
                <a class="rhc-btn rhc-btn-blue" href="{{ $content->file }}">{{ __('messages.download_file') }}</a>
            </div>
        @endif
    </div>
@endsection

