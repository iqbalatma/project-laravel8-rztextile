<x-dashboard.layout>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fa-solid fa-users-between-lines"></i>
            {{ $title }}
        </div>
        <div class="card-body">
            @can($customerPermissions::CREATE)
            <div class="d-grid gap-2 d-md-flex justify-content-md-start mb-4">
                <a href="{{ route('customers.create') }}" type="button" class="btn btn-primary">
                    <i class="fa-solid fa-square-plus"></i>
                    Add New Customers</a>
            </div>
            @endcan

            {{-- Form Filter and Search --}}
            <div class="row">
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-10">
                            <form action="{{ route('customers.index') }}">
                                <div class="input-group mb-3">
                                    <input type="hidden" name="type" value="{{ request()->input('type', 'all') }}">
                                    <input type="text" name="search" class="form-control" placeholder="What are you looking for ?" aria-label="Recipient's username" aria-describedby="basic-addon2" value="{{ request()->input('search') ?? ''}}" required>
                                    <button class="btn btn-primary"><i class="fa-solid fa-magnifying-glass"></i>Search</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-2">
                            <form action="{{ route('customers.index') }}">
                                <input type="hidden" name="type" value="{{ request()->input('type', 'all') }}">
                                <button class="btn btn-primary">Reset</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            @if ($customers->count() == 0)
            <x-data-not-found></x-data-not-found>
            @else
            {{-- Table Data Customer --}}
            <div class="table-responsive mt-4">
                <table class="table align-middle">
                    <thead>
                        <th>No</th>
                        <th>Id Number</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Total Invoice</th>
                        <th>Last Updated Time</th>
                        @canany([$customerPermissions::EDIT, $customerPermissions::DESTROY,])
                        <th class="text-center">Action</th>
                        @endcanany
                    </thead>
                    <tbody>
                        @foreach ($customers as $key => $customer)
                        <tr>
                            <td>{{ $customers->firstItem()+$key }}</td>
                            <td>{{ $customer->id_number ?? "-" }}</td>
                            <td>{{ $customer->name  ?? "-"}}</td>
                            <td>{{ $customer->phone ?? "-" }}</td>
                            <td>{{ $customer->address ?? "-"}}</td>
                            <td>{{ $customer->total_invoices ?? "-" }}</td>
                            <td>{{ $customer->updated_at ?? "-" }}</td>
                            @canany([$customerPermissions::EDIT, $customerPermissions::DESTROY,])
                            <td class="text-center">
                                <form action="{{ route('customers.destroy', $customer->id) }}" method="POST">
                                    @csrf
                                    @method("DELETE")
                                    <div class="d-grid gap-2 d-md-flex">
                                        @can($customerPermissions::EDIT)
                                        <a href="{{ route('customers.edit', $customer->id ) }}" class="btn btn-success">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        @endcan

                                        @can($customerPermissions::DESTROY)
                                        <a class="btn btn-danger btn-delete">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </a>
                                        @endcan
                                    </div>
                                </form>
                            </td>
                            @endcanany

                        </tr>
                        @endforeach
                    </tbody>
                </table>

                {{ $customers->links() }}
            </div>
            @endif
        </div>
    </div>

    @section("custom-scripts")
    <script src="{{ asset('js/customers/index.js') }}"></script>
    @endsection
</x-dashboard.layout>