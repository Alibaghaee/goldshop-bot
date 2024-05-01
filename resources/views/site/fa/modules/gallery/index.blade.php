@extends(getSiteBladePath('layouts.master'))

@section('title', $title ?? '')

@section('content')
    
    <div class="bg-grey-lighter">
        <div class="container py-8 leading-loose text-black">
            <div class="flex flex-wrap -mx-2">
                @foreach($galleries as $gallery)
                    <div class="w-full md:w-1/3 px-2 my-4">
                        <div class="shadow rounded bg-white h-full">
                            <a class="text-teal-dark no-underline hover:text-teal" href="{{ $gallery->url }}">
                                <img src="{{ imageCache($gallery->image, 300, 200) }}" class="rounded w-full" alt="{{ $gallery->title }}">
                            </a>
                            <div class="p-4">
                                <div class="mb-1 flex justify-end">
                                    <a href="{{ $gallery->url }}" class="rhc-btn rhc-btn-teal rhc-btn-rounded-full rhc-btn-sm w-32">
                                        {{ __('messages.show_images') }}
                                    </a>
                                </div>
                                <h2 class="mb-3 capitalize">
                                    <a class="text-teal-dark no-underline hover:text-teal" href="{{ $gallery->url }}">
                                        {{ $gallery->title }}
                                    </a>
                                </h2>
                                <div>
                                    {!! str_limit($gallery->description, 300) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="w-full">
                    {!! $galleries->links() !!}
                </div>
            </div>
        </div>
    </div>
    
@endsection
