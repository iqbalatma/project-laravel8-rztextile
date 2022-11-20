<x-app-layout :title="$title">
  <div class="alert alert-primary" role="alert">
    <div class="alert-message">
      A simple primary alert—check it out!
    </div>
  </div>
  <div class="row">
    <div class="card flex-fill w-100">
      <div class="card-header">
        <h5 class="card-title mb-0">{{ $cardTitle }}</h5>
        <small>{{ $cardDescription }}</small>
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
  </div>
</x-app-layout>