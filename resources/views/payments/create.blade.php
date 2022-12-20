<x-app-layout title="{{ $title }}" description="{{ $description }}">
    <div class="card mb-4">
        <div class="card-header">
            <i class="fa-solid fa-money-check-dollar"></i>
            {{ $cardTitle }}
        </div>
        <div class="card-body">
            <form class="row g-3" method="POST" action="{{ route('payments.store') }}">
                @csrf
                <div class="col-md-12">
                    <label for="invoice" class="form-label">Select Invoice For Payment</label>
                    <select class="form-select" aria-label="Select invoice for payment" name="invoice_id" id="invoice">
                        <option selected disabled>Select Invoice Below</option>
                        @foreach ($invoices as $invoice)
                        <option value="{{ $invoice->id }}" data-bill-left="{{ $invoice->bill_left }}">{{ $invoice->code }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-12">
                    <label for="bill_left" class="form-label">Bill Left</label>
                    <input type="number" class="form-control" id="bill_left" name="bill_left" value="0" readonly>
                </div>
                <div class="col-md-12">
                    <label for="payment_type" class="form-label">Select Payment Type For Payment</label>
                    <select class="form-select" aria-label="Select payment type for payment" name="payment_type" id="payment_type">
                        <option selected disabled>Select Invoice Below</option>
                        <option value="cash">Cash</option>
                        <option value="transfer">Transfer</option>
                    </select>
                </div>
                <div class="col-md-12">
                    <label for="paid_amount" class="form-label">Paid Amount</label>
                    <input type="number" class="form-control" id="paid_amount" name="paid_amount" placeholder="Enter paid amount for payment" required>
                </div>
                <div class="col-12">
                    <a href="{{ route('payments.index') }}" class="btn btn-danger"><i class="fa-solid fa-square-xmark"></i> Cancel</a>
                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Save</button>
                </div>
            </form>
        </div>
    </div>

    @section("custom-scripts")
    <script src="{{ asset('js/payments/create.js') }}"></script>
    @endsection
</x-app-layout>
