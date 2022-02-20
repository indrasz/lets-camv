@extends('layouts.app')

@section('title', ' My Service')

@section('content')

    @if (count($destination))
        <main class="h-full overflow-y-auto">
            <div class="container mx-auto">
                <div class="grid w-full gap-5 px-10 mx-auto md:grid-cols-12">
                    <div class="col-span-8">
                        <h2 class="mt-8 mb-1 text-2xl font-semibold text-gray-700">
                            Destination
                        </h2>
                        <p class="text-sm text-gray-400">
                            Destination page
                        </p>
                    </div>
                    <div class="col-span-4 lg:text-right">
                        <div class="relative mt-0 md:mt-6">
                            <a href="{{ route('dashboard.destination.create') }}" class="inline-block px-4 py-2 mt-2 text-left text-white rounded-xl bg-serv-button">
                                + Add Destination
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <section class="container px-6 mx-auto mt-5">
                <div class="grid gap-5 md:grid-cols-12">
                    <main class="col-span-12 p-4 md:pt-0">
                        <div class="px-6 py-2 mt-2 bg-white rounded-xl">
                            <table id="crudTable" class="w-full">
                                <thead>
                                    <tr>
                                        <th class="py-4">ID</th>
                                        <th class="py-4">Name</th>
                                        <th class="py-4">Category</th>
                                        <th class="py-4">Price</th>
                                        <th class="py-4">Location</th>
                                        <th class="py-4">Order Day</th>
                                        <th class="py-4">Action</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>

                        </div>
                    </main>
                </div>
            </section>
        </main>
    @else

        <div class="flex h-screen">
            <div class="m-auto text-center">
                <img src="{{ asset('/assets/images/empty-illustration.svg') }}" alt="" class="w-48 mx-auto">
                <h2 class="mt-8 mb-1 text-2xl font-semibold text-gray-700">
                    There is No Destination Yet
                </h2>
                <p class="text-sm text-gray-400">
                    It seems that you haven’t provided any service. <br>
                    Let’s create your Destination!
                </p>

                <div class="relative mt-0 md:mt-6">
                    <a href="{{ route('dashboard.destination.create') }}" class="px-4 py-2 mt-2 text-left text-white rounded-xl bg-serv-button">
                        + Add Destination
                    </a>
                </div>
            </div>
        </div>
    @endif
@endsection

@push('after-script')
<script>
    // AJAX DataTable
    var datatable = $('#crudTable').DataTable({
        ajax: {
            url: '{!! url()->current() !!}',
        },
        columns: [
            { data: 'id', name: 'id', width: '5%'},
            { data: 'name', name: 'name' },
            { data: 'category.name', name: 'category.name' },
            { data: 'price', name: 'price' },
            { data: 'location', name: 'location' },
            { data: 'orderDay', name: 'orderDay' },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false,
                width: '25%'
            },
        ],
    });
</script>
@endpush
