<x-dashboard.layout title="{{ $title}}" description="{{ $description }}">
    <div class="card mb-4">
        <div class="card-header">
            <i class="fa-solid fa-user-tag"></i>
            {{ $cardTitle }}
        </div>
        <div class="card-body">


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
                    </thead>
                    <tbody>
                        @foreach ($discountVouchers as $key => $voucher)
                        <tr>
                            <td>{{ $discountVouchers->firstItem()+$key }}</td>
                            <td>{{ strtoupper($voucher->code) }}</td>
                            <td>{{ $voucher->promotion_message->discount }} %</td>
                            <td>
                                @if ($voucher->is_valid)
                                <span class="badge rounded-pill bg-success">Valid</span>
                                @else
                                <span class="badge rounded-pill bg-danger">Invalid</span>
                                @endif
                            </td>
                            <td>{{ $voucher->updated_at }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif
        </div>
    </div>
</x-dashboard.layout>
