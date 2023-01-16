<x-dashboard.layout title="{{ $title }}" description="{{ $description }}">
    <div class="card mb-4">
        <div class="card-header">
            <i class="fa-solid fa-tags"></i>
            {{ $cardTitle }}
        </div>
        <div class="card-body">
            <div class="d-grid gap-2 d-md-flex justify-content-md-start mb-4">
                <a href="{{ route('promotion.messages.create') }}" type="button" class="btn btn-primary">
                    <i class="fa-solid fa-square-plus"></i>
                    Add New Message
                </a>
            </div>

            <div class="table-responsive mt-4">
                <table class="table align-middle">
                    <thead>
                        <th>No</th>
                        <th>Name</th>
                        <th>Message</th>
                        <th>Last Updated Time</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @foreach ($promotionMessages as $key => $message)
                        <tr>
                            <td>{{ $promotionMessages->firstItem() + $key }}</td>
                            <td>{{ $message->name }}</td>
                            <td>{!! $message->message !!}</td>
                            <td>{{ $message->updated_at }}</td>
                            <td>
                                <div class="d-grid gap-2 d-md-block">
                                    <a href="{{ route('promotion.messages.edit', $message->id) }}" class="btn btn-success">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                {{ $promotionMessages->links() }}
            </div>
        </div>
    </div>
</x-dashboard.layout>
