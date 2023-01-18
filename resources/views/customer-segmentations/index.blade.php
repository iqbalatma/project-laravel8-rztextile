<x-dashboard.layout title="{{ $title}}" description="{{ $description }}">
    <div class="card mb-4">
        <div class="card-header">
            <i class="fa-solid fa-user-tag"></i>
            {{ $cardTitle }}
        </div>
        <div class="card-body">


            @if ($customerSegmentations->count()==0)
            <x-data-not-found></x-data-not-found>
            @else
            {{-- Table Data Roles --}}
            <div class="table-responsive mt-4">
                <table class="table align-middle">
                    <thead>
                        <th>No</th>
                        <th>Key</th>
                        <th>Segment Name</th>
                        <th>Last Updated Time</th>
                    </thead>
                    <tbody>
                        @foreach ($customerSegmentations as $key => $segment)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ strtoupper($segment->key) }}</td>
                            <td>{{ ucwords($segment->name) }}</td>
                            <td>{{ $segment->updated_at }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif
        </div>
    </div>
</x-dashboard.layout>
