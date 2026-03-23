
@extends('layout')
@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

<!-- header start -->
    <header class="header">
        <div class="custom-container">
            <div class="head-content">
                <a href="#sidebar" class="sidebar-btn" data-bs-toggle="offcanvas">
                    <i class="iconsax" data-icon="text-align-left"></i>
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
            <div class="col-12">
                <!--<a href="#">-->
                    <div class="product-box" style="background-color: #ffe00b;">
                        <div class="product-content">
                            <h5 class="text-center">Your Shopping Points: {{ $availablePV}}</h5>
                            
                        </div>
                    </div>
                <!--</a>-->
            </div>
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

    <!-- flash sale section start -->
    <section class="product-category-section section-t-space section-b-space mt-24">
        <div class="custom-container">
            <div class="title">
                <h3>All Premium Products</h3>
                <a href="/UC_Shop" class="btn btn-small shop-btn">Shop Now</a>
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
                            <div class="like-icon animate ">
                                <!--<img class="img-fluid icon outline-icon" src="assets/images/svg/heart-outline.svg"-->
                                <!--    alt="">-->
                                <!--<img class="img-fluid icon fill-icon" src="assets/images/svg/heart-fill.svg" alt="">-->
                               
                            </div>
                        </div>
                        <div class="product-content">
                            <a href="/UC_Shop" class="add-icon">
                                <i class="iconsax" data-icon="add"></i>
                            </a>
                            <h6 class="content-color white-nowrap">{{$item->category}}</h6>
                            <a href="/UC_Product_Description">
                                <h5 class="title-color fw-medium white-nowrap mt-1">{{$item->name}}</h5>
                            </a>
                            <!--<ul class="rating-list">-->
                            <!--    <li>-->
                            <!--        <img src="assets/images/svg/star-fill.svg" alt="star">-->
                            <!--    </li>-->
                            <!--    <li>-->
                            <!--        <img src="assets/images/svg/star-fill.svg" alt="star">-->
                            <!--    </li>-->
                            <!--    <li>-->
                            <!--        <img src="assets/images/svg/star-fill.svg" alt="star">-->
                            <!--    </li>-->
                            <!--    <li>-->
                            <!--        <img src="assets/images/svg/star-fill.svg" alt="star">-->
                            <!--    </li>-->
                            <!--    <li>-->
                            <!--        <img src="assets/images/svg/star-outline.svg" alt="star">-->
                            <!--    </li>-->
                            <!--</ul>-->
                            
                            <div class="bottom-content">
                                @if($is_active)
                                
                                   <h5 class="price">₹ {{$item->price}} <del>₹ {{$item->mrp}}</del></h5>
                                @else
                                @php  $discount = $discount ??  '0'; 
                                      $offer_price = $item->mrp - ($item->mrp*($discount/100)); 
                                @endphp
                                
                                
                                           <h5 class="price">₹ {{$offer_price}} <del>₹ {{$item->mrp}}</del></h5>
                                           
                                @endif

                                <p class="see-all">SP:{{$item->pv}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
           
            </div>

            
        </div>
    </section>
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
                    
                     
                    <a href="/UC_Shop" class="banner-box">
                        <img class="img-fluid banner-img w-100 radius-10" src="https://admin.uniqconnectwc.com/storage/app/public/{{$products_3->cover_img}}" alt="banner">
                     </a>
                       
                   
                </div>
            </section>
    <!-- flash sale section start -->
     @endif
    
    
    @if($products_4)
    <!-- deals of day section start -->
    <section>
        <div class="custom-container">
            <div class="title">
                <h3>Cut-Off Offer</h3>
                <a href="/UC_Shop" class="see-all">Shop Now</a>
            </div>
            <a href="/UC_Shop" class="banner-box">
               
                
                  <img class="img-fluid banner-img w-100 radius-10" src="https://admin.uniqconnectwc.com/storage/app/public/{{$products_4->cover_img}}" alt="banner">
                
            </a>
        </div>
    </section>
    <!-- deals of day section end -->
    @endif
<script>
document.addEventListener('DOMContentLoaded', function () {
    const copyBtn = document.getElementById('copyBtn');
    
    const staticText = `https://uniqconnectwc.com/Sign_Up?sponcer_id={{ Auth::user()->memberid }}&sponsorname={{ urlencode(Auth::user()->name) }}`;


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


  function cart_clear() {
    //   alert();
        localStorage.removeItem("Ecart");
        localStorage.removeItem("Ecart_total");
            console.log('Cart clear...!'); 
        } 

    document.addEventListener("DOMContentLoaded", function() {
        // Your code to run when the DOM is ready
        cart_clear();
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


@endsection