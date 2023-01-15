<x-dashboard.layout title="{{ $title }}" description="{{ $description }}">
    {{-- <ul class="nav nav-tabs mb-4">
        <li class="nav-item">
            <a class="nav-link @if (Request::input('type')=='all' || is_null(Request::input('type'))) active @endif" aria-current="page" href="{{ route('customers.index',['type'=>'all']) }}">All</a>
    </li>
    <li class="nav-item">
        <a class="nav-link @if (Request::input('type')=='rfm')active @endif" href="{{ route('customers.index',['type'=>'rfm']) }}">RFM Point</a>
    </li>
    </ul> --}}



    {{-- @if (isset($customer)) --}}
    <div class="card mb-4">
        <div class="card-header">
            <i class="fa-solid fa-users-between-lines"></i>
            Summary
        </div>
        <div class="card-body">
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
                    </thead>
                    <tbody>
                        @if (isset($customers["mvc"]))
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
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
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
                    </thead>
                    <tbody>
                        @if (isset($customers["mgc"]))
                        @foreach ($customers["mgc"] as $key => $customer)
                        <tr>
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
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>

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
                    </thead>
                    <tbody>
                        @if (isset($customers["m"]))
                        @foreach ($customers["m"] as $key => $customer)
                        <tr>
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
                        </tr>
                        @endforeach
                        @endif
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
                    </thead>
                    <tbody>
                        @if (isset($customers["bz"]))
                        @foreach ($customers["bz"] as $key => $customer)
                        <tr>
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
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>

                {{-- {{ $customers->links() }} --}}
            </div>
        </div>
    </div>
    {{-- @else
    <x-data-not-found></x-data-not-found>
    @endif --}}

    @section("custom-scripts")
    <script src="{{ asset('js/customers/index.js') }}"></script>
    @endsection
</x-dashboard.layout>
