<x-app-layout :title="$title">
  <div class="card mb-4">
    <div class="card-header">
      <i class="fa-solid fa-file-invoice-dollar"></i>
      {{ $cardTitle }}
    </div>
    <div class="card-body">
      <ul class="nav nav-tabs">
        <li class="nav-item">
          <a class="nav-link @if ($type=='all') active @endif" aria-current="page" href="{{ route('invoices.index',['type'=>'all']) }}">All</a>
        </li>
        <li class="nav-item">
          <a class="nav-link @if ($type=='not-paid-off') active @endif" href="{{ route('invoices.index',['type'=>'not-paid-off']) }}">Not Paid Off</a>
        </li>
        <li class="nav-item">
          <a class="nav-link @if ($type=='paid-off') active @endif" href="{{ route('invoices.index',['type'=>'paid-off']) }}">Paid Off</a>
        </li>
      </ul>
      <div class="table-responsive mt-4">
        <table class="table align-middle">
          <thead>
            <th>No</th>
            <th>Code</th>
            <th>Capital</th>
            <th>Bill</th>
            <th>Profit</th>
            <th>Paid Amount</th>
            <th>Bill Left</th>
            <th>Customer</th>
            <th>Admin</th>
            <th>Is Paid Off</th>
            <th>Last Updated Time</th>
            <th>Action</th>
          </thead>
          <tbody>
            @foreach ($invoices as $key => $invoice)
            <tr>
              <td>{{ $invoices->firstItem()+$key }}</td>
              <td>{{ $invoice->code }}</td>
              <td>{{ formatToRupiah($invoice->total_capital) }}</td>
              <td>{{ formatToRupiah($invoice->total_bill) }}</td>
              <td>{{ formatToRupiah($invoice->total_profit) }}</td>
              <td>{{ formatToRupiah($invoice->total_paid_amount) }}</td>
              <td>{{ formatToRupiah($invoice->bill_left) }}</td>
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
              <td>
                @if (!$invoice->is_paid_off)
                <a href="{{ route('payments.createByInvoiceId', $invoice->id) }}" class="btn btn-primary">Add Payment</a>
                @else
                -
                @endif
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        {{ $invoices->links() }}
      </div>
    </div>
  </div>
</x-app-layout>