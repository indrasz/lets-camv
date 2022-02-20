@extends('layouts.front')

@section('title', ' Home')

@section('content')

    {{-- top --}}
    <div class="hero-bg">
        <!-- hero -->
        <div class="hero">
            <div class="mx-auto flex pt-16 pb-16 lg:pb-20 lg:px-24 md:px-16 sm:px-8 px-8 lg:flex-row flex-col">
                <!-- Left Column -->
                <div
                    class="lg:flex-grow lg:w-1/2 flex flex-col lg:items-start lg:text-left mb-3 md:mb-12 lg:mb-0 items-center text-center">
                    <h1
                        class="text-black-1 lg:leading-normal sm:text-4xl lg:text-5xl text-3xl mb-5 font-semibold lg:mt-20">
                        It’s Not Too Late To Find
                        SomeThing New Up There
                        With Let’s CamV

                    </h1>
                    <p class="text-lg leading-relaxed text-serv-text font-light tracking-wide mb-10 lg:mb-18 ">
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.  <br class="lg:block hidden">

                    </p>
                    <div class="md:flex contents items-center mx-auto lg:mx-0 lg:flex justify-center lg:space-x-8 md:space-x-2 space-x-0">
                        @guest
                            <div class="hidden lg:flex lg:items-center lg:w-auto w-full" id="menu">
                                <button
                                    onclick="toggleModal('loginModal')"
                                    class="lg:bg-serv-services-bg text-serv-login-text items-center border-0 block lg:inline-block  lg:py-3 lg:px-10 focus:outline-none rounded-2xl font-medium text-base mt-6 mr-5 lg:mt-0">
                                    Log In
                                </button>

                                <button
                                    onclick="toggleModal('registerModal')"
                                    class="lg:bg-serv-services-bg text-serv-login-text items-center border-0 block lg:inline-block  lg:py-3 lg:px-10 focus:outline-none rounded-2xl font-medium text-base mt-6 lg:mt-0">
                                    Sign Up
                                </button>
                            </div>
                        @endguest
                    </div>
                </div>
                <!-- Right Column -->
                <div class="w-full lg:w-1/2 text-center lg:justify-start justify-center flex pr-0">
                    <img class="bottom-0 lg:block lg:right-24 md:right-16 sm:right-8 right-8 w-75"
                        src="{{ asset('/assets/images/banner-camv.png') }}" width="650" alt="" />
                </div>
            </div>

        </div>
    </div>

    {{-- content --}}
    <div class="content">
        <!-- services -->
        <div class="bg-serv-services-bg overflow-hidden">
            <div class="pt-16 pb-16 lg:pb-20 lg:pl-24 md:pl-16 sm:pl-8 pl-8 mx-auto">
                <div class="flex flex-col w-full">
                    <h2 class="sm:text-2xl text-xl tracking-wider font-semibold mb-5 text-medium-black">
                        Our Recommendation For You</h2>
                </div>
                <div class="flex overflow-x-scroll pb-10 hide-scroll-bar dragscroll -mx-3">
                    <div class="flex flex-nowrap">

                        @forelse ($destination as $item)
                            @include('components.landing.service')
                        @empty
                            {{-- empty --}}
                        @endforelse
                       
                    </div>
                </div>
            </div>
        </div>

        <!-- call to action -->
        <div class="py-10 lg:py-24 flex lg:flex-row flex-col items-center cta-bg">
            <!-- Left Column -->
            <div class="w-full lg:w-1/2 text-center justify-center flex lg:mb-0 mb-12">
                <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ" data-lity>
                    <img id="hero" src="{{ asset('/assets/images/banner-camv.png') }}" width="650" alt="" class="p-5" />
                </a>
            </div>
            <!-- Right Column -->
            <div class="lg:w-1/2 w-full flex flex-col lg:items-start items-center lg:text-left text-center">
                <h2 class="md:text-4xl text-3xl font-semibold mb-10 lg:leading-normal text-medium-black">
                    Why? Choose Let’s Camv
                </h2>
                <p class="text-lg leading-relaxed text-serv-text font-light mb-10 lg:mb-18">
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                </p>
                <a
                    href="explore.php"
                    class="bg-serv-button px-10 py-4 text-base text-white font-semibold rounded-xl cursor-pointer focus:outline-none tracking-wide">
                    Learn More
                </a>
            </div>
        </div>
    </div>

@endsection
