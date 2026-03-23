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
                <a href="/">
                    <img class="img-fluid icon-btn back-arrow" src="assets/images/svg/back-arrow.svg" alt="back-arrow">
                </a>
            </div>
        </div>
    </header>
    <!-- header end -->

    <!-- signup section starts -->
    <section class="section-sm-t-space section-b-space">
        <div class="custom-container">
            <div class="auth-content text-center">
                <img class="img-fluid logo-sm" src="assets/images/logo/logo2.png" alt="logo-sm">
                <h1 class="title-center text-center" style="color: green;">Uniq Registration Successful!</h1>
                <h3 class="mt-2">Dear Mr/Ms. {{Auth::user()->name}},<br>Welcome To Uniq Family!</h3>
            </div><br><br>
            <div class="text-center">
                <h2><u>Login Credentials</u></h2><br>
                <h3>Your Uniq ID: {{Auth::user()->memberid}}</h3><br>
                <h3>Your Password: {{Auth::user()->pwd}}</h3>
            </div>
            <h5 class="text-center mt-24">
                Say Thanks To Mr/Ms. {{Auth::user()->promo}}
            </h5>
            
            <!--<a href="#" class="btn btn-primary w-100 auth-btn">Download Uniq App</a><br>-->
            <a href="/login" class="btn theme-btn w-100 auth-btn">Login!</a>

            
        </div>
    </section>
    
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/iconsax-icon.js"></script>
    <script src="assets/js/template-setting.js"></script>
    <script src="assets/js/script.js"></script>
</body>


</html>