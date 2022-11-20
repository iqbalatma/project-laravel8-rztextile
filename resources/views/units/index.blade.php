<x-app-layout>
  <div class="row">
    <div class="card flex-fill w-100">
      <div class="card-header">
        <h5 class="card-title mb-0">{{ $cardTitle }}</h5>
        <small>{{ $cardDescription }}</small>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table align-middle">
            <thead>
              <th>No</th>
              <th>Name</th>
              <th>Shortname</th>
            </thead>
            <tbody>
              @foreach ($units as $key => $unit)
              <tr>
                <td>{{ $units->firstItem()+$key }}</td>
                <td>{{ $unit->name }}</td>
                <td>{{ $unit->shortname }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>