<x-dashboard.layout>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fa-solid fa-user-tag"></i>
            {{ $cardTitle }}
        </div>
        <div class="card-body">
            @can($rolePermissions::CREATE)
            <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                <a href="{{ route('roles.create') }}" type="button" class="btn btn-primary">
                    <i class="fa-solid fa-square-plus"></i>
                    Add New Roles</a>
            </div>
            @endcan


            @if ($roles->count()==0)
            <x-data-not-found></x-data-not-found>
            @else
            {{-- Table Data Roles --}}
            <div class="table-responsive mt-4">
                <table class="table align-middle">
                    <thead>
                        <th>No</th>
                        <th>Name</th>
                        <th>Guard Name</th>
                        <th>Description</th>
                        <th>Last Updated Time</th>
                        @canany([$rolePermissions::EDIT, $rolePermissions::DESTROY])
                        <th>Action</th>
                        @endcanany
                    </thead>
                    <tbody>
                        @foreach ($roles as $key => $role)
                        <tr>
                            <td>{{ $roles->firstItem()+$key }}</td>
                            <td>{{ ucwords($role->name) }}</td>
                            <td>{{ ucwords($role->guard_name) }}</td>
                            <td>{{ $role->description }}</td>
                            <td>{{ $role->updated_at }}</td>
                            @canany([$rolePermissions::EDIT, $rolePermissions::DESTROY])
                            <td>
                                @can($rolePermissions::EDIT)
                                <a class="btn btn-success" href="{{ route('roles.edit', $role->id) }}">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                @endcan

                                @can($rolePermissions::DESTROY)
                                <button type="button" class="btn btn-danger btn-delete" data-id="{{ $role->id }}">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                                @endcan
                            </td>
                            @endcanany

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif
        </div>
    </div>


    <form id="form-delete" action="{{ route('roles.destroy', ':id') }}" class="d-none" method="POST">
        @csrf
        @method("DELETE")
    </form>

    @push("scripts")
    <script src="{{ asset('js/pages/roles/index.js') }}"></script>
    @endpush
</x-dashboard.layout>