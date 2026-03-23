<!DOCTYPE html>
<html lang="en">


<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Uniq Connect">
    <meta name="keywords" content="Uniq Connect">
    <meta name="author" content="Uniq Connect">
    <link rel="manifest" href="manifest.json">
    <link rel="icon" href="assets/images/logo/favicon.png" type="image/x-icon">
    <title>Uniq Connect</title>
    <link rel="apple-touch-icon" href="assets/images/logo/favicon.png">
    <meta name="theme-color" content="#2777FC">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="Uniq Connect">
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

<body onload="cartupdate()">
    <!-- loader start-->
    <div class="loader-wrapper" id="loader">
        <span class="loader"></span>
    </div>
    <!-- loader end -->

    <!-- header start -->
    <header class="main-header">
        <div class="custom-container">
            <div class="header-panel">
                <a href="#sidebar" class="sidebar-btn" data-bs-toggle="offcanvas">
                    <i class="iconsax" data-icon="text-align-left"></i>
                </a>
                <h3>UNIQ SHOP</h3>
                
            </div>
        </div>
    </header>
    <!-- header end -->

    <!-- cart section starts -->
    <section class="section-sm-t-space">
        <div class="custom-container">
            <div class="row gy-3 gx-0">
                
                @foreach($data as $item)
                <div class="col-12">
                    <div class="product-box vertical-product product-item"
             data-id="{{$item->id}}"
             data-name="{{$item->name}}"
              data-mrp="{{$item->mrp}}"
             data-price="{{$item->price}}">
                      
            <a href="product-details.html" class="product-img">
                <img src="assets/images/product/1.png" class="img-fluid" alt="">
            </a>
            <div class="product-content">
                <h6 class="content-color">{{$item->category}}</h6>
                <a href="product-details.html" class="product-top">
                    <h5 class="title-color white-nowrap">{{$item->name}}</h5>
                </a>
                <div class="bottom-content cart-content">
                    <h5 class="price">₹ {{$item->price}}</h5>
                    <input type="hidden" class="pv" value="{{$item->pv}}" >
                        
                    <div class="plus-minus">
                        <i class="iconsax icon sub" data-icon="minus"></i>
                        <input type="number" class="quantity" disabled value="0" step="1" min="0" max="10">
                        <i class="iconsax icon add" data-icon="add"></i>
                    </div>
                </div>
            </div>
        </div>
                        
                    </div>
               
                 @endforeach

           
            </div>
        </div>
    </section>

     <section>
        <div class="custom-container">
     
    <!--        <div class="promo-code position-relative">
                <input type="email" class="form-control code-form-control" placeholder="Apply promo code" disabled>
                <a href="#" class="btn btn-small theme-btn apply-btn fw-medium mt-0 disabled">Apply</a>
            </div> -->
        </div>
    </section>

    <section>
        <div class="custom-container">
            <div class="title mb-2">
                <h3>Price Details</h3>
            </div>
            <div class="bill-box">
                <div class="bill-box-content">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="fw-medium content-color">Total Items</h5>
                        <h5 class="fw-medium title-color" id="qty-total" >0 Items</h5>
                    </div>
                    <div class="d-flex align-items-center justify-content-between pt-2">
                        <h5 class="fw-medium content-color">Actual Price</h5>
                        <h5 class="fw-medium title-color"  id="cart-mrp_total">₹ 0.00</h5>
                    </div>
                    

                    <div class="total-amount">
                        <h5 class="fw-medium title-color">Total Payable Amount</h5>
                        <h4 class="fw-medium theme-color"  id="cart-total">₹ 0.00</h4>
                    </div>
                

                </div>
            </div>
            <h6 class="color-theme-color fw-medium mt-2">You save ₹ <span id="diss"></span> on this Order!</h6>
        </div>
    </section>

    <div class="secure-payment-wrapper mt-24">
        <img class="img-fluid" src="assets/images/svg/secure.svg" alt="secure">
        <p>Safe and secure payments. 100% Authentic products.</p>
    </div><br><br><br><br>

    

    <!-- cart buttons start -->
    <div class="cart-btns">
        <div>
            <!--<h6 class="content-color fw-medium"><del>₹ 1000.00</del></h6>-->
            <h4 class="fw-medium title-color" id="cart-total1">₹ 0.00</h4>
        </div>
        <a href="/Checkout" class="btn btn-small theme-btn">
            <i class="iconsax me-2" data-icon="bank-card"></i>
            Place Order
        </a>
    </div>
    <!-- cart buttons end -->

    <!-- bottom panel start -->
    <ul class="bottom-menu">
        <li><a href="/Home" class="active"><i class="iconsax text-content" data-icon="home-2"></i><h6>Home</h6></a></li>
        <li><a href="/Dashboard"><i class="iconsax text-content" data-icon="grid-apps"></i><h6>Account</h6></a></li>
        <li><a href="/UC_Wallet"><i class="iconsax text-content" data-icon="wallet-1"></i><h6>Wallet</h6></a></li>
        <li><a href="/Orders"><i class="iconsax text-content" data-icon="shop"></i><h6>Orders</h6></a></li>
        <li><a href="/Profile"><i class="iconsax text-content" data-icon="user-2"></i><h6>Profile</h6></a></li>
        <li><a href="#"><i class="iconsax text-content" data-icon="calendar-add"></i><h6>Todo</h6></a></li>
    </ul>
    <!-- bottom panel end -->

    <!-- sidebar starts -->
    <div class="offcanvas sidebar-offcanvas offcanvas-start" tabindex="-1" id="sidebar">
        <div class="offcanvas-header sidebar-header">
            <div class="sidebar-logo">
                <img class="img-fluid logo" src="assets/images/logo/logo.png" alt="logo">
            </div>
        </div>
        <div class="offcanvas-body">
            <a href="edit-profile.html" class="profile-part">
                <img class="img-fluid profile-pic" src="assets/images/avatar/1.png" alt="p8">
                <div>
                    <h3>Sathees</h3>
                    <span>UC100001</span>
                </div>
            </a>
            <ul class="link-section switch-section">
                <li>
                    <div class="pages">
                        <i class="iconsax sidebar-icon" data-icon="brush-3"> </i>
                        <h3>Dark</h3>
                    </div>
                    <div class="switch-btn">
                        <input id="dark-switch" type="checkbox">
                    </div>
                </li>

            </ul>

            <div class="bottom-sidebar">
                <a href="login.html" class="pages">
                    <i class="iconsax sidebar-icon" data-icon="logout-2"> </i>
                    <h3>Logout</h3>
                </a>
            </div>
        </div>
    </div>
    <!-- sidebar end -->
