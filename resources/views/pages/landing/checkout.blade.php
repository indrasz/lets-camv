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
                    <a href="#" class="font-medium">Checkout</a>
                </li>
            </ol>
        </nav>
    </div>

    {{-- detail --}}
    <section class="px-4 pt-6 pb-20 mx-auto w-auth lg:mx-12">
        <form action="{{ route('checkout-create', $item->id) }}" method="post">
            @csrf
        <div class="grid gap-3 md:grid-cols-12">

            @php $totalPrice = 0 @endphp

            <main class="p-4 lg:col-span-4 md:col-span-12">
                <!-- details heading -->
                <div class="w-80 h-auto overflow-hidden md:p-5 p-4 bg-white rounded-2xl inline-block">


                    @if ($item->destination->gallery != NULL)
                        <img class="rounded-2xl object-cover h-48 w-full" src="{{ url(Storage::url($item->destination->gallery->first()->photos)) }}" alt="photo camv" loading="lazy">
                    @else
                        <img class="rounded-2xl w-full" src="{{ url('https://via.placeholder.com/750x500') }}" alt="placeholder" />
                    @endif

                    <!--Title-->
                    <h1 class="font-semibold text-gray-900 text-lg mt-1 leading-normal py-4">
                    {{ $item->destination->name }}
                    </h1>
                    <!--Description-->
                    <div class="max-w-full">
                        @include('components.landing.rating')
                    </div>

                    <div class="text-center mt-5 flex justify-between w-full">
                        <span
                            class="text-serv-text mr-3 inline-flex items-center leading-none text-md py-1 ">
                            Price starts from:
                        </span>
                        <span
                            class="text-serv-button inline-flex items-center leading-none text-md font-semibold">
                            {{ 'Rp. '.number_format($item->destination->price) ?? '' }}
                        </span>
                    </div>
                </div>

            </main>
            <main class="p-4 lg:col-span-4 md:col-span-12">
                <!-- details heading -->
                <div class="w-80 h-auto overflow-hidden md:p-5 p-4 bg-white rounded-2xl inline-block">

                    @if ($item->camv->photo != NULL)
                        <img class="rounded-2xl object-cover h-48 w-full" src="{{ url(Storage::url($item->camv->photo)) }}" alt="photo camv" loading="lazy">
                    @else
                        <img class="rounded-2xl w-full" src="{{ url('https://via.placeholder.com/750x500') }}" alt="placeholder" />
                    @endif
                    <!--Title-->
                    <h1 class="font-semibold text-gray-900 text-lg mt-1 leading-normal py-4">
                    {{ $item->camv->name }}
                    </h1>
                    <!--Description-->
                    <div class="max-w-full">
                        @include('components.landing.rating')
                    </div>

                    <div class="text-center mt-5 flex justify-between w-full">
                        <span
                            class="text-serv-text mr-3 inline-flex items-center leading-none text-md py-1 ">
                            Price starts from:
                        </span>
                        <span
                            class="text-serv-button inline-flex items-center leading-none text-md font-semibold">
                            {{ 'Rp. '.number_format($item->camv->price) ?? '' }}
                        </span>
                    </div>
                </div>

            </main>

            <aside class="p-4 lg:col-span-4 md:col-span-12 md:pt-0">
                <div class="mb-4 border rounded-lg border-serv-testimonial-border">
                    <!--horizantil margin is just for display-->
                    <div class="relative p-16 mt-3 flex-auto mx-10">
                        <div class="mb-4">
                            <label class="block text-grey-darker text-sm mb-2" for="booking_date">Booking Day</label>

                            <input name="booking_date" class="appearance-none border border-gray-300 rounded-lg w-full py-3 px-4 placeholder-serv-text text-xs" id="booking_date" type="date" placeholder="name@domain.com" required autofocus>

                            @if ($errors->has('booking_date'))
                                <p class="text-red-500 mb-3 text-sm">{{ $errors->first('booking_date') }}</p>
                            @endif

                        </div>
                    </div>
                    <div class="px-4">
                        <table class="w-full mb-4">
                            <tr>
                                <td class="text-sm leading-7 text-serv-text">
                                    Harga Tiket Destinasi
                                </td>
                                <td class="mb-4 text-sm font-semibold text-right list-check">
                                    {{ 'Rp. '.number_format($item->destination->price) ?? '' }}
                                </td>
                            </tr>

                            <tr>
                                <td class="text-sm leading-7 text-serv-text">
                                    Harga Sewa Camv
                                </td>
                                <td class="mb-4 text-sm font-semibold text-right list-check">
                                    {{ 'Rp. '.number_format($item->camv->price) ?? '' }}
                                </td>
                            </tr>

                        </table>
                    </div>
                    @php $totalPrice = $item->camv->price + $item->destination->price @endphp

                    <input type="hidden" name="transaction_total" value="{{ $totalPrice }}">
                    <div class="px-4">
                        <h4 class="mb-4 text-lg font-semibold list-check"">
                            Total
                        </h4>
                    </div>
                    <div class="px-4">
                        <table class="w-full mb-4">

                            <tr>
                                <td class="text-sm leading-7 text-serv-text">
                                    Total Transaksi
                                </td>
                                <td class="mb-4 text-sm font-semibold text-right list-check">
                                    RP. {{ number_format($totalPrice ?? 0) }}
                                </td>
                            </tr>

                        </table>
                    </div>
                    <div class="px-4 pb-4 booking">
                        @auth
                            <button type="submit" class="block px-12 py-4 my-2 text-lg font-semibold text-center text-white bg-serv-button rounded-xl">
                                Booking Now
                            </button>

                        @endauth
                        @guest
                            <a onclick="toggleModal('loginModal')" class="block px-12 py-4 my-2 text-lg font-semibold text-center text-white bg-serv-button rounded-xl">
                                Booking Now
                            </a>
                        @endguest
                    </div>
                </div>
            </aside>

        </div>
        </form>
    </section>

    <div class="pt-6 pb-20 mx-8 lg:mx-20"></div>

@endsection

@push('after-script')
    <script>
        // Navbar toggling animation
        $(document).ready(function () {
            $(".mobile-menu-button").each(function (_, navToggler) {
                var target = $(navToggler).data("target");
                $(navToggler).on("click", function () {
                    $(target).animate({
                        height: "toggle",
                    })
                })
            })
        })
    </script>
@endpush
