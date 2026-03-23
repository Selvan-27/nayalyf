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

    

    

    <!-- banner section start -->

@yield('content')

    <!-- tap to top start -->
    <!--<div class="tap-to-top-box">-->
    <!--    <a href="#" class="scroll scroll-to-top">-->
    <!--        <i class="iconsax arrow" data-icon="arrow-up"></i>-->
    <!--        Tap to Top-->
    <!--    </a>-->
    <!--</div>-->
    <!-- tap to top end -->
@if($is_active ?? false)
    <!-- active bottom panel start -->
    <ul class="bottom-menu">
        <li><a href="/Home" class="active"><i class="iconsax text-content" data-icon="home-2"></i><h6>Home</h6></a></li>
        <li><a href="/shop"><i class="iconsax text-content" data-icon="shop"></i><h6>Shop</h6></a></li>
        <li><a href="/Dashboard"><i class="iconsax text-content" data-icon="grid-apps"></i><h6>Account</h6></a></li>
        <li><a href="/UC_Wallet"><i class="iconsax text-content" data-icon="wallet-1"></i><h6>Wallet</h6></a></li>
        <li><a href="/Profile"><i class="iconsax text-content" data-icon="user-2"></i><h6>Profile</h6></a></li>
        <!--<li><a href="/ToDo"><i class="iconsax text-content" data-icon="calendar-add"></i><h6>Todo</h6></a></li>-->
        <li><a href="/logout"><i class="iconsax text-content" data-icon="logout-2"></i><h6>Logout</h6></a></li>
    </ul>
    <!-- bottom panel end -->
@else
    <!--  Inactive bottom panel start -->
    <ul class="bottom-menu">
        <li><a href="/Home" class="active"><i class="iconsax text-content" data-icon="home-2"></i><h6>Home</h6></a></li>
        <li><a href="/shop"><i class="iconsax text-content" data-icon="shop"></i><h6>Shop</h6></a></li>
        <li><a href="/Orders"><i class="iconsax text-content" data-icon="grid-apps"></i><h6>Orders</h6></a></li>
        <li><a href="/Invites"><i class="iconsax text-content" data-icon="link-4"></i><h6>Invite</h6></a></li>
        <li><a href="/Profile2"><i class="iconsax text-content" data-icon="user-2"></i><h6>Profile</h6></a></li>
        @if(Auth::check())
        <li><a href="/logout"><i class="iconsax text-content" data-icon="logout-2"></i><h6>Logout</h6></a></li>
        
        @else
        <li><a href="/home"><i class="iconsax text-content" data-icon="logout-2"></i><h6>Login</h6></a></li>
        
        @endif
    </ul>
    <!-- bottom panel end -->

@endif
    <!-- sidebar starts -->
    <div class="offcanvas sidebar-offcanvas offcanvas-start" tabindex="-1" id="sidebar">
        <div class="offcanvas-header sidebar-header">
            <div class="sidebar-logo">
                <img class="img-fluid logo" src="assets/images/logo/logo.png" alt="logo">
            </div>
        </div>
        <div class="offcanvas-body">
            <div class="profile-part">
                @php
                    $photo = optional(Auth::user())->profile_photo;
                @endphp



                <img class="img-fluid profile-pic"   src="{{ $photo ? asset('profile/'.$photo) : asset('assets/images/avatar/uc.png') }}"  alt="p8">
                <div>
                    <h3>{{Auth::user()->name ?? "";}}</h3>
                    <span>{{Auth::user()->memberid ?? "";}}</span>
                    <h5>{{$member_rank ?? ""}}</h5>
                </div>
                
            </div>
            
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
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const currentPath = window.location.pathname;
            const menuLinks = document.querySelectorAll('.bottom-menu a');
    
            menuLinks.forEach(link => {
                // Remove existing active classes
                link.classList.remove('active');
    
                // Check if link href matches the current path
                if (link.getAttribute('href') === currentPath) {
                    link.classList.add('active');
                }
            });
        });
    </script>
    
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