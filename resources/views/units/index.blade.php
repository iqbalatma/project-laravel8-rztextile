<x-app-layout :title="$title">
  {{-- <div class="row">
    <div class="card flex-fill w-100">
      <div class="card-header">
        <h5 class="card-title mb-0">{{ $cardTitle }}</h5>
        <small>{{ $cardDescription }}</small>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table align-middle">
            <thead>
              <th>No</th>
              <th>Name</th>
              <th>Shortname</th>
              <th>Last Updated Time</th>
              <th class="text-center">Action</th>
            </thead>
            <tbody>
              @foreach ($units as $key => $unit)
              <tr>
                <td>{{ $units->firstItem()+$key }}</td>
                <td>{{ $unit->name }}</td>
                <td>{{ $unit->shortname }}</td>
                <td>{{ $unit->updated_at }}</td>
                <td class="text-center">
                  <div class="d-grid gap-2 d-md-block">
                    <a href="{{ route('units.edit', $unit->id) }}" class="btn btn-success">
                      <i data-feather="edit"></i> Edit
                    </a>
                    <a href="#" class="btn btn-danger">
                      <i data-feather="edit"></i> Delete
                    </a>
                  </div>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div> --}}
  <div class="card mb-4">
    <div class="card-header">
      <i class="fas fa-table me-1"></i>
      {{ $cardTitle }}
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table align-middle">
          <thead>
            <th>No</th>
            <th>Name</th>
            <th>Shortname</th>
            <th>Last Updated Time</th>
            <th class="text-center">Action</th>
          </thead>
          <tbody>
            @foreach ($units as $key => $unit)
            <tr>
              <td>{{ $units->firstItem()+$key }}</td>
              <td>{{ $unit->name }}</td>
              <td>{{ $unit->shortname }}</td>
              <td>{{ $unit->updated_at }}</td>
              <td class="text-center">
                <div class="d-grid gap-2 d-md-block">
                  <a href="{{ route('units.edit', $unit->id) }}" class="btn btn-success">
                    <i data-feather="edit"></i> Edit
                  </a>
                  <a href="#" class="btn btn-danger">
                    <i data-feather="edit"></i> Delete
                  </a>
                </div>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</x-app-layout>