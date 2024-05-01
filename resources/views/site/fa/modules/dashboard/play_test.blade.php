@extends(getSiteBladePath('layouts.master'))

@section('title', $product_item->title ?? '')

@section('content')
    
    <div class="">
        <div class="container md:py-8 md:my-8 leading-loose text-black">
            <div class="flex flex-wrap -mx-4">
                <div class="w-full px-4">
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
                </div>
            </div>
        </div>
    </div>
    
@endsection


@section('end-scripts')
    <script>
        var player = videojs('player', {language: 'fa'});

        player.nuevo({!! $product_item->videojs_options !!});
        player.vroll({!! $product_item->preroll_options !!});

        player.hotkeys({
            volumeStep: 0.1,
            seekStep: 5,
            alwaysCaptureHotkeys: true
        });

        player.on("pause", function(){
            // player.related();
        });
    </script>
@endsection