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

            @if ($promotionMessages->count() == 0)
            <x-data-not-found></x-data-not-found>
            @else
            <div class="table-responsive mt-4">
                <table class="table align-middle">
                    <thead>
                        <th>No</th>
                        <th>Name</th>
                        <th>Message</th>
                        <th>Segmentation Key</th>
                        <th>Segmentation Name</th>
                        <th>Discount</th>
                        <th>Prize</th>
                        <th>Message Prize</th>
                        <th>Last Updated Time</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @foreach ($promotionMessages as $key => $message)
                        <tr>
                            <td>{{ $promotionMessages->firstItem() + $key }}</td>
                            <td>{{ $message->name }}</td>
                            <td>{!! $message->message !!}</td>
                            <td>{{ strtoupper($message->customer_segmentation->key) }}</td>
                            <td>{{ ucfirst($message->customer_segmentation->name) }}</td>
                            <td>{{ ucfirst($message->discount) }} %</td>
                            <td>{{ $message->prize}}</td>
                            <td>{!! $message->message_prize !!}</td>
                            <td>{{ $message->updated_at }}</td>
                            <td>
                                <div class="d-grid gap-2 d-md-flex">
                                    <a href="{{ route('promotion.messages.edit', $message->id) }}" class="btn btn-success btn-sm">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <form action="{{ route('promotion.messages.destroy', $message->id) }}" method="POST">
                                        @csrf
                                        @method("DELETE")
                                        <button type="submit" class="btn btn-sm btn-danger btn-delete">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                {{ $promotionMessages->links() }}
            </div>
            @endif

        </div>
    </div>

    @section("custom-scripts")
    <script src="{{ asset('js/pages/promotion-messages/index.js') }}"></script>
    @endsection
</x-dashboard.layout>
