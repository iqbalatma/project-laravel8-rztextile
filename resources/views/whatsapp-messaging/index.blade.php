<x-dashboard.layout title="{{ $title }}" description="{{ $description }}">
    <div class="card mb-4">
        <div class="card-header">
            <i class="fa-solid fa-comments"></i>
            {{ $cardTitle }}
        </div>
        <div class="card-body">
            <div class="col-md-12">
                <ul class="mb-4 nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link @if (request()->input('type')=='single' || is_null(request()->input('type')) ) active @endif" aria-current="page" href="{{ route('whatsapp.messaging.index', ['type'=> 'single']) }}">Single Whatsapp Message</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if (request()->input('type')=='blast') ) active @endif" href="{{ route('whatsapp.messaging.index', ['type'=> 'blast']) }}">Blast Whatsapp Message</a>
                    </li>
                </ul>

                @if (request()->input('type')=='single' || is_null(request()->input('type')) )
                <form method="POST" action="{{ route('whatsapp.messaging.store') }}">
                    @csrf
                    <div class="mb-3">
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                                Select Customer
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                @foreach ($customers as $key => $customer)
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="customer[]" value="{{ $customer->id }}" id="customer-{{ $customer->id }}" />
                                            <label class="form-check-label" for="customer-{{ $customer->id }}">{{ $customer->phone }} | {{ $customer->name }} </label>
                                        </div>
                                    </a>
                                </li>
                                @endforeach
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="select-all" />
                                            <label class="form-check-label" for="select-all">Select All</label>
                                        </div>
                                    </a>
                                </li>


                            </ul>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="promotion" class="form-label">Promotion Message Name</label>
                        <select class="form-select promotion" id="promotion" name="promotion_message_id" aria-label="Default select example">
                            <option selected disabled>Open this select menu</option>
                            @foreach ($promotionMessages as $promotion)
                            <option value="{{ $promotion->id }}" data-message="{{ $promotion->message }}">{{ $promotion->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Message</label>
                        <div class="card">
                            <div class="card-body">
                                <input type="hidden" name="message" id="message-input" class="message-input">
                                <div id="message" class="message"></div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="fa-sharp fa-solid fa-paper-plane"></i> Send</button>
                </form>
                @else
                <form method="POST" action="{{ route('whatsapp.messaging.store') }}">
                    @csrf
                    <input type="hidden" name="type" value="{{ request()->input('type') }}">
                    <input type="hidden" name="promotion_message_id" id="promotion-message-id-blast">
                    <div class="mb-3">
                        <label for="segmentation_id" class="form-label">Select Customer Segmentation</label>
                        <select class="form-select segmentation" id="segmentation_id" name="segmentation_id" aria-label="Default select example">
                            <option selected disabled>Open this select menu</option>
                            @if(isset($dataRFM["customers"]["mvc"]) && count($dataRFM["customers"]["mvc"]) > 0)
                            <option value="1">Most Valueable Customer | {{ count($dataRFM["customers"]["mvc"]) }} customer</option>
                            @endif
                            @if(isset($dataRFM["customers"]["mgc"]) && count($dataRFM["customers"]["mgc"]) > 0)
                            <option value="2">Most Growable Customer | {{ count($dataRFM["customers"]["mgc"]) }} customer</option>
                            @endif
                            @if(isset($dataRFM["customers"]["m"]) && count($dataRFM["customers"]["m"]) > 0)
                            <option value="3">Migration Customer {{ count($dataRFM["customers"]["m"]) }} customer</option>
                            @endif
                            @if(isset($dataRFM["customers"]["bz"]) && count($dataRFM["customers"]["bz"]) > 0)
                            <option value="4">Bellow Zero Customer {{ count($dataRFM["customers"]["bz"]) }} customer</option>
                            @endif
                        </select>
                    </div>
                    <div class="d-none" id="blast-promotion-message-container">
                        <div class="row">
                            <div class="col-md-6">
                                <input class="form-check-input" type="radio" value="promotion" name="type_gift" id="type-gift2" checked>
                                <label class="form-check-label" for="type-gift2">
                                    Promotion
                                </label>

                                <p>
                                    <b id="discount-promo">
                                        Promo Discount
                                    </b>
                                </p>
                                <div class="mb-3">
                                    <label for="message" class="form-label">Message</label>
                                    <div class="card">
                                        <div class="card-body">
                                            <input type="hidden" name="message" id="message-input" class="message-input">
                                            <div id="message" class="message"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <input class="form-check-input" type="radio" value="prize" name="type_gift" id="flexRadioDefault1">
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Prize
                                </label>

                                <p>
                                    <b id="prize">
                                        Prize
                                    </b>
                                </p>

                                <div class="mb-3">
                                    <label for="message" class="form-label">Message</label>
                                    <div class="card">
                                        <div class="card-body">
                                            <input type="hidden" name="message_prize" id="message-input-prize" class="message-input-prize">
                                            <div id="message-prize" class="message"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="fa-sharp fa-solid fa-paper-plane"></i> Send</button>
                </form>
                @endif
            </div>
        </div>
    </div>


    @section("custom-scripts")
    <script src="{{ asset('js/pages/whatsapp-messaging/index.js') }}"></script>
    @endsection

</x-dashboard.layout>
