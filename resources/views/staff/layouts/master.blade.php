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
    <link rel="mask-icon" href="{{ isset($favicon) ? $favicon . '?t=' . time() : '' }}" color="#3b3896">

    <meta name="theme-color" content="#3b3896">
    <link rel="apple-touch-icon" href="{{ isset($favicon) ? $favicon . '?t=' . time() : '' }}">

    <title>@yield('title')</title>

    <!-- GCM Manifest (optional if VAPID is used) -->
    @if (config('webpush.gcm.sender_id'))
        <link rel="manifest" href="/manifest.json">
    @endif

<!-- Scripts -->
    {{-- <script>
        window.App = {!! json_encode([
            'user' => Auth::user(),
            'vapidPublicKey' => config('webpush.vapid.public_key'),
            'pusher' => [
                'key' => config('broadcasting.connections.pusher.key'),
                'cluster' => config('broadcasting.connections.pusher.options.cluster'),
            ],
        ]) !!};
    </script> --}}

    {{-- <script src="https://js.pusher.com/beams/1.0/push-notifications-cdn.js"></script>

    <script>
      const beamsClient = new PusherPushNotifications.Client({
        instanceId: '8f6a5e89-0891-47b5-b953-c6671a618dec',
      });

      beamsClient.start()
        .then(() => beamsClient.addDeviceInterest('hello'))
        .then(() => console.log('Successfully registered and subscribed!'))
        .catch(console.error);
    </script> --}}

    <link href="/manifest.json" rel="manifest">
    {{-- <script>
        'serviceWorker' in navigator && window.addEventListener('load', navigator.serviceWorker.register('/pwabuilder-sw/pwabuilder-sw.js'))
    </script> --}}
</head>
<body>

@yield('content')

<script>
    window.App = {!! json_encode([
                'locale' => app()->getLocale(),
                'user_id' => auth()->check() ? auth()->guard('admin')->id() : null,
                'settings' => auth()->check() ? auth()->guard('admin')->user()->settings : [],
                'domain_id' => request()->domain_id(),
                'csrf_token' => csrf_token(),
                'online_users' => [],
                'active_types_id' => auth()->check() ? auth()->guard('admin')->user()->activeTypesId() : [],
                'departments_id' => auth()->check() ? auth()->guard('admin')->user()->departmentIds->pluck('id') : [],
                'reminder_period' => setting(config('portal.reminder_period_setting_id')),
            ]) !!};
</script>
<script>
    window.addEventListener("flutterInAppWebViewPlatformReady", function (event) {

        const args = [
            {'ACCESS_TOKENS': {!! json_encode(auth()->check() ? Auth::guard('admin')->user()->last_access_token:null) !!}},
        ];
        window.flutter_inappwebview.callHandler('accessTokenWebLine', ...args);

        const condAuth = [
            {'COND_AUTH': {!! json_encode(auth()->check() ? 'authed':'not_authed') !!}}
        ];

        window.flutter_inappwebview.callHandler('userCheckAuth', ...condAuth);


        const locale = [
            {'LOCALE': {!! json_encode(app()->getLocale()) !!}}
        ];

        window.flutter_inappwebview.callHandler('getLocale', ...locale);

        const hostName = [
            {'HOST_NAME': {!! json_encode(request()->getHttpHost()) !!}}
        ];

        window.flutter_inappwebview.callHandler('getHostName', ...hostName);
    });
</script>


<script src="{{ mix('/js/staff.js') }}"></script>

@yield('end-scripts')
<script>


    function webViewHelpChat(data) {


        if (data == 'on') {

            window.directlyIsFlutterInAppWebViewReadyDirectlyEvent(true)
        }
    }

    function webViewHelpChatIos(data) {


        if (data == 'on') {

            window.directlyIsFlutterInAppWebViewIosReadyDirectlyEvent(true)
        }
    }

</script>
</body>
</html>
