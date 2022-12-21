<x-app-layout title="{{ $title }}" description="{{ $description }}">

    @if (isset($customer))
    <div class="card mb-4">
        <div class="card-header">
            <i class="fa-solid fa-users-between-lines"></i>
            Summary
        </div>
        <div class="card-body">
            <div class="d-grid gap-2 d-md-flex justify-content-md-start mt-4">
                <a href="{{ route('customers.create') }}" type="button" class="btn btn-primary">
                    <i class="fa-solid fa-square-plus"></i>
                    Add New Customers</a>
            </div>

            <div class="accordion mt-4" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                            Retency Point
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <ul class="list-group">
                                @foreach ($recencyPoint as $key => $point)
                                <li class="list-group-item">{{ $point["lower_threshold"] . " - " . $point["upper_threshold"]}}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Frequency Point
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <ul class="list-group">
                                @foreach ($frequencyPoint as $key => $point)
                                <li class="list-group-item">{{ $point["lower_threshold"] . " - " . $point["upper_threshold"]}}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            Monetery Point
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            @foreach ($moneteryPoint as $key => $point)
                            <li class="list-group-item">{{ $point["lower_threshold"] . " - " . $point["upper_threshold"]}}</li>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                            RFM Point
                        </button>
                    </h2>
                    <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            @foreach ($rfmPoint as $key => $point)
                            <li class="list-group-item">{{ $point["lower_threshold"] . " - " . $point["upper_threshold"]}}</li>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fa-solid fa-users-between-lines"></i>
            {{ $cardTitleMVC }}
        </div>
        <div class="card-body">
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
                        @foreach ($customers["mvc"] as $key => $customer)
                        <tr>
                            {{-- <td>{{ $customers->firstItem()+$key }}</td> --}}
                            <td>{{ $key+1 }}</td>
                            <td>{{ $customer->customer->id_number ?? "-" }}</td>
                            <td>{{ $customer->customer->name  ?? "-"}}</td>
                            <td>{{ $customer->customer->phone ?? "-" }}</td>
                            <td>{{ $customer->customer->address ?? "-"}}</td>
                            <td>{{ $customer->total_invoices ?? "-" }}</td>
                            <td class="text-nowrap">{{ formatToRupiah($customer->total_bill) }}</td>
                            <td>{{ $customer->recency . " hari" }}</td>
                            <td>{{ $customer->total_rfm }}</td>
                            <td>{{ $customer->customer->updated_at ?? "-" }}</td>
                            <td class="text-center">
                                <form action="{{ route('customers.destroy', $customer->customer->id) }}" method="POST">
                                    @csrf
                                    @method("DELETE")
                                    <div class="d-grid gap-2 d-md-flex">
                                        <a href="{{ route('customers.edit', $customer->customer->id ) }}" class="btn btn-success">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <a class="btn btn-danger btn-delete">
                                            <i class="fa-solid fa-trash-can"></i>
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
    <div class="card mb-4">
        <div class="card-header">
            <i class="fa-solid fa-users-between-lines"></i>
            {{ $cardTitleMGC }}
        </div>
        <div class="card-body">
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
                        @foreach ($customers["mgc"] as $key => $customer)
                        <tr>
                            {{-- <td>{{ $customers->firstItem()+$key }}</td> --}}
                            <td>{{ $key+1 }}</td>
                            <td>{{ $customer->customer->id_number ?? "-" }}</td>
                            <td>{{ $customer->customer->name  ?? "-"}}</td>
                            <td>{{ $customer->customer->phone ?? "-" }}</td>
                            <td>{{ $customer->customer->address ?? "-"}}</td>
                            <td>{{ $customer->total_invoices ?? "-" }}</td>
                            <td class="text-nowrap">{{ formatToRupiah($customer->total_bill) }}</td>
                            <td>{{ $customer->recency . " hari" }}</td>
                            <td>{{ $customer->total_rfm }}</td>
                            <td>{{ $customer->customer->updated_at ?? "-" }}</td>
                            <td class="text-center">
                                <form action="{{ route('customers.destroy', $customer->customer->id) }}" method="POST">
                                    @csrf
                                    @method("DELETE")
                                    <div class="d-grid gap-2 d-md-flex">
                                        <a href="{{ route('customers.edit', $customer->customer->id ) }}" class="btn btn-success">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <a class="btn btn-danger btn-delete">
                                            <i class="fa-solid fa-trash-can"></i>
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
    <div class="card mb-4">
        <div class="card-header">
            <i class="fa-solid fa-users-between-lines"></i>
            {{ $cardTitleM }}
        </div>
        <div class="card-body">
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
                        @foreach ($customers["m"] as $key => $customer)
                        <tr>
                            {{-- <td>{{ $customers->firstItem()+$key }}</td> --}}
                            <td>{{ $key+1 }}</td>
                            <td>{{ $customer->customer->id_number ?? "-" }}</td>
                            <td>{{ $customer->customer->name  ?? "-"}}</td>
                            <td>{{ $customer->customer->phone ?? "-" }}</td>
                            <td>{{ $customer->customer->address ?? "-"}}</td>
                            <td>{{ $customer->total_invoices ?? "-" }}</td>
                            <td class="text-nowrap">{{ formatToRupiah($customer->total_bill) }}</td>
                            <td>{{ $customer->recency . " hari" }}</td>
                            <td>{{ $customer->total_rfm }}</td>
                            <td>{{ $customer->customer->updated_at ?? "-" }}</td>
                            <td class="text-center">
                                <form action="{{ route('customers.destroy', $customer->customer->id) }}" method="POST">
                                    @csrf
                                    @method("DELETE")
                                    <div class="d-grid gap-2 d-md-flex">
                                        <a href="{{ route('customers.edit', $customer->customer->id ) }}" class="btn btn-success">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <a class="btn btn-danger btn-delete">
                                            <i class="fa-solid fa-trash-can"></i>
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
    <div class="card mb-4">
        <div class="card-header">
            <i class="fa-solid fa-users-between-lines"></i>
            {{ $cardTitleBZ }}
        </div>
        <div class="card-body">
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
                        @foreach ($customers["bz"] as $key => $customer)
                        <tr>
                            {{-- <td>{{ $customers->firstItem()+$key }}</td> --}}
                            <td>{{ $key+1 }}</td>
                            <td>{{ $customer->customer->id_number ?? "-" }}</td>
                            <td>{{ $customer->customer->name  ?? "-"}}</td>
                            <td>{{ $customer->customer->phone ?? "-" }}</td>
                            <td>{{ $customer->customer->address ?? "-"}}</td>
                            <td>{{ $customer->total_invoices ?? "-" }}</td>
                            <td class="text-nowrap">{{ formatToRupiah($customer->total_bill) }}</td>
                            <td>{{ $customer->recency . " hari" }}</td>
                            <td>{{ $customer->total_rfm }}</td>
                            <td>{{ $customer->customer->updated_at ?? "-" }}</td>
                            <td class="text-center">
                                <form action="{{ route('customers.destroy', $customer->customer->id) }}" method="POST">
                                    @csrf
                                    @method("DELETE")
                                    <div class="d-grid gap-2 d-md-flex">
                                        <a href="{{ route('customers.edit', $customer->customer->id ) }}" class="btn btn-success">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <a class="btn btn-danger btn-delete">
                                            <i class="fa-solid fa-trash-can"></i>
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
    @else
    <div class="card mb-4">
        <div class="card-header">
            <i class="fa-solid fa-users-between-lines"></i>
            Summary
        </div>
        <div class="card-body">
            There is no customer transaction and rfm point
        </div>
    </div>
    @endif


    @section("custom-scripts")
    <script src="{{ asset('js/customers/index.js') }}"></script>
    @endsection
</x-app-layout>
