<div class="inline-block px-3">
    <div class="w-96 h-auto overflow-hidden md:p-5 p-4 bg-white rounded-2xl inline-block">

        <!--Banner image-->

        @if ($item->photo != NULL)
            <img class="rounded-2xl object-cover h-48 w-full" src="{{ url(Storage::url($item->photo)) }}" alt="photo camv" loading="lazy">
        @else
            <img class="rounded-2xl w-full" src="{{ url('https://via.placeholder.com/750x500') }}" alt="placeholder" />
        @endif

        <!--Title-->
        <h1 class="font-semibold text-gray-900 text-lg mt-1 leading-normal py-4">
            {{ $item->name ?? '' }}
        </h1>

        <div class=" grid grid-cols lg:grid-cols-3 md:grid-cols-2 text-center gap-4 pt-4">
            @forelse ($item->feature as $features)
                <div class="bg-serv-services-bg text-serv-login-text items-center border-0 block lg:py-3 focus:outline-none rounded-2xl font-medium text-base mt-6 lg:mt-0">
                    {{ $features->feature }}
                </div>
            @empty

            @endforelse
        </div>

        <div class="text-center mt-5 flex justify-between w-full">
            <span
                class="text-serv-button inline-flex items-center leading-none text-md font-semibold">
                Rp {{ number_format($item->price) ?? '' }}
            </span>
            <div class="px-4 booking">
                @auth
                <form action="{{ route('camv-add', $item->id) }}" method="post">
                    @csrf
                    <button button class=" px-4 py-4 my-2 text-sm font-semibold text-center text-white bg-serv-button rounded-xl">
                        Booking Now
                    </button>
                </form>
                @endauth
                @guest
                    <a onclick="toggleModal('loginModal')" class=" px-4 py-4 my-2 text-lg font-semibold text-center text-white bg-serv-button rounded-xl">
                        Login First
                    </a>
                @endguest
            </div>
        </div>


    </div>

</div>
