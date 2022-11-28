<x-app-layout :title="$title">
  <div class="card mb-4">
    <div class="card-header">
      <i class="fa-solid fa-file-invoice-dollar"></i>
      {{ $cardTitle }}
    </div>
    <div class="card-body">
      <div class="table-responsive mt-4">
        <table class="table align-middle">
          <thead>
            <th>No</th>
            <th>Code</th>
            <th>Capital</th>
            <th>Payment</th>
            <th>Profit</th>
            <th>Payment Type</th>
            <th>Customer</th>
            <th>Admin</th>
            <th>Is Paid Off</th>
            <th>Last Updated Time</th>
          </thead>
          <tbody>
            @foreach ($invoices as $key => $invoice)
            <tr>
              <td>{{ $invoices->firstItem()+$key }}</td>
              <td>{{ $invoice->code }}</td>
              <td>{{ formatToRupiah($invoice->total_capital) }}</td>
              <td>{{ formatToRupiah($invoice->total_payment) }}</td>
              <td>{{ formatToRupiah($invoice->total_profit) }}</td>
              <td>
                @if ($invoice->payment_type == "cash")
                <span class="badge bg-primary">
                  {{ ucfirst($invoice->payment_type) }}
                </span>
                @else
                <span class="badge bg-secondary">
                  {{ ucfirst($invoice->payment_type) }}
                </span>
                @endif
              </td>
              <td>{{ $invoice->customer->name??"-" }}</td>
              <td>{{ $invoice->user->name??"-" }}</td>
              <td>
                @if ($invoice->is_paid_off)
                <span class="badge bg-success">Paid Off</span>
                @else
                <span class="badge bg-danger">Not Paid Off</span>
                @endif
              </td>
              <td>{{ $invoice->updated_at }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
        {{ $invoices->links() }}
      </div>
    </div>
  </div>

  @section("custom-scripts")
  @endsection
</x-app-layout>