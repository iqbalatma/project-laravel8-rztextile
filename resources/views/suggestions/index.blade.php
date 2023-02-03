<x-dashboard.layout title="{{ $title}}" description="{{ $description }}">
    <div class="card mb-4">
        <div class="card-header">
            <i class="fa-solid fa-user-tag"></i>
            {{ $cardTitle }}
        </div>
        <div class="card-body">


            @if ($suggestions->count()==0)
            <x-data-not-found></x-data-not-found>
            @else
            {{-- Table Data Roles --}}
            <div class="table-responsive mt-4">
                <table class="table align-middle">
                    <thead>
                        <th>No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Suggest</th>
                        <th>Last Updated Time</th>
                    </thead>
                    <tbody>
                        @foreach ($suggestions as $key => $role)
                        <tr>
                            <td>{{ $suggestions->firstItem()+$key }}</td>
                            <td>{{ ucwords($role->name) }}</td>
                            <td>{{ $role->email }}</td>
                            <td>{{ $role->phone }}</td>
                            <td>{{ $role->suggest }}</td>
                            <td>{{ $role->updated_at }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ ($suggestions->links()) }}
            </div>
            @endif
        </div>
    </div>
</x-dashboard.layout>
