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
    <!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">-->

<style>
.add-btn {
    padding: 10px 68px;
    border: 1px solid #e91e63;
    background: #e91e63;
    color: #FFFFFF;
    font-weight: 600;
    font-size: 18px;
    border-radius: 6px;
    cursor: pointer;
    width: fit-content;
}

.qty-box {
    display: flex;
    align-items: center;
    gap: 52px;
    padding: 4px 12px;
    border: 1px solid #e91e63;
    border-radius: 6px;
    width: fit-content;
}

.qty-btn {
    background: none;
    border: none;
    color: #e91e63;
    font-size: 20px;
    cursor: pointer;
    font-weight: bold;
}

.quantity {
    font-size: 16px;
    font-weight: bold;
}

</style>
</head>

<body>
    <!-- loader start-->
    <div class="loader-wrapper" id="loader">
        <span class="loader"></span>
    </div>
    <!-- loader end -->

    <!-- header start -->
    <header class="main-header product-header">
        <div class="custom-container">
            <div class="header-panel">
                <a onclick="history.back();">
                    <img class="img-fluid icon-btn back-arrow" src="assets/images/svg/back-arrow.svg" alt="back-arrow">
                </a>

                <h3>Product Details</h3>

                <a href="#" class="icon-box bg-white like-icon animate active inactive">
                    <img class="img-fluid icon outline-icon" src="assets/images/svg/heart-outline.svg" alt="">
                    <img class="img-fluid icon fill-icon" src="assets/images/svg/heart-fill.svg" alt="">
                </a>
            </div>
        </div>
    </header>
    <!-- header end -->

    <!-- product details section starts -->
    <section class="product-style-image px-20 pt-0">
        <div class="swiper product-thumbnail-img">
            <div class="swiper-wrapper">
                <div class="swiper-slide">

                    <img src="https://admin.uniqconnectwc.com/storage/app/public/{{$item->image_url}}" class="img" alt="">
                </div>
               
            </div>
        </div>

    </section>



    <!-- product content section starts -->
    <section class="product-content-section">
        <div class="custom-container">
            <div class="d-flex align-items-center justify-content-between gap-1">
                <h5 class="content-color fw-medium">{{$item->category}}</h5>
                <div class="rating-list">
                    <img class="img-fluid" src="assets/images/svg/star-fill.svg" alt="star">
                    <img class="img-fluid" src="assets/images/svg/star-fill.svg" alt="star">
                    <img class="img-fluid" src="assets/images/svg/star-fill.svg" alt="star">
                    <img class="img-fluid" src="assets/images/svg/star-fill.svg" alt="star">
                    <img class="img-fluid" src="assets/images/svg/star-fill.svg" alt="star">
                </div>
            </div>
            <h3 class="title-color fw-medium mt-2">{{$item->name}}</h3>
            
                                @if($is_active?? false)
                                
                <h3 class="price fw-medium color-theme-color mt-2">₹ {{$item->price}} <del class="content-color fw-medium"> ₹ {{$item->mrp}}</del></h3>
            
                                @else
                                @php  $discount = $item->discount ??  '0'; 
                                      $offer_price = $item->mrp - ($item->mrp*($discount/100)); 
                                @endphp
                            
                                 <h3 class="price fw-medium color-theme-color mt-2">₹ {{$offer_price}} <del class="content-color fw-medium"> ₹ {{$item->mrp}}</del>
                                    </h3>
            
                                <div class="see-all">SP:{{$item->pv}}</div>
                                @endif

            <div class="description mt-24">
                <h5 class="title-color fw-medium">Description</h5>
                <p class="content-color fw-medium mt-2">{{$item->description}}</p>
            </div>

            <!--<div class=" product-details-table mt-3">-->
            <!--    <table class="table table-responsive m-0">-->
            <!--        <thead>-->
            <!--            <tr>-->
            <!--                <th colspan="2">Details:</th>-->
            <!--            </tr>-->
            <!--        </thead>-->
            <!--        <tbody>-->
            <!--            <tr>-->
            <!--                <td class="details">Product Category</td>-->
            <!--                <td class="content">UCWC</td>-->
            <!--            </tr>-->
            <!--            <tr>-->
            <!--                <td class="details">Product Name</td>-->
            <!--                <td class="content">UC Antioxidant Juice</td>-->
            <!--            </tr>-->
            <!--            <tr>-->
            <!--                <td class="details">Quantity</td>-->
            <!--                <td class="content">500 ml</td>-->
            <!--            </tr>-->
            <!--            <tr>-->
            <!--                <td class="details">Distributor Price (DP)</td>-->
            <!--                <td class="content">₹ 1249.00</td>-->
            <!--            </tr>-->
            <!--            <tr>-->
            <!--                <td class="details">Maximum Retail Price (MRP)</td>-->
            <!--                <td class="content">₹ 1650.00</td>-->
            <!--            </tr>-->
            <!--            <tr>-->
            <!--                <td class="details">Net Profit</td>-->
            <!--                <td class="content">₹ 401.00</td>-->
            <!--            </tr>-->
            <!--            <tr>-->
            <!--                <td class="details">Re-Purchase Value (RP)</td>-->
            <!--                <td class="content">600</td>-->
            <!--            </tr>-->
                        
            <!--        </tbody>-->
            <!--    </table>-->
            <!--</div>-->
        </div>

    </section>

    <!-- fixed btn start -->
    <div class="fixed-btn-grp">
        <div class="custom-container">
            <div class=" d-flex align-items-center gap-3 w-100 m-0">
                <a href="#" class="btn btn-small white-btn w-50">
                    Download Pamphlet
                </a>
                    <!-- ADD / Qty Button -->
