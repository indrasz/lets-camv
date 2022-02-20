@extends('layouts.front')

@section('title', ' Booking Success')

@section('content')

    <section
        class="h-full w-full border-box lg:px-24 md:px-16 sm:px-8 px-8 sm:pt-5 pt-5 sm:pb-32 pb-20 transition-all duration-500 linear"
        style="background-color: #FFFAFA;">

    <style>

      .empty-4-1 .btn-view {
        background-color: #FF7C57;
        transition: 0.3s;
      }

      .empty-4-1 .btn-view:hover {
        background-color: #FF9779;
        transition: 0.3s;
      }

      .empty-4-1 .caption-text {
        color: #9C9C9C;
      }
    </style>

    <div class="empty-4-1" style="font-family: 'Poppins', sans-serif;">
      <div class="container mx-auto flex items-center justify-center flex-col">
        <img class="sm:w-auto w-5/6 mb-2.5 object-cover object-center"
          src="http://api.elements.buildwithangga.com/storage/files/2/assets/Empty%20State/EmptyState3/Empty-3-7.png"
          alt="">
        <div class="text-center w-full">
          <h1 class="text-3xl mb-3 font-semibold text-black tracking-wide">Checkout Successful</h1>
          <p class="caption-text mb-12 text-base tracking-wide leading-7">
            We've sent the receipt to your email<br class="sm:block hidden"> address is {{ Auth::user()->email }}
          </p>
          <div class="flex justify-center">
            <a href="{{ route('home') }}"
              class="btn-view inline-flex font-semibold text-white text-lg leading-7 py-4 px-8 rounded-xl focus:outline-none">
              Back to home
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

@endsection
