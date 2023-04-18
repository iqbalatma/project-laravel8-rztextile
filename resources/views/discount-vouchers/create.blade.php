<x-dashboard.layout>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fa-solid fa-users-gear"></i>
            {{ $cardTitle }}
        </div>
        <div class="card-body">
            <form class="row g-3" method="POST" action="{{ route('discount.vouchers.store') }}">
                @csrf
                <div class="col-md-12">
                    <label for="code" class="form-label">Code</label>
                    <input type="text" class="form-control" id="code" name="code" placeholder="Enter code for discount" required value="{{old('code')}}">
                </div>
                <div class="col-md-12">
                    <label for="percentage" class="form-label">Discount (%)</label>
                    <input type="number" class="form-control" id="percentage" name="percentage" placeholder="Enter percentage for discount" required value="{{old('code')}}">
                </div>
                <div class="col-12">
                    <a href="{{ route('discount.vouchers.index') }}" class="btn btn-danger"><i class="fa-solid fa-square-xmark"></i> Cancel</a>
                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
                </div>
            </form>
        </div>
    </div>
</x-dashboard.layout>