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
    <header class="main-header profile-header">
        <div class="custom-container">
            <div class="header-panel">
                <!--<a href="#sidebar" class="sidebar-btn" data-bs-toggle="offcanvas">-->
                <!--    <i class="iconsax" data-icon="text-align-left"></i>-->
                <!--</a>-->
                <h3>Activate Your Account Now!</h3>
            </div>
        </div>
    </header>
    <!-- header end -->

    <!-- profile section starts -->
    <section class="light-theme-bg">
        <div class="profile-background">
            <div class="profile-part">
                <div class="profile-image">
                    <img id="output" class="img-fluid profile-pic" src="assets/images/avatar/uc.png" alt="11">
                </div>
                <h3>[member_name]</h3>
                <p>[member-id]</p>
                   @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
                <form action="/activation_request" method="post">
                    @csrf
                    <input type="text" name="member_id" class="form-control w-100" >
                    <button type="submit" class="p-2 btn btn-primary w-100 btn-block" ><b>Activate Now!</b></button>
                </form>
            </div>
        </div><br><br>
    </section>

    <section class="pt-0">
        <div class="profile-wrapper">
            <ul class="profile-listing">
             
            <br>
                <!--<li>-->
                <!--    <a href="#center" data-bs-toggle="modal">-->
                <!--        <div class="profile-box color-1">-->
                <!--            <img class="img-fluid icon" src="assets/images/svg/edit.svg" alt="box">-->
                <!--        </div>-->
                <!--        <h5>Details</h5>-->
                <!--    </a>-->
                <!--</li>-->
                <!--<li>-->
                <!--    <a href="#idc" data-bs-toggle="modal">-->
                <!--        <div class="profile-box color-3">-->
                <!--            <img class="img-fluid icon" src="assets/images/svg/card.svg" alt="coupon">-->
                <!--        </div>-->
                <!--        <h5>ID Card</h5>-->
                <!--    </a>-->
                <!--</li>-->
                <!-- <li>
                    <a href="reviews.html">
                        <div class="profile-box color-3">
                            <img class="img-fluid icon" src="assets/images/svg/review.svg" alt="review">
                        </div>
                        <h5>Review</h5>
                    </a>
                </li> -->
                <!--<li>-->
                <!--    <a href="/UC_Help">-->
                <!--        <div class="profile-box color-2">-->
                <!--            <img class="img-fluid icon" src="assets/images/svg/help.svg" alt="help">-->
                <!--        </div>-->
                <!--        <h5>Help</h5>-->
                <!--    </a>-->
                <!--</li>-->
            </ul>

            <ul class="account-listing">
               
                <li>
                    <a href="#logout" data-bs-toggle="offcanvas" class="account-link">
                        <h5>Logout</h5>
                        <i class="iconsax icon" data-icon="chevron-right"></i>
                    </a>
                </li>
            </ul>
        </div>
    </section>
    <!-- profile section ends -->
    
    <!-- registration details modal starts -->
    <div class="modal element-modal fade" id="center" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header p-2">
                    <h2 class="modal-title" id="exampleModalLabel">Registration Details</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body text-center">
                            <div class="row gx-3 align-items-center mb-3">
                                <div class="col">Mr./Ms. [member_name]<br>[member_id]</div>

                            </div>

                            <div class="row gx-3 align-items-center mb-3">
                                <div class="col">Signed On<br>[date_time]</div>
                                <div class="col">Active From<br>[date_time]</div>
                            </div>
                            <hr>
                            <div class="row gx-3 align-items-center mb-3">
                                <div class="col">E-Mail<br>[membermail]</div>
                                <div class="col">Mobile<br>[membernumber]</div>
                            </div><hr>
                            <div class="row gx-3 align-items-center mb-3">
                                <div class="col">Sponsor Name<br>[sponsor_name]</div>
                                <div class="col">Sponsor ID<br>[sponsor_id]</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- registration details modal end -->

    <!-- ID Card modal starts -->
    <div class="modal element-modal fade" id="idc" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header p-2">
                    <h2 class="modal-title" id="exampleModalLabel">Activate Your Account!</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h3>You Will Be Redirected To Payment Page To Activate Your Uniq Connect Distributorship!</h3>
                </div>
                <div class="modal-footer">
                    <a href="/ID_Card_Form" class="btn theme-btn p-2">Proceed</a>
                </div>
            </div>
        </div>
    </div>
    <!-- ID Card modal end -->

    <!-- logout offcanvas start -->
    <div class="offcanvas offcanvas-bottom success-offcanvas" tabindex="-1" id="logout">
        <div class="offcanvas-header pt-0 px-0">
            <h5 class="offcanvas-title" id="offcanvasExampleLabel">Logout</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>

        <div class="offcanvas-body text-center p-0 pt-3 pb-4">
            <h5 class="fw-medium title-color">Are you sure you want to log out?</h5>
        </div>
        <div class="offcanvas-foorter d-flex align-items-center gap-3 shadow-none">
            <a type="Cancel" class="btn white-btn w-50">Cancel</a>
            <a href="/logout" class="btn theme-btn w-50">Logout</a>
        </div>
    </div>
    <!-- logout offcanvas end -->

    <!-- bottom panel start -->
    <!--<ul class="bottom-menu">-->
    <!--    <li><a href="/Home"><i class="iconsax text-content" data-icon="home-2"></i><h6>Home</h6></a></li>-->
    <!--    <li><a href="/Dashboard" class="active"><i class="iconsax text-content" data-icon="grid-apps"></i><h6>Account</h6></a></li>-->
    <!--    <li><a href="/UC_Wallet"><i class="iconsax text-content" data-icon="wallet-1"></i><h6>Wallet</h6></a></li>-->
    <!--    <li><a href="/Orders"><i class="iconsax text-content" data-icon="shop"></i><h6>Orders</h6></a></li>-->
    <!--    <li><a href="/Profile"><i class="iconsax text-content" data-icon="user-2"></i><h6>Profile</h6></a></li>-->
    <!--    <li><a href="#"><i class="iconsax text-content" data-icon="calendar-add"></i><h6>Todo</h6></a></li>-->
    <!--</ul>-->
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
                    <h3>[member_name]</h3>
                    <span>[member_id]</span>
                    <h5>[member_rank]</h5>
                </div>
                
            </a>
            
            <ul class="link-section switch-section">
                <!--<li class="active">
                    <a href="home.html" class="pages">
                        <i class="iconsax sidebar-icon icon" data-icon="home-2"></i>
                        <h3>Home</h3>
                    </a>
                </li>
                <li>
                    <a href="category.html" class="pages">
                        <i class="iconsax sidebar-icon icon" data-icon="grid-apps"></i>
                        <h3>Category</h3>
                    </a>
                </li>
                <li>
                    <a href="cart.html" class="pages">
                        <i class="iconsax sidebar-icon icon" data-icon="shopping-cart"></i>

                        <h3>Cart</h3>
                    </a>
                </li>

                <li>
                    <a href="wishlist.html" class="pages">
                        <i class="iconsax sidebar-icon icon" data-icon="heart"></i>
                        <h3>Wishlist</h3>
                    </a>
                </li>
                <li>
                    <a href="account.html" class="pages">
                        <i class="iconsax sidebar-icon icon" data-icon="user-2"></i>
                        <h3>Profile</h3>
                    </a>
                </li>

                <li>
                    <a href="page-listing.html" class="pages">
                        <i class="iconsax sidebar-icon icon" data-icon="book-closed"> </i>
                        <h3>Template Pages</h3>
                    </a>
                </li>

                <li>
                    <a href="elements-page.html" class="pages">
                        <i class="iconsax sidebar-icon icon" data-icon="document-text-1"> </i>
                        <h3> Template Elements</h3>
                    </a>
                </li>-->

                <!-- <li>
                    <div class="pages">
                        <i class="iconsax sidebar-icon" data-icon="repeat"> </i>
                        <h3>RTL</h3>
                    </div>
                    <div class="switch-btn">
                        <input id="dir-switch" type="checkbox">
                    </div>
                </li> -->

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
                <a href="/" class="pages">
                    <i class="iconsax sidebar-icon" data-icon="logout-2"> </i>
                    <h3>Logout</h3>
                </a>
            </div>
        </div>
    </div>
    <!-- sidebar end -->

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


<!-- Mirrored from themes.pixelstrap.com/pwa/Uniq Connect/account.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 12 Mar 2025 09:41:23 GMT -->
</html>