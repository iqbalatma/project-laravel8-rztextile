<x-dashboard.layout title="{{ $title }}" description="{{ $description }}">
    <div class="card mb-4">
        <div class="card-header">
            <i class="fa-solid fa-users-between-lines"></i>
            Summary
        </div>
        <div class="card-body">
            <div class="accordion mt-4" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                            Retency Point
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse " aria-labelledby="headingOne" data-bs-parent="#accordionExample">
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

    @foreach ($segments as $segment)
    <div class="card mb-4">
        <div class="card-header">
            <i class="fa-solid fa-users-between-lines"></i>
            {{ $segment["name"] }}
        </div>
        <div class="card-body">
            @if (isset($customers[$segment["key"]]) && count($customers[$segment["key"]])>0)
            <h5>Promotion Discount : {{ $promotion_message_discount[$segment["id"]-1]["discount"] }} %</h5>
            <div class="table-responsive mt-4">
                <table class="table align-middle" id="table-{{ $segment['key'] }}">
                    <thead>
                        <tr>
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
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($customers[$segment["key"]] as $key => $customer)
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
                    </tbody>
                </table>
            </div>
            @else
            <x-data-not-found></x-data-not-found>
            @endif
        </div>
    </div>
    @endforeach
    @section("custom-heads")
    <link rel="stylesheet" href="{{ asset('css/pages/segmented-customers.css') }}" />
    @endsection()
    @section("custom-scripts")
    <script type="text/javascript" src="{{ asset('js/pages/segmented-customers/index.js') }}"></script>
    @endsection
</x-dashboard.layout>
