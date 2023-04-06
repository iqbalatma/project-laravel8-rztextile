<x-dashboard.layout title="{{ $title }}" description="{{ $description }}">
    <div class="card mb-4">
        <div class="card-header">
            <i class="fa-solid fa-scale-unbalanced-flip"></i>
            {{ $cardTitle }}
        </div>
        <div class="card-body">

            <form class="row g-3" method="POST" action="{{ route('roles.store') }}">
                @csrf
                <div class="col-md-12">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter name of new role" required>
                </div>
                <div class="col-md-12">
                    <label for="description" class="form-label">Description</label>
                    <input type="text" class="form-control" id="description" name="description" placeholder="Enter description of new role" required value="{{ old('description') }}">
                </div>
                <div class="col-12">
                    <a href="{{ route('roles.index') }}" class="btn btn-danger"><i class="fa-solid fa-square-xmark"></i> Cancel</a>
                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Save</button>
                </div>
            </form>
        </div>
    </div>
</x-dashboard.layout>