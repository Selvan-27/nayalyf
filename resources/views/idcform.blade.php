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
                <h3>New ID Card Application</h3>
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
                    <i class="iconsax edit-icon" data-icon="camera"></i>
                    <input id="file" type="file" onchange="loadFile(event)">
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
                    <label class="form-label" for="inputemail">Registered Email</label>
                    <input type="email" class="form-control wo-icon" id="" value="[member_mail]"
                        disabled>
                </div>

                <div class="form-group">
                    <label class="form-label" for="inputnumber">Registered Mobile</label>
                    <input type="Number" class="form-control wo-icon" id="" value="[member_mobile]"
                        disabled>
                </div>

                <!-- <div class="form-group">
                    <label class="form-label title-color">Gender</label>
                </div>

                <div class=" d-flex align-items-center gap-5">
                    <div class="form-check">
                        <input class="form-check-input ms-auto" type="radio" name="flexRadioDefault"
                            id="flexRadioDefault1">
                        <label class="form-check-label" for="flexRadioDefault1">
                            Male
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input ms-auto" type="radio" name="flexRadioDefault"
                            id="flexRadioDefault2" checked>
                        <label class="form-check-label" for="flexRadioDefault2">
                            Female
                        </label>
                    </div>
                </div><br><hr> -->
                <!-- <br>
                <div class="form-group mt-0">
                    <label class="form-label" for="inputname">Sponsor Name</label>
                    <input type="text" class="form-control wo-icon" id="inputname" value="[sponsor_name]" disabled>
                </div><br>
                <div class="form-group mt-0">
                    <label class="form-label" for="inputname">Sponsor ID</label>
                    <input type="text" class="form-control wo-icon" id="inputname" value="[sponsor_name]" disabled>
                </div> -->
            </form>
        </div>

        <div class="fixed-btn-grp">
            <div class="custom-container">
                <a href="#successg" data-bs-toggle="modal" class="btn btn-mid theme-btn w-100">Apply New ID Card</a>
            </div>
        </div>
    </section>
    
    <div class="modal fade centered-modal" tabindex="-1" id="successg">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="d-grid align-content-center">
                        <img class="img-fluid success-img mx-auto" src="assets/images/gif/successfully.gif"
                            alt="successfully" />
                        <h3 class="text-center title-color fw-normal mt-1">Request Submitted Successfully!</h3>
                        <a href="/Profile" data-bs-dismiss="modal" class="btn theme-btn  w-100 mt-3">Back To Profile</a>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- profile section end -->

    <!-- panel-space start -->
    <div class="panel-space"></div>
    <!-- panel-space end -->

    
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/iconsax-icon.js"></script>
    <script src="assets/js/template-setting.js"></script>
    <script src="assets/js/image-change.js"></script>
    <script src="assets/js/script.js"></script>
</body>

</html>