<script>
document.addEventListener('DOMContentLoaded', function() {
  // Your JavaScript code here, or call a function
//   console.log("DOM tree is ready.");
  cart_clear();
  cartupdate3();
});


  function cart_clear() {
        localStorage.removeItem("Ecart");
        localStorage.removeItem("Ecart_total");
            console.log('Cart clear...!'); 
        } 
function cartupdate3(){

// Check if 'Ecart' data already exists in localStorage
const savedCart = localStorage.getItem("Ecart");

// If no cart data exists or if it's an invalid/empty cart (check for empty string or invalid JSON)
if (!savedCart || savedCart === "[]" || savedCart === "null") {
    const staticCart = [
        {
            id: 1,
            name: "ID Card",
            mrp: 150,
            price: 100,
            qty: 1,
            pv: 0,
            total: 100,
            mrp_total: 150
        }
    ];

    // Set the static data in localStorage
    localStorage.setItem("Ecart", JSON.stringify(staticCart));
    console.log("Static data has been set in localStorage.");
    
     const staticCartTotal = {
            total_mrp: 150,
            delivery_charge: 0,
            totalPV: 0,
            total_price: 100,
            grand_total: 100
        };

        // Set the static total data in localStorage
        localStorage.setItem("Ecart_total", JSON.stringify(staticCartTotal));
        console.log("Static Ecart_total data has been set in localStorage.");
        
        
} else {
    // If the cart data exists and it's valid
    console.log("Ecart data already exists in localStorage.");
}

    window.location.href = "https://uniqconnectwc.com/Checkout";
}


</script>


    <!-- bootstrap js -->
    <script src="assets/js/bootstrap.bundle.min.js"></script>

    <!-- iconsax icon -->
    <script src="assets/js/iconsax-icon.js"></script>

    <!-- template-setting js -->
    <script src="assets/js/template-setting.js"></script>

    <!-- remove-item js -->
    <!--<script src="assets/js/remove-item.js"></script>-->

    <!-- quantity js -->
    <script src="assets/js/quantity.js"></script>

    <!-- script js -->
    <script src="assets/js/script.js"></script>
</body>


<!-- Mirrored from themes.pixelstrap.com/pwa/Uniq Connect/cart.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 12 Mar 2025 09:41:14 GMT -->
</html>