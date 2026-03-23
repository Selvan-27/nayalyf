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
                <h2 style="color: #4F46E5;">Uniq Connect Wellness Care</h2>
                <p>GSTIN: 22AAAAA0000A1Z5</p>
                <p>Regd. Office: 123, Uniq Plaza, Anna Nagar, Chennai - 600001</p>
                <p>Contact: +91 82200 65758 | Email: billing@uniqconnectwc.in</p>
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
                    <div class="address-title">BILLED TO:</div>
                   <p><strong>John Doe</strong></p>
                   <p>{{ $customer->name }}</p>
                   <p>{{ $customer->address }}</p>
                   <p>{{ $customer->mobile }}</p>
                </div>
            </div>
            <div>
                <div class="address-box">
                    <div class="address-title">INVOICE DETAILS:</div>
                    <p><strong>Invoice No:</strong> INV-UC-2024-1254</p>
                    <p><strong>Invoice Date:</strong> 15-Jul-2024</p>
                    <p><strong>Order No:</strong> UC-ORD-2024-1254</p>
                    <p><strong>Order Date:</strong> 15-Jul-2024</p>
                    <p><strong>Payment Mode:</strong> Online Payment</p>
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
                    <th>Qty</th>
                    <th>Rate (₹)</th>
                    <th>Taxable Value (₹)</th>
                    <th>CGST (%)</th>
                    <th>SGST (%)</th>
                    <th>IGST (%)</th>
                    <th>Total (₹)</th>
                </tr>
            </thead>
            <tbody>
                   @php $grandTotal = 0; $total_CGST=0;  $total_SGST=0; @endphp
            @foreach($orderitems  as   $item)
                @php 
                    $total = $item->price * $item->quantity; 
                    $total_CGST += $item->CGST * $item->quantity; 
                    $total_SGST += $item->SGST * $item->quantity; 
                    $grandTotal += $total;
                @endphp
                <tr>
                    <td>1</td>
                    <td>{{ $item->name }}</td>
                    <td>{{$item->HSN}}</td>
                    <td>{{$item->quantity}}</td>
                    <td>{{ number_format($item->price, 2) }}</td>
                    <td>900.00</td>
                    <td>6%</td>
                    <td>6%</td>
                    <td>-</td>
                    <td>{{ number_format($item->price, 2) }}</td>
                </tr>
                  @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="5" rowspan="4"></td>
                    <td colspan="4">Subtotal</td>
                    <td>2,300.00</td>
                </tr>
                <tr>
                    <td colspan="4">CGST (₹54 + ₹54 + ₹45)</td>
                    <td>{{ number_format($total_CGST, 2) }}</td>
                </tr>
                <tr>
                    <td colspan="4">SGST (₹54 + ₹54 + ₹45)</td>
                    <td>{{ number_format($total_SGST, 2) }}</td>
                </tr>
                <tr class="total-row">
                    <td colspan="4">Grand Total</td>
                    <td>{{ number_format($grandTotal, 2) }}</td>
                </tr>
            </tfoot>
        </table>

        <!-- GST Summary -->
        <div class="gst-summary">
            <h4>GST Summary</h4>
            <p><strong>Total Taxable Value:</strong> ₹2,300.00</p>
            <p><strong>Total CGST (6% + 6% + 9%):</strong> ₹153.00</p>
            <p><strong>Total SGST (6% + 6% + 9%):</strong> ₹153.00</p>
            <p><strong>Total IGST:</strong> ₹0.00</p>
            <p><strong>Invoice Total (Inclusive of all taxes):</strong> ₹2,606.00</p>
            <p><strong>Amount in Words:</strong><b id="amountword"></b></p>
        </div>

        <!-- Terms and Signature -->
        <div class="terms">
            <p><strong>Terms & Conditions:</strong></p>
            <p>1. Goods once sold will not be taken back.</p>
            <p>2. Interest @18% p.a. will be charged on overdue payments.</p>
            <p>3. Subject to Mumbai Jurisdiction.</p>
        </div>

        <div class="signature">
            <p>For Uniq Connect Wellness Care</p>
            <div class="signature-line"></div>
            <p>Authorized Signatory</p>
        </div>

        <!-- Footer with Logo -->
        <div class="footer">
            
            <p>Thank you for your business!</p>
            <p>Visit us at: <a href="https://uniqconnectwc.in">www.uniqconnectwc.in</a></p>
            <p>Customer Care: +91 9876543210 | Email: support@uniqconnectwc.in</p>
        </div>
    </div>
     <script>
    let amount = `{{ number_format($grandTotal, 2) }}`;

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