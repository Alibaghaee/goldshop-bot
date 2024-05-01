<div class="flex justify-between flex-wrap text-grey-dark bg-white">
        <div class="h-16 flex flex-auto justify-start rahco-center">
            <div class="rahco-center h-full px-4 py-2 border-l border-grey-lighter cursor-pointer hover:bg-grey-lighter" :class="{ 'text-blue-light' : !right_open }" @click="minimize('right')">
                <svg class="w-8 h-8 fill-current" viewBox="0 0 1195 1195" xmlns="http://www.w3.org/2000/svg"><path d="M213.333 853.333h768V768h-768v85.333zm0-213.333h768v-85.333h-768V640zm0-298.667v85.333h768v-85.333h-768z"/></svg>
            </div>
            {{-- <div class="rahco-center p-2 h-full">
                <svg class="w-6 fill-current" viewBox="0 0 1195 1195" xmlns="http://www.w3.org/2000/svg"><path d="M1077.595 935.396L835.043 729.102c-25.074-22.566-51.89-32.926-73.552-31.926 57.256-67.068 91.842-154.078 91.842-249.176 0-212.078-171.922-384-384-384-212.076 0-384 171.922-384 384s171.922 384 384 384c95.098 0 182.108-34.586 249.176-91.844-1 21.662 9.36 48.478 31.926 73.552L956.73 1056.26c35.322 39.246 93.022 42.554 128.22 7.356s31.892-92.898-7.354-128.22zM469.333 704c-141.384 0-256-114.616-256-256s114.616-256 256-256 256 114.616 256 256-114.614 256-256 256z"/></svg>
                <input type="text" class="h-8 mr-2 rounded p-2" placeholder="جستجو">
            </div> --}}
        </div>

        <div class="rahco-center h-16 flex-auto">
            {{-- <div class="rahco-center flex-auto px-4 py-2 h-full cursor-pointer hover:bg-grey-lighter">
                <div>
                    <svg class="w-6 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 384"><path d="M317.7 161.9c0-97.6-52.5-130.8-101.6-138.2 0-.5.1-1 .1-1.6C216.2 9.8 205.3 0 192 0c-13.3 0-23.8 9.8-23.8 22.1 0 .6 0 1.1.1 1.6-49.2 7.5-102 40.8-102 138.4 0 113.8-28.3 126-66.3 158h384c-37.8-32.1-66.3-44.4-66.3-158.2zM192.2 384c26.8 0 48.8-19.9 51.7-43H140.5c2.8 23.1 24.9 43 51.7 43z"/></svg>
                </div>
                <div class="rahco-notify-count bg-pink-light">2</div>
            </div>

            <div class="rahco-center flex-auto px-4 py-2 h-full cursor-pointer hover:bg-grey-lighter">
                <div>
                    <svg class="w-6 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 256"><path d="M384 256V13.8l-131.1 99.8L321 191l-2 2-78.9-69.6L192 160l-48.1-36.6L65 193l-2-2 68-77.4L0 14v242z"/><path d="M375.7 0H8l184 139.9z"/></svg>
                </div>
                <div class="rahco-notify-count bg-orange-light">5</div>
            </div>

            <div class="rahco-center flex-auto px-4 py-2 h-full cursor-pointer hover:bg-grey-lighter">
                <div>
                    <svg class="w-6 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 367.79998779296875 352"><path d="M341.4 255.4c-14.6-15-56.1-43.1-83.3-43.1-6.3 0-11.8 1.4-16.3 4.3-13.3 8.5-23.9 15.1-29 15.1-2.8 0-5.8-2.5-12.4-8.2l-1.1-1c-18.3-15.9-22.2-20-29.3-27.4l-1.8-1.9c-1.3-1.3-2.4-2.5-3.5-3.6-6.2-6.4-10.7-11-26.6-29l-.7-.8c-7.6-8.6-12.6-14.2-12.9-18.3-.3-4 3.2-10.5 12.1-22.6 10.8-14.6 11.2-32.6 1.3-53.5-7.9-16.5-20.8-32.3-32.2-46.2l-1-1.2C94.9 6 83.5 0 70.8 0 56.7 0 45 7.6 38.8 11.6c-.5.3-1 .7-1.5 1-13.9 8.8-24 20.9-27.8 33.2C3.8 64.3 0 88.3 27.3 138.2c23.6 43.2 45 72.2 79 107.1 32 32.8 46.2 43.4 78 66.4 35.4 25.6 69.4 40.3 93.2 40.3 22.1 0 39.5 0 64.3-29.9 26-31.4 15.2-50.6-.4-66.7z"/></svg>
                </div>
                <div class="rahco-notify-count bg-green-light">7</div>
            </div> --}}
            
            @auth('admin')

            <div class="cursor-pointer flex-auto h-full hover:bg-grey-lighter rahco-center">
                <a href="{{ route('logout', app()->getLocale()) }}" 
                    class="h-full px-4 py-2 rahco-center text-grey-dark w-full" 
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    <svg class="w-6 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 448"><path d="M334.863 291.883l22.627 22.627L448 224l-90.51-90.51-22.628 22.628L386.745 208H160v32h226.745z"/><path d="M359.491 359.766C323.229 396.029 275.018 416 223.736 416c-51.287 0-99.506-19.971-135.772-56.235C51.697 323.501 32 275.285 32 224c0-51.281 19.697-99.495 55.965-135.761C124.232 51.973 172.45 32 223.736 32c51.279 0 99.491 19.973 135.755 56.238A196.044 196.044 0 0 1 366.824 96h40.731C367.081 37.972 299.846 0 223.736 0 100.021 0 0 100.298 0 224c0 123.715 100.021 224 223.736 224 76.112 0 143.35-37.97 183.822-96h-40.73a194.792 194.792 0 0 1-7.337 7.766z"/></svg>
                </a>
                <form id="logout-form" action="{{ route('logout', app()->getLocale()) }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
            @endauth

            <a href="/profiles/profiles/x/edit" class="rahco-center flex-auto px-4 py-2 h-full cursor-pointer hover:bg-grey-lighter no-underline text-grey-dark" title="ویرایش پروفایل">
                <div>{{ auth()->user()->fullname }}</div>
                <img src="{{ auth()->user()->avatar }}" class="w-12 mr-2" alt="">
            </a>

            <div class="rahco-center h-full px-4 py-2 border-r border-grey-lighter cursor-pointer hover:bg-grey-lighter" :class="{ 'text-blue-light' : !left_open }" @click="minimize('left')">
                <svg class="w-8 fill-current" viewBox="0 0 1195 1195" xmlns="http://www.w3.org/2000/svg"><path d="M213.333 853.333h768V768h-768v85.333zm0-213.333h768v-85.333h-768V640zm0-298.667v85.333h768v-85.333h-768z"/></svg>
            </div>
        </div>
    </div>