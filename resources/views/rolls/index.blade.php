<x-app-layout :title="$title">
  <div class="card mb-4">
    <div class="card-header">
      <i class="fa-solid fa-boxes-stacked"></i>
      {{ $cardTitle }}
    </div>
    <div class="card-body">
      <div class="d-grid gap-2 d-md-flex justify-content-md-start">
        <a href="{{ route('rolls.create') }}" type="button" class="btn btn-primary">
          <i class="fa-solid fa-square-plus"></i>
          Add New Roll</a>
      </div>

      <div class="table-responsive mt-4">
        <table class="table align-middle">
          <thead>
            <th>No</th>
            <th>Name</th>
            <th>Code</th>
            <th>QR Code</th>
            <th>Quantity Roll</th>
            <th>Quantity Unit</th>
            <th>QR Code Image</th>
            <th>Last Updated Time</th>
            <th class="text-center">Action</th>
          </thead>
          <tbody>
            @foreach ($rolls as $key => $roll)
            <tr>
              <td>{{ $rolls->firstItem()+$key }}</td>
              <td>{{ $roll->name }}</td>
              <td>{{ $roll->code }}</td>
              <td>{{ $roll->qrcode }}</td>
              <td>{{ $roll->quantity_roll . " rolls" }}</td>
              <td>{{ $roll->quantity_unit . " " . ($roll->unit->name??"") }}</td>
              <td>
                <img src="storage/images/qrcode/{{ $roll->qrcode_image }}" alt="">
              </td>
              <td>{{ $roll->updated_at??"-" }}</td>
              <td class="text-center">
                <div class="d-grid gap-2 d-md-block">
                  <a href="{{ route('rolls.edit', $roll->id) }}" class="btn btn-success">
                    <i class="fa-solid fa-pen-to-square"></i>
                    Edit
                  </a>
                  <a href="{{ route('rolls.downloadQrcode', $roll->qrcode_image) }}" class="btn btn-primary">
                    <i class="fa-solid fa-download"></i>
                    Download
                  </a>
                  <!-- Button trigger modal -->
                  <button type="button" class="btn btn-dark btn-print-qrcode" data-bs-toggle="modal" data-name="{{ $roll->name }}" data-code="{{ $roll->code }}" data-qrcode="{{ $roll->qrcode }}"
                    data-qrcode-image="{{ $roll->qrcode_image }}" data-id="{{ $roll->id }}" data-bs-target="#print-qrcode-modal">
                    <i class="fa-solid fa-print"></i>
                    Print
                  </button>
                </div>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        {{ ($rolls->links()) }}
      </div>
    </div>
  </div>

  <!-- Modal Print Qrcode -->
  <div class="modal fade" id="print-qrcode-modal" tabindex="-1" aria-labelledby="print-qrcode-modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="print-qrcode-modalLabel">Print Qrcode</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ route('rolls.printQrcode') }}" method="POST">
          @csrf
          <div class="modal-body">
            <div class="row">
              <div class="col-6">
                <img src="" class="d-block m-auto" id="qrcode-image-modal" alt="">
              </div>
              <div class="col-6">
                <div class="table-responsive">
                  <table class="table table-borderless">
                    <thead>
                      <tr>
                        <th scope="col">Name</th>
                        <th scope="col" id="roll-name-modal">-</th>
                      </tr>
                      <tr>
                        <th scope="col">Code</th>
                        <th scope="col" id="roll-code-modal">-</th>
                      </tr>
                      <tr>
                        <th scope="col">Qrcode</th>
                        <th scope="col" id="roll-qrcode-modal">-</th>
                      </tr>
                      <tr>
                        <th scope="col">Qrcode Filename</th>
                        <th scope="col" id="roll-qrcode-filename-modal">-</th>
                      </tr>
                    </thead>
                  </table>
                </div>
              </div>
            </div>
            <div class="row mt-4">
              <input type="hidden" name="id" id="roll-id-modal">
              <div class="col-12 mb-3">
                <label for="copies" class="form-label">Number of Copies</label>
                <input type="number" class="form-control" id="copies" name="copies" min="0">
                <div id="copiesHelp" class="form-text">Here is the number of copies that you want to print on this qrcode</div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Print</button>
          </div>
        </form>

      </div>
    </div>
  </div>

  @section("custom-scripts")
  <script src="{{ asset('js/rolls/index.js') }}"></script>
  @endsection
</x-app-layout>