<x-app-layout :title="$title">
  <div class="card mb-4">
    <div class="card-header">
      <i class="fa-solid fa-scale-unbalanced-flip"></i>
      {{ $cardTitle }}
    </div>
    <div class="card-body">
      <form class="row g-3" method="POST" action="{{ route('units.update', $unit->id) }}">
        @csrf
        @method("PATCH")
        <div class="col-md-12">
          <label for="name" class="form-label">Name</label>
          <input type="text" class="form-control" id="name" name="name" placeholder="Enter name of new unit" value="{{ $unit->name }}" required>
        </div>
        <div class="col-md-12">
          <label for="shortname" class="form-label">Shortname</label>
          <input type="text" class="form-control" id="shortname" name="shortname" placeholder="Enter shortname of new unit" value="{{ $unit->shortname }}" required>
        </div>
        <div class="col-12">
          <button type="submit" class="btn btn-primary">Save Changes</button>
        </div>
      </form>
    </div>
  </div>
</x-app-layout>