<x-app-layout :title="$title">
  <div class="card mb-4">
    <div class="card-header">
      <i class="fa-solid fa-scale-unbalanced-flip"></i>
      {{ $cardTitle }}
    </div>
    <div class="card-body">
      <div class="table-responsive mt-4">
        <table class="table align-middle">
          <thead>
            <th>No</th>
            <th>Name</th>
            <th>Description</th>
            <th>Last Updated Time</th>
          </thead>
          <tbody>
            @foreach ($roles as $key => $role)
            <tr>
              <td>{{ $roles->firstItem()+$key }}</td>
              <td>{{ ucwords($role->name) }}</td>
              <td>{{ $role->description }}</td>
              <td>{{ $role->updated_at }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</x-app-layout>