<!DOCTYPE html>
<html lang="en">


<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="kartify">
    <meta name="keywords" content="kartify">
    <meta name="author" content="kartify">
    <!--<link rel="manifest" href="manifest.json">-->
     <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="assets/images/logo/favicon.png" type="image/x-icon">
    <title>Uniq Connect</title>
    <link rel="apple-touch-icon" href="assets/images/logo/favicon.png">
    <meta name="theme-color" content="#2777FC">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="kartify">
    <meta name="msapplication-TileImage" content="assets/images/logo/favicon.png">
    <meta name="msapplication-TileColor" content="#FFFFFF">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="assets/css/br-hendrix.css">
    <link rel="stylesheet" type="text/css" id="rtl-link" href="assets/css/vendors/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/swiper-bundle.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/iconsax.css">
    <link rel="stylesheet" id="change-link" type="text/css" href="assets/css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
    <!-- loader start-->
    <div class="loader-wrapper" id="loader">
        <span class="loader"></span>
    </div>
    <!-- loader end -->

    <!-- header start -->
    <header class="main-header">
        <div class="custom-container">
            <div class="header-panel">
                <a onclick="history.back();">
                    <img class="img-fluid icon-btn back-arrow" src="assets/images/svg/back-arrow.svg" alt="back-arrow">
                </a>
                <h3>Checkout</h3>
            </div>
        </div>
    </header>
    <!-- header end -->

    <!-- checkout section starts -->
    <section class="section-sm-t-space">
        <div class="custom-container">
            <div class="title">
                <h3>Shipping address</h3>
            </div>

 
            <div class="address-box">
                <div class="address-head">
                    <div class="d-flex align-items-center gap-1">
                        <img class="img-fluid" src="assets/images/svg/location.svg" alt="location">
                        <h5 class="fw-medium title-color">Ship To</h5>
                    </div>
                    <a href="/Address" class="fw-medium btn btn-primary fw-medium">Manage Address</a>
                </div>
                                <!-----------------------------------select address------------------------------->
            
  <div class="address-box">
                <div class="address-head">
                    <div class="d-flex align-items-center gap-1">
                    <select class="form-control" id="delivery_address" onchange="show_selected_address(this.value)" >
                          <option value="0">--Select Address--</option>
                         @foreach($data as $item)
                        <option value="{{ $item->id }}">
                              
            {{ $item->full_name }} - {{ $item->street_address }} {{ $item->city }}, {{ $item->district }}, {{ $item->state }}, {{ $item->pincode }}
                        </option>
                        @endforeach
                    </select>    
                        
            </div>
        </div>
    </div> 
      <!-----------------------------------End address------------------------------->
   @forelse($data as $item)
<div class="address-content border rounded p-3 mb-3" id="Address_div{{ $item->id }}" style="display:none;" >
    

    <div class="d-flex justify-content-between align-items-center">
        <p class="mb-1 fw-bold text-primary" for="delivery{{ $loop->index }}">
            {{ $item->full_name }} - {{ $item->mobile_no }}
        </p>
       
    </div>

    <p class="mb-1">{{ $item->street_address }}</p>
    <label class="form-check-label text-muted" for="delivery{{ $loop->index }}">
        {{ $item->city }}, {{ $item->district }}, {{ $item->state }}, {{ $item->pincode }}
    </label>
</div>

@empty
    <div class="no-address">
        <p>No saved address found. Please add a new one.</p>
    </div>
@endforelse
                
            </div>
            
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
  
        </div>
    </section>

    <section>
        <!--<div class="title px-20">-->
        <!--    <h3>Delivery Method</h3>-->
        <!--</div>-->

<!--       <form class="theme-form">-->
<!--    <div class="form-group mt-0">-->
<!--        <div class="delivery-method custom-filter-checkbox custom-scrollbar px-20">-->
<!--            <div class="form-check">-->
<!--                <input class="form-check-input delivery-charge-option" type="radio" name="option" id="delivery1" checked value="0">-->
<!--                <label class="form-check-label" for="delivery1">-->
<!--                    <img class="img-fluid payment-img" src="assets/images/payment1.svg" alt="0">-->
<!--                </label>-->
<!--            </div>-->

