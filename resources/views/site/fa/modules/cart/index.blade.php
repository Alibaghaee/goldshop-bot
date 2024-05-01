@extends(getSiteBladePath('layouts.master'))

@section('title', 'سبد خرید')

@section('content')

    <div class="text-purple-darkest bg-1 leading-loose">
        <div class="container py-16">
            <cart :shipping_types="{{ json_encode($shipping_types) }}" ></cart>
        </div>
    </div>
    
@endsection
