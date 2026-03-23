@extends('layout.admin') @section('content')
<div class="page-body">
    <!-- Container-fluid starts-->
    <div class="container-fluid">

    <h2>Offline Billing (POS)</h2>
    <p>Use this section to generate bills for customers who are not registered on the platform.</p>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form id="pos-form" action="{{ route('ecom.offline_bill.store') }}" method="POST">
        @csrf
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="customer_name" class="form-label">Customer Name</label>
               <select class="form-select" id="customer_name" name="customer_name" required>
                    <option value="">Select Customer</option>
                    @foreach ($customers as $customer)
                        <option value="{{ $customer->id }}">{{ $customer->name }}-{{$customer->memberid}}</option>
                    @endforeach
                </select>

            </div>
            <div class="col-md-6">
                <label for="bill_date" class="form-label">Date</label>
                <input type="date" class="form-control" id="bill_date" name="bill_date" value="{{ date('Y-m-d') }}" required>
            </div>
        </div>

        <table class="table table-bordered" id="items-table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Qty</th>
                    <th>Rate</th>
                    <th>Total</th>
                    {{-- <th><button type="button" class="btn btn-success btn-sm" onclick="addRow()">+</button></th> --}}
                </tr>
            </thead>
            <tbody>
              
                @foreach ($products as $product => $item)
                 <tr>
                    <td><input type="text" name="product[]" class="form-control" value="{{ $item->name }}" required></td>
                    <td><input type="number" name="qty[]" class="form-control qty" min="1" value="1" required></td>
                    <td><input type="number" name="rate[]" class="form-control rate" min="0" value="{{ $item->price }}" required></td>
                    <td><input type="number" name="total[]" class="form-control total" value="{{ $item->price }}" readonly></td>
                    {{-- <td><button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)">-</button></td> --}}
                 </tr>
                @endforeach
               
            </tbody>
        </table>
        

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="discount" class="form-label">Discount</label>
                <input type="number" class="form-control" id="discount" name="discount" value="0" min="0" oninput="calculateTotals_with_dis(this.value)" required>
            </div>
          
          <div class="col-md-6">
                <label for="payment_method" class="form-label">Payment Method</label>
                <select class="form-select" id="payment_method" name="payment_method" required>
                    <option value="">Select Payment Method</option>
                    <option value="cash">Cash</option>
                    <option value="card">Card</option>
                    <option value="upi">UPI</option>
                </select>
            </div>
        </div>

        <div class="mb-3">
            <label for="grand_total" class="form-label">Grand Total</label>
            <input type="number" class="form-control" id="grand_total" name="grand_total" value="0" readonly>
        </div>

        <button type="submit" class="btn btn-primary">Generate Bill</button>
    </form>
</div>

<script>
function addRow() {
    let row = `<tr>
        <td><input type="text" name="product[]" class="form-control" required></td>
        <td><input type="number" name="qty[]" class="form-control qty" min="1" value="1" required></td>
        <td><input type="number" name="rate[]" class="form-control rate" min="0" value="0" required></td>
        <td><input type="number" name="total[]" class="form-control total" value="0" readonly></td>
        <td><button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)">-</button></td>
    </tr>`;
    document.querySelector('#items-table tbody').insertAdjacentHTML('beforeend', row);
}

function removeRow(btn) {
    btn.closest('tr').remove();
    calculateTotals();
}

document.addEventListener('input', function(e) {
    if (e.target.classList.contains('qty') || e.target.classList.contains('rate')) {
        let row = e.target.closest('tr');
        let qty = parseFloat(row.querySelector('.qty').value) || 0;
        let rate = parseFloat(row.querySelector('.rate').value) || 0;
        row.querySelector('.total').value = qty * rate;
        calculateTotals();
    }
});

function calculateTotals() {
    let totals = document.querySelectorAll('.total');
    let grandTotal = 0;
    totals.forEach(function(input) {
        grandTotal += parseFloat(input.value) || 0;
    });
    document.getElementById('grand_total').value = grandTotal;
}

function calculateTotals_with_dis($discount) {
    let totals = document.querySelectorAll('.total');
    let grandTotal = 0;
    totals.forEach(function(input) {
        grandTotal += parseFloat(input.value) || 0;
    });

    let discount = parseFloat(document.getElementById('discount').value) || 0;
    grandTotal -= discount;
    if (grandTotal < 0) {
        grandTotal = 0;
    }   
    document.getElementById('grand_total').value = grandTotal;
}
</script>
@endsection