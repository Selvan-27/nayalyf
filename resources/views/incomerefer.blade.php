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
                <h3>Your Team, You Ignited!</h3>
                <a href="/Dashboard" class="text-center"><img src="assets/images/icon/svg/card.svg"><h6>Account</h6></a>
            </div><br>
            

            
        </div>
    </header>
    <!-- header end -->

    <!-- section starts -->
    <section class="section-b-space">
        <div class="custom-container">
            <div class="row g-3">
                
                <div class="col-6">
                    <div class="product-box" style="background-color: #0d3ff5;">
                        <div class="product-content">
                            <h5 style="color: #fff;">Sign-Ups</h5>
                            <div class="bottom-content">
                                <h4 style="color: #fff;">😍 {{ $number_of_referrals ?? 0 }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="product-box" style="background-color: #0d3ff5;">
                        <div class="product-content">
                            <h5 style="color: #fff;">Active Members</h5>
                            <div class="bottom-content">
                                <h4 style="color: #fff;">😎 {{ $active_referrals ?? 0 }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="product-box" style="background-color: #ffe00b;">
                        <div class="product-content">
                            <h2 style="color: #000;">Ignite Bonus</h2>
                            <div class="bottom-content text-center">
                                <h2 style="color: #000;">₹ {{ number_format($ignite_payout ?? 0) }}</h2>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
            <br><hr>
            
            
            
            
            
            
            
            <div class="title">
                <h3>Know Your Direct Team!</h3>
            </div>

            <div class="row gy-3 gx-0">
                
                @foreach($data as $item)
                 <div class="col-12">
                    <div class="product-box vertical-product"   style="background-color: {{ $item->activation_status == 'success' ? '#a1fdc0' : '#fda1a1' }};">
                        
                        <div class="product-content">
                            <h6 style="color: green;">{{ $item->activation_status == 'success' ? 'Active' : 'Inactive' }}</h6>
                            <a href="#" class="product-top">
                                <h3 class="title-color white-nowrap">{{$item->name}} - {{$item->fromId}}</h3>
                                <p>Active Date: {{$item->date}}</p>
                                <p>Mail: {{$item->email}}</p>
                                <p>Mobile: {{$item->mobile}}</p>
                            </a>
                        </div>
                        <div class="see-all">
                            <img   src="{{ $item->profile_photo ? asset('profile/'.$item->profile_photo) : asset('assets/images/avatar/uc.png') }}" alt="profile"  class="product-img" alt="">
                        </div>
                    </div>
                </div>
                @endforeach

                    @foreach($inactive as $item)
                 <div class="col-12">
                    <div class="product-box vertical-product"   style="background-color:#fda1a1;">
                        
                        <div class="product-content">
                            <h6 style="color: red;">Inactive</h6>
                            <a href="#" class="product-top">
                                <h3 class="title-color white-nowrap">{{$item->name}} - {{$item->memberid}}</h3>
                             
                                <p>Mail: {{$item->email}}</p>
                                <p>Mobile: {{$item->mobile}}</p>
                            </a>
                        </div>
                        <div class="see-all">
                            <img   src="{{ $item->profile_photo ? asset('profile/'.$item->profile_photo) : asset('assets/images/avatar/uc.png') }}" alt="profile"  class="product-img" alt="">
                        </div>
                    </div>
                </div>
                @endforeach
                
            </div>



        </div>
    </section>
    <!-- section ends -->


    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/iconsax-icon.js"></script>
    <script src="assets/js/template-setting.js"></script>
    <script src="assets/js/script.js"></script>
</body>

</html>