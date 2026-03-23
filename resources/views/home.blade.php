
@extends('layout')
@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

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

.neon-btn {
    position: relative;
    padding: 16px 38px;
    font-size: 18px;
    font-weight: 700;
    width: 100%;
    color: #fff;
    background: linear-gradient(135deg, #ff00cc, #3333ff);
    border: none;
    border-radius: 50px;
    cursor: pointer;
    overflow: hidden;
    z-index: 1;
}

/* Text stays above */
.neon-btn span {
    position: relative;
    z-index: 2;
}

/* Neon rotating ring */
.neon-btn::before {
    content: "";
    position: absolute;
    inset: -3px;
    border-radius: 60px;
    background: conic-gradient(
        #ff00cc,
        #00ffff,
        #ffea00,
        #ff00cc
    );
    filter: blur(4px);
    animation: neonRotate 3s linear infinite;
    z-index: 0;
}

/* Inner mask to create ring */
.neon-btn::after {
    content: "";
    position: absolute;
    inset: 3px;
    border-radius: 50px;
    background: linear-gradient(135deg, #ff00cc, #3333ff);
    z-index: 1;
}

/* Hover pop */
.neon-btn:hover {
    transform: scale(1.07);
    transition: 0.3s ease;
}

/* Rotation animation */
@keyframes neonRotate {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}


/* Glass modal */
.glass-modal {
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(18px);
    -webkit-backdrop-filter: blur(18px);
    border-radius: 20px;
    border: 1px solid rgba(255, 255, 255, 0.25);
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.35);
    color: #fff;
}

/* Close button glass look */
.glass-close {
    filter: invert(1);
    opacity: 0.8;
}

/* Product image container */
.product-img-wrap {
    width: 140px;
    height: 140px;
    margin: 0 auto;
    border-radius: 20px;
    padding: 10px;
    background: rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(10px);
    box-shadow: 0 0 25px rgba(0, 255, 255, 0.35);
}

/* Image styling */
.product-img-wrap img {
    width: 100%;
    height: 100%;
    object-fit: contain;
    border-radius: 15px;
}

/* Button enhancement (optional neon touch) */
.theme-btn {
    background: linear-gradient(135deg, #00f2ff, #7b2cff);
    border: none;
    color: #fff;
    font-weight: 600;
    padding: 12px;
    border-radius: 30px;
    box-shadow: 0 0 20px rgba(123, 44, 255, 0.6);
}

/* Modal fade smooth */
.modal.fade .modal-dialog {
    transform: scale(0.9);
    transition: transform 0.3s ease-out;
}
.modal.show .modal-dialog {
    transform: scale(1);
}

/* Floating animation */
.product-img-wrap {
    animation: floatProduct 4s ease-in-out infinite;
}

/* Optional hover boost */
.product-img-wrap:hover {
    animation-play-state: paused;
    transform: scale(1.05);
}

/* Floating keyframes */
@keyframes floatProduct {
    0% {
        transform: translateY(0px);
    }
    50% {
        transform: translateY(-12px);
    }
    100% {
        transform: translateY(0px);
    }
}

#confetti-container {
    position: fixed;
    inset: 0;
    pointer-events: none;
    overflow: hidden;
    z-index: 9999;
}

/* Confetti */
.confetti {
    position: absolute;
    width: 10px;
    height: 14px;
    border-radius: 3px;
    animation: confettiFall linear forwards;
}

@keyframes confettiFall {
    0% {
        transform: translateY(-10vh) rotate(0deg);
        opacity: 1;
    }
    100% {
        transform: translateY(110vh) rotate(720deg);
        opacity: 0;
    }
}

/* Spark explosion */
.spark {
    position: absolute;
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background: #00ffff;
    box-shadow: 0 0 12px currentColor;
    animation: sparkBurst 0.8s ease-out forwards;
}

@keyframes sparkBurst {
    from {
        transform: translate(0,0) scale(1);
        opacity: 1;
    }
    to {
        transform: translate(var(--x), var(--y)) scale(0);
        opacity: 0;
    }
}





</style>
@if(isset(Auth::user()->memberid))
<!-- header start -->
    <header class="header">
        <div class="custom-container">
            <div class="head-content">
                <a href="#sidebar" class="sidebar-btn" data-bs-toggle="offcanvas">
                    <img style="max-width: 40px;" src="assets/images/logo/lo.png" alt="logo">
                </a>

                <a href="#" class="header-location">
                    <h6>{{Auth::user()->memberid?? ''}}</h6>

                    <div class="location-content">
                        <!--<img class="img-fluid location" src="assets/images/svg/location.svg" alt="location">-->
                        <h5>{{Auth::user()->name?? ''}}</h5>
                        <!--<i class="iconsax d-arrow" data-icon="chevron-down"></i>-->
                    </div>
                </a>
                <div class="ms-auto d-flex align-items-center gap-2">
                    <a href="/Orders">
                        <i class="iconsax icon-btn" data-icon="shopping-cart"></i>
                    </a>
                    <a href="/Notifications">
                        <i class="iconsax icon-btn notification-icon" data-icon="bell-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </header>
    <!-- header end -->
    <!-- banner section start -->

@endif

<div id="confetti-container"></div>

<audio id="successSound" preload="auto">
    <source src="/assets/sounds/success.mp3" type="audio/mpeg">
</audio>

    <section>
        <div class="custom-container">
            <div class="title">
                <div class="d-flex align-items-center gap-2">
                    <h3>Welcome {{Auth::user()->name?? ''}}!</h3>
                    
                </div>
                @php
                    $inviteLink = "https://uniqconnectwc.com/Sign_Up?sponcer_id=".(Auth::user()->memberid ?? '')."&sponsorname=".(Auth::user()->name ?? '');
                @endphp
                <div>
                    <a href="https://api.whatsapp.com/send?text={{ urlencode('Join with my invite link: '.$inviteLink) }}" 
                       target="_blank">
                        <button class="btn btn-outline-secondary" title="Invite Friends">
                        Invite
                    </button></a>
                    <!-- Copy Button -->
                    <!-- Clipboard Copy Button -->
                    <button id="copyBtn" class="btn btn-outline-secondary" title="Copy Invite Link">
                        <i class="bi bi-clipboard"></i>
                    </button>
                </div>
            </div>
             @if(isset(Auth::user()->memberid))
               
            <div class="col-12">
                <!--<a href="#">-->
                    <div class="product-box" style="background-color: #ffe00b; color: #000">
                        <div class="product-content">
                            <h5 class="text-center">Your Shopping Points: {{ $availablePV}}</h5>
                            
                        </div>
                    </div>
                <!--</a>-->
            </div>
            @endif
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

    </section>

    <section class=" position-relative">
        <div class="swiper banner-slider">
            <div class="swiper-wrapper">
                
                   @foreach($slider as $item)
                 
                <div class="swiper-slide">
                    <a href="/UC_Product_Description" class="banner-box">
                        <img class="img-fluid banner-img" src="https://admin.uniqconnectwc.com/storage/app/public/{{$item->image_url }}" alt="banner">
                    </a>
                </div>
                
                 @endforeach
               
            </div>
            <div class="swiper-pagination banner-pagination"></div>
        </div>
    </section>
    <!-- banner section end -->

    <!-- Category section starts -->
    <section>
        
        <div class="custom-container">
            <div class="title">
                <h3>Wellness Brand's!  <img src="assets/images/emoji/w.gif" alt="Hot Offer" width="28"></h3>
                <a href="/shop" class="btn btn-small shop-btn">Shop Now</a>
            </div>
            
            <ul class="categories-slider category-list">
                
                 @foreach($categories as $item)
                 
                <li>
                      <a href="/shop?cat={{$item->id}}" class="category-box">
                        <div class="category-box-img">
                            <img class="img-fluid category-img" src="https://admin.uniqconnectwc.site/storage/app/public/{{$item->image}}" alt="category">
                        </div>
                        <h5>{{$item->name}}</h5>
                    </a>
                </li>

                @endforeach
                
            </ul>
            
        </div>
    </section><br>
    <!-- Category section end -->
    
    <!-- free product button --
    
    <section class="custom-container">
        <button class="neon-btn" href="#success" data-bs-toggle="modal">
            <span>Get Your Free Products</span>
        </button>
    </section>
    
    <!-- free product button end-->
    
            <section>
                <div class="custom-container">
                    <div class="title">
                        <div class="d-flex align-items-center gap-2">
                            <h3>Welcome Offer For New Distributors Only!</h3>
                        </div>
                    </div>
                    <a href="#" class="banner-box">
                        <img class="img-fluid banner-img w-100 radius-10" src="assets/images/banner/wel.jpg" alt="banner">
                    </a>
                </div>
            </section>
    
        
@if( ($is_active ?? true) || empty(optional(Auth::user())->memberid) )
    <!-- flash sale section start -->
          @if($products_3)
    <section>
                <div class="custom-container">
                    <div class="title">
                        <div class="d-flex align-items-center gap-2">
                            <h3>Flash Sale</h3>
                            <div class="title-timer" id="clock">
                                <i class="iconsax clock" data-icon="clock"> </i>
        
                                <div class="counter">
                                    <span class="hours1"></span>
                                </div>
                                <div class="counter">
                                    <span class="minutes1"></span>
                                </div>
                                <div class="counter">
                                    <span class="seconds1"></span>
                                </div>
                            </div>
                        </div>
                        <a href="/UC_Shop" class="see-all">Shop Now</a>
        
                    </div>
                    
                     
                    <a href="/product-details?id={{ $products_3->id }}" class="banner-box">
                        <img class="img-fluid banner-img w-100 radius-10" src="https://admin.uniqconnectwc.com/storage/app/public/{{$products_3->cover_img}}" alt="banner">
                     </a>
                       
                   
                </div>
            </section>
    <!-- flash sale section End -->
        @endif
    
@endif     
    <!-- flash sale section start -->
    <section class="product-category-section section-t-space section-b-space mt-24">
        <div class="custom-container">
            <div class="title">
                <h3>All Premium Products <img src="assets/images/emoji/c.gif" alt="Hot Offer" width="28"></h3>
                <a href="/shop" class="btn btn-small shop-btn">Shop Now</a>
            </div>
            <div class="row g-3">
                @foreach($products as $item)
                <div class="col-6">
                    <div class="product-box">
                        <div class="product-img">
                            <div class="badge-img">
                                <span>{{$item->tag}}</span>
                            </div>
                              <a href="/product-details?id={{ $item->id }}">
                            <img src="https://admin.uniqconnectwc.com/storage/app/public/{{$item->image_url}}" class="img-fluid img" alt="">
                            </a>
                            <!--<div class="like-icon animate ">-->
                            <!--</div>-->
                        </div>
                        <div class="product-content">
                            
                            <h6 class="content-color white-nowrap">{{$item->category}}</h6>
                            <a href="/product-details?id={{ $item->id }}">
                                <h5 class="title-color fw-medium white-nowrap mt-1">{{$item->name}}</h5>
                            </a>
                            <div class="bottom-content">
                                @if($is_active?? false)
                                
                                   <h6 class="price">₹ {{$item->price}} <del>₹ {{$item->mrp}}</del></h6>
                                @else
                                @php  $discount = $item->discount ??  '0'; 
                                      $offer_price = $item->mrp - ($item->mrp*($discount/100)); 
                                @endphp
                                
                                <h6 class="price">₹ {{$offer_price}} <del>₹ {{$item->mrp}}</del></h6>
                                           
                                @endif

                                <p class="see-all">SP:{{$item->pv}}</p>
                            </div>
                            
                        </div>
    <!-- ADD / Qty Button -->
                        <div class="product-item"
                             data-id="{{ $item->id }}"
                             data-name="{{ $item->name }}"
                    @if($is_active?? false)
                             data-price="{{ $item->price }}"
                             data-mrp="{{ $item->mrp }}"
                    @else
                            data-price="{{ $offer_price }}"
                             data-mrp="{{ $item->mrp }}"
                    @endif         
                             data-dc="{{$item->dc}}"
                             data-pv="{{ $item->pv }}" style="float:right;  width:100%; padding: 5px 5px 5px 5px;" >
                        
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
                @endforeach
           
            </div>

            
        </div>
    </section>
    

    
    @if($products_4)
    <!-- deals of day section start -->
    <section>
        <div class="custom-container">
            <div class="title">
                <h3>Cut-Off Offer  <img src="assets/images/emoji/d.gif" alt="Hot Offer" width="28"></h3>
                 <a href="/product-details?id={{ $products_4->id }}" class="see-all">Shop Now</a>
            </div>
            <a href="/product-details?id={{ $products_4->id }}" class="banner-box">
               
                
                  <img class="img-fluid banner-img w-100 radius-10" src="https://admin.uniqconnectwc.com/storage/app/public/{{$products_4->cover_img}}" alt="banner">
                
            </a>
        </div>
        
    </section>
    <!-- deals of day section end -->
    @endif
    
   <br><br>
   
   <div class="modal fade centered-modal" tabindex="-1" id="success">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content glass-modal">
                

                <div class="modal-body text-center">
                    <button type="button" class="btn-close glass-close" data-bs-dismiss="modal" aria-label="Close"></button>
    
                    <!-- Product Image -->
                    <div class="product-img-wrap">
                        <img src="/assets/images/product/2.png" alt="Product Image">
                    </div>
    
                    <h3 class="title-color fw-normal mt-3">Get Your Free Products!</h3>
                    <h4 class="mt-2">You Got <b>2 UC ImmuniTEA</b></h4>
    
                    <a href="/shop" class="btn theme-btn w-100 mt-4">Claim Now!</a>
                </div>
            </div>
        </div>
    </div>

    
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
        overflow:hidden;"
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
  
  <script>
const confettiColors = [
    "#ff00cc", "#00ffff", "#ffea00",
    "#7b2cff", "#00ff88", "#ff5733"
];

function launchConfetti(count = 120) {
    const container = document.getElementById("confetti-container");

    for (let i = 0; i < count; i++) {
        const c = document.createElement("div");
        c.className = "confetti";

        const size = Math.random() * 8 + 6;
        c.style.width = size + "px";
        c.style.height = size * 1.4 + "px";
        c.style.left = Math.random() * 100 + "vw";
        c.style.background =
            confettiColors[Math.floor(Math.random() * confettiColors.length)];
        c.style.animationDuration = (Math.random() * 2 + 3) + "s";

        container.appendChild(c);
        setTimeout(() => c.remove(), 5000);
    }
}

function sparkExplosion(x, y, count = 20) {
    const container = document.getElementById("confetti-container");

    for (let i = 0; i < count; i++) {
        const spark = document.createElement("div");
        spark.className = "spark";

        const angle = Math.random() * Math.PI * 2;
        const distance = Math.random() * 80 + 40;

        spark.style.left = x + "px";
        spark.style.top = y + "px";
        spark.style.setProperty("--x", `${Math.cos(angle) * distance}px`);
        spark.style.setProperty("--y", `${Math.sin(angle) * distance}px`);
        spark.style.color =
            confettiColors[Math.floor(Math.random() * confettiColors.length)];

        container.appendChild(spark);
        setTimeout(() => spark.remove(), 800);
    }
}

/* 🔔 Success Sound */
function playSuccessSound() {
    const sound = document.getElementById("successSound");
    sound.currentTime = 0;
    sound.play().catch(() => {});
}

/* Bootstrap modal hook */
const successModal = document.getElementById("success");

successModal.addEventListener("shown.bs.modal", () => {

    // Play sound
    playSuccessSound();

    // Confetti rain
    launchConfetti(150);

    // Spark explosion from modal center
    const rect = successModal.querySelector(".modal-content").getBoundingClientRect();
    sparkExplosion(
        rect.left + rect.width / 2,
        rect.top + rect.height / 2,
        25
    );
});
</script>


  
  
  
  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const copyBtn = document.getElementById('copyBtn');
    
    const staticText = `https://uniqconnectwc.com/Sign_Up?sponcer_id={{ Auth::user()->memberid ?? "0" }}&sponsorname={{ urlencode(Auth::user()->name ?? "0") }}`;


    // const staticText = "This is the static text to be copied.";

    copyBtn.addEventListener('click', function () {
        navigator.clipboard.writeText(staticText)
            .then(() => {
                // Change icon temporarily to indicate success
                copyBtn.innerHTML = '<i class="bi bi-clipboard-check"></i>';
                setTimeout(() => {
                    copyBtn.innerHTML = '<i class="bi bi-clipboard"></i>';
                }, 1500);
            })
            .catch(err => {
                console.error('Copy failed:', err);
                alert("Failed to copy text.");
            });
    });
});

    function showCartButton() {
     let cart = JSON.parse(localStorage.getItem("Ecart")) || [];
    const countSpan = document.getElementById("cartCount");

    countSpan.textContent = cart.length;

    // Optional: hide badge if empty
    countSpan.style.display = cart.length === 0 ? "none" : "inline-flex";
    viewCartBtn.style.display = cart.length === 0 ? "none" : "block";
    
}
  function cart_clear() {
    //   alert();
        // localStorage.removeItem("Ecart");
        // localStorage.removeItem("Ecart_total");
        //     console.log('Cart clear...!'); 
        


        } 

    document.addEventListener("DOMContentLoaded", function() {
        // Your code to run when the DOM is ready
        // cart_clear();
        showCartButton();
        console.log("DOM is fully loaded and parsed!");
    });
    
  

function startDayTimer() {
    function updateTimer() {
        let now = new Date();

        // tomorrow at 00:00:00
        let tomorrow = new Date();
        tomorrow.setHours(24, 0, 0, 0);

        // remaining time (ms)
        let diff = tomorrow - now;

        let hours = Math.floor(diff / (1000 * 60 * 60));
        let minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
        let seconds = Math.floor((diff % (1000 * 60)) / 1000);

        // update UI
        document.querySelector("#clock .hours1").textContent = hours
            .toString()
            .padStart(2, "0");
        document.querySelector("#clock .minutes1").textContent = minutes
            .toString()
            .padStart(2, "0");
        document.querySelector("#clock .seconds1").textContent = seconds
            .toString()
            .padStart(2, "0");
    }

    updateTimer(); // initial call
    setInterval(updateTimer, 1000); // update every second
}
  startDayTimer();
</script>

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
</script>

@endsection