@extends('layouts.front')

@section('title', ' Detail')

@section('content')

    <div>
         <!-- breadcrumb -->
         <nav class="mx-8 mt-8 text-sm lg:mx-20" aria-label="Breadcrumb">
            <ol class="inline-flex p-0 list-none">
                <li class="flex items-center">
                    <a href="{{ route('home') }}" class="text-gray-400">Home</a>
                    <svg class="w-3 h-3 mx-3 text-gray-400 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                        <path d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z" />
                    </svg>
                </li>
                <li class="flex items-center">
                    <a href="#" class="text-gray-400">Detail Destinasi</a>
                    <svg class="w-3 h-3 mx-3 text-gray-400 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                        <path d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z" />
                    </svg>
                </li>
                <li class="flex items-center">
                    <a href="#" class="font-medium">{{ $destination->name }}</a>

                </li>
            </ol>
        </nav>
    </div>

    {{-- detail --}}
    <section class="px-4 pt-6 pb-20 mx-auto w-auth lg:mx-12">
        <div class="grid gap-5 md:grid-cols-12">

            <main class="p-4 lg:col-span-8 md:col-span-12">
                <!-- details heading -->
                <div class="details-heading">
                    <h1 class="text-2xl font-semibold">{{ $destination->name ?? '' }}</h1>
                    <div class="my-3">
                        @include('components.landing.rating')
                    </div>
                </div>
                <div class="p-3 my-4 bg-gray-100 rounded-lg image-gallery" x-data="gallery()">
                    <img :src="featured" alt="" class="rounded-lg cursor-pointer w-100" data-lity>
                    <div class="flex overflow-x-scroll hide-scroll-bar dragscroll">

                        <div class="flex mt-2 flex-nowrap">
                            @forelse ($destination->gallery as $item)
                                <img :class="{ 'border-4 border-serv-button': active === {{ $item->id }} }" @click="changeThumbnail('{{ url(Storage::url($item->photos)) }}', {{ $item->id }})" src="{{ url(Storage::url($item->photos)) }}" alt="thumbnail service" class="inline-block mr-2 rounded-lg cursor-pointer h-20 w-36 object-cover">
                            @empty
                                {{-- empty --}}
                            @endforelse
                        </div>

                    </div>
                </div>
                <div class="content">
                    <div x-data="{ tab: window.location.hash ? window.location.hash.substring(1) : 'description' }" id="tab_wrapper">
                        <!-- The tabs navigation -->
                        <nav class="my-8" aria-label="navigation">
                            <a class="inline-block px-8 py-2 my-2 mr-2 font-medium rounded-xl" :class="{ 'bg-serv-bg text-white': tab === 'description','bg-serv-services-bg text-serv-bg' : tab !== 'description' }" @click.prevent="tab = 'description'; window.location.hash = 'description'" href="#">Description</a>
                            <a class="inline-block px-8 py-2 my-2 mr-2 font-medium rounded-xl" :class="{ 'bg-serv-bg text-white': tab === 'seller' ,'bg-serv-services-bg text-serv-bg' : tab !== 'seller' }" @click.prevent="tab = 'seller'; window.location.hash = 'seller'" href="#">About The Seller</a>
                            <a class="inline-block px-8 py-2 my-2 mr-2 font-medium rounded-xl" :class="{ 'bg-serv-bg text-white': tab === 'reviews' ,'bg-serv-services-bg text-serv-bg' : tab !== 'reviews' }" @click.prevent="tab = 'reviews'; window.location.hash = 'reviews'" href="#">Reviews</a>
                        </nav>

                        <!-- The tabs content -->
                        <div x-show.transition.duration.500ms="tab === 'description'" class="leading-8 text-md">
                            <h2 class="text-xl font-semibold">About This <span class="text-serv-button">Destination</span></h2>
                            <div class="mt-4 mb-8 content-description">
                                <p>
                                    {{ $destination->description ?? '' }}
                                </p>
                            </div>
                            <h3 class="my-4 text-lg font-semibold">About?</h3>

                            <p class="mb-4">
                                {{ $service->location ?? '' }}
                            </p>
                            <p class="mb-4 font-medium">
                                Contact Us
                            </p>
                        </div>
                        <div x-show.transition.duration.500ms="tab === 'seller'" class="leading-8 text-md">
                            <h2 class="mb-4 text-xl font-semibold">About <span class="text-serv-button">Us</span></h2>
                            <div class="grid md:grid-cols-12">
                                <div class="flex items-center col-span-12 p-2 lg:col-span-6">

                                    <div class="flex-grow p-4 -mt-8 leading-8 lg:mt-0">
                                        <div class="text-lg font-semibold text-gray-700">
                                            {{-- {{ $service->user->name ?? '' }} --}}
                                        </div>
                                        <div class="text-gray-400">
                                            Bandung, Indonesia
                                        </div>
                                    </div>
                                </div>
                                <div class="items-center col-span-12 p-2 lg:col-span-6">
                                    <div class="ml-24 -mt-10 lg:my-6 lg:text-right">
                                        @include('components.landing.rating')
                                    </div>
                                </div>
                            </div>

                            <hr class="border-serv-services-bg">
                            <p class="my-4 text-lg text-gray-400">
                                 {{ date("d F Y",strtotime($destination->created_at)) ?? '' }}
                            </p>
                        </div>
                        <div x-show.transition.duration.500ms="tab === 'reviews'">
                            <h2 class="mb-4 text-xl font-semibold"><span class="text-serv-button">210</span> Happy Clients</h2>

                            @include('components.landing.review')
                            @include('components.landing.review')
                            @include('components.landing.review')

                        </div>
                    </div>
                </div>
            </main>

            <aside class="p-4 lg:col-span-4 md:col-span-12 md:pt-0">
                <div class="mb-4 border rounded-lg border-serv-testimonial-border">
                    <!--horizantil margin is just for display-->


                    <div class="px-4 pt-4 pb-2 features-list">
                        <ul class="mb-4 text-sm list-check">
                            <li class="pl-10 my-4">#</li>
                            <li class="pl-10 my-4">#</li>
                            <li class="pl-10 my-4">#</li>
                            <li class="pl-10 my-4">#</li>
                            <li class="pl-10 my-4">#</li>
                        </ul>
                    </div>
                    <div class="px-4">
                        <table class="w-full mb-4">
                            <tr>
                                <td class="text-sm leading-7 text-serv-text">
                                    Price starts from:
                                </td>
                                <td class="mb-4 text-xl font-semibold text-right text-serv-button">
                                    {{ 'Rp. '.number_format($destination->price) ?? '' }}
                                </td>
                            </tr>

                        </table>
                    </div>
                    <div class="px-4 pb-4 booking">


                        @auth
                            <a href="{{ route('choose-camv', $destination->id) }}" class="block px-12 py-4 my-2 text-lg font-semibold text-center text-white bg-serv-button rounded-xl">
                                Booking Now
                            </a>
                        @endauth

                        @guest
                            <a onclick="toggleModal('loginModal')" class="block px-12 py-4 my-2 text-lg font-semibold text-center text-white bg-serv-button rounded-xl">
                                Login First
                            </a>
                        @endguest
                    </div>
                </div>
            </aside>

        </div>
    </section>

@endsection

@push('after-script')
    <script>
        function gallery() {
            return {
                featured: '{{ url(Storage::url($destination->gallery->first()->photos)) }}',
                active: 1,
                changeThumbnail: function(url, position) {
                    this.featured = url;
                    this.active = position;
                }
            }
        }
    </script>
@endpush
