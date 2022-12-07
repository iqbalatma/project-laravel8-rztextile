<x-app-layout :title="$title">
  <div class="card mb-4">
    <div class="card-header">
      <i class="fa-solid fa-file-invoice-dollar"></i>
      {{ $cardTitle }}
    </div>
    <div class="card-body">
      <div class="d-grid gap-2 d-md-flex justify-content-md-start mb-4">
        <a href="{{ route('registration.credentials.create') }}" type="button" class="btn btn-primary">
          <i class="fa-solid fa-square-plus"></i>
          Add New Credentials</a>
      </div>

      <div class="table-responsive mt-4">
        <table class="table align-middle">
          <thead>
            <th>No</th>
            <th>Credentials</th>
            <th>Role</th>
            <th>Status</th>
            <th>Action</th>
          </thead>
          <tbody>
            @foreach ($registrationCredentials as $key => $credential)
            <tr>
              <td>{{ $registrationCredentials->firstItem()+$key }}</td>
              <td>{{ $credential->credential }}</td>
              <td>{{ $credential->role->name ?? "-" }}</td>
              <td>
                @if ($credential->is_active)
                <span class="badge rounded-pill bg-success">Active</span>
                @else
                <span class="badge rounded-pill bg-danger">Inactive</span>
                @endif
              </td>
              <td>

              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>

</x-app-layout>