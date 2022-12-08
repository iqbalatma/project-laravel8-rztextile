<x-app-layout :title="$title">
  <div class="card mb-4">
    <div class="card-header">
      <i class="fa-solid fa-magnifying-glass"></i>
      {{ $cardTitle }}
    </div>
    <div class="card-body">
      <div class="col-md-12">
        <label for="select-roll" class="form-label">Choose Roll</label>
        <select id="select-roll" name="roll">
          @foreach ($rolls as $key => $roll)
          <option value="{{ $roll->id }}" data-data="{{ json_encode($roll) }}">
            {{ $roll->id }} | {{ $roll->name }} | {{ $roll->qrcode }}
          </option>
          @endforeach
        </select>
      </div>
    </div>
  </div>

  @section("custom-scripts")
  <script src="{{ asset('js/search-roll/index.js') }}"></script>
  @endsection
</x-app-layout>