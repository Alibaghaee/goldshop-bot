<!doctype html>
<html lang="{{ app()->getLocale() }}">


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="/css/app-site.css" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="/dist/output.css"/>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"/>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/vazir-font/27.2.0/font-face.css"
          integrity="sha512-ZHFuHiK3EA1uh2tx7nB0j9HyXR/IAFW24KVNFGjY8QIjtDKHmcowjUyObXF40wYrG25+kECHEbH8rL+HbvRwYA=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>

    <link rel="icon" type="image/jpg" href="{{asset('/image/site/logo.png')}}"/>

    <script src="{{asset('/dist/tailwind.js')}}"></script>
    <script src="{{asset('dist/fontawsom.all.min.css')}}"></script>
    <script src="{{asset('dist/fontawsom.all.min.js')}}"></script>

    <link
        rel="stylesheet"
        href="{{asset('/dist/swiperAds9.css')}}"/>


    <title>@yield('title')</title>
    <meta name="description" content="@yield('metaDescription')">

    <style>
        #confirm {
            width: 4rem !important;
            margin-left: 1rem;
        }

        .pagination{
            padding-top: 2rem!important;
            color: white!important;
        }
    </style>


</head>
<body>


<div id="app">

    @include(getSiteBladePath('modules.bime.sidebar'))



    {{-- @include(getSiteBladePath('modules.home.partials.footer_menu')) --}}

    {{-- @include(getSiteBladePath('modules.home.partials.footer')) --}}

    @yield('content')

    @include(getSiteBladePath('modules.bime.footer'))


    <flash message="{{ session('flash') }}" level_name="{{ session('level') }}"></flash>

</div>





<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

<script src="/js/app-site.js"></script>

<script>

    $(document).ready(function () {
        var swiper = new Swiper(".mySwiper", {
            navigation: {
                nextEl: ".mySwiperMain  .swiper-button-prev",
                prevEl: ".mySwiperMain  .swiper-button-next",
            },
            slidesPerView: 1,

            loop: true,
            breakpoints: {
                // When window width is <= 767px
                767: {
                    slidesPerView: 2,
                    spaceBetween: 0
                },
                // When window width is <= 992px
                992: {
                    slidesPerView: 3,
                    spaceBetween: 0
                },
                1200: {
                    slidesPerView: 4,
                    spaceBetween: 0
                },
                1400: {
                    slidesPerView: 5,
                    spaceBetween: 0
                }
            },
            autoplay: {
                delay: 2000,
            },
        });

    });
</script>

<script>

    $(document).ready(function () {

        var swiper22 = new Swiper(".newsSwiper", {
            navigation: {
                nextEl: ".newsSwiperMain .swiper-button-prev",
                prevEl: ".newsSwiperMain .swiper-button-next",
            },
            slidesPerView: 1,

            loop: true,
            breakpoints: {
                // When window width is <= 767px
                767: {
                    slidesPerView: 2,
                    spaceBetween: 0
                },
                // When window width is <= 992px
                992: {
                    slidesPerView: 3,
                    spaceBetween: 0
                },
                1200: {
                    slidesPerView: 4,
                    spaceBetween: 0
                },
                1400: {
                    slidesPerView: 5,
                    spaceBetween: 0
                }
            },
            autoplay: {
                delay: 2000,
            },
        });

    });
</script>

<script src="{{asset('/dist/swiperAds9.js')}}"></script>

<script>

    const sidebar = document.querySelector(".sidebar")
    const hambergerMenu = document.querySelector(".ham-menu")
    const overlay = document.querySelector(".overlay")
    const search = document.querySelector(".search")

    const toggleSidebar = () => {
        if (sidebar.style.right == '0px') {
            sidebar.style.right = "-250px"
            overlay.style.opacity = 0
            overlay.style.visibility = "hidden"
            return
        }
        sidebar.style.right = 0
        overlay.style.opacity = 1
        overlay.style.visibility = "visible"

    }

    hambergerMenu.onclick = toggleSidebar
    overlay.onclick = toggleSidebar
    search.onclick = toggleSidebar


    // Initialize the map
    var mymap = L.map('map').setView([32.4279, 53.6880], 6);

    // Add a tile layer
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: 'Map data © <a href="https://openstreetmap.org">OpenStreetMap</a> contributors',
        maxZoom: 18,
    }).addTo(mymap);

    L.marker([35.6892, 51.3890]).addTo(mymap)
        .bindPopup('Tehran, Iran')
        .openPopup();


</script>

@yield('end-scripts')
@yield('end-scripts-one')
@yield('end-scripts-two')


</body>
</html>



