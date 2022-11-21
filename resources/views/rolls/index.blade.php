<x-app-layout :title="$title">
  <div class="card mb-4">
    <div class="card-header">
      <i class="fa-solid fa-boxes-stacked"></i>
      {{ $cardTitle }}
    </div>
    <div class="card-body">
      <div class="d-grid gap-2 d-md-flex justify-content-md-start">
        <a href="{{ route('rolls.create') }}" type="button" class="btn btn-primary">
          <i class="fa-solid fa-square-plus"></i>
          Add New Roll</a>
      </div>

      <div class="table-responsive mt-4">
        <table class="table align-middle">
          <thead>
            <th>No</th>
            <th>Name</th>
            <th>Code</th>
            <th>QR Code</th>
            <th>Quantity Roll</th>
            <th>Quantity Unit</th>
            <th>Last Updated Time</th>
            <th class="text-center">Action</th>
          </thead>
          <tbody>
            @foreach ($rolls as $key => $roll)
            <tr>
              <td>{{ $rolls->firstItem()+$key }}</td>
              <td>{{ $roll->name }}</td>
              <td>{{ $roll->code }}</td>
              <td>{{ $roll->qrcode }}</td>
              <td>{{ $roll->quantity_roll . " rolls" }}</td>
              <td>{{ $roll->quantity_unit . " " . $roll->unit->name??"" }}</td>
              <td>{{ $roll->updated_at??"-" }}</td>
              <td class="text-center">
                {{-- <form action="{{ route('rolls.destroy', $roll->id) }}" method="POST"> --}}
                  @csrf
                  @method("DELETE")
                  <div class="d-grid gap-2 d-md-block">
                    <a href="{{ route('rolls.edit', $roll->id) }}" class="btn btn-success">
                      <i data-feather="edit"></i> Edit
                    </a>
                    <a class="btn btn-danger btn-delete">
                      <i data-feather="edit"></i> Delete
                    </a>
                  </div>
                  {{--
                </form> --}}
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        {{ ($rolls->links()) }}

      </div>
    </div>
  </div>


</x-app-layout>