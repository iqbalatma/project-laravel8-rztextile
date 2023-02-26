<x-dashboard.layout title="{{ $title }}" description="{{ $description }}">
    <div class="card mb-4">
        <div class="card-header">
            <i class="fa-solid fa-tags"></i>
            {{ $cardTitle }}
        </div>
        <div class="card-body">
            <form class="row g-3" method="POST" action="{{ route('promotion.messages.store') }}">
                @csrf
                <div class="col-md-12">
                    <label for="name" class="form-label">Message Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter name of message promotion" required>
                </div>
                <div class="col-md-12">
                    <label for="discount" class="form-label">Message Discount</label>
                    <input type="number" class="form-control" id="discount" name="discount" placeholder="Enter discount of message promotion">
                </div>
                <div class="col-md-12">
                    <label for="discount" class="form-label">Customer Segmentation</label>
                    <select class="form-control form-select mb-3" aria-label=".form-select-lg example" name="customer_segmentation_id">
                        <option selected>Select Customer Segmentations</option>
                        @foreach ($customerSegmentations as $segment)
                        <option value="{{ $segment->id }}">{{ ucfirst($segment->name) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-12">
                    <label for="message" class="form-label">Message</label>
                    {{-- <textarea class="form-control" id="message" name="message" rows="3"></textarea> --}}
                    <x-forms.tinymce-editor message="" name="message"></x-forms.tinymce-editor>
                </div>

                <div class="col-md-12">
                    <label for="prize" class="form-label">Prize</label>
                    <input type="number" class="form-control" id="prize" name="prize" placeholder="Enter prize of message promotion">
                </div>

                <div class="col-md-12">
                    <label for="message_prize" class="form-label">Message Prize</label>
                    <x-forms.tinymce-editor message="" name="message_prize"></x-forms.tinymce-editor>
                </div>
                <div class="col-12">
                    <a href="{{ route('promotion.messages.index') }}" class="btn btn-danger"><i class="fa-solid fa-square-xmark"></i> Cancel</a>
                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
                </div>
            </form>
        </div>
    </div>


    @section("custom-heads")
    <x-head.tinymce-config />
    @endsection
</x-dashboard.layout>
