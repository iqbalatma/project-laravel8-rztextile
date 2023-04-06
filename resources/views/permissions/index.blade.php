<x-dashboard.layout>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fa-solid fa-user-tag"></i>
            {{ $cardTitle }}
        </div>
        <div class="card-body">
            <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                <a href="{{ route('roles.create') }}" type="button" class="btn btn-primary">
                    <i class="fa-solid fa-square-plus"></i>
                    Add New Roles</a>
            </div>

            @if ($permissions->count()==0)
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
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @foreach ($permissions as $key => $permission)
                        <tr>
                            <td>{{ $permissions->firstItem()+$key }}</td>
                            <td>{{ ucwords($permission->name) }}</td>
                            <td>{{ ucwords($permission->guard_name) }}</td>
                            <td>{{ $permission->description }}</td>
                            <td>{{ $permission->updated_at }}</td>
                            <td>
                                {{-- <a class="btn btn-success" href="{{ route('permissionss.edit', $permissions->id) }}">
                                Edit
                                </a>
                                <button type="button" class="btn btn-danger btn-delete" data-id="{{ $permissions->id }}">
                                    Delete
                                </button> --}}
                            </td>
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