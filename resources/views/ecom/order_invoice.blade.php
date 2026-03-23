<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uniq Connect - Tax Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 10px;
            font-size: 13px;
            
        }
        .row {
            width: 80mm;
            max-width: 80mm;
            margin: 0 auto;
            padding: 5px;
            border: 2px dashed #555454;
        }
        .invoice {
            width: 80mm;
            max-width: 80mm;
            margin: 0 auto;
            padding: 5px;
            border: 2px dashed #555454;
        }
        .header {
            text-align: center;
            margin-bottom: 10px;
            border-bottom: 2px dashed #000;
            padding-bottom: 10px;
        }
        .header img {
            max-width: 150px;
            height: auto;
        }
        .store-info {
            font-size: 12px;
            text-align: center;
            margin: 5px 0;
        }
        .gst-info {
            font-weight: bold;
            text-align: center;
            margin: 5px 0;
        }
        .invoice-title {
            text-align: center;
            font-weight: bold;
            font-size: 16px;
            margin: 8px 0;
        }
        .invoice-details {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
        }
        .customer-info {
            margin-bottom: 10px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin: 5px 0;
        }
        .table th {
            text-align: left;
            padding: 3px;
            border-bottom: 1px dashed #ccc;
            font-size: 12px;
        }
        .table td {
            padding: 4px 3px;
            border-bottom: 1px dashed #ccc;
            vertical-align: top;
        }
        .table .right {
            text-align: right;
        }
        .summary {
            margin-top: 10px;
            border-top: 2px dashed #000;
            border-bottom: 2px dashed #000;
            padding: 8px 0;
            
        }
        .summary-row {
            display: flex;
            justify-content: space-between;
            margin: 3px 0;
            
        }
        .summary1 {
            margin-top: 10px;
            border-top: 2px dashed #000;
            border-bottom: 2px dashed #000;
            padding: 8px 0;
            width: 80mm;
            max-width: 80mm;
            margin: 0 auto;
            padding: 5px;
            border: 2px dashed #555454;
        }
        .summary-row1 {
            display: flex;
            justify-content: space-between;
            margin: 3px 0;
            
        }
        .total {
            font-weight: bold;
            font-size: 14px;
        }
        .footer {
            text-align: center;
            margin-top: 10px;
            font-size: 11px;
        }
        .barcode {
            text-align: center;
            margin: 10px 0;
            font-family: 'Libre Barcode 128', cursive;
            font-size: 24px;
        }
        .thank-you {
            text-align: center;
            margin: 10px 0;
            font-weight: bold;
        }
        .terms {
            font-size: 10px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="invoice" id="invoice_div">
        <!-- Header -->
        <div class="header">
            <img src="../assets/images/logo/logo2.png" alt="Uniq Connect Logo">
            <div class="store-info">
                Uniq Connect Wellness Care<br>
                140, 9th Cross, Street,<br>
                SML Nagar, Guduvanchery,<br>
                Chennai - 600040<br>
                Contact: +91 82200 65758
            </div>
            <div class="gst-info">
                GSTIN: 33BNQPR7484B1ZL
            </div>
        </div>

        <!-- Invoice Title -->
        <div class="invoice-title">
            TAX INVOICE
        </div>

        <!-- Invoice Details -->
        <div class="invoice-details">
           <div>
                <strong>Invoice No:</strong>{{ $orders->id }}{{ $orders->created_at->format('mY') }}<br>
                <strong>Order No:</strong> {{ $orders->order_id }}<br>
                <strong>Date:</strong> {{ $orders->created_at->format('d-m-Y') }}<br>
                <!--<strong>Order No:</strong> UC-ORD-1254<br>-->
                <!--<strong>PAN:</strong> AAAAA0000A-->
            </div>
            
        </div>

        <!-- Customer Info -->
        <div class="customer-info">
            <strong>Shipping Address:</strong><br>
          
            
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
            
        </div><br>

        <!-- Items Table -->
       <table class="table">
    <thead>
        <tr>
            <th>Item</th>
            <th>Qty</th>
            <th class="right">Rate</th>
            <th class="right">Amount</th>
        </tr>
    </thead>
    <tbody>

        @php 
            $grandTotal = 0; 
            $total_CGST = 0;  
            $total_SGST = 0; 
        @endphp

        @foreach($orderitems as $item)

            @php
                // detect if this is a sub-product row
                $isSub = $item->sub_product_name !== null;

                $name = $isSub ? $item->sub_product_name : $item->product_name;
                $HSN  = $isSub ? $item->sub_product_HSN  : $item->product_HSN;

                $price = $item->price;         // already 0 for offer item
                $qty   = $item->quantity;
                $amount = $price * $qty;

                // tax values
                $CGST = $isSub ? $item->sub_product_CGST : $item->product_CGST;
                $SGST = $isSub ? $item->sub_product_SGST : $item->product_SGST;

                $total_CGST += $CGST * $qty;
                $total_SGST += $SGST * $qty;

                $grandTotal += $amount;
            @endphp

            <tr>
                <td>
                    {{ $name }}  
                    <br>
                    <small class="text-muted">HSN: {{ $HSN }}</small>

                    @if($isSub)
                        <!--<br><span style="color:green; font-size:12px;">(FREE ITEM)</span>-->
                    @endif
                </td>

                <td>{{ $qty }}</td>

                <td class="right">₹ {{ number_format($price, 2) }}</td>

                <td class="right">₹ {{ number_format($amount, 2) }}</td>
            </tr>

        @endforeach

    </tbody>
</table>


        <!-- Summary -->
        <div class="summary">
            <div class="summary-row">
                <div>Subtotal:</div>
                <div>₹{{$grandTotal-$total_CGST-$total_SGST}}</div>
            </div>
            <div class="summary-row">
                <div>CGST:</div>
                <div>₹{{$total_CGST}}</div>
            </div>
            <div class="summary-row">
                <div>SGST:</div>
                <div>₹{{$total_SGST}}</div>
            </div>
                <div class="summary-row">
                <div>Discount:</div>
                <div>₹{{ $orders->discount ?? 0 }}</div>
            </div>
            
            
            <div class="summary-row total">
                <div>Total Amount:</div>
                <div>{{ number_format($grandTotal-$orders->discount, 2) }}</div>
            </div>
        </div>

        <!-- Payment Info -->
        <div style="margin-top: 8px;">
            <strong>Payment Mode:</strong>  {{ $orders->mode }} Payment<br>
            <strong>Amount in Words:</strong> <b id="amountword"></b>Only.
        </div>

        <!-- GST Breakdown -->
        <table class="table" style="margin-top: 10px;">
            <thead>
                <tr>
                    <th>HSN</th>
                    <th>Tax%</th>
                    <th class="right">Taxable</th>
                    <th class="right">CGST</th>
                    <th class="right">SGST</th>
                </tr>
            </thead>
            <tbody>
                @php $grandTotal = 0; @endphp
            @foreach($orderitems  as   $item)
                @php 
                    $total = $item->price * $item->quantity; 
                    $CGST = $item->product_CGST * $item->quantity; 
                    $SGST = $item->product_SGST * $item->quantity; 
                    $grandTotal += $total;
                @endphp
                <tr>
                    
                    <td>{{ $item->product_HSN }}</td>
                    <td>{{ $item->product_Tax }}</td>
                     <td>{{ $total-$CGST-$SGST }}</td>
                    <td class="right">{{ number_format($CGST, 2) }}</td>
                    <td class="right">{{ number_format($SGST, 2) }}</td>
                </tr>
            @endforeach
                
            </tbody>
        </table>

        <!-- Barcode -->
        <!--<div class="barcode">-->
        <!--    *UC-2024-1254*-->
        <!--</div>-->

        <!-- Footer -->
        <div class="terms">
            <strong>Terms:</strong><br>
            1. Goods sold are not returnable.<br>
            2. Subject to Chennai jurisdiction.
        </div>
        <div class="thank-you">
            Thank You! 
        </div>
        <div class="footer">
            Uniq Connect Wellness Care<br>
            www.uniqconnectwc.com | support@uniqconnectwc.com
        </div>
    </div>
    <div class="summary1">
        <div class="summary-row1">
            <!--<a onclick="window.print();">Download</a>-->
              <div class="download-btn text-center mt-4">
    <button id="downloadBtn" class="btn btn-lg text-white" style="background-color: #9f4ab0;">⬇️ Download</button>
  </div>
            <!--<button>Print</button>-->
        </div>
    </div>
    <!-- <div class="row">-->
    <!--    <div class="col-lg-10">-->
              <!-- Download Button -->

    <!--    </div>-->
        <!--<div class="col-lg-6">-->
        <!--    <button>Print</button>-->
        <!--</div>-->
    <!--</div> -->
     <script>
    let amount = '{{ round($grandTotal) }}';

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
  

   <!-- Include html2pdf.js -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>

  <script>
    document.getElementById("downloadBtn").addEventListener("click", () => {
      const element = document.getElementById("invoice_div");

      const opt = {
        margin: 0,
        filename: 'invoice.pdf',
        image: { type: 'jpeg', quality: 1 },
        html2canvas: {
          scale: 2,
          useCORS: true,
          allowTaint: true,
        },
        jsPDF: {
          unit: 'mm',
          format: 'a5',
          orientation: 'portrait'
        }
      };

      html2pdf().set(opt).from(element).save();
    });
  </script>
</body>
</html>



