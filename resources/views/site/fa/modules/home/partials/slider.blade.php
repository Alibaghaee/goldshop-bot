{{-- slider --}}
<div class="owl-carousel main-slider dir-ltr z-0" id="slider-6">
    @foreach($slider->items as $item)
      <div>
        <img src="/imagecache/top-slider/{{ str_replace('/storage/images/', '', $item->image) }}">
      </div>
    @endforeach
</div>