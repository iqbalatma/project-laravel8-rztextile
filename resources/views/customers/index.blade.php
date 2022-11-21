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
              <td class="text-center">
                <form action="{{ route('customers.destroy', $customer->id) }}" method="POST">
                  @csrf
                  @method("DELETE")
                  <div class="d-grid gap-2 d-md-block">
                    <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-success">
                      <i data-feather="edit"></i> Edit
                    </a>
                    <a class="btn btn-danger btn-delete">
                      <i data-feather="edit"></i> Delete
                    </a>
                  </div>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>

        {{ $customers->links() }}
      </div>
    </div>
  </div>

  @section("custom-scripts")
  <script>
    $(document).ready(function(){
      $(".btn-delete").on("click", function(){
        const form =  $(this).closest("form");
        Swal.fire({
          title: 'Are you sure want to delete the unit ?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            form.submit();
          }
        })
      });
    });
  </script>
  @endsection
</x-app-layout>