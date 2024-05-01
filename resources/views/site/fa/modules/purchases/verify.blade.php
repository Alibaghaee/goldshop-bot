<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- <link href="/css/videojs-preroll.css" rel="stylesheet" type="text/css"> --}}
    <link href="/css/app-site.css" rel="stylesheet" type="text/css">
    <link href="/css/pretty-checkbox.css" rel="stylesheet" type="text/css">
    <title></title>
    <style>
        #confirm {
            width: 4rem !important;
            margin-left: 1rem;
        }
    </style>
</head>
<body>

<div
    id="app" {{-- class="flex-reverse flex flex-col justify-center" style="min-height: 100vh;/*background-image: url('/image/site/bg-layer-4.svg');*/ background-size: cover;" --}}>

    {{--    @include(getSiteBladePath('modules.home.partials.menu'))--}}


    <div class="text-purple-darkest leading-loose h-full flex items-center">
        <div class="container py-16">
            <div class="w-full md:max-w-md mx-auto bg-white rounded shadow-md">

                <div class="w-full p-8 rounded-lg">
                    <div class="leading-loose text-grey-darkset px-4">


                        <div class="   text-center text-2xl md:text-3xl font-bold text-purple-darkest mb-2 w-full">تایید
                            پرداخت
                        </div>


                        <form action="{{route('wallet.charge.purchase',$wallet->id)}}">
                            @csrf


                            <div class="mx-auto"> مبلغ : <span
                                    class="inline font-bold "> {{number_format($wallet->amount ?? 0)}}</span></div>
                            <div class="mx-auto"> برای تایید و رفتن به صفحه پرداخت دکمه زیر را کلیک کنید.</div>

                            <button class="w-full font-bold p-3 my-3 rounded rounded-md border border-green  bg-white hover:bg-green
                                        text-center text-green hover:text-white">
                                تایید
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <flash message="{{ session('flash') }}" level_name="{{ session('level') }}"></flash>

</div>

<script src="/js/app-site.js"></script>


</body>
</html>






