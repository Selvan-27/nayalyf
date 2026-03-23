<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .invoice-box {
            padding: 20px;
            border: 1px solid #ddd;
            margin: 20px auto;
            max-width: 800px;
            background: #fff;
        }
        .invoice-header {
            border-bottom: 2px solid #000;
            margin-bottom: 20px;
            padding-bottom: 10px;
        }
    </style>
</head>
<body>

<div class="invoice-box">
    <!-- Header -->
    <div class="row invoice-header">
        <div class="col-6">
            <h4>Customer Details</h4>
            <p>
                <strong>{{ $customer->name }}</strong><br>
                {{ $customer->address }}<br>
                Phone: {{ $customer->phone }}<br>
                Email: {{ $customer->email }}
            </p>
        </div>
        <div class="col-6 text-end">
            <h4>Shop Details</h4>
            <p>
                <strong>Name</strong><br>
                Adress
               <br>
                Phone: 9876543210<br>
                Email: email@gmail.com
            </p>
        </div>
    </div>

    <!-- Invoice Info -->
    <div class="row mb-4">
        <div class="col-6">
            <h6>Invoice No: <strong>#{{ $orders->order_id }}</strong></h6>
            <h6>Date: <strong>{{ $orders->created_at->format('d-m-Y') }}</strong></h6>
        </div>
        <div class="col-6 text-end">
            {{-- <h6>Payment Status: <strong>{{ $order->payment_status }}</strong></h6> --}}
        </div>
    </div>

    <!-- Product Table -->
    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Product</th>
                <th>Qty</th>
                <th>Price (₹)</th>
                <th>Total (₹)</th>
            </tr>
        </thead>
        <tbody>
            @php $grandTotal = 0; @endphp
            @foreach($orderitems  as   $item)
                @php 
                    $total = $item->price * $item->quantity; 
                    $grandTotal += $total;
                @endphp
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->name }}</td>
                   <td>{{ $item->quantity }}</td>
                    <td>{{ number_format($item->price, 2) }}</td>
                    <td>{{ number_format($total, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="4" class="text-end">Grand Total</th>
                <th>{{ number_format($grandTotal, 2) }}</th>
            </tr>
        </tfoot>
    </table>

    <!-- Footer -->
    <div class="text-center mt-4">
        <p>Thank you for your purchase!</p>
    </div>
</div>

</body>
</html>
