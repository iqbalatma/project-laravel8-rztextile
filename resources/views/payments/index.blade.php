<x-app-layout :title="$title">
  <div class="card mb-4">
    <div class="card-header">
      <i class="fa-solid fa-file-invoice-dollar"></i>
      {{ $cardTitle }}
    </div>
    <div class="card-body">
      <div class="d-grid gap-2 d-md-flex justify-content-md-start">
        <a href="{{ route('payments.create') }}" type="button" class="btn btn-primary">
          <i class="fa-solid fa-square-plus"></i>
          Add New Payment</a>
      </div>

      <div class="table-responsive mt-4">
        <table class="table align-middle">
          <thead>
            <th>No</th>
            <th>Invoice Code</th>
            <th>Payment Code</th>
            <th>Paid Amount</th>
            <th>Payment Type</th>
            <th>Admin</th>
            <th>Payment Date Time</th>
          </thead>
          <tbody>
            @foreach ($payments as $key => $payment)
            <tr>
              <td>{{ $payments->firstItem()+$key }}</td>
              <td>{{ $payment->invoice->code }}</td>
              <td>{{ $payment->code }}</td>
              <td>{{ formatToRupiah($payment->paid_amount) }}</td>
              <td>
                @if ($payment->payment_type == "cash")
                <span class="badge rounded-pill bg-success">{{ ucfirst($payment->payment_type) }}</span>
                @else
                <span class="badge rounded-pill bg-primary">{{ ucfirst($payment->payment_type) }}</span>
                @endif
              </td>
              <td>{{ $payment->user->name??"-" }}</td>
              <td>{{ $payment->created_at }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>




</x-app-layout>