<!--            <div class="form-check">-->
<!--                <input class="form-check-input delivery-charge-option" type="radio" name="option" id="delivery2" value="49">-->
<!--                <label class="form-check-label" for="delivery2">-->
<!--                    <img class="img-fluid payment-img" src="assets/images/payment2.svg" alt="49">-->
<!--                </label>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</form>-->

<!--    </section>-->

    <!-- <section>
        <div class="custom-container">
            <div class="title">
                <h3>Payment Method</h3>
            </div>

            <div class="payment-method-box">
                <ul class="theme-form border-design payment-form">
                    <li class="form-check mt-0">
                        <label class="form-check-label" for="flexRadioDefault2">
                            <img class="img-fluid payment-icon apple-img" src="assets/images/logo/favi.png"
                                alt="ucwallet">
                            Uniq Connect Wallet (Bal: ₹ 10000)
                        </label>
                        <input class="form-check-input ms-auto" type="radio" name="flexRadioDefault"
                            id="flexRadioDefault2" checked>
                    </li>
                    <li class="form-check mt-0">
                        <label class="form-check-label" for="flexRadioDefault3">
                            <img class="img-fluid payment-icon" src="assets/images/icon/svg/google.svg" alt="paypal">
                            Secure Online Payment
                        </label>
                        <input class="form-check-input ms-auto" type="radio" name="flexRadioDefault"
                            id="flexRadioDefault3" checked>
                    </li>
                    
                </ul>
            </div>
        </div>
    </section> -->


    <section class="section-b-space">
        <div class="custom-container">
            <div class="title mb-2">
                <h3>Shopping Item Details</h3>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="table table-responsive ">
                        <table id="recent-orders" class="table">
                            <thead>
                                <tr class="text-center">
                                    <th class="border-top-0">#</th>
                                    <th class="border-top-0">items</th>
                                    <th class="border-top-0">Qty</th>
                                    <!--<th class="border-top-0">MRP</th>-->
                                    <th class="border-top-0">Price</th>
                                    <th class="border-top-0">Total</th><th class="border-top-0">Action</th>
                                </tr>
                            </thead>
                            <tbody id="cart-items">
                                <!-- Cart items will be dynamically added here -->
                            </tbody>
                            <!--<tfoot>-->
                            <!--    <tr>  -->
                            <!--        <th colspan="6" class="text-right"><a href="UC_Shop" style="color: #2777fc; text-align: right;"><u>+ Add More Products</u></a></th>-->
                            <!--    </tr>-->

                            <!--</tfoot>-->
                            

                        </table>
                        <a href="UC_Shop" class="btn btn-primary w-100">+ Add More Products</a>

                    </div>
                </div>
                
            </div>
        </div>
    </section>

    <section class="section-b-space">
        <div class="custom-container">
            <div class="title mb-2">
                <h3>Payment Details</h3>
            </div>

            <div class="bill-box checkout-bill-box">
               <div class="bill-box-content">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <h5 class="fw-medium content-color">Product Total</h5>
                    <h5 class="fw-medium title-color" id="product-total">₹ 0.00</h5>
                </div>
            
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <h5 class="fw-medium content-color">Delivery Charges</h5>
                    <h5 class="fw-medium title-color" id="delivery-charge">₹ 0.00</h5>
                </div>
            
                <hr>
            
                <div class="d-flex align-items-center justify-content-between">
                    <h5 class="fw-medium content-color">Total</h5>
                    <h5 class="fw-medium title-color" id="Ttotal">₹ 0.00</h5>
                </div>
                <div class="d-flex align-items-center justify-content-between">
                    <h5 class="fw-medium content-color">Wallet</h5>
                    <h5 class="fw-medium title-color" id="use-wallet">₹ 0.00</h5>
                </div>
                <div class="d-flex align-items-center justify-content-between">
                    <h5 class="fw-bold content-color">Grand Total</h5>
                    <h5 class="fw-bold title-color" id="grand-total">₹ 0.00</h5>
                </div>
            </div>

            </div>
            <div class="payment-method-box">
                <ul class="theme-form border-design payment-form">
                    <!--<a onclick="updateWallet_balance('100')">-->
                    <li class="form-check mt-0">
                        <label class="form-check-label" for="flexRadioDefault">
                            <img class="img-fluid payment-icon apple-img" src="assets/images/logo/48.png" alt="ucwallet">
                            Use Uniq Connect <br> Wallet Balance: ₹ {{ $withdrawable_amount ?? 0 }}
                        </label>
                        <input class="form-check-input ms-auto" id="walletInput" value="{{ $withdrawable_amount ?? 0 }}" type="checkbox" name="flexRadioDefault" style="border: #000 solid"  @if(($withdrawable_amount ?? 0) == 0) disabled @endif>
                    </li>
                    <!--</a>-->
                    <!-- <li class="form-check mt-0">-->
                    <!--    <label class="form-check-label" for="flexRadioDefault3">-->
                    <!--        <img class="img-fluid payment-icon" src="assets/images/icon/svg/google.svg" alt="paypal">-->
                    <!--        Secure Online Payment-->
                    <!--    </label>-->
                    <!--    <input class="form-check-input ms-auto" type="radio" name="flexRadioDefault"-->
                    <!--        id="flexRadioDefault3" checked>-->
                    <!--</li>-->
                    
                </ul>
            </div><br>
            <div class="text-center">
                Net Payable Amount
                <h3 class="text-center" id="payable_id">Net Payable Amount: ₹ 0.00</h3>
                <input type="hidden" id="payable_id_amt" >
            </div>
        </div>
    </section>

    <div class="fixed-btn-grp">
        <div class="custom-container">
            <a href="#" onclick="pay()" class="btn btn-mid theme-btn w-50">Pay Phonepe </a>
            
            <button id="placeOrderBtn"  class="btn btn-mid theme-btn w-100">Place Order</button>
        </div>
    </div>
    <!-- checkout section ends -->

    <!-- panel-space start -->
    <div class="panel-space"></div>
    <!-- panel-space end -->




    <!-- success modal start -->
    <div class="modal fade centered-modal" tabindex="-1" id="success">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="d-grid align-content-center">
                        <img class="img-fluid success-img mx-auto" src="assets/images/gif/successfully.gif"
                            alt="successfully" />
                            <h3 class="text-center title-color fw-normal mt-1">Payment Successfully!</h3>
                            <h3 class="text-center title-color fw-normal mt-1">Your Order ID is OR436373</h3>
                        
                        <a href="/Orders" class="btn theme-btn  w-100 mt-3">View Order</a>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- success modal end -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>
        
        document.getElementById("walletInput").addEventListener("change", function () {
    if (this.checked) {
        // Apply wallet balance
        let walletAmount = parseFloat(this.value) || 0;
        updateWallet_balance(walletAmount);
    } else {
        // Remove wallet balance
        updateWallet_balance(0);
    }
           
});





