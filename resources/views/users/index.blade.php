<x-dashboard.layout>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fa-solid fa-users-gear"></i>
            {{ $cardTitle }}
        </div>
        <div class="card-body">
            @can($userPermissions::CREATE)
            {{-- Button Add New User --}}
            <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                <a href="{{ route('users.create') }}" type="button" class="btn btn-primary">
                    <i class="fa-solid fa-square-plus"></i>
                    Add New User</a>
            </div>
            @endcan


            @if ($users->count()==0)
            <x-data-not-found></x-data-not-found>
            @else
            {{-- Table Users --}}
            <div class="table-responsive mt-4">
                <table class="table align-middle">
                    <thead>
                        <th>No</th>
                        <th>ID Number</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Phone Number</th>
                        <th>Status</th>
                        <th>Email Verified At</th>
                        <th>Roles</th>
                        <th>Last Updated Time</th>
                        @canany([$userPermissions::EDIT,$userPermissions::CHANGE_STATUS_ACTIVE])
                        <th>Action</th>
                        @endcanany
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
                                @if ($user->is_active)
                                <span class="badge bg-success">Active</span>
                                @else
                                <span class="badge bg-danger">Inactive</span>
                                @endif
                            </td>
                            <td>
                                @foreach($user->roles as $key => $role)
                                <span class="badge bg-primary">{{ ucwords($role->name) }}</span>
                                @endforeach
                            </td>
                            <td>
                                @if (!$user->email_verified_at)
                                <span class="badge bg-warning">Not Verified</span>
                                @else
                                {{ $user->email_verified_at }}
                                @endif
                            </td>
                            <td>{{ $user->updated_at }}</td>
                            @canany([$userPermissions::EDIT,$userPermissions::CHANGE_STATUS_ACTIVE])
                            <td>
                                <div class="d-grid gap-2 d-md-flex">
                                    @can($userPermissions::EDIT)
                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-success">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    @endcan

                                    @can($userPermissions::CHANGE_STATUS_ACTIVE)
                                    <form action="{{ route('users.change.status.active', $user->id) }}" method="POST">
                                        @csrf
                                        @method("PUT")
                                        @if ($user->is_active)
                                        <button type="submit" class="btn btn-sm btn-danger btn-change-status">
                                            <i class="fa-solid fa-x"></i>
                                        </button>
                                        @else
                                        <button type="submit" class="btn btn-sm btn-primary btn-change-status">
                                            <i class="fa-solid fa-square-check"></i>
                                        </button>
                                        @endif
                                    </form>
                                    @endcan
                                </div>
                            </td>
                            @endcanany
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $users->links() }}
            </div>
            @endif
        </div>
    </div>

    @section("custom-scripts")
    <script src="{{ asset('js/pages/user-managements/index.js') }}"></script>
    @endsection

</x-dashboard.layout>