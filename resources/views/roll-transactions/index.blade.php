<x-app-layout :title="$title">
  <div class="card mb-4">
    <div class="card-header">
      <i class="fa-solid fa-right-left"></i>
      {{ $cardTitle }}
    </div>
    <div class="card-body">
      <div class="d-grid gap-2 d-md-flex justify-content-md-start mb-4">
        <a href="{{ route('roll.transactions.putAway') }}" type="button" class="btn btn-danger">
          <i class="fa-solid fa-square-minus"></i>
          Put Away
        </a>
        <a href="{{ route('restock.create') }}" type="button" class="btn btn-primary">
          <i class="fa-solid fa-square-plus"></i>
          Restock
        </a>
      </div>

      <ul class="nav nav-tabs">
        <li class="nav-item">
          <a class="nav-link @if ($type=='all') active @endif" aria-current="page" href="{{ route('roll.transactions.index',['type'=>'all']) }}">All</a>
        </li>
        <li class="nav-item">
          <a class="nav-link @if ($type=='restock') active @endif" href="{{ route('roll.transactions.index',['type'=>'restock']) }}">Restock</a>
        </li>
        <li class="nav-item">
          <a class="nav-link @if ($type=='sold') active @endif" href="{{ route('roll.transactions.index',['type'=>'sold']) }}">Sold</a>
        </li>
        <li class="nav-item">
          <a class="nav-link @if ($type=='broken') active @endif" href="{{ route('roll.transactions.index',['type'=>'broken']) }}">Broken</a>
        </li>
      </ul>

      <div class="table-responsive mt-4">
        <table class="table align-middle">
          <thead>
            <th>No</th>
            <th>Invoice Code</th>
            <th>Roll Name</th>
            <th>Roll Code</th>
            <th>Quantity Roll</th>
            <th>Quantity Unit</th>
            <th>Type</th>
            <th>Admin</th>
            <th>Date Time</th>
          </thead>
          <tbody>
            @foreach ($rollTransactions as $key => $transaction)
            <tr>
              <td>{{ $rollTransactions->firstItem()+$key }}</td>
              <td>{{ $transaction->invoice->code??"-" }}</td>
              <td>{{ $transaction->roll->name??"-" }}</td>
              <td>{{ $transaction->roll->code??"-" }}</td>
              <td>{{ $transaction->quantity_roll??0 }}</td>
              <td>{{ ($transaction->quantity_unit??0) . " " . $transaction->roll->unit->name }}</td>
              <td>
                @if ($transaction->type=="restock")
                <span class="badge rounded-pill bg-success">{{ $transaction->type }}</span>
                @elseif ($transaction->type=="sold")
                <span class="badge rounded-pill bg-primary">{{ $transaction->type }}</span>
                @else
                <span class="badge rounded-pill bg-danger">{{ $transaction->type }}</span>
                @endif
              </td>
              <td>{{ $transaction->user->name??"-" }}</td>
              <td>{{ $transaction->created_at??"-" }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>

        {{ $rollTransactions->links() }}

      </div>
    </div>
  </div>
</x-app-layout>