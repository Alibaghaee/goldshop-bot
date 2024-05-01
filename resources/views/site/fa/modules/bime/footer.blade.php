@if(isset($contactUs) && $contactUs !== null)
    <div id="contactUs"></div>
    <contact-us :item="{{$contactUs}}"></contact-us>
@endIf

<div class="w-full py-12 bg-blue-900 text-white">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 justify-items-center content-between text-sm">
        <div class="  ">
            <div class="p-2 flex flex-col ">
                <div class="mb-10 font-bold">{{$aboutMeFooter->name}}</div>
                <div class="p-1 mt-1 text-justify">{!! $aboutMeFooter->description !!}</div>

            </div>
        </div>
        <div class="  ">
            <div class="p-2 flex flex-col">
                <div class="mb-10 font-bold">{{$infoFooter->name}}</div>

                <div class=" mt-1 p-1 flex flex-col">
                    @foreach($infoFooter->items->sortBy('order') as $item)

                        <div class="mt-1  flex flex-row">
                            <div>{{$item->title}}:</div>
                            <div>{!! $item->description !!}</div>
                        </div>

                    @endforeach
                </div>
            </div>
        </div>

    </div>

</div>
<footer class="flex gap-2 bg-black text-white py-6 px-2  "  >
    <p class="text-center grow text-xs">© تمام حقوق مادى و معنوى وب سایت براى شرکت امید آسایش و سرمایه
        ایرانیان محفوظ است 1402</p>
</footer>
