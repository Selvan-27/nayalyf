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
                <h3>Banking Details</h3>
            </div>
        </div>
    </header>
    <!-- header end -->

    <!-- profile section starts -->
    <section class="pt-0">
        <div class="profile-background edit-profile-bg">
            <div class="profile-part mt-2">
                <div class="profile-image">
                    <img id="output" class="img-fluid profile-pic" src="assets/images/avatar/uc.png" alt="11">
                </div>
                <h3>[member_name]</h3>
                <p>[member-id]</p>
                <p>[member_rank]</p>
            </div>
        </div>
    </section>

    <section class="section-b-space">
        <div class="custom-container">
            <form class="theme-form profile-form">
                
                <div class="form-group">
                    <label class="form-label" for="acname">A/C Holder Name</label>
                    <input type="text" class="form-control wo-icon" name="acname" Placeholder="Enter A/C Holder's Full Name">
                </div>

                <div class="form-group">
                    <label class="form-label" for="bankname">Bank Name</label>
                    <input type="text" class="form-control wo-icon" name="bankname" Placeholder="Enter Bank Name">
                </div>

                
                <div class="form-group">
                    <label class="form-label" for="branchname">Branch Name</label>
                    <input type="text" class="form-control wo-icon" name="branchname" Placeholder="Enter Bank's Branch Name">
                </div>

                <div class="form-group">
                    <label class="form-label" for="ifsc">IFSC Code</label>
                    <input type="text" class="form-control wo-icon" name="ifsc" Placeholder="Enter IFSC Code">
                </div>
                <div class="form-group">
                    <label class="form-label" for="acnumber">Bank Account Number</label>
                    <input type="number" class="form-control wo-icon" name="acnumber" Placeholder="Enter Bank Account Number">
                </div>
            </form>
        </div>

        <div class="fixed-btn-grp">
            <div class="custom-container">
                <a href="#" class="btn btn-mid theme-btn w-100">Update Banking Details</a>
            </div>
        </div>
    </section>

    <!-- profile section end -->

    <!-- panel-space start -->
    <div class="panel-space"></div>
    <!-- panel-space end -->

    <!-- bootstrap js -->
    <script src="assets/js/bootstrap.bundle.min.js"></script>

    <!-- iconsax icon -->
    <script src="assets/js/iconsax-icon.js"></script>

    <!-- template-setting js -->
    <script src="assets/js/template-setting.js"></script>

    <!-- image change js -->
    <script src="assets/js/image-change.js"></script>

    <!-- script js -->
    <script src="assets/js/script.js"></script>
</body>

</html>