function updateWallet_balance(value) {
    let wallet_balance = parseFloat(value) || 0;

    let cartTotal = JSON.parse(localStorage.getItem("Ecart_total")) || {};

    cartTotal.wallet = wallet_balance;

    // Delivery charge already saved in cartTotal or set default
let deliveryCharge = cartTotal.delivery_charge || 0;
let productTotal   = cartTotal.total_price || 0;


 productTotal = productTotal + deliveryCharge;

// Wallet can be applied only to product total
let usedWallet = Math.min(wallet_balance, productTotal);

// Amount payable after wallet

let grandTotal = productTotal - usedWallet;
cartTotal.wallet = usedWallet;
cartTotal.grand_total = grandTotal;

    localStorage.setItem("Ecart_total", JSON.stringify(cartTotal));
    // displayCart(); // update UI
    //  let cartTotal = JSON.parse(localStorage.getItem("Ecart_total"));

            if (cartTotal) {
                document.getElementById('product-total').innerText = `₹ ${(cartTotal.total_price || 0).toFixed(2)}`;
                document.getElementById('Ttotal').innerText = `₹ ${(cartTotal.ttotal || 0).toFixed(2)}`;
                document.getElementById('grand-total').innerText = `₹ ${(cartTotal.grand_total || 0).toFixed(2)}`;
                document.getElementById('payable_id').innerText = `₹ ${(cartTotal.grand_total || 0).toFixed(2)}`;
                document.getElementById('use-wallet').innerText = `-₹ ${(cartTotal.wallet || 0).toFixed(2)}`;
                 document.getElementById('delivery-charge').innerText =  `₹ ${(cartTotal.delivery_charge || 0).toFixed(2)}`;
                document.getElementById('payable_id_amt').value = (cartTotal.grand_total || 0);
            } else {
                document.getElementById('product-total').innerText = `₹ 0.00`;
                document.getElementById('delivery-charge').innerText = `₹ 0.00`;
                document.getElementById('use-wallet').innerText = `₹ 0.00`;
                document.getElementById('grand-total').innerText = `₹ 0.00`;
            }
}

    </script>
