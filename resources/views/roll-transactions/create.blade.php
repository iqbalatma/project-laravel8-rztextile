<x-dashboard.layout>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fa-solid fa-circle-xmark"></i>
            {!! $cardTitle !!}
        </div>
        <div class="card-body">
            <form class="row g-3" id="form" method="POST" action="{{ route('roll.transactions.store') }}">
                @csrf
                <div class="col-md-12">
                    <label for="roll" class="form-label">Select Roll For Transactions</label>
                    <select class="form-select" aria-label="Select unit for roll" name="roll_id" id="roll">
                        <option selected disabled>Select Roll Below</option>
                        @foreach ($rolls as $roll)
                        <option value="{{ $roll->id }}">{{ $roll->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-12">
                    <label for="quantity_roll" class="form-label">Quantity Roll Transaction</label>
                    <input type="number" min="0" class="form-control" id="quantity_roll" name="quantity_roll" placeholder="Enter quantity roll" required>
                </div>
                <div class="col-md-12">
                    <label for="quantity_unit" class="form-label">Quantity Unit Transaction</label>
                    <input type="number" min="0" class="form-control" id="quantity_unit" name="quantity_unit" placeholder="Enter quantity unit" required>
                </div>
                <div class="col-md-12">
                    <label for="quantity_unit" class="form-label">Choose Transaction Type Bellow</label>

                    <div class="d-grid gap-2 d-md-block">
                        <input type="radio" class="btn-check" name="type" value="restock" id="success-outlined" autocomplete="off" checked>
                        <label class="btn btn-outline-success" for="success-outlined">Restock</label>

                        <input type="radio" class="btn-check" name="type" value="broken" id="danger-outlined" autocomplete="off">
                        <label class="btn btn-outline-danger" for="danger-outlined">Deadstock</label>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-footer">
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a href="{{ route('roll.transactions.index') }}" class="btn btn-danger"><i class="fa-solid fa-square-xmark"></i> Cancel</a>
                <button type="submit" form="form" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Save</button>
            </div>
        </div>
    </div>
</x-dashboard.layout>