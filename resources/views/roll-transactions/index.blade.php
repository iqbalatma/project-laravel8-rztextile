<x-app-layout :title="$title">
  <div class="card mb-4">
    <div class="card-header">
      <i class="fa-solid fa-right-left"></i>
      {{ $cardTitle }}
    </div>
    <div class="card-body">
      <div class="table-responsive mt-4">
        <table class="table align-middle">
          <thead>
            <th>No</th>
            <th>Roll Name</th>
            <th>Roll Code</th>
            <th>Quantity Roll</th>
            <th>Quantity Unit</th>
            <th>Type</th>
            <th>Admin</th>
            <th>Last Updated Time</th>
          </thead>
          <tbody>
            @foreach ($rollTransactions as $key => $transaction)
            <tr>
              <td>{{ $rollTransactions->firstItem()+$key }}</td>
              <td>{{ $transaction->roll->name??"-" }}</td>
              <td>{{ $transaction->roll->code??"-" }}</td>
              <td>{{ $transaction->quantity_roll??0 }}</td>
              <td>{{ $transaction->quantity_unit??0 }}</td>
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
              <td>{{ $transaction->updated_at??"-" }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</x-app-layout>