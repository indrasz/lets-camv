<a href="{{ route('detail-destination', $item->slug) }}" class="inline-block px-3">
    <div class="w-96 h-auto overflow-hidden md:p-5 p-4 bg-white rounded-2xl inline-block">

        <!--Banner image-->
        @if ($item->gallery)
            <img class="rounded-2xl object-cover" src="{{ url(Storage::url($item->gallery->first()->photos)) }}" alt="photo freelancer" loading="lazy">
        @else
            <img class="rounded-2xl w-full" src="{{ url('https://via.placeholder.com/750x500') }}" alt="placeholder" />
        @endif

        <!--Title-->
        <h1 class="font-semibold text-gray-900 text-lg mt-1 leading-normal py-4">
           {{ $item->name ?? '' }}, {{ $item->location }}
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
                Rp {{ number_format($item->price )?? '' }}
            </span>
        </div>
    </div>
</a>
