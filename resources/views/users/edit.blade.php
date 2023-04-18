<x-dashboard.layout>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fa-solid fa-users-gear"></i>
            {{ $cardTitle }}
        </div>
        <div class="card-body">
            <form class="row g-3" method="POST" action="{{ route('users.update', $user->id) }}">
                @csrf
                @method("PATCH")
                <div class="col-md-12">
                    <label for="id_number" class="form-label">ID Number</label>
                    <input type="text" class="form-control" id="id_number" name="id_number" placeholder="Enter id number of new user" required value="{{ $user->id_number }}">
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
                    <textarea class="form-control" id="address" name="address" rows="3" placeholder="Enter your address">{{ $user->address }}"</textarea>
                </div>
                <div class="col-md-12">
                    <label for="is_active" class="form-label">Status Active</label>
                    <select class="form-select" aria-label="Default select example" name="is_active">
                        <option value="1" @if ($user->is_active)
                            selected
                            @endif>Active</option>
                        <option value="0" @if (!$user->is_active)
                            selected
                            @endif>Nonactive</option>
                    </select>
                </div>
                <div class="col-md-12">
                    <label for="roles" class="form-label">Roles</label><br>
                    @foreach ($roles as $key=> $role)
                    <div class="form-check form-switch form-check-inline">
                        <input name="roles[]" class="form-check-input" type="checkbox" id="roles-{{ $role->id }}" value="{{ $role->id }}" @if($role->is_active) checked @endif>
                        <label class="form-check-label" for="roles-{{ $role->id }}">{{ ucwords($role->name) }}</label>
                    </div>
                    @endforeach
                </div>
                <div class="col-12">
                    <a href="{{ route('users.index') }}" class="btn btn-danger"><i class="fa-solid fa-square-xmark"></i> Cancel</a>
                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
                </div>
            </form>
        </div>
    </div>
</x-dashboard.layout>