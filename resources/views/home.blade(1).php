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
                    <a href="/UC_Shop">
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
                <a href="#" class="btn btn-small  btn-success">Invite Link!</a>
            </div>

            <!--<div class="row g-3">-->
            <!--    <div class="col-12">-->
            <!--        <a href="/ID_Card_Form" class="btn theme-btn w-100">Apply Uniq ID Card Now!</a>-->
            <!--    </div>-->
            <!--</div><br>-->

            <div class="row g-3">
                <div class="col-6">
                    <a href="#">
                        <div class="product-box" style="background-color: #0d3ff5;">
                            <div class="product-content">
                                <h5 style="color: #fff;">Total Earnings</h5>
                                <div class="bottom-content">
                                    <h5 style="color: #fff;">₹ 160</h5>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-6">
                    <a href="#">
                        <div class="product-box" style="background-color: #0d3ff5;">
                            <div class="product-content">
                                <h5 style="color: #fff;">Wallet Balance</h5>
                                <div class="bottom-content">
                                    <h5 style="color: #fff;">₹ 160</h5>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   


                <div class="col-12">
                    <a href="#">
                        <div class="product-box" style="background-color: #ffe00b;">
                            <div class="product-content">
                                <h5 style="color: #000;">Re-Purchase Value (RV)</h5>
                                <div class="bottom-content">
                                    <h5 style="color: #000;">800</h5>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class=" position-relative">
        <div class="swiper banner-slider">
            <div class="swiper-wrapper">
                
                   @foreach($slider as $item)
                 
                  
              
                <div class="swiper-slide">
                    <a href="/UC_Product_Description" class="banner-box">
                        <img class="img-fluid banner-img" src="https://uniqadmin.metrosoft.in/storage/app/public/{{$item->image_url }}" alt="banner">
                    </a>
                </div>
                
                 @endforeach
                <!--<div class="swiper-slide">-->
                <!--    <a href="/UC_Product_Description" class="banner-box">-->
                <!--        <img class="img-fluid banner-img" src="assets/images/banner/2.png" alt="banner">-->
                <!--    </a>-->
                <!--</div>-->
                <!--<div class="swiper-slide">-->
                <!--    <a href="/UC_Product_Description" class="banner-box">-->
                <!--        <img class="img-fluid banner-img" src="assets/images/banner/3.png" alt="banner">-->
                <!--    </a>-->
                <!--</div>-->
                <!--<div class="swiper-slide">-->
                <!--    <a href="/UC_Product_Description" class="banner-box">-->
                <!--        <img class="img-fluid banner-img" src="assets/images/banner/4.png" alt="banner">-->
                <!--    </a>-->
                <!--</div>-->
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
                            <img src="assets/images/product/1.png" class="img-fluid img" alt="">
                            <div class="like-icon animate ">
                                <img class="img-fluid icon outline-icon" src="assets/images/svg/heart-outline.svg"
                                    alt="">
                                <img class="img-fluid icon fill-icon" src="assets/images/svg/heart-fill.svg" alt="">
                               
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
                                <h5 class="price">₹ {{$item->price}} <del>₹ {{$item->mrp}}</del></h5>
                                <div class="see-all">PV {{$item->pv}}</div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                <!--<div class="col-6">-->
                <!--    <div class="product-box">-->
                <!--        <div class="product-img">-->
                <!--            <div class="badge-img">-->
                <!--                <span>Hot</span>-->
                <!--            </div>-->
                <!--            <img src="assets/images/product/2.png" class="img-fluid img" alt="">-->
                <!--            <div class="like-icon animate active inactive">-->
                <!--                <img class="img-fluid icon outline-icon" src="assets/images/svg/heart-outline.svg"-->
                <!--                    alt="">-->
                <!--                <img class="img-fluid icon fill-icon" src="assets/images/svg/heart-fill.svg" alt="">-->
                <!--                <div class="effect-group">-->
                <!--                    <span class="effect"></span>-->
                <!--                    <span class="effect"></span>-->
                <!--                    <span class="effect"></span>-->
                <!--                    <span class="effect"></span>-->
                <!--                    <span class="effect"></span>-->
                <!--                </div>-->
                <!--            </div>-->
                <!--        </div>-->


                <!--        <div class="product-content">-->
                <!--            <a href="/UC_Shop" class="add-icon">-->
                <!--                <i class="iconsax" data-icon="add"></i>-->
                <!--            </a>-->

                <!--            <a href="/UC_Product_Description">-->
                <!--                <h6 class="content-color white-nowrap">UCWC</h6>-->
                <!--                <h5 class="title-color fw-medium white-nowrap mt-1">Herbal Detox Tea</h5>-->
                <!--            </a>-->
                <!--            <ul class="rating-list">-->
                <!--                <li>-->
                <!--                    <img src="assets/images/svg/star-fill.svg" alt="star">-->
                <!--                </li>-->
                <!--                <li>-->
                <!--                    <img src="assets/images/svg/star-fill.svg" alt="star">-->
                <!--                </li>-->
                <!--                <li>-->
                <!--                    <img src="assets/images/svg/star-fill.svg" alt="star">-->
                <!--                </li>-->
                <!--                <li>-->
                <!--                    <img src="assets/images/svg/star-fill.svg" alt="star">-->
                <!--                </li>-->
                <!--                <li>-->
                <!--                    <img src="assets/images/svg/star-outline.svg" alt="star">-->
                <!--                </li>-->
                <!--            </ul>-->
                <!--            <div class="bottom-content">-->
                <!--                <h5 class="price">₹ 20 <del>₹ 50</del></h5>-->
                <!--                <div class="see-all">PV 600</div>-->
                <!--            </div>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--</div>-->

                <!--<div class="col-6">-->
                <!--    <div class="product-box">-->
                <!--        <div class="product-img">-->
                <!--            <div class="badge-img">-->
                <!--                <span>Hot</span>-->
                <!--            </div>-->
                <!--            <img src="assets/images/product/3.png" class="img-fluid img" alt="">-->
                <!--            <div class="like-icon animate ">-->
                <!--                <img class="img-fluid icon outline-icon" src="assets/images/svg/heart-outline.svg"-->
                <!--                    alt="">-->
                <!--                <img class="img-fluid icon fill-icon" src="assets/images/svg/heart-fill.svg" alt="">-->
                <!--                <div class="effect-group">-->
                <!--                    <span class="effect"></span>-->
                <!--                    <span class="effect"></span>-->
                <!--                    <span class="effect"></span>-->
                <!--                    <span class="effect"></span>-->
                <!--                    <span class="effect"></span>-->
                <!--                </div>-->
                <!--            </div>-->
                <!--        </div>-->
                <!--        <div class="product-content">-->
                <!--            <a href="/UC_Shop" class="add-icon">-->
                <!--                <i class="iconsax" data-icon="add"></i>-->
                <!--            </a>-->
                <!--            <h6 class="content-color white-nowrap">UCWC</h6>-->
                <!--            <a href="/UC_Product_Description">-->
                <!--                <h5 class="title-color fw-medium white-nowrap mt-1">Dia Care Capsules</h5>-->
                <!--            </a>-->
                <!--            <ul class="rating-list">-->
                <!--                <li>-->
                <!--                    <img src="assets/images/svg/star-fill.svg" alt="star">-->
                <!--                </li>-->
                <!--                <li>-->
                <!--                    <img src="assets/images/svg/star-fill.svg" alt="star">-->
                <!--                </li>-->
                <!--                <li>-->
                <!--                    <img src="assets/images/svg/star-fill.svg" alt="star">-->
                <!--                </li>-->
                <!--                <li>-->
                <!--                    <img src="assets/images/svg/star-fill.svg" alt="star">-->
                <!--                </li>-->
                <!--                <li>-->
                <!--                    <img src="assets/images/svg/star-outline.svg" alt="star">-->
                <!--                </li>-->
                <!--            </ul>-->
                <!--            <div class="bottom-content">-->
                <!--                <h5 class="price">₹ 200 <del>₹ 250</del></h5>-->
                <!--                <div class="see-all">PV 600</div>-->
                <!--            </div>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--</div>-->
                <!--<div class="col-6">-->
                <!--    <div class="product-box">-->
                <!--        <div class="product-img">-->
                <!--            <div class="badge-img">-->
                <!--                <span>Hot</span>-->
                <!--            </div>-->
                <!--            <img src="assets/images/product/4.png" class="img-fluid img" alt="">-->
                <!--            <div class="like-icon animate active inactive">-->
                <!--                <img class="img-fluid icon outline-icon" src="assets/images/svg/heart-outline.svg"-->
                <!--                    alt="">-->
                <!--                <img class="img-fluid icon fill-icon" src="assets/images/svg/heart-fill.svg" alt="">-->
                <!--                <div class="effect-group">-->
                <!--                    <span class="effect"></span>-->
                <!--                    <span class="effect"></span>-->
                <!--                    <span class="effect"></span>-->
                <!--                    <span class="effect"></span>-->
                <!--                    <span class="effect"></span>-->
                <!--                </div>-->
                <!--            </div>-->
                <!--        </div>-->

                <!--        <div class="product-content">-->
                <!--            <a href="/UC_Shop" class="add-icon">-->
                <!--                <i class="iconsax" data-icon="add"></i>-->
                <!--            </a>-->

                <!--            <a href="/UC_Product_Description">-->
                <!--                <h6 class="content-color white-nowrap">UCWC</h6>-->
                <!--                <h5 class="title-color fw-medium white-nowrap mt-1">Multi Vitamin Capsules</h5>-->
                <!--            </a>-->
                <!--            <ul class="rating-list">-->
                <!--                <li>-->
                <!--                    <img src="assets/images/svg/star-fill.svg" alt="star">-->
                <!--                </li>-->
                <!--                <li>-->
                <!--                    <img src="assets/images/svg/star-fill.svg" alt="star">-->
                <!--                </li>-->
                <!--                <li>-->
                <!--                    <img src="assets/images/svg/star-fill.svg" alt="star">-->
                <!--                </li>-->
                <!--                <li>-->
                <!--                    <img src="assets/images/svg/star-fill.svg" alt="star">-->
                <!--                </li>-->
                <!--                <li>-->
                <!--                    <img src="assets/images/svg/star-outline.svg" alt="star">-->
                <!--                </li>-->
                <!--            </ul>-->
                <!--            <div class="bottom-content">-->
                <!--                <h5 class="price">₹ 10 <del>₹ 20</del></h5>-->
                <!--                <div class="see-all">PV 600</div>-->
                <!--            </div>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--</div>-->
                <!--<div class="col-6">-->
                <!--    <div class="product-box">-->
                <!--        <div class="product-img">-->
                <!--            <div class="badge-img">-->
                <!--                <span> Out Of Stock</span>-->
                <!--            </div>-->
                <!--            <img src="assets/images/product/3a.png" class="img-fluid img" alt="">-->
                <!--            <div class="like-icon animate ">-->
                <!--                <img class="img-fluid icon outline-icon" src="assets/images/svg/heart-outline.svg"-->
                <!--                    alt="">-->
                <!--                <img class="img-fluid icon fill-icon" src="assets/images/svg/heart-fill.svg" alt="">-->
                <!--                <div class="effect-group">-->
                <!--                    <span class="effect"></span>-->
                <!--                    <span class="effect"></span>-->
                <!--                    <span class="effect"></span>-->
                <!--                    <span class="effect"></span>-->
                <!--                    <span class="effect"></span>-->
                <!--                </div>-->
                <!--            </div>-->
                <!--        </div>-->
                <!--        <div class="product-content">-->
                <!--            <a href="/UC_Shop" class="add-icon">-->
                <!--                <i class="iconsax" data-icon="add"></i>-->
                <!--            </a>-->
                <!--            <h6 class="content-color white-nowrap">UCWC</h6>-->
                <!--            <a href="/UC_Product_Description">-->
                <!--                <h5 class="title-color fw-medium white-nowrap mt-1">Man Power Capsules</h5>-->
                <!--            </a>-->
                <!--            <ul class="rating-list">-->
                <!--                <li>-->
                <!--                    <img src="assets/images/svg/star-fill.svg" alt="star">-->
                <!--                </li>-->
                <!--                <li>-->
                <!--                    <img src="assets/images/svg/star-fill.svg" alt="star">-->
                <!--                </li>-->
                <!--                <li>-->
                <!--                    <img src="assets/images/svg/star-fill.svg" alt="star">-->
                <!--                </li>-->
                <!--                <li>-->
                <!--                    <img src="assets/images/svg/star-fill.svg" alt="star">-->
                <!--                </li>-->
                <!--                <li>-->
                <!--                    <img src="assets/images/svg/star-outline.svg" alt="star">-->
                <!--                </li>-->
                <!--            </ul>-->
                <!--            <div class="bottom-content">-->
                <!--                <h5 class="price">₹ 200 <del>₹ 250</del></h5>-->
                <!--                <div class="see-all">PV 600</div>-->
                <!--            </div>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--</div>-->
                <!--<div class="col-6">-->
                <!--    <div class="product-box">-->
                <!--        <div class="product-img">-->
                <!--            <div class="badge-img">-->
                <!--                <span> Out Of Stock</span>-->
                <!--            </div>-->
                <!--            <img src="assets/images/product/4a.png" class="img-fluid img" alt="">-->
                <!--            <div class="like-icon animate active inactive">-->
                <!--                <img class="img-fluid icon outline-icon" src="assets/images/svg/heart-outline.svg"-->
                <!--                    alt="">-->
                <!--                <img class="img-fluid icon fill-icon" src="assets/images/svg/heart-fill.svg" alt="">-->
                <!--                <div class="effect-group">-->
                <!--                    <span class="effect"></span>-->
                <!--                    <span class="effect"></span>-->
                <!--                    <span class="effect"></span>-->
                <!--                    <span class="effect"></span>-->
                <!--                    <span class="effect"></span>-->
                <!--                </div>-->
                <!--            </div>-->
                <!--        </div>-->

                <!--        <div class="product-content">-->
                <!--            <a href="/UC_Shop" class="add-icon">-->
                <!--                <i class="iconsax" data-icon="add"></i>-->
                <!--            </a>-->

                <!--            <a href="/UC_Product_Description">-->
                <!--                <h6 class="content-color white-nowrap">UCWC</h6>-->
                <!--                <h5 class="title-color fw-medium white-nowrap mt-1">Man Power Oil</h5>-->
                <!--            </a>-->
                <!--            <ul class="rating-list">-->
                <!--                <li>-->
                <!--                    <img src="assets/images/svg/star-fill.svg" alt="star">-->
                <!--                </li>-->
                <!--                <li>-->
                <!--                    <img src="assets/images/svg/star-fill.svg" alt="star">-->
                <!--                </li>-->
                <!--                <li>-->
                <!--                    <img src="assets/images/svg/star-fill.svg" alt="star">-->
                <!--                </li>-->
                <!--                <li>-->
                <!--                    <img src="assets/images/svg/star-fill.svg" alt="star">-->
                <!--                </li>-->
                <!--                <li>-->
                <!--                    <img src="assets/images/svg/star-outline.svg" alt="star">-->
                <!--                </li>-->
                <!--            </ul>-->
                <!--            <div class="bottom-content">-->
                <!--                <h5 class="price">₹ 10 <del>₹ 20</del></h5>-->
                <!--                <div class="see-all">PV 600</div>-->
                <!--            </div>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--</div>-->
            </div>

            
        </div>
    </section>
    <section>
        <div class="custom-container">
            <div class="title">
                <div class="d-flex align-items-center gap-2">
                    <h3>Flash Sale</h3>
                    <div class="title-timer" id="clock">
                        <i class="iconsax clock" data-icon="clock"> </i>

                        <div class="counter">
                            <span class="hours"></span>
                        </div>
                        <div class="counter">
                            <span class="minutes"></span>
                        </div>
                        <div class="counter">
                            <span class="seconds"></span>
                        </div>
                    </div>
                </div>
                <a href="/UC_Shop" class="see-all">Shop Now<</a>

            </div>
            <a href="/UC_Shop" class="banner-box">
                <img class="img-fluid banner-img w-100 radius-10" src="assets/images/banner/5.png" alt="banner">
            </a>

            <!--<div class="row g-3">-->
            <!--    <div class="col-6">-->
            <!--        <div class="product-box">-->
            <!--            <div class="product-img">-->
                            <!--<div class="badge-img">
            <!--                    <span> Sale</span>-->
            <!--                </div>-->
            <!--                <img src="assets/images/product/1.png" class="img-fluid img" alt="">-->
            <!--                <div class="like-icon animate ">-->
            <!--                    <img class="img-fluid icon outline-icon" src="assets/images/svg/heart-outline.svg"-->
            <!--                        alt="">-->
            <!--                    <img class="img-fluid icon fill-icon" src="assets/images/svg/heart-fill.svg" alt="">-->
            <!--                    <div class="effect-group">-->
            <!--                        <span class="effect"></span>-->
            <!--                        <span class="effect"></span>-->
            <!--                        <span class="effect"></span>-->
            <!--                        <span class="effect"></span>-->
            <!--                        <span class="effect"></span>-->
            <!--                    </div>-->
            <!--                </div>-->
            <!--            </div>-->
            <!--            <div class="product-content">-->
            <!--                <a href="/UC_Shop" class="add-icon">-->
            <!--                    <i class="iconsax" data-icon="add"></i>-->
            <!--                </a>-->
            <!--                <h6 class="content-color white-nowrap">UCWC</h6>-->
            <!--                <a href="/UC_Product_Description">-->
            <!--                    <h5 class="title-color fw-medium white-nowrap mt-1">Super Antioxidant Juice</h5>-->
            <!--                </a>-->
            <!--                <ul class="rating-list">-->
            <!--                    <li>-->
            <!--                        <img src="assets/images/svg/star-fill.svg" alt="star">-->
            <!--                    </li>-->
            <!--                    <li>-->
            <!--                        <img src="assets/images/svg/star-fill.svg" alt="star">-->
            <!--                    </li>-->
            <!--                    <li>-->
            <!--                        <img src="assets/images/svg/star-fill.svg" alt="star">-->
            <!--                    </li>-->
            <!--                    <li>-->
            <!--                        <img src="assets/images/svg/star-fill.svg" alt="star">-->
            <!--                    </li>-->
            <!--                    <li>-->
            <!--                        <img src="assets/images/svg/star-outline.svg" alt="star">-->
            <!--                    </li>-->
            <!--                </ul>-->
            <!--                <div class="bottom-content">-->
            <!--                    <h5 class="price">₹ 320 <del>₹ 350</del></h5>-->
            <!--                </div>-->
            <!--            </div>-->
            <!--        </div>-->
            <!--    </div>-->
            <!--    <div class="col-6">-->
            <!--        <div class="product-box">-->
            <!--            <div class="product-img">-->
            <!--                <img src="assets/images/product/2.png" class="img-fluid img" alt="">-->
            <!--                <div class="like-icon animate active inactive">-->
            <!--                    <img class="img-fluid icon outline-icon" src="assets/images/svg/heart-outline.svg"-->
            <!--                        alt="">-->
            <!--                    <img class="img-fluid icon fill-icon" src="assets/images/svg/heart-fill.svg" alt="">-->
            <!--                    <div class="effect-group">-->
            <!--                        <span class="effect"></span>-->
            <!--                        <span class="effect"></span>-->
            <!--                        <span class="effect"></span>-->
            <!--                        <span class="effect"></span>-->
            <!--                        <span class="effect"></span>-->
            <!--                    </div>-->
            <!--                </div>-->
            <!--            </div>-->


            <!--            <div class="product-content">-->
            <!--                <a href="/UC_Shop" class="add-icon">-->
            <!--                    <i class="iconsax" data-icon="add"></i>-->
            <!--                </a>-->

            <!--                <a href="/UC_Product_Description">-->
            <!--                    <h6 class="content-color white-nowrap">UCWC</h6>-->
            <!--                    <h5 class="title-color fw-medium white-nowrap mt-1">Herbal Detox Tea</h5>-->
            <!--                </a>-->
            <!--                <ul class="rating-list">-->
            <!--                    <li>-->
            <!--                        <img src="assets/images/svg/star-fill.svg" alt="star">-->
            <!--                    </li>-->
            <!--                    <li>-->
            <!--                        <img src="assets/images/svg/star-fill.svg" alt="star">-->
            <!--                    </li>-->
            <!--                    <li>-->
            <!--                        <img src="assets/images/svg/star-fill.svg" alt="star">-->
            <!--                    </li>-->
            <!--                    <li>-->
            <!--                        <img src="assets/images/svg/star-fill.svg" alt="star">-->
            <!--                    </li>-->
            <!--                    <li>-->
            <!--                        <img src="assets/images/svg/star-outline.svg" alt="star">-->
            <!--                    </li>-->
            <!--                </ul>-->
            <!--                <div class="bottom-content">-->
            <!--                    <h5 class="price">₹ 20 <del>₹ 50</del></h5>-->
            <!--                </div>-->
            <!--            </div>-->
            <!--        </div>-->
            <!--    </div>-->

            <!--    <div class="col-6">-->
            <!--        <div class="product-box">-->
            <!--            <div class="product-img">-->
            <!--                <img src="assets/images/product/3.png" class="img-fluid img" alt="">-->
            <!--                <div class="like-icon animate ">-->
            <!--                    <img class="img-fluid icon outline-icon" src="assets/images/svg/heart-outline.svg"-->
            <!--                        alt="">-->
            <!--                    <img class="img-fluid icon fill-icon" src="assets/images/svg/heart-fill.svg" alt="">-->
            <!--                    <div class="effect-group">-->
            <!--                        <span class="effect"></span>-->
            <!--                        <span class="effect"></span>-->
            <!--                        <span class="effect"></span>-->
            <!--                        <span class="effect"></span>-->
            <!--                        <span class="effect"></span>-->
            <!--                    </div>-->
            <!--                </div>-->
            <!--            </div>-->
            <!--            <div class="product-content">-->
            <!--                <a href="/UC_Shop" class="add-icon">-->
            <!--                    <i class="iconsax" data-icon="add"></i>-->
            <!--                </a>-->
            <!--                <h6 class="content-color white-nowrap">UCWC</h6>-->
            <!--                <a href="/UC_Product_Description">-->
            <!--                    <h5 class="title-color fw-medium white-nowrap mt-1">Dia Care Capsules</h5>-->
            <!--                </a>-->
            <!--                <ul class="rating-list">-->
            <!--                    <li>-->
            <!--                        <img src="assets/images/svg/star-fill.svg" alt="star">-->
            <!--                    </li>-->
            <!--                    <li>-->
            <!--                        <img src="assets/images/svg/star-fill.svg" alt="star">-->
            <!--                    </li>-->
            <!--                    <li>-->
            <!--                        <img src="assets/images/svg/star-fill.svg" alt="star">-->
            <!--                    </li>-->
            <!--                    <li>-->
            <!--                        <img src="assets/images/svg/star-fill.svg" alt="star">-->
            <!--                    </li>-->
            <!--                    <li>-->
            <!--                        <img src="assets/images/svg/star-outline.svg" alt="star">-->
            <!--                    </li>-->
            <!--                </ul>-->
            <!--                <div class="bottom-content">-->
            <!--                    <h5 class="price">₹ 200 <del>₹ 250</del></h5>-->
            <!--                </div>-->
            <!--            </div>-->
            <!--        </div>-->
            <!--    </div>-->
            <!--    <div class="col-6">-->
            <!--        <div class="product-box">-->
            <!--            <div class="product-img">-->

            <!--                <img src="assets/images/product/4.png" class="img-fluid img" alt="">-->
            <!--                <div class="like-icon animate active inactive">-->
            <!--                    <img class="img-fluid icon outline-icon" src="assets/images/svg/heart-outline.svg"-->
            <!--                        alt="">-->
            <!--                    <img class="img-fluid icon fill-icon" src="assets/images/svg/heart-fill.svg" alt="">-->
            <!--                    <div class="effect-group">-->
            <!--                        <span class="effect"></span>-->
            <!--                        <span class="effect"></span>-->
            <!--                        <span class="effect"></span>-->
            <!--                        <span class="effect"></span>-->
            <!--                        <span class="effect"></span>-->
            <!--                    </div>-->
            <!--                </div>-->
            <!--            </div>-->

            <!--            <div class="product-content">-->
            <!--                <a href="/UC_Shop" class="add-icon">-->
            <!--                    <i class="iconsax" data-icon="add"></i>-->
            <!--                </a>-->

            <!--                <a href="/UC_Product_Description">-->
            <!--                    <h6 class="content-color white-nowrap">UCWC</h6>-->
            <!--                    <h5 class="title-color fw-medium white-nowrap mt-1">Multi Vitamin Capsules</h5>-->
            <!--                </a>-->
            <!--                <ul class="rating-list">-->
            <!--                    <li>-->
            <!--                        <img src="assets/images/svg/star-fill.svg" alt="star">-->
            <!--                    </li>-->
            <!--                    <li>-->
            <!--                        <img src="assets/images/svg/star-fill.svg" alt="star">-->
            <!--                    </li>-->
            <!--                    <li>-->
            <!--                        <img src="assets/images/svg/star-fill.svg" alt="star">-->
            <!--                    </li>-->
            <!--                    <li>-->
            <!--                        <img src="assets/images/svg/star-fill.svg" alt="star">-->
            <!--                    </li>-->
            <!--                    <li>-->
            <!--                        <img src="assets/images/svg/star-outline.svg" alt="star">-->
            <!--                    </li>-->
            <!--                </ul>-->
            <!--                <div class="bottom-content">-->
            <!--                    <h5 class="price">₹ 10 <del>₹ 20</del></h5>-->
            <!--                </div>-->
            <!--            </div>-->
            <!--        </div>-->
            <!--    </div>-->

                
            <!--</div>-->
        </div>
    </section>
    <!-- flash sale section start -->
    

    <!-- recommended section start -->
    <section>
        <div class="custom-container">
            <div class="title">
                <h3>Business Tools</h3>
                <a href="/UC_Shop" class="btn btn-small shop-btn">Shop Now</a>
            </div>
            <div class="row g-3">
                @foreach($business_list as $item)
                <div class="col-6">
                    <div class="product-box">
                        <div class="product-img">
                            <div class="badge-img">
                                <span>{{$item->tag}}</span>
                            </div>
                            <img src="assets/images/product/1.png" class="img-fluid img" alt="">
                            <div class="like-icon animate ">
                                <img class="img-fluid icon outline-icon" src="assets/images/svg/heart-outline.svg"
                                    alt="">
                                <img class="img-fluid icon fill-icon" src="assets/images/svg/heart-fill.svg" alt="">
                               
                            </div>
                        </div>
                        <div class="product-content">
                            <a href="/UC_Shop" class="add-icon">
                                <i class="iconsax" data-icon="add"></i>
                            </a>
                            <h6 class="content-color white-nowrap">UCWC</h6>
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
                                <h5 class="price">₹ {{$item->price}} <del>₹ {{$item->mrp}}</del></h5>
                                <div class="see-all">PV {{$item->pv}}</div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </section><br><br>
    <!-- recommended section end -->

    <!-- deals of day section start -->
    <section>
        <div class="custom-container">
            <div class="title">
                <h3>Cut-Off Offer</h3>
                <a href="/UC_Shop" class="see-all">Shop Now</a>
            </div>
            <a href="/UC_Shop" class="banner-box">
                <img class="img-fluid banner-img w-100 radius-10" src="assets/images/banner/5.png" alt="banner">
            </a>
        </div>
    </section>
    <!-- deals of day section end -->

    


    <!-- best sale section start -->
    <!--<section>
        <div class="custom-container">
            <div class="title">
                <h3>Best Selling</h3>
                <a href="#" class="see-all">See all</a>
            </div>

            <div class="row g-3">
                <div class="col-6">
                    <div class="product-box">
                        <div class="product-img">
                            <div class="badge-img">
                                <span>Hot</span>
                            </div>
                            <img src="assets/images/product/1.png" class="img-fluid img" alt="">
                            <div class="like-icon animate ">
                                <img class="img-fluid icon outline-icon" src="assets/images/svg/heart-outline.svg"
                                    alt="">
                                <img class="img-fluid icon fill-icon" src="assets/images/svg/heart-fill.svg" alt="">
                                <div class="effect-group">
                                    <span class="effect"></span>
                                    <span class="effect"></span>
                                    <span class="effect"></span>
                                    <span class="effect"></span>
                                    <span class="effect"></span>
                                </div>
                            </div>
                        </div>
                        <div class="product-content">
                            <a href="/UC_Shop" class="add-icon">
                                <i class="iconsax" data-icon="add"></i>
                            </a>
                            <h6 class="content-color white-nowrap">UCWC</h6>
                            <a href="product-details.html">
                                <h5 class="title-color fw-medium white-nowrap mt-1">Super Antioxidant Juice</h5>
                            </a>
                            <ul class="rating-list">
                                <li>
                                    <img src="assets/images/svg/star-fill.svg" alt="star">
                                </li>
                                <li>
                                    <img src="assets/images/svg/star-fill.svg" alt="star">
                                </li>
                                <li>
                                    <img src="assets/images/svg/star-fill.svg" alt="star">
                                </li>
                                <li>
                                    <img src="assets/images/svg/star-fill.svg" alt="star">
                                </li>
                                <li>
                                    <img src="assets/images/svg/star-outline.svg" alt="star">
                                </li>
                            </ul>
                            <div class="bottom-content">
                                <h5 class="price">₹ 320 <del>₹ 350</del></h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="product-box">
                        <div class="product-img">
                            <img src="assets/images/product/2.png" class="img-fluid img" alt="">
                            <div class="like-icon animate active inactive">
                                <img class="img-fluid icon outline-icon" src="assets/images/svg/heart-outline.svg"
                                    alt="">
                                <img class="img-fluid icon fill-icon" src="assets/images/svg/heart-fill.svg" alt="">
                                <div class="effect-group">
                                    <span class="effect"></span>
                                    <span class="effect"></span>
                                    <span class="effect"></span>
                                    <span class="effect"></span>
                                    <span class="effect"></span>
                                </div>
                            </div>
                        </div>


                        <div class="product-content">
                            <a href="/UC_Shop" class="add-icon">
                                <i class="iconsax" data-icon="add"></i>
                            </a>

                            <a href="product-details.html">
                                <h6 class="content-color white-nowrap">UCWC</h6>
                                <h5 class="title-color fw-medium white-nowrap mt-1">Herbal Detox Tea</h5>
                            </a>
                            <ul class="rating-list">
                                <li>
                                    <img src="assets/images/svg/star-fill.svg" alt="star">
                                </li>
                                <li>
                                    <img src="assets/images/svg/star-fill.svg" alt="star">
                                </li>
                                <li>
                                    <img src="assets/images/svg/star-fill.svg" alt="star">
                                </li>
                                <li>
                                    <img src="assets/images/svg/star-fill.svg" alt="star">
                                </li>
                                <li>
                                    <img src="assets/images/svg/star-outline.svg" alt="star">
                                </li>
                            </ul>
                            <div class="bottom-content">
                                <h5 class="price">₹ 20 <del>₹ 50</del></h5>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-6">
                    <div class="product-box">
                        <div class="product-img">
                            <img src="assets/images/product/3.png" class="img-fluid img" alt="">
                            <div class="like-icon animate ">
                                <img class="img-fluid icon outline-icon" src="assets/images/svg/heart-outline.svg"
                                    alt="">
                                <img class="img-fluid icon fill-icon" src="assets/images/svg/heart-fill.svg" alt="">
                                <div class="effect-group">
                                    <span class="effect"></span>
                                    <span class="effect"></span>
                                    <span class="effect"></span>
                                    <span class="effect"></span>
                                    <span class="effect"></span>
                                </div>
                            </div>
                        </div>
                        <div class="product-content">
                            <a href="/UC_Shop" class="add-icon">
                                <i class="iconsax" data-icon="add"></i>
                            </a>
                            <h6 class="content-color white-nowrap">UCWC</h6>
                            <a href="product-details.html">
                                <h5 class="title-color fw-medium white-nowrap mt-1">Dia Care Capsules</h5>
                            </a>
                            <ul class="rating-list">
                                <li>
                                    <img src="assets/images/svg/star-fill.svg" alt="star">
                                </li>
                                <li>
                                    <img src="assets/images/svg/star-fill.svg" alt="star">
                                </li>
                                <li>
                                    <img src="assets/images/svg/star-fill.svg" alt="star">
                                </li>
                                <li>
                                    <img src="assets/images/svg/star-fill.svg" alt="star">
                                </li>
                                <li>
                                    <img src="assets/images/svg/star-outline.svg" alt="star">
                                </li>
                            </ul>
                            <div class="bottom-content">
                                <h5 class="price">₹ 200 <del>₹ 250</del></h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="product-box">
                        <div class="product-img">
                            <div class="badge-img">
                                <span>Hot</span>
                            </div>
                            <img src="assets/images/product/4.png" class="img-fluid img" alt="">
                            <div class="like-icon animate active inactive">
                                <img class="img-fluid icon outline-icon" src="assets/images/svg/heart-outline.svg"
                                    alt="">
                                <img class="img-fluid icon fill-icon" src="assets/images/svg/heart-fill.svg" alt="">
                                <div class="effect-group">
                                    <span class="effect"></span>
                                    <span class="effect"></span>
                                    <span class="effect"></span>
                                    <span class="effect"></span>
                                    <span class="effect"></span>
                                </div>
                            </div>
                        </div>

                        <div class="product-content">
                            <a href="/UC_Shop" class="add-icon">
                                <i class="iconsax" data-icon="add"></i>
                            </a>

                            <a href="product-details.html">
                                <h6 class="content-color white-nowrap">UCWC</h6>
                                <h5 class="title-color fw-medium white-nowrap mt-1">Multi Vitamin Capsules</h5>
                            </a>
                            <ul class="rating-list">
                                <li>
                                    <img src="assets/images/svg/star-fill.svg" alt="star">
                                </li>
                                <li>
                                    <img src="assets/images/svg/star-fill.svg" alt="star">
                                </li>
                                <li>
                                    <img src="assets/images/svg/star-fill.svg" alt="star">
                                </li>
                                <li>
                                    <img src="assets/images/svg/star-fill.svg" alt="star">
                                </li>
                                <li>
                                    <img src="assets/images/svg/star-outline.svg" alt="star">
                                </li>
                            </ul>
                            <div class="bottom-content">
                                <h5 class="price">₹ 10 <del>₹ 20</del></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>-->
    <!-- best sale section start -->

    <!-- deals of week section start -->
    <!-- <section>
        <div class="custom-container">
            <div class="title">
                <h3>Deals of The Week</h3>
                <a href="deals.html" class="see-all">See all</a>
            </div>
            <a href="/UC_Shop" class="banner-box">
                <img class="img-fluid banner-img w-100 radius-10" src="assets/images/banner/6.png" alt="banner">
            </a>
        </div>
    </section> -->
    <!-- deals of week section end -->

    <!-- Shop section start -->
    <!--<section class="section-b-space">
        <div class="custom-container">
            <div class="title">
                <h3>Shop for her</h3>
                <a href="/UC_Shop" class="see-all">See all</a>
            </div>
            <div class="row gy-3 gx-0">
                <div class="col-12">
                    <div class="product-box vertical-product">
                        <a href="product-details.html" class="product-img">
                            <img src="assets/images/product/11.png" class="img-fluid" alt="">
                        </a>
                        <div class="product-content">
                            <h6 class="content-color">Apple</h6>
                            <a href="product-details.html" class="product-top">
                                <h5 class="title-color white-nowrap">Smart TV System </h5>
                            </a>
                            <div class="bottom-content">
                                <h5 class="price">₹ 450 <del>₹ 460</del></h5>
                            </div>
                        </div>
                        <div class="like-icon animate ">
                            <img class="img-fluid icon outline-icon" src="assets/images/svg/heart-outline.svg" alt="">
                            <img class="img-fluid icon fill-icon" src="assets/images/svg/heart-fill.svg" alt="">
                            <div class="effect-group">
                                <span class="effect"></span>
                                <span class="effect"></span>
                                <span class="effect"></span>
                                <span class="effect"></span>
                                <span class="effect"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="product-box vertical-product">
                        <a href="product-details.html" class="product-img">
                            <img src="assets/images/product/12.png" class="img-fluid" alt="">
                        </a>
                        <div class="product-content">
                            <h6 class="content-color">Gadgets</h6>
                            <a href="product-details.html" class="product-top">
                                <h5 class="title-color white-nowrap">Latest Smart Camera </h5>
                            </a>
                            <div class="bottom-content">
                                <h5 class="price">₹ 450 <del>₹ 460</del></h5>
                            </div>
                        </div>
                        <div class="like-icon animate ">
                            <img class="img-fluid icon outline-icon" src="assets/images/svg/heart-outline.svg" alt="">
                            <img class="img-fluid icon fill-icon" src="assets/images/svg/heart-fill.svg" alt="">
                            <div class="effect-group">
                                <span class="effect"></span>
                                <span class="effect"></span>
                                <span class="effect"></span>
                                <span class="effect"></span>
                                <span class="effect"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>-->
    <!-- Shop section end -->

    <!-- tap to top start -->
    <div class="tap-to-top-box">
        <a href="#" class="scroll scroll-to-top">
            <i class="iconsax arrow" data-icon="arrow-up"></i>
            Tap to Top
        </a>
    </div>
    <!-- tap to top end -->

    <!-- bottom panel start -->
    <ul class="bottom-menu">
        <li><a href="/Home" class="active"><i class="iconsax text-content" data-icon="home-2"></i><h6>Home</h6></a></li>
        <li><a href="/Dashboard"><i class="iconsax text-content" data-icon="grid-apps"></i><h6>Account</h6></a></li>
        <li><a href="/UC_Wallet"><i class="iconsax text-content" data-icon="wallet-1"></i><h6>Wallet</h6></a></li>
        <li><a href="/Orders"><i class="iconsax text-content" data-icon="shop"></i><h6>Orders</h6></a></li>
        <li><a href="/Profile"><i class="iconsax text-content" data-icon="user-2"></i><h6>Profile</h6></a></li>
        <li><a href="/ToDo"><i class="iconsax text-content" data-icon="calendar-add"></i><h6>Todo</h6></a></li>
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
                <img class="img-fluid profile-pic" src="assets/images/avatar/uc.png" alt="p8">
                <div>
                    <h3>{{Auth::user()->name ;}}</h3>
                    <span>{{Auth::user()->memberid ;}}</span>
                    <h5>[member_rank]</h5>
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
                <a href="/logout" class="pages">
                    <i class="iconsax sidebar-icon" data-icon="logout-2"> </i>
                    <h3>Logout</h3>
                </a>
            </div>
        </div>
    </div>
    <!-- sidebar end -->

    
    <script src="assets/js/swiper-bundle.min.js"></script>
    <script src="assets/js/custom-swiper.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/iconsax-icon.js"></script>
    <script src="assets/js/template-setting.js"></script>
    <script src="assets/js/range-slider.js"></script>
    <script src="assets/js/timer.js"></script>
    <script src="assets/js/tap-to-top.js"></script>
    <script src="assets/js/script.js"></script>
</body>


</html>