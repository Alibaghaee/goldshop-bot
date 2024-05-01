@extends(getSiteBladePath('layouts.master'))

@section('title', setting(13))

@section('content')
    
    <div class="font-black text-teal text-3xl text-center mb-8 md:mt-8">{{ setting(17) }}</div>
        
    <refund_form :descriptions="{{ json_encode($descriptions) }}"></refund_form>

@endsection


@section('end-scripts')
    <script></script>
@endsection
