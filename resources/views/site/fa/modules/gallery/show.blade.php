@extends(getSiteBladePath('layouts.master'))

@section('title', $gallery->title ?? '')

@section('content')
    
    <div class="container py-8 my-8 leading-loose">
        <gallery :images="{{ json_encode($images) }}"></gallery>
    </div>
    
@endsection
