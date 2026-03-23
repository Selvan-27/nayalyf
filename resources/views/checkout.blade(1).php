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
                        <h5 class="fw-medium title-color">Home</h5>
                    </div>
                    <a href="#change-address" data-bs-toggle="offcanvas" class="theme-color fw-medium">Change</a>
                </div>
                <div class="address-content">
                    <p>[registered-address]</p>
                </div>
                
            </div>
        </div>
    </section>

    <section>
        <div class="title px-20">
            <h3>Delivery Method</h3>
        </div>

       <form class="theme-form">
    <div class="form-group mt-0">
        <div class="delivery-method custom-filter-checkbox custom-scrollbar px-20">
            <div class="form-check">
                <input class="form-check-input delivery-charge-option" type="radio" name="option" id="delivery1" checked value="0">
                <label class="form-check-label" for="delivery1">
                    <img class="img-fluid payment-img" src="assets/images/payment1.svg" alt="0">
                </label>
            </div>

            <div class="form-check">
                <input class="form-check-input delivery-charge-option" type="radio" name="option" id="delivery2" value="49">
                <label class="form-check-label" for="delivery2">
                    <img class="img-fluid payment-img" src="assets/images/payment2.svg" alt="49">
                </label>
            </div>
        </div>
    </div>
</form>

    </section>

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
                                    <th class="border-top-0">MRP</th>
                                      <th class="border-top-0">Price</th>
                                        <th class="border-top-0">Total</th>
                                </tr>
                            </thead>
                            <tbody id="cart-items">
            <!-- Cart items will be dynamically added here -->
        </tbody>
                            <!--<tfoot>-->
                            <!--    <tr>   <th></th><th></th><th></th>-->
                            <!--        <th>Total Items:</th>-->
                            <!--        <th>4</th>-->
                                    
                            <!--        <th>₹ 3198.00</th>-->
                            <!--    </tr>-->

                            <!--</tfoot>-->

                        </table>

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
                    <h5 class="fw-medium content-color">Delivery Charge</h5>
                    <h5 class="fw-medium title-color" id="delivery-charge">₹ 0.00</h5>
                </div>
            
                <hr>
            
                <div class="d-flex align-items-center justify-content-between">
                    <h5 class="fw-bold content-color">Grand Total</h5>
                    <h5 class="fw-bold title-color" id="grand-total">₹ 0.00</h5>
                </div>
            </div>

            </div>
            <div class="payment-method-box">
                <ul class="theme-form border-design payment-form">
                    <li class="form-check mt-0">
                        <label class="form-check-label" for="flexRadioDefault">
                            <img class="img-fluid payment-icon apple-img" src="assets/images/logo/favi.png" alt="ucwallet">
                            Use Uniq Connect Wallet Balance: ₹ 100.00
                        </label>
                        <input class="form-check-input ms-auto" type="checkbox" name="flexRadioDefault"
                            id="flexRadioDefault">
                    </li>
                    <!-- <li class="form-check mt-0">
                        <label class="form-check-label" for="flexRadioDefault3">
                            <img class="img-fluid payment-icon" src="assets/images/icon/svg/google.svg" alt="paypal">
                            Secure Online Payment
                        </label>
                        <input class="form-check-input ms-auto" type="radio" name="flexRadioDefault"
                            id="flexRadioDefault3" checked>
                    </li> -->
                    
                </ul>
            </div><br>
            <div class="text-center">
                <h3 class="text-center" id="payable_id">Net Payable Amount: ₹ 0.00</h3>
                <input type="hidden" id="payable_id_amt" >
            </div>
        </div>
    </section>

    <div class="fixed-btn-grp">
        <div class="custom-container">
            <a href="#" onclick="pay()" class="btn btn-mid theme-btn w-50">Continue </a>
            
            <button id="placeOrderBtn"  class="btn btn-mid theme-btn w-50">Place Order</button>
        </div>
    </div>
    <!-- checkout section ends -->

    <!-- panel-space start -->
    <div class="panel-space"></div>
    <!-- panel-space end -->


    <!-- change address offcanvas start -->
    <div class="offcanvas offcanvas-bottom filter-offcanvas" tabindex="-1" id="change-address">
        <div class="offcanvas-header">
            <h3>Change Address</h3>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <form class="theme-form">
                <div class="form-group mt-0">
                    <div class="location-type custom-filter-checkbox">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="option" id="payment11" checked>
                            <label class="form-check-label" for="payment11">
                                Home
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="option" id="payment12">
                            <label class="form-check-label" for="payment12">
                                Work
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="option" id="payment13">
                            <label class="form-check-label" for="payment13">
                                Other
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="inputaddress">Street Address</label>
                    <input type="text" class="form-control wo-icon" id="inputaddress" placeholder="Enter address">
                </div>

                <div class="form-group">
                    <label class="form-label" for="inputcity">City</label>
                    <input type="text" class="form-control wo-icon" id="inputcity" placeholder="Enter city">
                </div>
                <div class="form-group">
                    <label class="form-label" for="inputcode">Zip Code</label>
                    <input type="number" class="form-control wo-icon" id="inputcode" placeholder="Enter zip code">
                </div>
            </form>
        </div>
        <div class="btn-grp d-flex gap-3 mt-4">
            <a data-bs-dismiss="offcanvas" class="btn white-btn w-50">Cancel</a>
            <a data-bs-dismiss="offcanvas" class="btn theme-btn w-50">Change</a>
        </div>
    </div>
    <!-- change address offcanvas end -->

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
<script>
  document.getElementById("placeOrderBtn").addEventListener("click", function () {
    // Get cart data from localStorage
    const cart = JSON.parse(localStorage.getItem("Ecart")) || [];

    if (cart.length === 0) {
      alert("Cart is empty!");
      return;
    }
    // Calculate total
    const total = cart.reduce((sum, item) => sum + item.total, 0);
    let csrfToken = $('meta[name="csrf-token"]').attr("content");
    // Example payload (customize as needed)
    const orderData = {
      cart: cart,
      total: total,
      user_id: 1, // Replace with actual user ID or null
      address_id: 3 // Replace with real address ID
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
                    
                    // Show the Bootstrap modal
                    let successModal = new bootstrap.Modal(document.getElementById("success"));
                    successModal.show();
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

            var row = $("<tr>");
            row.append("<td>" + (index + 1) + "</td>");
            row.append("<td>" + item.name + "</td>");
              row.append("<td>" + item.qty + "</td>");
            row.append("<td>Rs." + item.mrp + "</td>");
            row.append("<td>Rs." + item.price + "</td>");
            row.append("<td>Rs." + item.total + "</td>");
            row.append("<td><button class='remove-from-cart' data-index='" + index + "'>Remove</button></td>");
            cartItems.append(row);
        });
        
        
         let cartTotal = JSON.parse(localStorage.getItem("Ecart_total"));

if (cartTotal) {
    document.getElementById('product-total').innerText = `₹ ${(cartTotal.total_price || 0).toFixed(2)}`;
    document.getElementById('delivery-charge').innerText = `₹ ${(cartTotal.delivery_charge || 0).toFixed(2)}`;
    document.getElementById('grand-total').innerText = `₹ ${(cartTotal.grand_total || 0).toFixed(2)}`;
    document.getElementById('payable_id').innerText = `₹ ${(cartTotal.grand_total || 0).toFixed(2)}`;
    
    document.getElementById('payable_id_amt').value = (cartTotal.grand_total || 0);
} else {
    document.getElementById('product-total').innerText = `₹ 0.00`;
    document.getElementById('delivery-charge').innerText = `₹ 0.00`;
    document.getElementById('grand-total').innerText = `₹ 0.00`;
}
    
    }
    // Function to update only delivery charge
