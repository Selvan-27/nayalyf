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

    
    <!-- Animations -->
    <style>
        @keyframes floatIcon {
            0%,100% { transform:translateY(0); }
            50% { transform:translateY(-10px); }
        }

        @keyframes heartBeat {
            0%,100% { transform:scale(1); }
            25% { transform:scale(1.18); }
            40% { transform:scale(0.95); }
            60% { transform:scale(1.12); }
        }

        @keyframes glassShine {
            0% { transform:translateX(-120%) rotate(25deg); }
            100% { transform:translateX(120%) rotate(25deg); }
        }
        </style>

        <script>
        function selectChallenge(type) {
            localStorage.setItem("selectedChallenge", type);
            alert("Selected: " + type + " challenge");
        }
    </script>
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
                <a href="home.html">
                    <img class="img-fluid icon-btn back-arrow" src="assets/images/svg/back-arrow.svg" alt="back-arrow">
                </a>
                <h3>Let's Do The Healthy Challenge!</h3>
            </div>
        </div>
    </header>
    <!-- header end -->

    <!-- Challenge Selection Section -->
    <section class="section-sm-t-space section-b-space">
    <div class="custom-container">

        <h4 style="text-align:center; font-weight:700; margin-bottom:28px;">
            🎯 Select Your Challenge
        </h4>

        <!-- Tiles Wrapper -->
        <div style="
            display:grid;
            grid-template-columns:repeat(auto-fit,minmax(400px,1fr));
            gap:22px;
        ">

            <!-- Wellness Challenge -->
            <div onclick="selectChallenge('wellness')" style="
                cursor:pointer;
                border-radius:22px;
                padding:28px 20px;
                text-align:center;
                background:rgba(255,255,255,0.18);
                backdrop-filter:blur(14px);
                -webkit-backdrop-filter:blur(14px);
                border:1px solid rgba(255,255,255,0.35);
                box-shadow:0 12px 35px rgba(0,0,0,0.12);
                transition:all .35s ease;
                position:relative;
                overflow:hidden;
            " onmouseover="this.style.transform='translateY(-8px) scale(1.04)'" onmouseout="this.style.transform='none'">

                <!-- Glass shine -->
                <div style="
                    position:absolute;
                    top:-60%;
                    left:-40%;
                    width:180%;
                    height:180%;
                    background:linear-gradient(120deg, transparent, rgba(255,255,255,0.25), transparent);
                    transform:rotate(25deg);
                    animation:glassShine 6s linear infinite;
                "></div>

                <!-- Animated Icon -->
                <div style="
                    font-size:48px;
                    position:relative;
                    z-index:1;
                    animation:floatIcon 3s ease-in-out infinite;
                ">🌿</div>

                <h5 style="margin-top:14px; font-weight:700; position:relative; z-index:1;">
                    Wellness Care
                </h5>
                <p style="font-size:13px; color:#555; margin-top:6px; position:relative; z-index:1;">
                    Holistic body & mind balance
                </p>
            </div>

            <!-- Heart Challenge -->
            <div onclick="selectChallenge('heart')" style="
                cursor:pointer;
                border-radius:22px;
                padding:28px 20px;
                text-align:center;
                background:rgba(255,255,255,0.18);
                backdrop-filter:blur(14px);
                -webkit-backdrop-filter:blur(14px);
                border:1px solid rgba(255,255,255,0.35);
                box-shadow:0 12px 35px rgba(0,0,0,0.12);
                transition:all .35s ease;
                position:relative;
                overflow:hidden;
            " onmouseover="this.style.transform='translateY(-8px) scale(1.04)'" onmouseout="this.style.transform='none'">

                <div style="
                    position:absolute;
                    top:-60%;
                    left:-40%;
                    width:180%;
                    height:180%;
                    background:linear-gradient(120deg, transparent, rgba(255,255,255,0.25), transparent);
                    transform:rotate(25deg);
                    animation:glassShine 6s linear infinite;
                "></div>

                <!-- Heartbeat -->
                <div style="
                    font-size:48px;
                    position:relative;
                    z-index:1;
                    animation:heartBeat 1.2s infinite;
                ">🫀</div>

                <h5 style="margin-top:14px; font-weight:700; position:relative; z-index:1;">
                    Heart Care
                </h5>
                <p style="font-size:13px; color:#555; margin-top:6px; position:relative; z-index:1;">
                    Support your heart health
                </p>
            </div>

            <!-- Diabetic Challenge -->
            <div onclick="selectChallenge('diabetic')" style="
                cursor:pointer;
                border-radius:22px;
                padding:28px 20px;
                text-align:center;
                background:rgba(255,255,255,0.18);
                backdrop-filter:blur(14px);
                -webkit-backdrop-filter:blur(14px);
                border:1px solid rgba(255,255,255,0.35);
                box-shadow:0 12px 35px rgba(0,0,0,0.12);
                transition:all .35s ease;
                position:relative;
                overflow:hidden;
            " onmouseover="this.style.transform='translateY(-8px) scale(1.04)'" onmouseout="this.style.transform='none'">

                <div style="
                    position:absolute;
                    top:-60%;
                    left:-40%;
                    width:180%;
                    height:180%;
                    background:linear-gradient(120deg, transparent, rgba(255,255,255,0.25), transparent);
                    transform:rotate(25deg);
                    animation:glassShine 6s linear infinite;
                "></div>

                <!-- Floating -->
                <div style="
                    font-size:48px;
                    position:relative;
                    z-index:1;
                    animation:floatIcon 2.6s ease-in-out infinite;
                ">🩸</div>

                <h5 style="margin-top:14px; font-weight:700; position:relative; z-index:1;">
                    Diabetic Care
                </h5>
                <p style="font-size:13px; color:#555; margin-top:6px; position:relative; z-index:1;">
                    Maintain healthy sugar levels
                </p>
            </div>

        </div>
    </div>
</section>

    <!-- flash sale section start -->
    <section class="product-category-section section-t-space section-b-space mt-24">
        <div class="custom-container">
            <div class="title">
                <h3>All Challenge Products <img src="assets/images/emoji/c.gif" alt="Hot Offer" width="28"></h3>
                <!--<a href="/shop" class="btn btn-small shop-btn">Shop Now</a>-->
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
    
    <!-- Challenge section ends -->
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
    <!-- bootstrap js -->
    <script src="assets/js/bootstrap.bundle.min.js"></script>

    <!-- iconsax icon -->
    <script src="assets/js/iconsax-icon.js"></script>

    <!-- template-setting js -->
    <script src="assets/js/template-setting.js"></script>

    <!-- script js -->
    <script src="assets/js/script.js"></script>
</body>

</html>