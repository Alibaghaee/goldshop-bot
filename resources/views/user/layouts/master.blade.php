<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="{{ mix('/css/app-admin-ltr.css') }}" rel="stylesheet" type="text/css">
        {{-- <link href="/css/pretty-checkbox.css" rel="stylesheet" type="text/css"> --}}
        <link rel="icon" type="image/svg+xml" href="{{ isset($favicon) ? $favicon . '?t=' . time() : '' }}">
        <link rel="alternate icon" href="/favicon.ico">
        <link rel="mask-icon" href="{{ isset($favicon) ? $favicon . '?t=' . time() : '' }}" color="#ff8a01">

        <title>@yield('title')</title>
    </head>
    <body>
        
        @yield('content')

        <script>
            window.App = {!! json_encode([
                'user_id'    => auth()->guard('bed')->id(),
                'locale'     => app()->getLocale(),
                'settings'   => auth()->guard('bed')->check() ? auth()->guard('bed')->user()->settings : [],
                'domain_id'  => request()->domain_id(),
                'csrf_token' => csrf_token(),
            ]) !!};
        </script>

        <script src="{{ mix('/js/staff.js') }}"></script>
    </body>
</html>
