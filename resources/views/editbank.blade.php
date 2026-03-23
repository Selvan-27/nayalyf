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
    <!-- <section class="pt-0">
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
    </section> -->

    <section class="section-b-space">
        <div class="custom-container">
         
<form class="theme-form profile-form" method="POST" action="{{ route('bank.update') }}">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label class="form-label" for="acname">A/C Holder Name</label>
        <input type="text" class="form-control wo-icon" name="acname" id="acname"
               value="{{ old('acname', $user->name ?? '') }}"
               placeholder="Enter A/C Holder's Full Name" disabled>
    </div>

    <div class="form-group">
        <label class="form-label" for="bankname">Bank Name</label>
        <input type="text" class="form-control wo-icon" name="bankname" id="bankname"
               value="{{ old('bankname', $user->bank_Name ?? '') }}"
               placeholder="Enter Bank Name" disabled>
    </div>

    <div class="form-group">
        <label class="form-label" for="branchname">Branch Name</label>
        <input type="text" class="form-control wo-icon" name="branchname" id="branchname"
               value="{{ old('branchname', $user->branch_Name ?? '') }}"
               placeholder="Enter Bank's Branch Name" disabled>
    </div>

    <div class="form-group">
        <label class="form-label" for="ifsc">IFSC Code</label>
        <input type="text" class="form-control wo-icon" name="ifsc" id="ifsc"
               value="{{ old('ifsc', $user->ifsc_Code ?? '') }}"
               placeholder="Enter IFSC Code" disabled>
    </div>

    <div class="form-group">
        <label class="form-label" for="acnumber">Bank Account Number</label>
        <input type="text" class="form-control wo-icon" name="acnumber" id="acnumber"
               value="{{ old('acnumber', $user->account_Number ?? '') }}"
               placeholder="Enter Bank Account Number" disabled>
    </div>

    <div class="mt-3">
        <!--<button type="button" class="btn btn-secondary" id="editBtn">Edit</button>-->
        <!--<button type="submit" class="btn btn-primary d-none" id="saveBtn">Save</button>-->
    </div>
            </form>
        </div>

        <!-- <div class="fixed-btn-grp">
            <div class="custom-container">
                <a href="#" class="btn btn-mid theme-btn w-100">Update Banking Details</a>
            </div>
        </div> -->
    </section>

    <!-- profile section end -->

    <!-- panel-space start -->
    <div class="panel-space"></div>
    <!-- panel-space end -->
    <div class="fixed-btn-grp">
        <div class="custom-container">
            
            <!--<a href="#center" class="btn theme-btn w-100" data-bs-toggle="modal">Update Banking Detail</a>-->
        </div>
    </div>
    
    <!-- center modal starts -->
    <div class="modal element-modal fade" id="center" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header p-2">
                    <h2 class="modal-title" id="exampleModalLabel">Contact Support</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>To update your banking deails, kindly contact customer support.</p>
                </div>
                <!--<div class="modal-footer">-->
                <!--    <a href="element-modal.html" class="btn outline-btn p-2" data-bs-dismiss="modal">Close</a>-->
                <!--    <a href="element-modal.html" class="btn theme-btn p-2">Save</a>-->
                <!--</div>-->
            </div>
        </div>
    </div>
    <!-- center modal end -->
    <!-- bootstrap js -->
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/iconsax-icon.js"></script>
    <script src="assets/js/template-setting.js"></script>
    <script src="assets/js/image-change.js"></script>
    <script src="assets/js/script.js"></script>
</body>


</html>