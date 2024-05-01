@extends(getSiteBladePath('layouts.master'))

@section('title', setting(13))

@section('content')
    
    <div class="font-black text-teal text-3xl text-center mb-8 md:mt-8 leading-normal">{!! setting(32) !!}</div>
    
    <pay_form 
    action="/fa/registration_check" 
    method="post" 
    class="md:px-8 mx-auto" 
    :genders="{{ json_encode($genders) }}" 
    :provinces="{{ json_encode($provinces) }}"
    :cities="{{ json_encode($cities) }}"
    :descriptions="{{ json_encode($descriptions) }}"
    :grades="{{ json_encode($grades) }}"
    :fields_of_study="{{ json_encode($fields_of_study) }}"
    :payment_subjects="{{ json_encode($payment_subjects) }}"
    >
    </pay_form>

@endsection


@section('end-scripts')
    <script></script>
@endsection
