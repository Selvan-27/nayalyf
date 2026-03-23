<!DOCTYPE html>
<html lang="en">


<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="kartify">
    <meta name="keywords" content="kartify">
    <meta name="author" content="kartify">
    <link rel="manifest" href="manifest.json">
    <link rel="icon" href="assets/images/logo/favicon.png" type="image/x-icon">
    <title>Uniq Connect</title>
    <link rel="apple-touch-icon" href="assets/images/logo/favicon.png">
    <meta name="theme-color" content="#2777FC">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="kartify">
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
                <h3>Payment</h3>
            </div>
        </div>
    </header>
    <!-- header end -->

    <!-- checkout section starts -->
    <section class="section-sm-t-space">
        <div class="custom-container">
            <div class="title">
                <h3>Shipping address</h3>
            </div>

            <div class="address-box">
                <div class="address-head">
                    <div class="d-flex align-items-center gap-1">
                        <img class="img-fluid" src="assets/images/svg/location.svg" alt="location">
                        <h5 class="fw-medium title-color">Home</h5>
                    </div>
                </div>
                <div class="address-content">
                    <p>268 Dina Glens, North Reba, New York - 66788</p>
                </div>
            </div>
        </div>
    </section>

    <section class="section-lg-b-space">
        <div class="custom-container">
            <div class="title">
                <h3>Payment Method</h3>
                <a href="/Checkout" class="theme-color fw-medium">Change</a>
            </div>

            <h5 class="payment-part d-flex align-items-center gap-2 content-color fw-medium">
                <img class="img-fluid" src="assets/images/icon/svg/card.svg" alt="card">
                **** **** **** 8047
            </h5>

            <form class="theme-form">
                <div class="form-group">
                    <input type="text" class="form-control wo-icon" id="inputname" value="Ava Williams"
                        placeholder="Enter name">
                </div>

                <div class="form-group">
                    <input type="number" class="form-control wo-icon" id="inputnumber" value="4716962716358047"
                        placeholder="Enter number">
                </div>

                <div class="d-flex align-items-center gap-3">
                    <div class="form-group">
                        <input type="date" class="form-control wo-icon" id="inputcode" placeholder="Enter zip code">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control wo-icon" value="123" id="inputcode"
                            placeholder="Enter zip code">
                    </div>
                </div>
            </form>
        </div>
    </section>

    <div class="fixed-btn-grp">
        <div class="custom-container">
            <a href="#success" data-bs-toggle="modal" class="btn btn-mid theme-btn w-100">Pay ₹ 1200.00
            </a>
        </div>
    </div>
    <!-- checkout section ends -->

    <!-- success modal start -->
    <div class="modal fade centered-modal" tabindex="-1" id="success">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="d-grid align-content-center">
                        <img class="img-fluid success-img mx-auto" src="assets/images/gif/successfully.gif"
                            alt="successfully" />
                            <h3 class="text-center title-color fw-normal mt-1">Payment Successfully!</h3>
                            <h3 class="text-center title-color fw-normal mt-1">Your Order ID is OR436373</h3>
                        
                        <a href="/Track_Order" class="btn theme-btn  w-100 mt-3">Track Order</a>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- success modal end -->

   
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/iconsax-icon.js"></script>
    <script src="assets/js/template-setting.js"></script>
    <script src="assets/js/script.js"></script>
</body>

</html>