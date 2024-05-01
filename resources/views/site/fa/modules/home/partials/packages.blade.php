<div class="leading-loose text-purple-darkest">
    <div class="flex flex-wrap container py-12">
        <div class="text-center md:text-right text-2xl md:text-3xl font-bold text-purple-darkest mb-2 w-full">جهت خرید هر یک از محصولات زیر روی آن کلیک کنید</div>
            
            @foreach($packages->chunk(4) as $packages_chunk)
            <div class="flex flex-wrap -mx-2">
                @foreach($packages_chunk as $package)
                    <div class="w-full md:w-1/4 px-0 mb-6 px-2">
                      <div class="bg-white shadow flex flex-wrap rounded">
                          <div class="flex justify-center items-center w-full">
                              <a href="{{ $package->index_url }}" class="w-full">
                                  <img src="{{ $package->image }}" class="w-full rounded-t" alt="{{ $package->title }}">
                              </a>
                          </div>
                          <div class="flex flex-col p-3 px-4 rounded w-full">
                              <div class="flex flex-col py-3 border-b-2 border-grey-lighter w-full">
                                  <a href="{{ $package->index_url }}" class="no-underline font-bold text-xl text-purple-darkest hover:text-purple-dark w-full">{{ $package->title }}</a>
                                  <div class="text-green font-medium">{{ number_format($package->price) }} ریال</div>
                              </div>
                              <div class="py-3">{{ $package->info }}</div>
                          </div>
                      </div>
                    </div>
                @endforeach
            </div>
            @endforeach
    </div>
</div>