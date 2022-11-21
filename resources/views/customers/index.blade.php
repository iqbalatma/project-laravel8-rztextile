<x-app-layout :title="$title">
  <div class="card mb-4">
    <div class="card-header">
      <i class="fa-solid fa-users-between-lines"></i>
      {{ $cardTitle }}
    </div>
    <div class="card-body">
      <div class="d-grid gap-2 d-md-flex justify-content-md-start">
        <a href="{{ route('customers.create') }}" type="button" class="btn btn-primary">
          <i class="fa-solid fa-square-plus"></i>
          Add New Customers</a>
      </div>

      <div class="table-responsive mt-4">
        <table class="table align-middle">
          <thead>
            <th>No</th>
            <th>Id Number</th>
            <th>Name</th>
            <th>Phone</th>
            <th>Address</th>
            <th>Last Updated Time</th>
            <th class="text-center">Action</th>
          </thead>
          <tbody>
            @foreach ($customers as $key => $customer)
            <tr>
              <td>{{ $customers->firstItem()+$key }}</td>
              <td>{{ $customer->id_number }}</td>
              <td>{{ $customer->name }}</td>
              <td>{{ $customer->phone }}</td>
              <td>{{ $customer->address }}</td>
              <td>{{ $customer->updated_at }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>

  @section("custom-scripts")
  <script>

  </script>
  @endsection
</x-app-layout>