<html>

<head>
  <title>{{ $title }}</title>

  <style>
    #table-all-sales {
      margin-left: -30px;
    }

    #table-all-sales td,
    #table-all-sales th,
    #table-all-sales {
      border: 1.5px solid rgb(61, 61, 61);
      border-collapse: collapse;
      font-size: 12px;
      text-align: center;
      padding-left: 5px;
      padding-right: 5px;
    }

    #table-all-sales th {
      background-color: #2c6faf;
      color: #ffffff;
    }

    .nowrap {
      white-space: nowrap;
    }
  </style>
</head>

<body>
  <h1 style="text-align: center">
    {{ $companyName }}
  </h1>


  <table id="table-all-sales">
    <thead>
      <tr>
        <th>No</th>
        <th style="white-space: nowrap;">Invoice Code</th>
        <th style="white-space: nowrap;">Capital</th>
        <th>Bill</th>
        <th>Profit</th>
        <th>Paid Amount</th>
        <th>Bill Left</th>
        <th>Payment Status</th>
        <th>Customer</th>
        <th>Admin</th>
        <th>Date</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($sales_report["all_invoice"] as $key => $invoice)
      <tr>
        <td>{{ $key+1 }}</td>
        <td class="nowrap">{{ $invoice->code }}</td>
        <td class="nowrap">{{ formatToRupiah($invoice->total_capital) }}</td>
        <td class="nowrap">{{ formatToRupiah($invoice->total_bill) }}</td>
        <td class="nowrap">{{ formatToRupiah($invoice->total_profit) }}</td>
        <td class="nowrap">{{ formatToRupiah($invoice->total_paid_amount) }}</td>
        <td class="nowrap">{{ formatToRupiah($invoice->bill_left) }}</td>
        <td>
          @if($invoice->is_paid_off)
          Lunas
          @else
          Belum Lunas
          @endif
        </td>
        <td>{{ $invoice->customer->name ?? "-" }}</td>
        <td>{{ $invoice->user->name ?? "-" }}</td>
        <td class="nowrap">{{ date('d-m-Y', strtotime($invoice->created_at)) }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</body>

</html>