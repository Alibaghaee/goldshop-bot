@extends(getSiteBladePath('layouts.master'))

@section('title', $product_item->title ?? '')

@section('content')
    
    <div class="">
        <div class="container md:py-8 md:my-8 leading-loose text-black">
            <div class="flex flex-wrap -mx-4">
                <div class="w-full md:w-2/3 px-4">
                    <div class="mb-4 text-xl text-grey-darkest font-bold">{{ $product_item->title }}</div>
                    <div class="mb-8 rounded">
                        @if($product_item->type == 1)
                            <video
                                id="player"
                                class="video-js w-full rounded vjs-theme-fantasy vjs-fluid vjs-big-play-centered js-controls-enabled"
                                controls
                                preload="auto"
                                playsinline
                                width="640"
                                height="360"
                                poster="{{ $product_item->cover }}"  
                                data-setup="{}"
                              >
                                <source src="{{ $product_item->filePath('SD') }}" type='video/mp4' label='کیفیت متوسط' res='480' />
                                <source src="{{ $product_item->filePath('HD') }}" type='video/mp4' label='کیفیت بالا' res='720' />
                                <source src="{{ $product_item->filePath('FHD') }}" type='video/mp4' label='کیفیت عالی' res='1080' />
                            </video>

                        @else
                            <a class="no-underline px-4 cursor-pointer text-white block rounded text-center text-xl font-medium hover-shadow bg-blue p-4" href="{{ $product_item->file }}">{{ $product_item->title }}</a>
                        @endif
                    </div>

                    @foreach($product_item->product->items as $item)
                        @if($item->type == 1)

                            <a href="{{ route('dashboard.play', [app()->getLocale(), $item->id]) }}" class="no-underline text-grey-darkest text-orange hover:text-green rounded flex hover-shadow w-full p-4 justify-between items-center @if($product_item->id == $item->id) border-2 border-green-lighter font-bold @endif" style="background-color: #f6f8fa;">
                                <div class="flex items-center text-grey-darkest">
                                    <img class="w-48 rounded hidden sm:block" src="{{ $item->cover }}" alt="{{ $item->title }}">
                                    <div class="md:mr-4 text-xl">{{ $item->title }}</div>
                                </div>
                                <div class="flex">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 fill-current cursor-pointer" viewBox="0 0 40 40"><path d="M20 0C8.95 0 0 8.95 0 20s8.95 20 20 20 20-8.95 20-20S31.05 0 20 0zm-4 29V11l12 9-12 9z"/></svg>
                                </div>
                            </a>
                            {{-- <div class="bg-grey-light mb-4 -mt-2 mx-1 opacity-50">
                                <div class="bg-grey-dark mr-auto rounded" style="height:5px;width:{{ round(auth()->user()->videoTrackPercent($item->id))  }}%"></div>
                            </div> --}}
                        @else
                            <a href="{{ $item->file }}" class="no-underline text-grey-darkest text-orange hover:text-green rounded mb-4 flex hover-shadow w-full p-4 justify-between items-center @if($product_item->id == $item->id) border-2 border-green-lighter font-bold @endif" style="background-color: #f6f8fa;">
                                <div class="flex items-center text-grey-darkest">
                                    <img class="w-48 rounded hidden sm:block" src="{{ $item->cover }}" alt="{{ $item->title }}">
                                    <div class="md:mr-4 text-xl">{{ $item->title }}</div>
                                </div>
                                <div class="flex">
                                    <svg class="w-16 h-16 fill-current cursor-pointer" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 480 320"><path d="M387.002 121.001C372.998 52.002 312.998 0 240 0c-57.998 0-107.998 32.998-132.998 81.001C47.002 87.002 0 137.998 0 200c0 65.996 53.999 120 120 120h260c55 0 100-45 100-100 0-52.998-40.996-96.001-92.998-98.999zM208 172V96h64v76h68L240 272 140 172h68z"/></svg>
                                </div>
                            </a>
                        @endif
                    @endforeach
                </div>
                <div class="w-full md:w-1/3 px-4">
                    <div class="font-bold text-xl mb-4">محتوای مرتبط</div>
                    @foreach($related_products as $product)
                        <a href="{{ route('dashboard.show', [app()->getLocale(), $product->id]) }}" class="no-underline text-grey-darkest hover:text-black rounded mb-4 flex flex-wrap hover-shadow" style="background-color: #f6f8fa;">
                            <img class="rounded" src="{{ $product->image }}">
                            <div class="p-4 w-full">
                                <div class="w-full">{{ $product->title }}</div>
                                <div class="flex flex-row pt-3 w-full font-medium justify-between">
                                    <div class="ml-12 flex items-baseline">
                                        <div class="flex justify-center items-center bg-grey-lighter rounded-full w-4 h-4 ml-1">
                                            <svg class="w-2 h-2 fill-current text-green" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1026.666748046875 1024"><path d="M1021.833 385.5q-6.5-21.5-23-36t-38.5-17.5l-262-40-117-248q-10-20-28-32t-40-12-40 12-28 32l-117 248-262 40q-22 3-38.5 17.5t-23 36-1.5 43 21 37.5l190 193-45 273q-4 22 4 43t26 34q20 15 44 15 19 0 36-9l234-129 235 129q16 9 35 9 25 0 44-15 18-13 26-34t4-43l-44-273 189-193q16-15 21-37t-1.5-43.5z"/></svg>
                                        </div>
                                        {{ $product->video_count }} ویدئو
                                    </div>
                                    <div class="flex items-baseline">
                                        <div class="flex justify-center items-center bg-grey-lighter rounded-full w-4 h-4 ml-1">
                                            <svg class="w-2 h-2 fill-current text-green" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1026.666748046875 1024"><path d="M1021.833 385.5q-6.5-21.5-23-36t-38.5-17.5l-262-40-117-248q-10-20-28-32t-40-12-40 12-28 32l-117 248-262 40q-22 3-38.5 17.5t-23 36-1.5 43 21 37.5l190 193-45 273q-4 22 4 43t26 34q20 15 44 15 19 0 36-9l234-129 235 129q16 9 35 9 25 0 44-15 18-13 26-34t4-43l-44-273 189-193q16-15 21-37t-1.5-43.5z"/></svg>
                                        </div>
                                        {{ $product->article_count }} جزوه
                                    </div>
                                    {{-- <div class="ml-12 flex items-baseline">
                                        <div class="flex justify-center items-center bg-grey-lighter rounded-full w-4 h-4 ml-1">
                                            <svg class="w-2 h-2 fill-current text-green" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 638 1030"><path d="M68 13l558 476q12 11 12 26t-12 26L68 1017q-19 16-43.5 7T0 991V39Q0 15 24.5 6T68 13z"/></svg>
                                        </div>
                                        9K بازدید
                                    </div> --}}
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    
@endsection


@section('end-scripts-one')   
    <script>
        var player = videojs('player', {language: 'fa'});

        player.nuevo({!! $product_item->videojs_options !!});
        player.vroll({!! $product_item->preroll_options !!});

        player.hotkeys({
            volumeStep: 0.1,
            seekStep: 5,
            alwaysCaptureHotkeys: true
        });

        video.on('play', function() {
            // POST current time and state = 'playing' to the server
            axios.post('/fa/video_track', {
                product_item_id : {{ $product_item->id }},
                duration        : player.duration(),
                current_time    : player.currentTime(),
                state           : 'play',
            });
        })

        video.on('pause', function() {
            // POST current time and state = 'paused' to the server
            axios.post('/fa/video_track', {
                product_item_id        : {{ $product_item->id }},
                current_time           : player.currentTime(),
                remaining_time_display : player.remainingTimeDisplay(),
                state                  : 'pause',
            });
        })

        player.on('playing', function() {
          setInterval( function() {
              // POST current time and state to the server
              axios.post('/fa/video_track', {
                  product_item_id        : {{ $product_item->id }},
                  current_time           : player.currentTime(),
                  remaining_time_display : player.remainingTimeDisplay(),
              });
          }, 10000);
        });

    </script>
@endsection