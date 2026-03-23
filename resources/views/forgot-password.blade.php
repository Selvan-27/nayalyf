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
                <a href="login.html">
                    <img class="img-fluid icon-btn back-arrow" src="assets/images/svg/back-arrow.svg" alt="back-arrow">
                </a>
            </div>
        </div>
    </header>
    <!-- header end -->

    <!-- forgot password section starts -->
    <section class="section-sm-t-space section-b-space">
        <div class="custom-container">
            <div class="auth-content">
                <h1 class="title-color">Forgot your password?</h1>
                <h5 class="fw-normal content-color mt-2">Enter the email associated with your account and we’ll send an
                    email.
                </h5>
            </div>
            
            <form class="theme-form" action="/forgetPassword" method="POST">
                        @csrf
                <div class="form-group">
                    <label class="form-label" for="inputemail">MemberID</label>
                    <input type="text" class="form-control wo-icon" name="email" placeholder="Enter MemberID">
                </div>
            		    @if ($errors->has('login_error'))
    <div class="alert alert-danger  mt-5 ms-5 me-5">
        {{ $errors->first('login_error') }}
    </div>
@endif
		    @if ($errors->has('success'))
    <div class="alert alert-success mt-5 ms-5 me-5">
        {{ $errors->first('success') }}
    </div>
@endif
@if(session('success'))
    <div class="alert alert-success  mt-5 ms-5 me-5">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger  mt-5 ms-5 me-5">
        {{ session('error') }}
    </div>
@endif

            <button type="submit" class="btn theme-btn w-100 auth-btn">Send email</button>
</form>
            <a href="/" class="theme-color d-flex align-items-center justify-content-center gap-1 mt-24"> Skip,
                I’ll confirm later </a>
        </div>
    </section>
    <!-- forgot password section ends -->

    <!-- bootstrap js -->
    <script src="assets/js/bootstrap.bundle.min.js"></script>

    <!-- iconsax icon -->
    <script src="assets/js/iconsax-icon.js"></script>

    <!-- template-setting js -->
    <script src="assets/js/template-setting.js"></script>

    <!-- script js -->
    <script src="assets/js/script.js"></script>
</body>


<!-- Mirrored from themes.pixelstrap.com/pwa/kartify/forgot-password.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 12 Mar 2025 09:41:48 GMT -->
</html>