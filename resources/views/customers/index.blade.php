<x-app-layout :title="$title">
    <div class="card mb-4">
        <div class="card-header">
            <i class="fa-solid fa-users-between-lines"></i>
            {{ $cardTitle }}
        </div>
        <div class="card-body">
            <div class="d-grid gap-2 d-md-flex justify-content-md-start mt-4">
                <a href="{{ route('customers.create') }}" type="button" class="btn btn-primary">
                    <i class="fa-solid fa-square-plus"></i>
                    Add New Customers</a>
            </div>

            <div class="table-responsive mt-4">
                <table class="table align-middle">
                    <thead>
                        <th>No</th>
                        <th>Id Number</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Total Invoice</th>
                        <th>Total Bill</th>
                        <th>Total Recency</th>
                        <th>RFM Point</th>
                        <th>Last Updated Time</th>
                        <th class="text-center">Action</th>
                    </thead>
                    <tbody>
                        @foreach ($customers as $key => $customer)
                        <tr>
                            {{-- <td>{{ $customers->firstItem()+$key }}</td> --}}
                            <td>{{ $key+1 }}</td>
                            <td>{{ $customer->customer->id_number ?? "-" }}</td>
                            <td>{{ $customer->customer->name  ?? "-"}}</td>
                            <td>{{ $customer->customer->phone ?? "-" }}</td>
                            <td>{{ $customer->customer->address ?? "-"}}</td>
                            <td>{{ $customer->total_invoices ?? "-" }}</td>
                            <td>{{ formatToRupiah($customer->total_bill) }}</td>
                            <td>{{ $customer->recency . " hari" }}</td>
                            <td>{{ $customer->total_rfm }}</td>
                            <td>{{ $customer->customer->updated_at ?? "-" }}</td>
                            <td class="text-center">
                                <form action="{{ route('customers.destroy', $customer->customer->id) }}" method="POST">
                                    @csrf
                                    @method("DELETE")
                                    <div class="d-grid gap-2 d-md-flex">
                                        <a href="{{ route('customers.edit', $customer->customer->id ) }}" class="btn btn-success">
                                            <i data-feather="edit"></i> Edit
                                        </a>
                                        <a class="btn btn-danger btn-delete">
                                            <i data-feather="edit"></i> Delete
                                        </a>
                                    </div>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                {{-- {{ $customers->links() }} --}}
            </div>
        </div>
    </div>

    @section("custom-scripts")
    <script src="{{ asset('js/customers/index.js') }}"></script>
    @endsection
</x-app-layout>
