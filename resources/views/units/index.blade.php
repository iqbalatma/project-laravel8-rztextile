<x-app-layout :title="$title">
  <div class="card mb-4">
    <div class="card-header">
      <i class="fa-solid fa-scale-unbalanced-flip"></i>
      {{ $cardTitle }}
    </div>
    <div class="card-body">
      <div class="d-grid gap-2 d-md-flex justify-content-md-start">
        <a href="{{ route('units.create') }}" type="button" class="btn btn-primary">
          <i class="fa-solid fa-square-plus"></i>
          Add New Unit</a>
      </div>

      <div class="table-responsive mt-4">
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