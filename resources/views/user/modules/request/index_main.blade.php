@extends('staff.layouts.layout')

@section('layout-content')
    <div class="h-full bg-grey-lighter w-full text-grey-dark">

            <div class="hidden md:block shadow py-8 pb-4">
                <div class="container">
                    {{-- Header --}}
                    <div class="flex justify-between">
                        <a href="#" class="no-underline text-center text-grey-darkest hover:text-grey">
                            <div class="mb-3">
                                <img src="/image/site/home.svg" alt="Home">
                            </div>
                            <div>Home</div>                        
                        </a>
                        <a href="#" class="no-underline text-center text-grey-darkest hover:text-grey">
                            <div class="mb-3">
                                <img src="/image/site/user.svg" alt="User">
                            </div>
                            <div>Your Requests</div>
                        </a>
                        <a href="#" class="no-underline text-center text-grey-darkest hover:text-grey">
                            <div class="mb-3">
                                <img src="/image/site/bed.svg" alt="Bed">
                            </div>
                            <div>Choose Room</div>
                        </a>
                        <a href="#" class="no-underline text-center text-grey-darkest hover:text-grey">
                            <div class="mb-3">
                                <img src="/image/site/messages.svg" alt="Messages">
                            </div>
                            <div>Messages</div>
                        </a>
                        <a href="#" class="no-underline text-center text-grey-darkest hover:text-grey">
                            <div class="mb-3">
                                <img src="/image/site/settings.svg" alt="Settings">
                            </div>
                            <div>Settings</div>
                        </a>
                    </div>
                </div>
            </div>

            {{-- Side Navigation Bars - start --}}
            <div class="fixed pin-y pin-x z-10 w-4/5 shadow-lg overflow-scroll hidden">
                <div class="bg-white p-10">
                    <div class="text-sm uppercase font-bold mb-24">Helpchat</div>
                    <div class="uppercase text-xs font-bold">
                        <div class="flex items-center mb-10">
                            <a href="#" class="no-underline text-grey-darkest hover:text-grey-dark">
                                <img src="/image/site/home.svg" class="w-4 h-4 mr-4 align-text-bottom" alt="Home">
                                Home
                            </a>
                        </div>
                        <div class="flex items-center mb-10">
                            <a href="#" class="no-underline text-grey-darkest hover:text-grey-dark">
                                <img src="/image/site/user.svg" class="w-4 h-4 mr-4 align-text-bottom" alt="User">
                                Your Requests
                            </a>
                        </div>
                        <div class="flex items-center mb-10">
                            <a href="#" class="no-underline text-grey-darkest hover:text-grey-dark">
                                <img src="/image/site/bed.svg" class="w-4 h-4 mr-4 align-text-bottom" alt="Bed">
                                Choose Room
                            </a>
                        </div>
                        <div class="flex items-center mb-10">
                            <a href="#" class="no-underline text-grey-darkest hover:text-grey-dark">
                                <img src="/image/site/messages.svg" class="w-4 h-4 mr-4 align-text-bottom" alt="Messages">
                                Messages
                            </a>
                        </div>
                        <div class="flex items-center mb-10">
                            <a href="#" class="no-underline text-grey-darkest hover:text-grey-dark">
                                <img src="/image/site/settings.svg" class="w-4 h-4 mr-4 align-text-bottom" alt="Settings">
                                Settings
                            </a>
                        </div>
                    </div>
                </div>

                <div class="bg-indigo-dark uppercase p-10 py-12 text-xs">
                    <div class="flex flex-wrap opacity-75">
                        <div class="w-1/2 flex flex-col">
                            <a href="#" class="no-underline text-grey-light hover:text-grey-lightest mb-10">ABOUT</a>
                            <a href="#" class="no-underline text-grey-light hover:text-grey-lightest mb-10">HELP</a>
                            <a href="#" class="no-underline text-grey-light hover:text-grey-lightest mb-10">TERMS</a>
                            <a href="#" class="no-underline text-grey-light hover:text-grey-lightest mb-10">GUIDLINES</a>
                        </div>
                        <div class="w-1/2 flex flex-col">
                            <a href="#" class="no-underline text-grey-light hover:text-grey-lightest mb-10">TESTIMONIALS</a>
                            <a href="#" class="no-underline text-grey-light hover:text-grey-lightest mb-10">ADVERTISE</a>
                            <a href="#" class="no-underline text-grey-light hover:text-grey-lightest mb-10">INTEGRATIONS</a>
                            <a href="#" class="no-underline text-grey-light hover:text-grey-lightest mb-10">CAREERS</a>
                        </div>
                    </div>
                    <div>
                        <div class="w-full md:w-1/2 text-left mt-8">
                            <a href="#" class="mr-6">
                                <img src="/image/site/instagram.svg" class="w-4 h-4" alt="instagram">
                            </a> 
                            <a href="#" class="mr-6">
                                <img src="/image/site/twitter.svg" class="w-4 h-4" alt="twitter">
                            </a> 
                            <a href="#" class="mr-6">
                                <img src="/image/site/facebook.svg" class="w-4 h-4" alt="facebook">
                            </a>
                             <a href="#">
                                <img src="/image/site/web.svg" class="w-4 h-4" alt="web">
                            </a>
                         </div>
                    </div>
                </div>
            </div>
            {{-- Side Navigation Bars - end --}}

            {{-- mobile header start --}}
            <div class="md:hidden shadow py-6">
                <div class="container">
                    <div class="flex">
                        <div class="w-1/3">
                            <img src="/image/site/menu.svg" class="px-2 w-10" alt="menu">
                        </div>
                        <div class="w-1/3 text-center">Helpchat</div>
                    </div>
                </div>
            </div>
            {{-- mobile header end --}}

            {{-- settings start --}}
            <div class="container">
                <div class="rounded-lg bg-white flex flex-wrap p-4 py-6 md:px-8 mt-4 md:mt-8 justify-between">
                    <div class="flex items-center">
                        <img src="/image/site/settings-gears.svg" class="h-10 w-10 md:h-16 md:w-16 mr-3 md:mr-6" alt="users">
                        <div class="leading-tight">
                            <div class="text-xl md:text-4xl text-black">Settings</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="bg-white rounded-lg flex flex-wrap mt-4 md:mt-6">
                    <div class="w-full md:w-1/2 p-6 md:px-12">
                        <div class="flex">
                            <div class="w-1/6 flex justify-center items-center">
                                <img src="/image/site/simple-user.svg" class="w-6 h-6" alt="user">
                            </div>
                            <div class="w-5/6 py-8 flex justify-between border-b-2 border-grey-lighter">
                                <div class="font-bold">Account</div>
                                <div>Andrea Jakobsen</div>
                            </div>
                        </div>
                        <div class="flex">
                            <div class="w-1/6 flex justify-center items-center">
                                <img src="/image/site/language.svg" class="w-6 h-6" alt="language">
                            </div>
                            <div class="w-5/6 py-8 flex justify-between border-b-2 border-grey-lighter">
                                <div class="font-bold">Sprache wählen</div>
                                <div>Deutsch</div>
                            </div>
                        </div>
                        <div class="flex">
                            <div class="w-1/6 flex justify-center items-center">
                                <img src="/image/site/notification.svg" class="w-6 h-6" alt="notification">
                            </div>
                            <div class="w-5/6 py-8 flex justify-between border-b-2 border-grey-lighter">
                                <div class="font-bold">Benachrichtigungen</div>
                                <div>
                                    <div class="form-switch -my-2">
                                        <input type="checkbox" name="notification" id="notification" value="true" class="form-switch-checkbox"> 
                                        <label for="notification" class="form-switch-label"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex">
                            <div class="w-1/6 flex justify-center items-center">
                                <img src="/image/site/voice.svg" class="w-6 h-6" alt="voice">
                            </div>
                            <div class="w-5/6 py-8 flex justify-between border-b-2 border-grey-lighter">
                                <div class="font-bold">Ton</div>
                                <div>
                                    <div class="form-switch -my-2">
                                        <input type="checkbox" name="voice" id="voice" class="form-switch-checkbox"> 
                                        <label for="voice" class="form-switch-label"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex">
                            <div class="w-1/6 flex justify-center items-center">
                                <img src="/image/site/help.svg" class="w-6 h-6" alt="help">
                            </div>
                            <div class="w-5/6 py-8 flex justify-between border-b-2 border-grey-lighter">
                                <div class="font-bold">Hilfe</div>
                                <div>Fragen?</div>
                            </div>
                        </div>
                    </div>
                    <div class="w-full md:w-1/2 border-l-2 border-grey-lighter">
                        <div class="border-b-2 border-grey-lighter">
                            <div class="p-6 text-center">Account</div>
                        </div>
                        <div class="p-6 py-12 leading-normal flex flex-wrap justify-center items-center">

                            <div class="w-full md:w-3/4 -mb-2">
                                <div class="p-4 px-6 border-2 border-indigo-lightest bg-indigo-lightest rounded-lg w-full mb-2 flex cursor-pointer flex justify-between">
                                    <div class="flex">
                                        <img src="/image/site/german.svg" class="w-6 h-6 mr-3" alt="german">
                                        Deutsch
                                    </div>
                                    <img src="/image/site/simple-check.svg" alt="check">
                                </div>
                                <div class="p-4 px-6 border-2 border-indigo-lightest rounded-lg w-full mb-2 flex cursor-pointer flex justify-between">
                                    <div class="flex">
                                        <img src="/image/site/france.svg" class="w-6 h-6 mr-3" alt="france">
                                        Français
                                    </div>
                                </div>
                                <div class="p-4 px-6 border-2 border-indigo-lightest rounded-lg w-full mb-2 flex cursor-pointer flex justify-between">
                                    <div class="flex">
                                        <img src="/image/site/uk.svg" class="w-6 h-6 mr-3" alt="uk">
                                        English
                                    </div>
                                </div>
                                <div class="p-4 px-6 border-2 border-indigo-lightest rounded-lg w-full mb-2 flex cursor-pointer flex justify-between">
                                    <div class="flex">
                                        <img src="/image/site/spain.svg" class="w-6 h-6 mr-3" alt="spain">
                                        Español
                                    </div>
                                </div>
                                <br>
                            </div>

                            <div class="bg-indigo-lightest rounded-lg w-full md:w-3/4">
                                <div class="p-6 px-8" style="min-height: 240px;">
                                    <div class="flex justify-between">
                                        <div>
                                            <div class="font-bold text-xl">Andrea Jakobsen</div>
                                            <div>Lorem, ipsum.</div>
                                        </div>
                                        <div>
                                            <img src="/image/site/avatar.svg" class="h-24 w-24" alt="avatar">
                                        </div>
                                    </div>
                                    <div></div>
                                </div>
                                <div class="border-t-2 border-grey-lighter p-6 px-8">
                                    <a href="#" class="no-underline text-grey-dark">
                                        <img src="/image/site/pen.svg" alt="edit" class="align-text-top h-4 w-4 mr-2">Edit
                                    </a>
                                </div>
                            </div>
                            <div class="w-full mt-8">
                                <a href="#" class="text-sm bg-indigo-dark block no-underline no-underline p-3 rounded-full text-center text-white w-48 hover:bg-white hover:text-indigo-dark mt-4 border-2 border-indigo-dark mx-auto">Logout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- settings end --}}

            {{-- select rooms start --}}
            <div class="container">
                <div class="rounded-lg bg-white flex flex-wrap p-4 py-6 md:px-8 mt-8 justify-between">
                    <div class="flex flex-wrap items-center">
                        <div>
                            <img src="/image/site/users.svg" class="h-10 w-10 md:h-16 md:w-16 mr-3 md:mr-6" alt="users">
                        </div>
                        <div class="leading-tight">
                            <div class="text-xl md:text-4xl text-black">8 current requests</div>
                            <div class="text-purple md:text-2xl">24 patients are in Helpchat</div>
                        </div>
                    </div>
                    <div class="hidden md:flex items-center justify-end w-full md:w-auto text-sm md:text-base">
                        <div class="mr-10 text-center">
                            <img src="/image/site/radio.svg" class="w-4 h-4 md:h-6 md:w-6" alt="radio">
                            <div class="mt-1">Select All</div>
                        </div>
                        <div class="text-center">
                            <img src="/image/site/save.svg" class="w-4 h-4 md:h-6 md:w-6" alt="save">
                            <div class="mt-1">Save</div>
                        </div>
                    </div>
                </div>

                <div class="flex md:hidden rounded-lg bg-white flex-wrap p-4 md:px-8 mt-4 justify-between">
                    <div class="flex items-center justify-around w-full md:w-auto text-sm md:text-base">
                        <div class="text-center">
                            <img src="/image/site/radio.svg" class="h-6 w-6" alt="radio">
                            <div class="mt-1">Select All</div>
                        </div>
                        <div class="text-center">
                            <img src="/image/site/save.svg" class="h-6 w-6" alt="save">
                            <div class="mt-1">Save</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container mt-4">
                <div class="flex flex-wrap -mx-1 md:-mx-2 -mb-2">
                    @foreach(range(1, 8) as $item)
                    <div class="w-1/2 md:w-1/4 px-1 md:px-2 mb-2 md:mb-4">
                        <div class="flex justify-between items-center bg-indigo-lightest rounded-lg p-2 py-4 md:py-4 md:px-6 border-2 border-indigo-lightest">
                            <div>Room 1</div>
                            <img src="/image/site/bed-circle.svg" class="w-6 h-6 md:h-16 md:w-16" alt="bed-circle">
                        </div>
                    </div>
                    <div class="w-1/2 md:w-1/4 px-1 md:px-2 mb-2 md:mb-4">
                        <div class="flex justify-between items-center bg-white rounded-lg p-2 py-4 md:py-4 md:px-6 border-2 border-indigo-lightest">
                            <div>Room 1</div>
                            <img src="/image/site/bed-circle.svg" class="w-6 h-6 md:h-16 md:w-16" alt="bed-circle">
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            {{-- select rooms end --}}

            <div class="container my-16">
                @foreach(range(1, 2) as $item)
                <div class="bg-white rounded-lg flex mb-4">
                    <div class="w-1/3 md:w-1/5 flex flex-col md:flex-row items-center py-2 px-3 md:py-4 md:px-6">
                        <div>
                            <img src="/image/site/service-1.svg" class="h-16 w-16" alt="service-1">
                        </div>
                        <div class="leading-normal ml-4">
                            <div>Room 18</div>
                            <div>Bed 3</div>
                        </div>
                    </div>
                    <div class="w-1/3 md:w-3/5 py-2 px-3 md:py-4 md:px-6 border-r-2 border-l-2 border-grey-lighter">
                        <div class="leading-tight">
                            <div class="font-bold text-xl md:text-2xl">Infusion</div>
                            <div class="md:text-xl">Infusion finished</div>
                            <div class="text-right text-indigo text-base">5 min ago</div>
                        </div>
                    </div>
                    <div class="w-1/3 md:w-1/5 py-2 px-3 md:py-4 md:px-6 flex flex-col md:flex-row justify-around items-center">
                        <div class="w-1/2 text-center">
                            <img src="/image/site/green-check.svg" alt="green-check">
                            <div class="mt-2">Done</div>
                        </div>
                        <div class="w-1/2 text-center">
                            <img src="/image/site/red-share.svg" alt="red-share">
                            <div class="mt-2">Share</div>
                        </div>
                    </div>
                </div>
                @endforeach

                @foreach(range(1, 2) as $item)
                <div class="bg-grey-light rounded-lg flex mb-4">
                    <div class="w-1/3 md:w-1/5 flex flex-col md:flex-row items-center py-2 px-3 md:py-4 md:px-6">
                        <div>
                            <img src="/image/site/service-1.svg" class="h-16 w-16" alt="service-1">
                        </div>
                        <div class="leading-normal ml-4">
                            <div>Room 18</div>
                            <div>Bed 3</div>
                        </div>
                    </div>
                    <div class="w-1/3 md:w-3/5 py-2 px-3 md:py-4 md:px-6 border-r-2 border-l-2 border-grey-lighter">
                        <div class="leading-tight">
                            <div class="font-bold text-xl md:text-2xl">Infusion</div>
                            <div class="md:text-xl">Infusion finished</div>
                            <div class="text-right text-indigo text-base">5 min ago</div>
                        </div>
                    </div>
                    <div class="w-1/3 md:w-1/5 py-2 px-3 md:py-4 md:px-6 flex flex-col md:flex-row justify-around items-center">
                        <div class="w-1/2 text-center">
                            <img src="/image/site/big-cross.svg" alt="big-cross">
                            <div class="mt-2">Reopen</div>
                        </div>
                        <div class="w-1/2 text-center">
                            <img src="/image/site/green-check.svg" alt="green-check">
                            <div class="mt-2">Share</div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="container">
                <div class="rounded-lg bg-white flex flex-wrap p-4 py-6 md:px-8 mt-8 justify-between">
                    <div class="flex flex-wrap items-center">
                        <img src="/image/site/users.svg" class="h-10 w-10 md:h-16 md:w-16 mr-3 md:mr-6" alt="users">
                        <div class="leading-tight">
                            <div class="text-xl md:text-4xl text-black">8 current requests</div>
                            <div class="text-purple md:text-2xl">24 patients are in Helpchat</div>
                        </div>
                    </div>
                    <div class="hidden md:flex items-center">
                        <div class="mr-10">
                            <img src="/image/site/menu-2.svg" alt="menu-2">
                        </div>
                        <div class="">
                            <img src="/image/site/menu-1.svg" alt="menu-1">
                        </div>
                    </div>
                </div>
            </div>

            <div class="container mt-4 md:mt-6 text-grey-dark">
                <div class="w-full md:w-1/3 mb-4 md:mb-6 bg-white rounded-lg p-6 text-center text-xl">
                    No requests at the moment
                </div>

                <div class="flex flex-wrap -mx-6">
                    @foreach(range(1, 3) as $item)
                    <div class="w-full md:w-1/3 mb-4 md:mb-12 px-6">
                        <div class="bg-white rounded-lg py-4 px-6 shadow">
                            <div class="md:text-xl mb-6">Requests of Room 4  - Bed 3</div>
                            <div class="text-center">
                                <img src="/image/site/service-1.svg" class="w-48 md:w-64" alt="service-1">
                            </div>
                            <div class="leading-normal px-6">
                                <div class="font-bold text-xl md:text-2xl">Infusion</div>
                                <div class="md:text-xl">Infusion finished</div>
                                <div class="text-right text-indigo font-bold text-base mt-4">5 min ago</div>
                            </div>
                            <div class="border-b-2 border-indigo-lightest -mx-6 my-3"></div>
                            <div class="flex flex-wrap py-4">
                                <button type="button" class="rhc-btn-type-one mb-3">
                                    Reqeust done
                                    <img class="absolute pin-r pin-t w-10 h-10" src="/image/site/check.svg" alt="check">
                                </button>
                                <button type="button" class="rhc-btn-type-one">
                                    Share
                                    <img class="absolute pin-r pin-t w-10 h-10" src="/image/site/share.svg" alt="share">
                                </button>
                            </div>
                        </div>
                    </div>
                    @endforeach

                    @foreach(range(1, 3) as $item)
                    <div class="w-full md:w-1/3 mb-4 md:mb-12 px-6">
                        <div class="bg-white rounded-lg py-4 px-6 shadow">
                            <div class="md:text-xl mb-6">Requests of Room 4  - Bed 3</div>
                            <div class="text-center">
                                <img src="/image/site/big-check.svg" class="w-48 md:w-64" alt="service-1">
                            </div>
                            <div class="leading-normal px-6">
                                <div class="font-bold text-xl md:text-2xl">Infusion</div>
                                <div class="md:text-xl">Infusion finished</div>
                                <div class="text-right text-indigo font-bold text-base mt-4">5 min ago</div>
                            </div>
                            <div class="border-b-2 border-indigo-lightest -mx-6 my-3"></div>
                            <div class="flex flex-wrap py-4">
                                <button type="button" class="rhc-btn-type-one mb-3">
                                    Reopen Reqeust
                                    <img class="absolute pin-r pin-t w-10 h-10" src="/image/site/cross.svg" alt="cross">
                                </button>
                                <div type="button" class="rhc-btn-type-one-disabled">
                                    Share
                                    <img class="absolute pin-r pin-t w-10 h-10" src="/image/site/share.svg" alt="share">
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
@endsection