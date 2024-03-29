<x-dashboard.layout>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fa-solid fa-scale-unbalanced-flip"></i>
            {{ $cardTitle }}
        </div>
        <div class="card-body">
            @can($unitPermissions::CREATE)
            <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                <a href="{{ route('units.create') }}" type="button" class="btn btn-primary">
                    <i class="fa-solid fa-square-plus"></i>
                    Add New Unit</a>
            </div>
            @endcan

            @if ($units->count() == 0)
            <x-data-not-found></x-data-not-found>
            @else
            {{-- Table Data Unit --}}
            <div class="table-responsive mt-4">
                <table class="table align-middle">
                    <thead>
                        <th>No</th>
                        <th>Name</th>
                        <th>Shortname</th>
                        <th>Last Updated Time</th>
                        @canany([$unitPermissions::EDIT, $unitPermissions::DESTROY])
                        <th class="text-center">Action</th>
                        @endcanany
                    </thead>
                    <tbody>
                        @foreach ($units as $key => $unit)
                        <tr>
                            <td>{{ $units->firstItem()+$key }}</td>
                            <td>{{ $unit->name }}</td>
                            <td>{{ $unit->shortname }}</td>
                            <td>{{ $unit->updated_at }}</td>

                            @canany([$unitPermissions::EDIT, $unitPermissions::DESTROY])
                            <td class="text-center">
                                <form action="{{ route('units.destroy', $unit->id) }}" method="POST">
                                    @csrf
                                    @method("DELETE")
                                    <div class="d-grid gap-2 d-md-block">
                                        @can($unitPermissions::EDIT)
                                        <a href="{{ route('units.edit', $unit->id) }}" class="btn btn-success">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        @endcan

                                        @can($unitPermissions::DESTROY)
                                        <a class="btn btn-danger btn-delete">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </a>
                                        @endcan
                                    </div>
                                </form>
                            </td>
                            @endcanany

                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ ($units->links()) }}
            </div>
            @endif
        </div>
    </div>

    @section("custom-scripts")
    <script src="{{ asset('js/pages/units/index.js') }}"></script>
    @endsection
</x-dashboard.layout>
