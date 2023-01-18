<x-dashboard.layout title="{{ $title }}" description="{{ $description }}">
    <div class=" card mb-4">
        <div class="card-header">
            <i class="fa-solid fa-boxes-stacked"></i>
            {{ $cardTitle }}
        </div>
        <div class="card-body">
            <form class="row g-3" method="POST" action="{{ route('promotion.messages.update') }}">
                @csrf
                @method("PUT")
                <input type="hidden" name="id" value="{{ $message->id }}">
                <div class="col-md-12">
                    <label for="name" class="form-label">Message Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter name of message promotion" value="{{ $message->name }}" required>
                </div>
                <div class="col-md-12">
                    <select class="form-control form-select mb-3" aria-label=".form-select-lg example" name="customer_segmentation_id">
                        <option selected>Select Customer Segmentations</option>
                        @foreach ($customerSegmentations as $segment)
                        <option value="{{ $segment->id }}" @if ($segment->id == $message->customer_segmentation_id) selected @endif>{{ ucfirst($segment->name) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-12">
                    <label for="message" class="form-label">Message</label>
                    {{-- <textarea class="form-control" id="message" name="message" rows="3"></textarea> --}}
                    <x-forms.tinymce-editor message="{!! $message->message !!}"></x-forms.tinymce-editor>
                </div>
                <div class="col-12">
                    <a href="{{ route('promotion.messages.index') }}" class="btn btn-danger"><i class="fa-solid fa-square-xmark"></i> Cancel</a>
                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Save Changes</button>
                </div>
            </form>
        </div>
    </div>

    @section("custom-heads")
    <x-head.tinymce-config />
    @endsection

    @section("custom-scripts")
    <script src="{{ asset('js/rolls/create.js') }}"></script>
    @endsection
</x-dashboard.layout>
