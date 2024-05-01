@extends(getSiteBladePath('layouts.master'))

@section('title', $package->title ?? '')

@section('content')
    
    <div class="h-screen">
        <div class="container md:py-12 leading-loose text-black">
            <div class="flex flex-wrap -mx-4">
                <div class="text-center md:text-right text-2xl md:text-3xl font-bold text-purple-darkest mb-2 w-full px-4">{{ $package->title }}</div>
                @foreach($package->category->items as $category)
                    <div class="w-full md:w-1/2 px-4 mb-4 md:mb-8">
                        <a href="{{ $category->description }}" class="flex">
                            <img src="{{ $category->image }}" alt="{{ $category->title }}" class="w-full h-full rounded">
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    
@endsection
