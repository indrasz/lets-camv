@extends('layouts.front')

@section('title', ' Explore')

@section('content')

    <div class="content">
        <!-- services -->
        <div class="bg-serv-bg-explore overflow-hidden">
            <div class="pt-16 pb-16 lg:pb-20 lg:px-24 md:px-16 sm:px-8 px-8 mx-auto">
                <div class="text-center">
                    <h1 class="text-3xl font-semibold mb-1">Choose Your Camv</h1>
                    <p class="leading-8 text-serv-text mb-10">
                        Come Join To Us
                    </p>
                </div>
                <div class="grid grid-cols lg:grid-cols-3 md:grid-cols-2 gap-3">
                   @forelse ($camv as $item )
                       @include('components.landing.service-explore')
                   @empty
                   {{-- Empty --}}
                   @endforelse
                </div>

            </div>
        </div>
    </div>

@endsection
