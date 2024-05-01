@extends(getSiteBladePath('layouts.master'))

@section('title', $product->html_title ?? '')

@section('content')

    <items_list :product="{{ $product }}" :related_products="{{ $related_products }}"></items_list>
    
    
    
@endsection
