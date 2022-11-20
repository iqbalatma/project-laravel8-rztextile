<x-app-layout :title="$title">
  <div class="card mb-4">
    <div class="card-header">
      <i class="fa-solid fa-scale-unbalanced-flip"></i>
      {{ $cardTitle }}
    </div>
    <div class="card-body">
      <form class="row g-3" method="POST" action="">
        @csrf
        <div class="col-md-12">
          <label for="name" class="form-label">Name</label>
          <input type="text" class="form-control" id="name" name="name" placeholder="Enter name of new unit" required>
        </div>
        <div class="col-md-12">
          <label for="shortname" class="form-label">Shortname</label>
          <input type="text" class="form-control" id="shortname" name="shortname" placeholder="Enter shortname of new unit" required>
        </div>
        <div class="col-12">
          <a href="{{ route('units.index') }}" class="btn btn-danger">Cancel</a>
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>
  </div>
</x-app-layout>