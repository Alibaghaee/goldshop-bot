@extends(getSiteBladePath('layouts.master'))

@section('title', $title ?? '')

@section('content')
    
    <products :products="{{ $products }}" :categories="{{ $categories }}" :active_tags="{{ json_encode(request()->query('tags') ?? []) }}"></products>
    

    {{-- <div class="h-screen">
        <div class="container w-full md:max-w-md bg-green text-white p-3 leading-loose rounded text-center mt-16">
            این بخش در حال تکمیل شدن است. و به زودی امکان مشاهده ویدئوها فعال خواهد شد.
        </div>
    </div> --}}
    
    
@endsection
