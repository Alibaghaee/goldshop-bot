<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="/css/app.css" rel="stylesheet" type="text/css">
        <link href="/css/pretty-checkbox.css" rel="stylesheet" type="text/css">
        <title>@yield('title')</title>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.10.5/tinymce.min.js" integrity="sha512-TXT0EzcpK/3KaFksZ59D/1A3orhVtDzhwgtYeSIGxM6ZgCW1+ak+2BqbJPps2JQlkvRApI37Xqbr8ligoIGjBQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        {{-- <script src="//rubaxa.github.io/Sortable/Sortable.js"></script> --}}  {{-- temp --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
        <link rel="icon" type="image/jpg" href="{{asset('/image/site/logo.png')}}"/>

        <style>
            .text-5xl{
                font-size: 2.75rem !important;
            }
        </style>
        @yield('styles')
    </head>
    <body>

        @yield('content')

        <script>
            window.App = {!! json_encode([
                'blacklistReloadTime' =>  (int) setting(config('portal.setting_id.blacklist_reload_time'), 120)  * 1000,
            ]) !!};
        </script>

        <script src="/js/app.js"></script>

        <script>
            // List with handle -- temp
            // Sortable.create(app, {
            //   handle: '.flex',
            //   animation: 150
            // });
        </script>
        @yield('end-scripts')
        @yield('end-scripts-2')
    </body>
</html>
