<x-dashboard.layout>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fa-solid fa-user-tag"></i>
            {{ $cardTitle }}
        </div>
        <div class="card-body">
            @can($discountVoucherPermissions::CREATE)
            {{-- Button Add New User --}}
            <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                <a href="{{ route('discount.vouchers.create') }}" type="button" class="btn btn-primary">
                    <i class="fa-solid fa-square-plus"></i>
                    Add New Discount Voucher</a>
            </div>
            @endcan

            @if ($discountVouchers->count()==0)
            <x-data-not-found></x-data-not-found>
            @else
            {{-- Table Data Roles --}}
            <div class="table-responsive mt-4">
                <table class="table align-middle">
                    <thead>
                        <th>No</th>
                        <th>Code</th>
                        <th>Discount</th>
                        <th>Status</th>
                        <th>Last Updated Time</th>
                        @can($discountVoucherPermissions::CHANGE_VALIDATE_STATUS)
                        <th>Action</th>
                        @endcan
                    </thead>
                    <tbody>
                        @foreach ($discountVouchers as $key => $voucher)
                        <tr>
                            <td>{{ $discountVouchers->firstItem()+$key }}</td>
                            <td>{{ strtoupper($voucher->code) }}</td>
                            <td>{{ $voucher->percentage }} %</td>
                            <td>
                                @if ($voucher->is_valid)
                                <span class="badge rounded-pill bg-success">Valid</span>
                                @else
                                <span class="badge rounded-pill bg-danger">Invalid</span>
                                @endif
                            </td>
                            <td>{{ $voucher->updated_at }}</td>
                            @can($discountVoucherPermissions::CHANGE_VALIDATE_STATUS)
                            <td>
                                @if($voucher->is_valid)
                                <a href="{{ route('discount.vouchers.change.validate.status', ['id'=> $voucher->id, 'status' =>'invalidate']) }}" class="btn btn-danger">Invalidate</a>
                                @else
                                <a href="{{ route('discount.vouchers.change.validate.status', ['id'=> $voucher->id, 'status' =>'validate']) }}" class="btn btn-success">Validate</a>
                                @endif
                            </td>
                            @endcan
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif
        </div>
    </div>
</x-dashboard.layout>