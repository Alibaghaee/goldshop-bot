<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="{{ mix('/css/app-site.css') }}" rel="stylesheet" type="text/css">
        <link href="/css/pretty-checkbox.css" rel="stylesheet" type="text/css">
        <title>@yield('title')</title>
        {{-- <script src="//rubaxa.github.io/Sortable/Sortable.js"></script> --}}  {{-- temp --}}
    </head>
    <body>

        <div id="app">
            @include(getSiteBladePath('modules.home.partials.nav'))

            @yield('content')

            @include(getSiteBladePath('modules.home.partials.footer'))

            <flash message="{{ session('flash') }}" level_name="{{ session('level') }}"></flash>
        </div>
        <script src="{{ mix('/js/app-site.js') }}"></script>
        <script>
            // List with handle -- temp
            // Sortable.create(app, {
            //   handle: '.flex',
            //   animation: 150
            // });
        </script>
        @yield('end-scripts')
    </body>
</html>
