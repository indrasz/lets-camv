@extends('layouts.app')

@section('title', ' Profile')

@section('content')

    <main class="h-full overflow-y-auto">

        <div class="container mx-auto">
            <div class="grid w-full gap-5 px-10 mx-auto md:grid-cols-12">
                <div class="col-span-8">
                    <h2 class="mt-8 mb-1 text-2xl font-semibold text-gray-700">
                        User Profile
                    </h2>
                    <p class="text-sm text-gray-400">
                        Customer
                    </p>
                </div>
            </div>
        </div>

        <section class="container px-6 mx-auto mt-5">
            <div class="grid gap-3 md:grid-cols-12">
                <main class="col-span-12 p-4 md:pt-0">
                    <div class="px-6 py-2 mt-2 bg-white rounded-xl">
                        <table id="crudTable" class="w-full">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </main>
            </div>
        </section>
    </main>

    {{-- <div class="flex h-screen">
        <div class="m-auto text-center">
            <img src="{{ asset('/assets/images/empty-illustration.svg') }}" alt="" class="w-48 mx-auto">
            <h2 class="mt-8 mb-1 text-2xl font-semibold text-gray-700">
                There is No Requests Yet
            </h2>
            <p class="text-sm text-gray-400">
                It seems that you haven’t provided any service. <br>
                Let’s create your first service!
            </p>

            <div class="relative mt-0 md:mt-6">
                <a href="#" class="px-4 py-2 mt-2 text-left text-white rounded-xl bg-serv-button">
                    + Add Services
                </a>
            </div>
        </div>
    </div> --}}

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
            { data: 'roles', name: 'roles' },
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
