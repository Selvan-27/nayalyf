
@extends('layout')
@section('content')

<style>
.add-btn {
    padding: 8px 70px;
    border: 1px solid #e91e63;
    color: #e91e63;
    font-weight: 600;
    font-size: 14px;
    border-radius: 6px;
    cursor: pointer;
    width: fit-content;
}

.qty-box {
    display: flex;
    align-items: center;
    gap: 58px;
    padding: 3px 12px;
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

.search-wrapper {
    position: relative;
}

.search-wrapper input {
    padding-right: 45px;
}

.search-btn {
    position: absolute;
    right: 14px;
    top: 50%;
    transform: translateY(-50%);
    background: transparent;
    border: none;
    font-size: 18px;
    cursor: pointer;
    z-index: 1;
}

.emboss-search {
    display: flex;
    align-items: center;
    background: #f1f5f9;
    border-radius: 30px;
    padding: 12px 18px;

    /* Embossed / Neumorphic effect */
    box-shadow:
        inset 6px 6px 10px rgba(0, 0, 0, 0.08),
        inset -6px -6px 10px rgba(255, 255, 255, 0.9);
}

.emboss-search input {
    flex: 1;
    border: none;
    outline: none;
    background: transparent;
    font-size: 15px;
    color: #333;
}

.emboss-search input::placeholder {
    color: #9aa4b2;
}

.emboss-search button {
    border: none;
    background: #e8eef5;
    border-radius: 50%;
    width: 38px;
    height: 38px;
    cursor: pointer;
    font-size: 16px;

    /* Raised button inside embossed bar */
    box-shadow:
        3px 3px 6px rgba(0, 0, 0, 0.12),
        -3px -3px 6px rgba(255, 255, 255, 0.9);
}

.emboss-search button:active {
    box-shadow:
        inset 2px 2px 4px rgba(0, 0, 0, 0.15),
        inset -2px -2px 4px rgba(255, 255, 255, 0.8);
}



/* Container remains same */
.neon-check-box {
    position: relative;
    margin: 20px auto;
    padding: 20px 24px;
    max-width: 460px;
    text-align: center;
    border-radius: 20px;
    color: #eaffff;
    background-image: linear-gradient(to right bottom, #00b2ff, #00a0ff, #008bff, #0074ff, #0059ff);
    backdrop-filter: blur(14px);
    -webkit-backdrop-filter: blur(14px);
    overflow: hidden;
}

/* ⚡ Neon border tracing */
.neon-check-box::before {
    content: "";
    position: absolute;
    inset: 0;
    padding: 2px;
    border-radius: 20px;
    background: linear-gradient(
        90deg,
        transparent,
        #00ffff,
        #7b2cff,
        #00ffff,
        transparent
    );
    background-size: 300% 300%;
    animation: neonTrace 3s linear infinite;
    mask:
        linear-gradient(#000 0 0) content-box,
        linear-gradient(#000 0 0);
    -webkit-mask:
        linear-gradient(#000 0 0) content-box,
        linear-gradient(#000 0 0);
    mask-composite: exclude;
    -webkit-mask-composite: xor;
}

@keyframes neonTrace {
    0% { background-position: 0% 50%; }
    100% { background-position: 300% 50%; }
}

/* 🎯 Checkmark */
.checkmark {
    width: 56px;
    height: 56px;
    stroke-width: 3;
    stroke-miterlimit: 10;
    filter: drop-shadow(0 0 8px #00ffff);
}

/* Looping animations */
.checkmark.loop .checkmark-circle {
    stroke: #7b2cff;
    stroke-dasharray: 157;
    stroke-dashoffset: 157;
    animation: circleLoop 2.5s ease-in-out infinite;
}

.checkmark.loop .checkmark-check {
    stroke: #00ffff;
    stroke-dasharray: 48;
    stroke-dashoffset: 48;
    animation: tickLoop 2.5s ease-in-out infinite;
}

/* Circle loop */
@keyframes circleLoop {
    0%   { stroke-dashoffset: 157; opacity: 0; }
    20%  { opacity: 1; }
    50%  { stroke-dashoffset: 0; }
    80%  { opacity: 1; }
    100% { stroke-dashoffset: 157; opacity: 0; }
}

/* Tick loop (starts after circle) */
@keyframes tickLoop {
    0%   { stroke-dashoffset: 48; opacity: 0; }
    40%  { opacity: 0; }
    60%  { stroke-dashoffset: 0; opacity: 1; }
    80%  { opacity: 1; }
    100% { stroke-dashoffset: 48; opacity: 0; }
}

/* Text */
.success-text {
    font-size: 15px;
    font-weight: 600;
    line-height: 1.6;
    margin: 0;
}





</style>
    <header class="main-header">
        <div class="custom-container">
            <div class="header-panel">
                <a onclick="history.back();">
                    <img class="img-fluid icon-btn back-arrow" src="assets/images/svg/back-arrow.svg" alt="back-arrow">
                </a>
                <h3>UNIQ SHOP</h3>
            </div>
        </div>
    </header>
    
    <!-- search section starts -->
        <section class="section-sm-t-space">
            <div class="custom-container">
                <form action="/shop">
                    <div class="emboss-search">
        
                        <input
                            type="search"
                            name="d"
                            placeholder="Search here....."
                            value="{{ request('d') }}"
                        >
        
                        <button type="submit" aria-label="Search">
                            🔍
                        </button>
        
                    </div>
                </form>
            </div>
        </section>

    <!-- search section end -->
    

    <section class="section-sm-t-space">
        <div class="custom-container">
            <div class="filter-grid-btn d-flex align-items-centerr gap-3">
                <a href="#sort" data-bs-toggle="offcanvas" class="btn white-btn theme-color d-flex align-items-center justify-content-center gap-2 w-50">
                    <i class="iconsax filter-icon" data-icon="setting-3"> </i> Sort by
                </a>

                <a href="/Orders"  class="btn white-btn  theme-color  d-flex align-items-center justify-content-center gap-2 w-50">
                    <i class="iconsax filter-icon" data-icon="shopping-cart"> </i> Your Orders
                </a>
            </div>
        </div>
    </section>
    
    
 <!--   <div class="neon-check-box">
 
        <div class="checkmark-wrap">
            <svg class="checkmark loop" viewBox="0 0 52 52">
                <circle class="checkmark-circle" cx="26" cy="26" r="25" fill="none"/>
                <path class="checkmark-check" fill="none"
                      d="M14 27 L23 36 L38 18"/>
            </svg>
        </div>
    
        <p class="success-text">
            Free Products Successfully Added To Your Cart.<br>
            You’ll Receive Them With Your Next Order!
        </p>
        <h4>Shop Now & Don’t Miss Out</h4>
    </div>-->



    <!-- Category section starts -->
    <section>
        <div class="custom-container">
            <div class="title"><h3>Shop By Brands!  <img src="assets/images/emoji/s.gif" alt="Hot Offer" width="30"></h3></div>
            <ul class="categories-slider category-list">
                
                 @foreach($categories as $item)
                 
                <li>
                      <a href="/shop?cat={{$item->id}}" class="category-box">
                        <div class="category-box-img">
                            <img class="img-fluid category-img" src="https://admin.uniqconnectwc.com/storage/app/public/{{$item->image}}" alt="category">
                        </div>
                        <h5>{{$item->name}}</h5>
                    </a>
                </li>

                @endforeach
                
            </ul><hr/>
        </div>
    </section>
    <!-- Category section end -->
    <!-- product section start -->
    <section class="section-b-space">
        <div class="custom-container">
            <div class="title">
                <h3>All Premium Products  <img src="assets/images/emoji/c.gif" alt="Hot Offer" width="30"></h3>
            </div>
 
            <div class="row g-3">
                @foreach($products as $item)
                <div class="col-6">
                    <div class="product-box">
                        <div class="product-img">
                            <div class="badge-img">
                                <span>{{$item->tag}}</span>
                            </div>
                            <img src="https://admin.uniqconnectwc.com/storage/app/public/{{$item->image_url}}" class="img-fluid img" alt="">
                        </div>
                        <div class="product-content">
                            
                            <h6 class="content-color white-nowrap">{{$item->category}}</h6>
                            <a href="/UC_Product_Description">
                                <h5 class="title-color fw-medium white-nowrap mt-1">{{$item->name}}</h5>
                            </a>
                         
                            
                            <div class="bottom-content">
                                @if($is_active)
                                
                                   <h5 class="price">₹ {{$item->price}} <del>₹ {{$item->mrp}}</del></h5>
                                @else
                                @php  $discount = $item->discount ??  '0'; 
                                      $offer_price = $item->mrp - ($item->mrp*($discount/100)); 
                                @endphp
                                
                                
                                           <h5 class="price">₹ {{$offer_price}} <del>₹ {{$item->mrp}}</del></h5>
                                           
                                @endif

                                <p class="see-all">SP:{{$item->pv}}</p>
                            </div>
                            
                <!-- ADD / Qty Button -->
                        <div class="product-item"
                             data-id="{{ $item->id }}"
                             data-name="{{ $item->name }}"
                             data-price="{{ $item->price }}"
                             data-mrp="{{ $item->mrp }}"
                             data-dc="{{$item->dc}}"
                             data-pv="{{ $item->pv }}" style="float:right;  width:100%;" >
                        
                            <!-- ADD Button -->
                            <div class="add-btn" id="addBtn-{{ $item->id }}" onclick="enableQty({{ $item->id }})" style="width:100%; display:flex; align-items:center; justify-content:center; gap:6px;">
                                <img src="assets/images/emoji/sh.gif" alt="Hot Offer" width="30">
                                ADD
                            </div>
                        
                            <!-- Quantity Box -->
                            <div class="qty-box" id="qtyBox-{{ $item->id }}" style="display:none;  width:100%; align-items:center; justify-content:space-between; gap:6px;">
                                <button class="qty-btn sub" data-id="{{ $item->id }}" style="
                                    background:transparent;
                                    border:none;
                                    font-size:22px;
                                    font-weight:600;
                                    cursor:pointer;
                                    min-width:30px;
                                    text-align:left;
                                ">−</button>
                                <span class="quantity" id="qtyValue-{{ $item->id }}">1</span>
                                <button class="qty-btn add" data-id="{{ $item->id }}" style="
                                    background:transparent;
                                    border:none;
                                    font-size:22px;
                                    font-weight:600;
                                    cursor:pointer;
                                    min-width:30px;
                                    text-align:right;
                                ">+</button>
                            </div>
                        </div>



                    
                        
                    </div>
                </div>
                 </div>
                @endforeach
           
            </div>
    </section>
    <br><br><br>


   
    <!-- flash sale section start -->

    <!-- sort offcanvas start -->
    <div class="offcanvas offcanvas-bottom filter-offcanvas" tabindex="-1" id="sort">
        <div class="offcanvas-header">
            <h3>Sort By</h3>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
           <form class="theme-form border-design" method="GET" action="{{ url('/shop') }}">
               
            <!--<div class="form-check">-->
            <!--    <label for="sort1">Top Rated Product</label>-->
            <!--    <input type="radio" name="sort" value="top" id="sort1" class="ms-auto"-->
            <!--    {{ request('sort')=='top' ? 'checked' : '' }}-->
            <!--    onchange="this.form.submit()">-->
            <!--</div>-->
        
            <div class="form-check">
                <label for="sort2">Latest Arrival</label>
                <input type="radio" name="sort" value="latest" id="sort2" class="ms-auto"
                {{ request('sort')=='latest' ? 'checked' : '' }}
                onchange="this.form.submit()">
            </div>
        
            <div class="form-check">
                <label for="sort3">Price (Highest First)</label>
                <input type="radio" name="sort" value="price_desc" id="sort3" class="ms-auto"
                {{ request('sort')=='price_desc' ? 'checked' : '' }}
                onchange="this.form.submit()">
            </div>
        
            <div class="form-check">
                <label for="sort4">Price (Lowest First)</label>
                <input type="radio" name="sort" value="price_asc" id="sort4" class="ms-auto"
                {{ request('sort')=='price_asc' ? 'checked' : '' }}
                onchange="this.form.submit()">
            </div>
        
            <div class="form-check">
                <label for="sort5">A to Z (Alphabetical)</label>
                <input type="radio" name="sort" value="a_z" id="sort5" class="ms-auto"
                {{ request('sort')=='a_z' ? 'checked' : '' }}
                onchange="this.form.submit()">
            </div>
        </form>

        </div>
    </div>
    <!-- sort offcanvas end -->

    <!-- Filter offcanvas start -->
    <div class="offcanvas offcanvas-bottom filter-offcanvas" tabindex="-1" id="filter">
        <div class="offcanvas-header">
            <h3>Filter by</h3>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <form class="theme-form pb-80">

                <div class="row">
                      @foreach($categories as $item)
                <div class="col-3">
                  <a href="/shop?cat={{$item->id}}">
                    <div class="product-box" >
                        <div class="product-img" style="border-radius: 50%;">
                           
                            <img class="img-fluid category-img" src="https://admin.uniqconnectwc.com/storage/app/public/{{$item->image}}" alt="Category Image" width="100px">
                           
                        </div>
                        <div class="product-content">
                            <h6 class="content-color white-nowrap">{{$item->name}}</h6>
                        </div>
                    </div>
                </a>
                </div>
                @endforeach
                </div>
            </form>
        </div>
    </div>
    <!-- Filter offcanvas end -->
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
    z-index:1;
    overflow:hidden;
      "
      href="/UC_Shop"
      onblur="(function(el){ el.style.boxShadow='0 6px 16px rgba(46,164,79,0.18)'; el.style.transform='translateY(0) scale(1)'; })(this)">
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
    <!-- quantity js -->
    <script src="assets/js/quantity.js"></script>
    <!-- bootstrap js -->
    <script src="assets/js/bootstrap.bundle.min.js"></script>

    <!-- iconsax icon -->
    <script src="assets/js/iconsax-icon.js"></script>

    

    <!-- template-setting js -->
    <script src="assets/js/template-setting.js"></script>

    <!-- script js -->
    <script src="assets/js/script.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script>
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

 function showCartButton() {
     let cart = JSON.parse(localStorage.getItem("Ecart")) || [];
    const countSpan = document.getElementById("cartCount");

    countSpan.textContent = cart.length;

    // Optional: hide badge if empty
    countSpan.style.display = cart.length === 0 ? "none" : "inline-flex";
    viewCartBtn.style.display = cart.length === 0 ? "none" : "block";
    
}

    document.addEventListener("DOMContentLoaded", function() {
        showCartButton();
        console.log("DOM is fully loaded and parsed!");
    });
    
</script>


<script>
document.getElementById("success")
    .addEventListener("shown.bs.modal", () => {

        const box = document.querySelector(".neon-check-box");
        box.innerHTML = box.innerHTML; // re-trigger SVG animation

    });
</script>




@endsection



