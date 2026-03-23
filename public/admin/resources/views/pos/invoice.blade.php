<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GST Invoice - Uniq Connect Wellness Care</title>
    <style>
        /* Base Styles */
        body {
            font-family: 'Poppins', Arial, sans-serif;
            margin: 0;
            padding: 20px;
            color: #333;
            background-color: #fff;
        }
        .invoice-container {
            max-width: 800px;
            margin: 0 auto;
            border: 1px solid #e0e0e0;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            padding: 20px 0;
            border-bottom: 2px solid #4F46E5;
        }
        .header img {
            max-width: 200px;
            height: auto;
            margin-bottom: 10px;
        }
        .company-info {
            margin-top: 10px;
            font-size: 14px;
            color: #555;
        }
        .invoice-title {
            background: linear-gradient(135deg, #4F46E5 0%, #8A4FFF 100%);
            color: white;
            padding: 15px;
            text-align: center;
            font-size: 24px;
            font-weight: 600;
            margin: 20px 0;
        }
        .invoice-details {
            display: flex;
            justify-content: space-between;
            padding: 0 20px;
            margin-bottom: 20px;
        }
        .invoice-details div {
            width: 90%;
        }
        .address-box {
            border: 1px solid #e0e0e0;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
        .address-title {
            font-weight: 600;
            color: #6D28D9;
            margin-bottom: 10px;
        }
        .invoice-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        .invoice-table th {
            background-color: #F5F3FF;
            color: #6D28D9;
            padding: 12px;
            text-align: left;
            font-weight: 600;
            border: 1px solid #e0e0e0;
        }
        .invoice-table td {
            padding: 12px;
            border: 1px solid #e0e0e0;
        }
        .invoice-table tfoot td {
            font-weight: 600;
            background-color: #F8FAFC;
        }
        .total-row {
            color: #4F46E5;
            font-size: 16px;
        }
        .gst-summary {
            margin-top: 20px;
            padding: 15px;
            background-color: #F5F3FF;
            border-radius: 5px;
        }
        .gst-summary h4 {
            color: #6D28D9;
            margin-top: 0;
        }
        .footer {
            text-align: center;
            margin-top: 40px;
            padding: 20px;
            border-top: 2px solid #4F46E5;
            font-size: 14px;
            color: #555;
        }
        .footer img {
            max-width: 150px;
            height: auto;
            margin-bottom: 10px;
        }
        .terms {
            margin-top: 30px;
            font-size: 12px;
            color: #777;
            border-top: 1px dashed #ccc;
            padding-top: 15px;
            padding-left: 10px;
        }
        .signature {
            margin-top: 40px;
            text-align: right;
            padding-right: 10px;
        }
        .signature-line {
            border-top: 1px solid #333;
            width: 200px;
            display: inline-block;
            margin-top: 50px;
        }
    </style>
</head>
<body>
    <div class="invoice-container">
        <!-- Header with Logo -->
        <div class="header">
            <img src="https://uniqconnectwc.com/assets/images/logo/logo2.png" alt="Uniq Connect Logo">
            <div class="company-info">
                <!--<h2 style="color: #4F46E5;">Uniq Connect Wellness Care</h2>-->
                <p>GSTIN: 33BNQPR7484B1ZL</p>
                <p>Regd. Office: 140, 9th Cross Street, SML Nagar, Guduvanchery, Chennai - 603 202</p>
                <p>Contact: +91 82200 65758 | Email: billing@uniqconnectwc.com</p>
            </div>
        </div>

        <!-- Invoice Title -->
        <div class="invoice-title">
            TAX INVOICE
        </div>

        <!-- Invoice Details -->
        <div class="invoice-details">
            <div>
                <div class="address-box">
                    <div class="address-title">INVOICE DETAILS:</div>
                    <p><strong>Invoice No:</strong> {{ $orders->id }}{{ $orders->created_at->format('mY') }}</p>
                    <p><strong>Invoice Date:</strong> {{ $orders->order_date }}</p>
                    <p><strong>Order No:</strong> {{ $orders->order_id }}</p>
                    <p><strong>Order Date:</strong> {{ $orders->order_date }}</p>
                    <p><strong>Payment Mode:</strong> {{ $orders->mode }} Payment</p>
                </div>
            </div>
            <div>
                <div class="address-box">
                    <div class="address-title">BILLED TO:</div>
            @if(isset($address->full_name))
            
             <p>{{ $address->full_name ?? "" }}<br>
            {{ $address->street_address ?? "" }} {{$address->city ?? ""}}<br>
            {{$address->district ?? ""}} <br>
            {{$address->state ?? ""}} <br>
            {{$address->pincode ?? ""}} <br>
            {{ $address->mobile_no ?? ""}} </p>
            @else
            {{$customer->name}}<br>
            {{$customer->mobile}}<br>
            {{$orders->short_address}}<br>
            
            @endif
            
                  
                  
            
            
                </div>
            </div>
            
        </div>

        <!-- Invoice Table -->
        <table class="invoice-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Description</th>
                    <th>HSN Code</th>
                  
                   
                    <th>Rate (₹)</th>
                      <th>Qty</th>
                    <th>CGST (₹)</th>
                    <th>SGST (₹)</th>
                    <th>Total (₹)</th>
                </tr>
            </thead>
            <tbody>
                   @php $ttotal=0; $grandTotal = 0; $total_CGST=0;  $total_SGST=0; $total_qty=0; $taxable_tt=0; @endphp
            @foreach($orderitems  as   $item)
                @php 
                  $total_qty +=  $item->quantity; 
                    $total = $item->price * $item->quantity; 
                    $total_CGST += $item->CGST * $item->quantity; 
                    $total_SGST += $item->SGST * $item->quantity; 
                    $grandTotal += $total;
                    
                    $taxable_tt+=$item->price -$item->CGST -$item->SGST;
                    
                    $ttotal=$grandTotal;    
                @endphp
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{$item->HSN}}</td>
                
                 
                     <td>{{ $item->price -$item->CGST -$item->SGST}}</td>
                         <td>{{$item->quantity}}</td>
                    <!--<td>900.00</td>-->
                    <td>{{$item->CGST*$item->quantity}}</td>
                    <td>{{$item->SGST*$item->quantity}}</td>
                  
                    <td>{{ number_format($item->price*$item->quantity, 2) }}</td>
                </tr>
                  @endforeach
            </tbody>
            <tfoot>
                <tr>
                    
                    <td colspan="4">Grand Total</td>
                   
                    <td>{{ $total_qty }}</td>
                    <td>{{ number_format($total_CGST, 2) }}</td>
                    <td>{{ number_format($total_SGST, 2) }}</td>
                
                    <td>{{ number_format($ttotal, 2) }}</td>
                </tr>
                <tr>
                    <td colspan="7">Discount</td>
                   <td>{{ number_format($orders->discount, 2) }}</td>
                </tr>
                <tr>
                    <td colspan="7">Total</td>
                   <td>{{ number_format($ttotal-($orders->discount),2) }}</td>
                </tr>
            </tfoot>
        </table>

        <!-- GST Summary -->
        <div class="gst-summary">
            <h4>Bill Summary</h4>
            <!--<p><strong>Total Taxable Value:</strong> ₹{{ number_format($grandTotal, 2) }}</p>-->
            <!--<p><strong>Total CGST :</strong> ₹{{ number_format($total_CGST, 2) }}</p>-->
            <!--<p><strong>Total SGST :</strong> ₹{{ number_format($total_SGST, 2) }}</p>-->
            <!--<p><strong>Total IGST:</strong> ₹0.00</p>-->
            <p><strong>Total Paid Amount (Inclusive of all taxes):</strong> ₹{{ number_format($ttotal-($orders->discount),2) }}</p>
            <p> <strong>Amount in Words: </strong>Rupees <span id="amountword"></span> Only.</p>
        </div>



        <div class="terms">
            <p><strong><u>Notes:</u></strong></p>
            <p> {{$orders->remarks}}</p>
            
        </div>

        <!-- Terms and Signature -->
        <div class="terms">
            <p><strong><u>Terms & Conditions:</u></strong></p>
            <p>1. Goods once sold will not be taken back.</p>
            <p>2. Subject to Chennai Jurisdiction.</p>
            
        </div>
        <div class="terms">
            <p><strong><u>Declaration:</u></strong></p>
            <p>🔹 We declare that this invoice shows the actual price of the goods described and that all particulars are true and correct.</p>
            
        </div>


        <!-- Footer with Logo -->
        <div class="footer">
            
            <h1 style="color: #4F46E5;">Thank You!</h1>
            <p>Visit us at: <a href="https://uniqconnectwc.com">www.uniqconnectwc.com</a></p>
            <p>Customer Care: +91 82200 65758 | Email: billing@uniqconnectwc.com</p>
            <p class="text-center"><strong>This is a Computer Generated Invoice. Hence, Physical Signature Not Requered.</strong></p>
        </div>
        
    </div>
     <script>
    let amount = '{{ number_format($ttotal-($orders->discount)) }}';

    function numberToWords(num) {
      const a = [
        '', 'One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven',
        'Eight', 'Nine', 'Ten', 'Eleven', 'Twelve', 'Thirteen',
        'Fourteen', 'Fifteen', 'Sixteen', 'Seventeen', 'Eighteen',
        'Nineteen'
      ];
      const b = ['', '', 'Twenty', 'Thirty', 'Forty', 'Fifty',
        'Sixty', 'Seventy', 'Eighty', 'Ninety'
      ];

      if ((num = num.toString()).length > 9) return 'Overflow';
      let n = ('000000000' + num).substr(-9).match(/(\d{2})(\d{2})(\d{2})(\d{1})(\d{2})/);
      if (!n) return;
      let str = '';
      str += (n[1] != 0) ? (a[Number(n[1])] || b[n[1][0]] + ' ' + a[n[1][1]]) + ' Crore ' : '';
      str += (n[2] != 0) ? (a[Number(n[2])] || b[n[2][0]] + ' ' + a[n[2][1]]) + ' Lakh ' : '';
      str += (n[3] != 0) ? (a[Number(n[3])] || b[n[3][0]] + ' ' + a[n[3][1]]) + ' Thousand ' : '';
      str += (n[4] != 0) ? (a[Number(n[4])] || b[n[4][0]] + ' ' + a[n[4][1]]) + ' Hundred ' : '';
      str += (n[5] != 0) ?
        ((str != '') ? 'and ' : '') +
        (a[Number(n[5])] || b[n[5][0]] + ' ' + a[n[5][1]]) + ' ' : '';
      return str.trim();
    }

    document.getElementById("amountword").innerText = numberToWords(amount);
  </script>
</body>
</html>