function updateDeliveryChargeFromRadio(value) {
    let deliveryCharge = parseFloat(value) || 0;

    let cartTotal = JSON.parse(localStorage.getItem("Ecart_total")) || {};

    cartTotal.delivery_charge = deliveryCharge;
    cartTotal.grand_total = (cartTotal.total_price || cartTotal.total_price) + deliveryCharge;
    
    //   let grandTotal = (deliveryCharge === 0) ? productTotal : productTotal + deliveryCharge;


    localStorage.setItem("Ecart_total", JSON.stringify(cartTotal));

    // Update the displayed amount
    displayCart();
}


// Attach event listeners to radio buttons
document.querySelectorAll('.delivery-charge-option').forEach(radio => {
    radio.addEventListener('change', function() {
        updateDeliveryChargeFromRadio(this.value);
    });
});

    
    
     // Event listener for remove from cart button
    $(document).on("click", ".remove-from-cart", function() {
        var index = $(this).data("index");
        var cart = JSON.parse(localStorage.getItem("Ecart")) || [];
        cart.splice(index, 1); // Remove item from cart array
        localStorage.setItem("Ecart", JSON.stringify(cart)); // Update localStorage
        displayCart(); // Update cart display
        //navbar_TotalPrice(); // Update total prices
    });
    
    });
    


// function order_place(){
//   // Example using Fetch or Axios
// const cart = JSON.parse(localStorage.getItem('Ecart'));

// fetch('/save-cart', {
//   method: 'POST',
//   headers: {
//     'Content-Type': 'application/json',
//     'Accept': 'application/json',
//   },
//   body: JSON.stringify({ cart: cart })
// });
  
// }
// </script>

<script>
    function pay(){
          let payableId = document.getElementById('payable_id_amt').value;
          alert(payableId);

    // Redirect with parameter
    window.location.href = "/pay?payable_id=" + payableId;
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


<!-- Mirrored from themes.pixelstrap.com/pwa/kartify/checkout.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 12 Mar 2025 09:41:36 GMT -->
</html>