<div class="product-item"
     data-id="{{ $item->id }}"
     data-name="{{ $item->name }}"
     data-price="{{ $item->price }}"
     data-mrp="{{ $item->mrp }}"
     data-dc="0"
     data-pv="{{ $item->pv }}" style="float:right" >

    <!-- ADD Button -->
    <div class="add-btn" id="addBtn-{{ $item->id }}" onclick="enableQty({{ $item->id }})">
        ADD
    </div>

    <!-- Quantity Box -->
    <div class="qty-box" id="qtyBox-{{ $item->id }}" style="display:none;">
        <button class="qty-btn sub" data-id="{{ $item->id }}">−</button>
        <span class="quantity" id="qtyValue-{{ $item->id }}">1</span>
        <button class="qty-btn add" data-id="{{ $item->id }}">+</button>
    </div>
</div>
            </div>
        </div>
    </div>
    <!-- fixed btn end -->

 <div style="display:flex; align-items:center; gap:12px;">
    <a
      id="viewCartBtn"
      aria-label="View Cart"
      style="
        position:fixed;
    bottom:120px;
    left:50%;
    transform:translateX(-50%);
    padding:14px 26px;
    background:#2ea44f;
    color:#FFF44F;
    border:none;
    border-radius:14px;
    font-size:17px;
    font-weight:600;
    cursor:pointer;
    display:inline-flex;
    align-items:center;
    gap:10px;
    box-shadow:0 8px 20px rgba(0,0,0,0.2);
    z-index:9999;
    overflow:hidden;
      "
      href="/UC_Shop"
      onblur="(function(el){ el.style.boxShadow='0 6px 16px rgba(46,164,79,0.18)'; el.style.transform='translateY(0) scale(1)'; })(this)"
    >
      <!-- Cart icon (SVG inline) -->
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true" style="flex:0 0 auto;">
        <path d="M7 4h-2l-1 2" stroke="#FFF44F" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
        <path d="M6 6h14l-1.5 9.5a2 2 0 0 1-2 1.6H9a2 2 0 0 1-2-1.6L6.2 8" stroke="#FFF44F" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
        <circle cx="10" cy="20" r="1.4" fill="#FFF44F"/>
        <circle cx="18" cy="20" r="1.4" fill="#FFF44F"/>
      </svg>

      <span style="font-weight:600; letter-spacing:0.2px;">View Cart</span>

      <!-- small badge count (optional) -->
      <span id="cartCount" style="
          min-width:22px;
          height:22px;
          border-radius:999px;
          background: rgba(255,244,79,0.12);
          color: #FFF44F;
          display:inline-flex;
          align-items:center;
          justify-content:center;
          font-size:13px;
          font-weight:700;
        ">3</span>
    </a>
  </div>
    <!-- panel-space start -->
    <div class="panel-space"></div>
    <!-- panel-space end -->

    <!-- bootstrap js -->
    <script src="assets/js/bootstrap.bundle.min.js"></script>

    <!-- swiper js -->
    <script src="assets/js/swiper-bundle.min.js"></script>
    <script src="assets/js/custom-swiper.js"></script>

    <!-- iconsax icon -->
    <script src="assets/js/iconsax-icon.js"></script>

    <!-- template-setting js -->
    <script src="assets/js/template-setting.js"></script>

    <!-- script js -->
    <script src="assets/js/script.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    
