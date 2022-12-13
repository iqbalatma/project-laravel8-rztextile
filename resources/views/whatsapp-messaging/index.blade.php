<x-app-layout :title="$title">
  <div class="card mb-4">
    <div class="card-header">
      <i class="fa-solid fa-comments"></i>
      {{ $cardTitle }}
    </div>
    <div class="card-body">
      <div class="col-md-12">
        <form method="POST" action="{{ route('whatsapp.messaging.store') }}">
          @csrf
          <div class="mb-3">
            <label for="phone" class="form-label">Phone Number</label>
            <input type="text" class="form-control" id="phone" name="phone" aria-describedby="emailHelp">
          </div>
          <div class="mb-3">
            <label for="promotion" class="form-label">Promotion Message Name</label>
            <select class="form-select" id="promotion" aria-label="Default select example">
              <option selected disabled>Open this select menu</option>
              @foreach ($promotionMessages as $promotion)
              <option value="{{ $promotion->id }}">{{ $promotion->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="mb-3">
            <label for="message" class="form-label">Message</label>
            <textarea class="form-control" id="message" name="message" rows="3"></textarea>
          </div>
          <button type="submit" class="btn btn-primary">Send</button>
        </form>
      </div>
    </div>
  </div>


  @section("custom-scripts")
  <script src="{{ asset('js/whatsapp-messaging/index.js') }}"></script>
  @endsection

</x-app-layout>