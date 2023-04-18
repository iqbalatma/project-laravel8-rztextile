<x-dashboard.layout>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fa-solid fa-users-gear"></i>
            {{ $cardTitle }}
        </div>
        <div class="card-body">
            <form class="row g-3" method="POST" action="{{ route('user.profile.update') }}">
                @csrf
                @method("PATCH")
                <div class="col-md-12">
                    <label for="id_number" class="form-label">ID Number</label>
                    <input type="number" class="form-control" id="id_number" name="id_number" placeholder="Enter id number of new user" required value="{{ $user->id_number }}">
                </div>
                <div class="col-md-12">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter name of new user" required value="{{ $user->name }}">
                </div>
                <div class="col-md-12">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter email of new user" value="{{ $user->email }}" readonly>
                </div>
                <div class="col-md-12">
                    <label for="phone" class="form-label">Phone Number</label>
                    <input type="phone" class="form-control" id="phone" name="phone" placeholder="Enter phone of new user" required value="{{ $user->phone }}">
                </div>
                <div class="col-md-12">
                    <label for="address" class="form-label">Address</label>
                    <textarea class="form-control" id="address" name="address" rows="3" placeholder="Enter your address">{{ $user->address }}</textarea>
                </div>
                <div class="col-12">
                    <a href="{{ route('users.index') }}" class="btn btn-danger"><i class="fa-solid fa-square-xmark"></i> Cancel</a>
                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
                </div>
            </form>
        </div>
    </div>
</x-dashboard.layout>