@extends('staff.modules.home.master')

@section('home-master-content')
    <h2 class="text-xl md:text-3xl font-normal mb-6 mt-2 md:mt-16">@lang('Enter your Username and Password')</h2>

    <staff-login action="{{ locale_url('signin') }}" privacy_policy_url="{{ $privacy_policy_url }}"></staff-login>
    
@endsection

@section('end-scripts')
    <script>
        $("#staff-login").submit(function(){
            let username = $("input#username").val()
            let password = $("input#password").val()

            value = JSON.stringify({
                'username': username,
                'password': password,
            })

            window.userCredentialsHandler.postMessage(value);
        });
    </script>
@endsection