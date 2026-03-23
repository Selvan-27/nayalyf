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
    <style>
        .address-box {
            list-style: none;
        }

        .address-card {
            background: #fff;
            border-radius: 12px;
            padding: 15px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
            cursor: pointer;
            position: relative;
        }

        .address-card:hover {
            background: #f4f7ff;
            transform: translateY(-3px);
            box-shadow: 0 4px 14px rgba(0,0,0,0.1);
        }

        .address-card a {
            z-index: 2;
            position: relative;
        }
    </style>

</head>

<body>
    <!-- loader start-->
    <div class="loader-wrapper" id="loader">
        <span class="loader"></span>
    </div>
    <!-- loader end -->

    <!-- header starts -->
    <header class="main-header">
        <div class="custom-container">
            <div class="header-panel">
                <a onclick="history.back();">
                    <img class="img-fluid icon-btn back-arrow" src="assets/images/svg/back-arrow.svg" alt="back-arrow">
                </a>
                <h3>Your Contacts</h3>
            </div>
        </div>
    </header>
    <br>
    <!-- header end -->
    <section class="custom-container">
        <div class="row g-3">
            <div class="col-4">
                <a href="#">
                    <div class="product-box" style="background-color: #0d3ff5;">
                        <div class="product-content">
                            <h5 style="color: #fff;">Contacts</h5>
                            <div class="bottom-content">
                                <h5 style="color: #fff;">0</h5>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-4">
                <a href="#">
                    <div class="product-box" style="background-color: #0d3ff5;">
                        <div class="product-content">
                            <h5 style="color: #fff;">Visited</h5>
                            <div class="bottom-content">
                                <h5 style="color: #fff;">0</h5>
                            </div>
                        </div>
                    </div>
                </a>
            </div>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   
            <div class="col-4">
                <a href="#">
                    <div class="product-box" style="background-color: #ffe00b;">
                        <div class="product-content">
                            <h5 style="color: #000;">Follow Up</h5>
                            <div class="bottom-content">
                                <h5 style="color: #000;">0</h5>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div><hr>
    </section>
    <section class="section-sm-t-space">
        <div class="custom-container">
            <form class="theme-form search-form d-flex  p-0 align-content-center gap-2">
                <div class="form-group">
                    <div class="form-input align-items-center">
                        <input type="search" class="form-control search" id="inputusername"
                            placeholder="Search Here..." style="border: 1px solid">
                        <i class="iconsax search-icon" data-icon="search-normal-2"> </i>
                    </div>
                </div>
                <a href="#">
                    <i class="iconsax filter-btn" data-icon="arrow-circle-left" style="border: 1px solid"></i>
                </a>
            </form>
        </div>
    </section>
    <!-- address section starts -->
    <section class="section-sm-t-space">
        <div class="custom-container">
            <ul class="address-listing">
                
                <li class="w-100 address-box">
                    <div class="card address-card" onclick="window.location.href='/Contact_Form';">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h4 class="fw-bold theme-color">[contact_name]</h4>
                                <h6 class="fw-bold title-color">[contact_number]</h6>
                            </div>
                            <a href="#edit-address" data-bs-toggle="offcanvas" class="theme-color fw-medium" 
                            style="border: 1px solid; padding: 10px; border-radius: 30px">
                                <img src="assets/images/svg/edit.svg" alt="edit">
                            </a>
                        </div>
                        <div class="address-content">
                            <p>Last Visited On [visit_date]</p>
                            <div class="see-all">Follow Up On [follow_date]</div>
                        </div>
                    </div>
                </li>

            </ul>
        </div>

        <div class="fixed-btn-grp">
            <div class="custom-container">
                <a href="#new-address" data-bs-toggle="offcanvas" class="btn btn-mid theme-btn w-100">Add New Contact</a>
            </div>
        </div>
    </section>
    <!-- address section ends -->

    <!-- change address section starts -->
    <div class="offcanvas offcanvas-bottom filter-offcanvas" tabindex="-1" id="new-address">
        <div class="offcanvas-header">
            <h3>Add New Contact</h3>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <form class="theme-form">
                <div class="form-group">
                    <label class="form-label" for="inputcontactname">Name</label>
                    <input type="text" class="form-control wo-icon" id="inputcontactname" placeholder="Enter Name">
                </div>

                <div class="form-group">
                    <label class="form-label" for="inputcontactnumber">Mobile</label>
                    <input type="text" class="form-control wo-icon" id="inputcontactnumber" placeholder="Enter Mobile Number">
                </div>
                
            </form>
        </div>
        <div class="btn-grp d-flex gap-3 mt-4">
            
            <a data-bs-dismiss="offcanvas" class="btn theme-btn w-100">Add</a>
        </div>
    </div>
    <!-- change address section ends -->

    <!-- edit address section starts -->
    <div class="offcanvas offcanvas-bottom filter-offcanvas" tabindex="-1" id="edit-address">
        <div class="offcanvas-header">
            <h3>Edit Contact</h3>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <form class="theme-form">
                <div class="form-group">
                    <label class="form-label" for="inputcontactname">Name</label>
                    <input type="text" class="form-control wo-icon" id="inputcontactname" placeholder="Enter Name">
                </div>

                <div class="form-group">
                    <label class="form-label" for="inputcontactnumber">Mobile</label>
                    <input type="text" class="form-control wo-icon" id="inputcontactnumber" placeholder="Enter Mobile Number">
                </div>
                
            </form>
        </div>
        <div class="btn-grp d-flex gap-3 mt-4">
            <a data-bs-dismiss="offcanvas" class="btn white-btn w-50">Cancel</a>
            <a data-bs-dismiss="offcanvas" class="btn theme-btn w-50">Update</a>
        </div>
    </div>
    <!-- edit address section ends -->

    <!-- panel-space start -->
    <div class="panel-space"></div>
    <!-- panel-space end -->

    

   
    <!-- bootstrap js -->
    <script src="assets/js/bootstrap.bundle.min.js"></script>

    <!-- iconsax icon -->
    <script src="assets/js/iconsax-icon.js"></script>

    <!-- homescreen popup icon -->
    <script src="assets/js/homescreen-popup.js"></script>

    <!-- template-setting js -->
    <script src="assets/js/template-setting.js"></script>

    <!-- script js -->
    <script src="assets/js/script.js"></script>
   

</body>

</html>