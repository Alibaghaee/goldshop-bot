<div class="h-16 bg-indigo-light flex justify-center items-center text-2xl flex">
    <a href="#" class="flex-1 h-full bg-indigo-light hover:bg-indigo-dark text-white flex items-center justify-center no-underline border-l border-indigo">
        <svg class="w-8 h-8 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 416 416"><path d="M246.1 317.5c-2.6-1.8-7.2-4.5-17.5-4.5H112.5C77.8 313 48 286.9 48 253.8V153h-1.8C19.9 153 0 173.5 0 198.5v128.9c0 25 21.4 40.6 47.7 40.6H64v48l53.1-45c1.9-1.4 5.3-3 13.2-3h89.8c23 0 47.4-11.4 51.9-32l-25.9-18.5z"/><path d="M353 0H135.7C101 0 80 26.8 80 59.8V228c0 33.1 28 60 62.7 60h101.1c10.4 0 15 2.3 17.5 4.2L336 352v-64h17c34.8 0 63-26.9 63-59.9V59.8c0-33-28.2-59.8-63-59.8z"/></svg>
    </a>
    <a href="#" class="flex-1 h-full bg-indigo-light hover:bg-indigo-dark text-white flex items-center justify-center no-underline border-l border-indigo">
        <svg class="w-8 h-8 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M32 384h272v32H32zM400 384h80v32h-80zM384 447.5c0 17.949-14.327 32.5-32 32.5-17.673 0-32-14.551-32-32.5v-95c0-17.949 14.327-32.5 32-32.5 17.673 0 32 14.551 32 32.5v95z"/><g><path d="M32 240h80v32H32zM208 240h272v32H208zM192 303.5c0 17.949-14.327 32.5-32 32.5-17.673 0-32-14.551-32-32.5v-95c0-17.949 14.327-32.5 32-32.5 17.673 0 32 14.551 32 32.5v95z"/></g><g><path d="M32 96h272v32H32zM400 96h80v32h-80zM384 159.5c0 17.949-14.327 32.5-32 32.5-17.673 0-32-14.551-32-32.5v-95c0-17.949 14.327-32.5 32-32.5 17.673 0 32 14.551 32 32.5v95z"/></g></svg>
    </a>
    <a href="#" class="flex-1 h-full bg-indigo-light hover:bg-indigo-dark text-white flex items-center justify-center no-underline border-l border-indigo">
        <svg class="w-8 h-8 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 404.3999938964844 396.1000061035156"><path d="M384.7 134.5c12.2-14.2 19.6-32.3 19.6-52.2.1-43.8-35.5-79.6-80.4-82.1-1.6-.1-3.1-.1-4.8-.1-20.4-.1-39.1 6.8-53.8 18.1l53.8 52.4L308.5 81c-25.7-19.4-57.2-32-91.2-34.9V46c0-8.5-7-15.5-15.5-15.5s-15.5 7-15.5 15.5v.1c-34 2.9-65 15.5-90.6 34.9L85.3 70.7l53.8-52.4C124.4 6.9 105.7.1 85.4.2c-1.6 0-3.2.1-4.8.1C35.6 2.8 0 38.6.2 82.4c0 19.8 7.4 38 19.6 52.2l54-52.6 9.5 9.5c-35.1 31.9-57.1 78-57.1 129.2 0 43.9 16.2 84 43 114.7L32.8 380l12.5 10.1 35.2-42.9c31.6 30.2 74.4 48.9 121.6 48.9h.4c47.2 0 90.2-18.7 121.8-48.9l35.2 43 12.3-10.1-36.5-44.7c26.8-30.8 43-70.9 43-114.7 0-51.1-22-97.3-57.2-129.3l9.5-9.5 54.1 52.6zM218.3 246.1h-112v-16h96v-128h16v144z"/></svg>
    </a>
</div>

<div class="bg-white p-2">
    <input type="text" value="" placeholder="جستجو پرونده" class="mb-2 rahco-text-input">

    <simple-card color="bg-pink-light" title="18" description="مراجعه امروز"></simple-card>
    <simple-card color="bg-blue-light" title="7" description="نوبت های خالی"></simple-card>
    <simple-card color="bg-teal-light" title="7" description="نوبت های خالی"></simple-card>

    <div class="rounded text-grey-darker bg-grey-lighter mt-4 p-2">
        <todos :tasks="null"></todos>
    </div>
</div>

