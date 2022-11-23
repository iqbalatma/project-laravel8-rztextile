<x-app-layout :title="$title">
  <div class="row">
    <div class="col-xl-7 col-xxl-8 mb-4">
      <div class="card flex-fill w-100">
        <div class="card-header">
          <i class="fa-solid fa-cart-shopping"></i>
          {{ $cardTitle }}
        </div>
        <div class="card-body">
          <div class="table-responsive mt-4">
            <table class="table align-middle" id="table-product">
              <thead>
                <th>ID</th>
                <th>Code</th>
                <th>Name</th>
                <th>Roll Quantity</th>
                <th>Unit Per Roll</th>
                <th>Unit Quantity</th>
                <th>Unit Price</th>
                <th>Sub Total</th>
                <th class="text-center">Action</th>
                <th>Available Roll</th>
                <th>Available Unit</th>
              </thead>
              <tbody>

              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-5 col-xxl-4">
      <div class="card flex-fill w-100">
        <div class="card-header">
          <i class="fa-solid fa-cart-shopping"></i>
          {{ $cardTitle }}
        </div>
        <div class="card-body">
          <div class="col-md-12">
            <label for="select-roll" class="form-label">Choose Roll</label>
            <select id="select-roll" name="roll">
              @foreach ($rolls as $key => $roll)
              <option value="{{ $roll->id }}" data-data="{{ json_encode($roll) }}">{{ $roll->name }}</option>
              @endforeach
            </select>
          </div>
        </div>
      </div>
    </div>
  </div>

  @section("custom-scripts")
  <script src="{{ asset('js/shopping/index.js') }}"></script>
  @endsection
</x-app-layout>