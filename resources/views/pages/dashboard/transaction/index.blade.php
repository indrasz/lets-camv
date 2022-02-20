@extends('layouts.app')

@section('title', ' My Order')

@section('content')

    <main class="h-full overflow-y-auto">
        <div class="container mx-auto">
            <div class="grid w-full gap-5 px-10 mx-auto md:grid-cols-12">
                <div class="col-span-8">
                    <h2 class="mt-8 mb-1 text-2xl font-semibold text-gray-700">
                        My Orders
                    </h2>
                    <p class="text-sm text-gray-400">
                         Total Orders
                    </p>
                </div>
                <div class="col-span-4 lg:text-right">

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
                                        <th class="py-4">Destination</th>
                                        <th class="py-4">Camv</th>
                                        <th class="py-4">Total</th>
                                        <th class="py-4">Booking Date</th>
                                        <th class="py-4">Status</th>
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
            { data: 'user.name', name: 'user.name' },
            { data: 'destination.name', name: 'destination.name' },
            { data: 'camv.name', name: 'camv.name' },
            { data: 'transaction_total', name: 'transaction_total' },
            { data: 'booking_date', name: 'booking_date' },
            { data: 'transaction_status', name: 'transaction_status' },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false,
                width: '15%'
            },
        ],
    });
</script>
@endpush