<script>
  document.getElementById("placeOrderBtn").addEventListener("click", function () {
    // Get cart data from localStorage
    const cart = JSON.parse(localStorage.getItem("Ecart")) || [];

    if (cart.length === 0) {
    //   alert("Cart is empty!");
      Swal.fire({
                icon: 'error',
                title: 'Cart is empty!',
                // text: "You have select Delivery Address.",
                confirmButtonText: 'OK'
      }).then(() => {
                 window.location.href = "/UC_Shop";
            });
            return;
    }
    
    
    // let selected = document.querySelector('delivery_address');
    let selected = document.getElementById('delivery_address').value
    // alert(selected);
    if (selected==0) {
         Swal.fire({
                icon: 'error',
                title: 'No Delivery address selected!',
                text: "You have select Delivery Address.",
                confirmButtonText: 'OK'
            });
            
        // alert("No Delivery address selected!");
         return;
    }
       let cartTotal = JSON.parse(localStorage.getItem("Ecart_total")) || {};
        
     let grand_total= cartTotal.grand_total; 
      let total_price= cartTotal.total_price; 
      let totalPV= cartTotal.totalPV; 
      let delivery_charge= cartTotal.delivery_charge; 
      let totalWallet= cartTotal.wallet; 


    // Calculate total
    const total = cart.reduce((sum, item) => sum + item.total, 0);
    let csrfToken = $('meta[name="csrf-token"]').attr("content");
    // Example payload (customize as needed)
    const orderData = {
      cart: cart,
      total: total_price,
      grand_total:grand_total,
      totalPV: totalPV, // Replace with actual user ID or null
      delivery_charge: delivery_charge, // Replace with actual user ID or null
      totalWallet: totalWallet, // Replace with actual user ID or null
      address_id: selected // Replace with real address ID
    };

    // Send to Laravel API
    fetch("/place-order", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
        Accept: "application/json",
         "X-CSRF-TOKEN": csrfToken, // Laravel-style header
      },
      body: JSON.stringify(orderData),
    })
      .then((response) => response.json())
      .then((data) => {
          console.log(data);
       // alert("Order placed! Order ID: " + data.order_id);
        // Optionally clear cart after success
                    // Set the Order ID in the modal
                    document.querySelector("#success h3:nth-child(3)").textContent = 
                    "Your Order ID is " + data.order_id;
                    
                    //sweetalert2
                    
                    Swal.fire({
                      title: "Order Placed Successfully!",
                      text: "Your Order ID is " +data.order_id,
                      icon: "success"
                    }).then(() => {
                 window.location.href = "/Orders";
            });
            return;

                    // Show the Bootstrap modal
                    //let successModal = new bootstrap.Modal(document.getElementById("success"));
                    //successModal.show();
    //-------------------------------------------------------
       localStorage.removeItem("Ecart");
       localStorage.removeItem("Ecart_total");
       
      })
      .catch((error) => {
        console.error("Error placing order:", error);
        alert("Something went wrong while placing the order.");
      });
  });
</script>

