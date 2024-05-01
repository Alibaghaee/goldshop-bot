@extends(getSiteBladePath('layouts.master'))

@section('title', 'اتوبوسرانی')

@section('content')





    <div class="shadow-inner py-2 bg-teal">

        <div class="container">
            <div class="flex flex-row-reverse flex-wrap items-center justify-start w-full">
                <div>
                    <form action="{{route('logout',app()->getLocale())}}" method="post">
                        @csrf
                        <button class="rounded rounded-md   m-1 p-2
                text-center text-teal hover:text-white hover:bg-teal bg-white
                   shadow-lg"
                        >
                            خروج
                        </button>
                    </form>
                </div>
                <a class="rounded rounded-md   m-1 p-2
                text-center text-teal hover:text-white hover:bg-teal bg-white
                   shadow-lg"
                   href="{{url('fa/login')}}"

                >صفحه اصلی</a>
                <div>
                </div>
            </div>
        </div>
    </div>
    <div class="border-b border-grey-lighter">
        <div class="container">
            <form action="{{route('profile.update',app()->getLocale())}}" method="post">
                @csrf
                @method("PUT")

                <div class="mx-0">
                    <div class="mt-3 w-full  rounded rounded-md border border-teal">
                        <div class="flex flex-row text-grey-darkest">
                            <div class="flex flex-col px-3 mx-3">

                                <div class="p-2">
                                    <div class="inline-block px-3 ml-2">نام:</div>
                                    <div class="inline-block text-grey-darker">
                                        <input value="{{$user->name}}" type="text" name="name"
                                               class="rounded rounded   bg-teal-lightest p-1">
                                    </div>
                                </div>
                                <div class="p-2">
                                    <div class="inline-block px-3 ml-2">نام خانوادگی:</div>
                                    <div class="inline-block text-grey-darker">
                                        <input value="{{$user->family}}" type="text" name="family"
                                               class="rounded rounded   bg-teal-lightest p-1">
                                    </div>
                                </div>
{{--                                <div class="p-2">--}}
{{--                                    <div class="inline-block px-3 ml-2">موبایل:</div>--}}
{{--                                    <div class="inline-block text-grey-darker">--}}
{{--                                        <input value="{{$user->mobile}}" type="text" name="mobile"--}}
{{--                                               class="rounded rounded   bg-teal-lightest p-1">--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                                <div class="p-2">
                                    <div class="inline-block px-3 ml-2">موبایل دوم:</div>
                                    <div class="inline-block text-grey-darker">
                                        <input value="{{$user->second_mobile}}" type="text" name="second_mobile"
                                               class="rounded rounded   bg-teal-lightest p-1">
                                    </div>
                                </div>

                            </div>

                            <div class="flex flex-col px-3 mx-3">


                                <div class="p-2">
                                    <div class="">آدرس:</div>
                                    <div class="inline-block text-grey-darker">
                                    <textarea
                                        cols="40" rows="5"
                                        type="text" name="address" class="rounded rounded   bg-teal-lightest p-1">
                                            {{$user->address}}
                                         </textarea>
                                    </div>
                                </div>


                            </div>

                        </div>
                        <div class="inline-block text-red p-1 text-sm">
                            @if($errors->any())
                                {!! implode('', $errors->all('<div>:message</div>')) !!}
                            @endif

                        </div>
                    </div>
                </div>


                <div class="flex flex-wrap py-1 items-center font-semibold text-grey-darkest text-center">
                    <div class="flex flex-wrap items-center justify-center md:justify-start md:w-4/5 py-1 w-full ">
                        <div class="flex flex-col md:flex-row   mt-2 mx-0 ">

                            <button class="rounded rounded-md border  border-teal m-1 p-3
                text-center text-teal hover:text-white hover:bg-teal
                   shadow-md"
                            >تایید
                            </button>

                        </div>

                    </div>
                </div>
            </form>
        </div>
@endsection
