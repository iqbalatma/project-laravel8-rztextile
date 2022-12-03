<x-app-layout :title="$title">
  <div class="card mb-4">
    <div class="card-header">
      <i class="fa-solid fa-users-gear"></i>
      {{ $cardTitle }}
    </div>
    <div class="card-body">
      <div class="d-grid gap-2 d-md-flex justify-content-md-start">
        <a href="{{ route('units.create') }}" type="button" class="btn btn-primary">
          <i class="fa-solid fa-square-plus"></i>
          Add New User</a>
      </div>

      <div class="table-responsive mt-4">
        <table class="table align-middle">
          <thead>
            <th>No</th>
            <th>ID Number</th>
            <th>Name</th>
            <th>Email</th>
            <th>Address</th>
            <th>Phone Number</th>
            <th>Role</th>
            <th>Last Updated Time</th>
          </thead>
          <tbody>
            @foreach ($users as $key => $user)
            <tr>
              <td>{{ $users->firstItem()+$key }}</td>
              <td>{{ $user->id_number??"-" }}</td>
              <td>{{ $user->name }}</td>
              <td>{{ $user->email }}</td>
              <td>{{ $user->address }}</td>
              <td>{{ $user->phone }}</td>
              <td>
                <span class="badge rounded-pill 
                @if ($user->role->id==1)
                bg-danger
                @elseif($user->role->id==2)
                bg-warning
                @elseif($user->role->id==3)
                bg-success
                @else
                bg-primary
                @endif
               ">{{ ucfirst($user->role->name) }}</span>
              </td>
              <td>{{ $user->updated_at }}</td>
            </tr>
            @endforeach

          </tbody>
        </table>
      </div>
    </div>
  </div>

</x-app-layout>