<script>
    
    
   
    $(document).ready(function(){

    displayCart();
    
  
        // Function to display cart items
    function displayCart() {
        var cartItems = $("#cart-items");
        cartItems.empty(); // Clear previous items

        var cart = JSON.parse(localStorage.getItem("Ecart")) || [];
        cart.forEach(function(item, index) {

            var row = $("<tr class='text-center'>");
            row.append("<td>" + (index + 1) + "</td>");
            row.append("<td style='font-size:15px;'>" + item.name + "</td>");
              row.append("<td>" + item.qty + "</td>");
            // row.append("<td>Rs." + item.mrp + "</td>");
            row.append("<td>Rs." + item.price + "/<del style='font-size:15px;'>Rs." + item.mrp + "</del></td>");
            row.append("<td>Rs." + item.total + "</td>");
            row.append("<td><button class='remove-from-cart btn' style='border: 1px solid red;' data-index='" + index + "'>❌</button></td>");
            cartItems.append(row);
        });
        
        
         let cartTotal = JSON.parse(localStorage.getItem("Ecart_total"));

    if (cartTotal) {
                document.getElementById('product-total').innerText = `₹ ${(cartTotal.total_price || 0).toFixed(2)}`;
                document.getElementById('Ttotal').innerText = `₹ ${(cartTotal.ttotal || 0).toFixed(2)}`;
                document.getElementById('grand-total').innerText = `₹ ${(cartTotal.grand_total || 0).toFixed(2)}`;
                document.getElementById('payable_id').innerText = `₹ ${(cartTotal.grand_total || 0).toFixed(2)}`;
                document.getElementById('use-wallet').innerText = `-₹ ${(cartTotal.wallet || 0).toFixed(2)}`;
                document.getElementById('delivery-charge').innerText =  `₹ ${(cartTotal.delivery_charge || 0).toFixed(2)}`;
                document.getElementById('payable_id_amt').value = (cartTotal.grand_total || 0);
            } else {
                document.getElementById('product-total').innerText = `₹ 0.00`;
                document.getElementById('delivery-charge').innerText = `₹ 0.00`;
                document.getElementById('use-wallet').innerText = `₹ 0.00`;
                document.getElementById('grand-total').innerText = `₹ 0.00`;
            }
    
    }
    

    
     // Event listener for remove from cart button
    $(document).on("click", ".remove-from-cart", function() {
        var index = $(this).data("index");
        var cart = JSON.parse(localStorage.getItem("Ecart")) || [];
        cart.splice(index, 1); // Remove item from cart array
        localStorage.setItem("Ecart", JSON.stringify(cart)); // Update localStorage
        updateCartTotal()
        displayCart(); // Update cart display
        //navbar_TotalPrice(); // Update total prices
       //localStorage.removeItem("Ecart");
       //localStorage.removeItem("Ecart_total");
    });
    
    });
    
    
     function updateCartTotal(){
        let cart = JSON.parse(localStorage.getItem("Ecart")) || [];

        let totalPrice = 0;
        let totalMrp = 0;
        let totalPV = 0;
        let totalDc = 0;
        let qty_total = 0;

        cart.forEach(item => {
            totalPrice += item.total;
            totalMrp += item.mrp_total;
            totalPV += item.pv;
            totalDc += item.dc;
            qty_total += item.qty;
        });

        let cartTotal = {
            total_mrp: totalMrp,
            delivery_charge: totalDc,
            wallet: 0,
            totalPV: totalPV,
            total_price: totalPrice,
            grand_total: totalPrice
        };

        localStorage.setItem("Ecart_total", JSON.stringify(cartTotal));

        // Update UI
        $("#cart-total").text("₹ " + totalPrice.toFixed(2));
        $("#cart-total1").text("₹ " + totalPrice.toFixed(2));
        $("#qty-total").text(qty_total + " Items");
        $("#diss").text((totalMrp - totalPrice).toFixed(2));
        $("#cart-mrp_total").text("₹ " + totalMrp.toFixed(2));

        // console.log("Cart Total:", cartTotal);
    }

    function pay(){
          let payableId = document.getElementById('payable_id_amt').value;
          alert(payableId);

    // Redirect with parameter
    window.location.href = "/pay?payable_id=" + payableId;
    }
function show_selected_address(addressId) {
    // Hide all address divs
    var addressDivs = document.querySelectorAll('.address-content');
    addressDivs.forEach(function(div) {
        div.style.display = 'none';
    });

    // Show the selected address div
    var selectedAddressDiv = document.getElementById('Address_div' + addressId);
    if (selectedAddressDiv) {
        selectedAddressDiv.style.display = 'block';
    }
}

</script>


    <!-- bootstrap js -->
    <script src="assets/js/bootstrap.bundle.min.js"></script>

    <!-- iconsax icon -->
    <script src="assets/js/iconsax-icon.js"></script>

    <!-- template-setting js -->
    <script src="assets/js/template-setting.js"></script>

    <!-- script js -->
    <script src="assets/js/script.js"></script>
    
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</body>

</html>