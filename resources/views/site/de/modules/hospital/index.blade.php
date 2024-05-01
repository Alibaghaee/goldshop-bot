@extends('staff.layouts.layout')

@section('layout-content')
    <div class="bg-purple text-white leading-normal font-normal flex flex-col w-full"
         style="background-image: url('/image/site/over-layer.png');background-size: cover;">
        {{-- Header --}}
        <div class="w-5/6 md:3/4 mx-auto py-8 flex justify-between items-center">
            <div class="text-sm md:text-2xl font-semibold">
                <a href="#" class="no-underline text-white hover:text-grey-lightest">{{ $nav_menu->name }}</a>
            </div>
            <div class="flex items-center text-xs md:text-base">

                <div class="language relative">

                    <img src="/image/site/lang.svg" alt="language"
                         class="flex align-text-bottom md:align-middle md:p-2">
                    <div class="absolute flex flex-row-reverse z-50" style="right: -2rem;">
                        @foreach($languages->chunk(10) as $languages_chunk)

                            <div class="basis-1/4  language-content">
                                @foreach($languages_chunk as $language)
                                    <a class="language-item "
                                       href="/{{ $language->lower_case_key.'/home/hospital/index' }}">
                                        {{ $language->title }}
                                        <img src="{{ $language->icon }}" class="w-6 h-6 rounded-full">
                                    </a>
                                @endforeach
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>


        {{-- Main --}}
        <div class="w-5/6 md:3/4 mx-auto">
            <div class="flex flex-wrap">
                <div class="w-full md:w-1/2 flex flex-col md:justify-center">

                    <div class="flex text-grey-darkest">
                        <div class="container leading-loose">
                            <div class="w-full md:w-4/5 mx-auto my-8">

                                <h2 class="text-xl md:text-3xl font-normal mb-6 mt-2 md:mt-16 text-white">@lang('Enter hospital code')</h2>

                                <get-hospital
                                        action="{{ locale_url('home/hospital/get') }}"

                                ></get-hospital>

                            </div>
                        </div>
                    </div>

                </div>
                <div class="flex-col-reverse hidden lg:-mb-16 md:-mb-10 md:flex md:w-1/2 overflow-hidden w-full">
                    <img src="/image/site/img-1.svg" class="" width="667" alt="image">
                </div>
            </div>
            <img src="/image/site/img-1.svg" class="-mb-10 sm:-mb-14 block md:hidden" width="667" alt="image">
        </div>
        {{-- Footer --}}
        @include('staff.modules.home.footer')
    </div>
@endsection