<script>
    
    document.addEventListener("DOMContentLoaded", function() {
        // Your code to run when the DOM is ready
        // cart_clear();
        showCartButton();
        console.log("DOM is fully loaded and parsed!");
    });
    
    
        function showCartButton() {
     let cart = JSON.parse(localStorage.getItem("Ecart")) || [];
    const countSpan = document.getElementById("cartCount");

    countSpan.textContent = cart.length;

    // Optional: hide badge if empty
    countSpan.style.display = cart.length === 0 ? "none" : "inline-flex";
    viewCartBtn.style.display = cart.length === 0 ? "none" : "block";
    
}
    
        
    
        function showCartButton() {
     let cart = JSON.parse(localStorage.getItem("Ecart")) || [];
    const countSpan = document.getElementById("cartCount");

    countSpan.textContent = cart.length;

    // Optional: hide badge if empty
    countSpan.style.display = cart.length === 0 ? "none" : "inline-flex";
    viewCartBtn.style.display = cart.length === 0 ? "none" : "block";
    
}
        // ---------------------------
    // CLICK "ADD" BUTTON
    // ---------------------------
     function enableQty(id){
        $("#addBtn-" + id).hide();
        $("#qtyBox-" + id).css("display", "flex");

        // Default 1 qty
        $("#qtyValue-" + id).text(1);

        updateCart($(".product-item[data-id='"+id+"']"));
    }

    // ---------------------------
    // INCREASE QTY
    // ---------------------------
    $(document).on("click", ".add", function(){
        let id = $(this).data("id");

        let qtyEl = $("#qtyValue-" + id);
        let qty = parseInt(qtyEl.text()) + 1;

        qtyEl.text(qty);

        updateCart($(".product-item[data-id='"+id+"']"));
    });



    // ---------------------------
    // DECREASE QTY
    // ---------------------------
    $(document).on("click", ".sub", function(){
        let id = $(this).data("id");

        let qtyEl = $("#qtyValue-" + id);
        let qty = parseInt(qtyEl.text()) - 1;

        if (qty <= 0) {
            qtyEl.text(0);

            $("#qtyBox-" + id).hide();
            $("#addBtn-" + id).show();
        } else {
            qtyEl.text(qty);
        }

        updateCart($(".product-item[data-id='"+id+"']"));
    });




    // ---------------------------
    // UPDATE LOCALSTORAGE CART
    // ---------------------------
    function updateCart(productItem){

        let id    = productItem.data("id");
        let name  = productItem.data("name");
        let price = parseFloat(productItem.data("price"));
        let mrp   = parseFloat(productItem.data("mrp"));
        let dc    = parseFloat(productItem.data("dc"));
        let pv    = parseFloat(productItem.data("pv"));

        let qty   = parseInt(productItem.find(".quantity").text()) || 0;

        let product = {
            id: id,
            name: name,
            price: price,
            mrp: mrp,
            qty: qty,
            pv: pv * qty,
            dc: dc * qty,
            total: price * qty,
            mrp_total: mrp * qty
        };

        let cart = JSON.parse(localStorage.getItem("Ecart")) || [];
        let index = cart.findIndex(item => item.id == id);

        // Add or update
        if (qty > 0) {
            if (index !== -1) cart[index] = product;
            else cart.push(product);
        }
        // Remove if qty = 0
        else {
            cart = cart.filter(item => item.id !== id);
        }

        localStorage.setItem("Ecart", JSON.stringify(cart));
        showCartButton();
    }

</script>
<script>
$(document).ready(function(){

    // Load stored quantities when page opens
    loadItemsFromLocalStorage();



    // ---------------------------
    // LOAD QTY FROM LOCALSTORAGE
    // ---------------------------
    function loadItemsFromLocalStorage() {

        let cart = JSON.parse(localStorage.getItem("Ecart")) || [];

        cart.forEach(item => {
            let pid = item.id;

            // Set quantity
            $("#qtyValue-" + pid).text(item.qty);

            if (item.qty > 0) {
                $("#addBtn-" + pid).hide();
                $("#qtyBox-" + pid).css("display", "flex");
            } else {
                $("#qtyBox-" + pid).hide();
                $("#addBtn-" + pid).show();
            }
        });
    }


});
</script>
</body>

</html>