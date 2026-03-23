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
                <h3>Your Auto-Ignited Rebirths!</h3>
                <a href="/Dashboard" class="text-center"><img src="assets/images/icon/svg/card.svg"><h6>Account</h6></a>
            </div>
            
        </div>
    </header>
    <!-- header end -->

    <!-- section starts -->
    <section class="section-b-space">
        <div class="custom-container">
            <div class="row g-3 pt-3">
                
                <div class="col-12">
                    <a href="#"><div class="product-box" style="background-color: #0d3ff5;">
                        <div class="product-box vertical-product">
                            <div class="product-content">
                                <h5 style="color: #fff;">Re-Ignite Bonus</h5>
                                <div class="bottom-content">
                                    <h4 style="color: #fff;">₹ {{ number_format($reignite_payout ?? 0) }}</h4>
                                </div>
                            </div>
                            <div class="see-all text-center">
                                <h6 style="color: #fff;">Re-Births</h6>
                                <h6 style="color: #fff;">{{ $data['rebirth_count'] ?? 0 }}</h6>
                            </div>
                        </div>
                    </div></a>
                </div>
                
            </div><br><hr>

            <div class="title">
                <h3>Your Re-Birth IDs!</h3>
            </div>

            <div class="row gy-3 gx-0">
                @if(isset($data['rebirth_ids']) && $data['rebirth_ids']->count() > 0)
                    @foreach($data['rebirth_ids'] as $rebirth)
                        <div class="col-12">
                            <a href="#"><div class="product-box vertical-product" style="background-color: #a1fdc0;">
                                <div class="product-content">
                                    <h6 style="color: green;">Active</h6>
                                    <a href="#" class="product-top">
                                        <h3 class="title-color white-nowrap">{{ $rebirth->memberid }}</h3>
                                        <p>Active Date: {{ $rebirth->created_at ? \Carbon\Carbon::parse($rebirth->created_at)->format('d/m/Y H:i A') : 'N/A' }}</p>
                                        <p>Name: {{ $rebirth->FullName ?? 'N/A' }}</p>
                                    </a>
                                </div>
                                <div class="see-all">
                                    <img src="assets/images/avatar/rb.png" class="product-img" alt="">
                                </div>
                            </div></a>
                        </div>
                    @endforeach
                @else
                    <div class="col-12">
                        <div class="product-box vertical-product" style="background-color: #fca5a5;">
                            <div class="product-content text-center">
                                <h6 style="color: red;">No Re-Birth IDs Found</h6>
                                <p style="color: #000;">You don't have any rebirth IDs yet.</p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>



        </div>
    </section><br><br><br><br><br>
    <!-- section ends -->


    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/iconsax-icon.js"></script>
    <script src="assets/js/template-setting.js"></script>
    <script src="assets/js/script.js"></script>
</body>

</html>