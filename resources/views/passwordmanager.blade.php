<!DOCTYPE html>
<html lang="en">

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
                <h3>Password Manager</h3>
            </div>
        </div>
    </header>
    <!-- header end -->

    <!-- password manager section starts -->
    <section class="section-sm-t-space section-b-space">
        <div class="custom-container">
            {{-- Success Message --}}
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

{{-- Validation / Error Messages --}}
@if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

          <form class="theme-form" method="POST" action="{{ route('password.update') }}">
            @csrf
                 <div class="form-group mt-0">
        <label class="form-label" for="inputpassword1">Current Password</label>
        <input type="password" class="form-control wo-icon" id="inputpassword1" name="current_password"
            placeholder="Enter current password" required>
    </div>

    <div class="form-group">
        <label class="form-label" for="inputpassword2">New Password</label>
        <input type="password" class="form-control wo-icon" id="inputpassword2" name="new_password"
            placeholder="Enter new password" required>
    </div>

    <div class="form-group">
        <label class="form-label" for="inputpassword3">Confirm Password</label>
        <input type="password" class="form-control wo-icon" id="inputpassword3" name="new_password_confirmation"
            placeholder="Enter confirm password" required>
    </div>
    
                 <button type="submit" class="btn btn-mid theme-btn w-100 mt-3">Update Password</button>
            </form>
        </div>
        <div class="fixed-btn-grp">
            <div class="custom-container">
                <!--<a href="#successg" data-bs-toggle="modal" class="btn btn-mid theme-btn w-100">Change-->
                    <!--Password</a>-->
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
                        <h3 class="text-center title-color fw-normal mt-1">Password Changed Successfully!</h3>
                        <a href="/Profile"  class="btn theme-btn  w-100 mt-3">Back To Profile</a>

                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- password manager section ends -->

    <!-- panel-space start -->
    <div class="panel-space"></div>
    <!-- panel-space end -->

    <!-- bootstrap js -->
    <script src="assets/js/bootstrap.bundle.min.js"></script>

    <!-- iconsax icon -->
    <script src="assets/js/iconsax-icon.js"></script>

    <!-- template-setting js -->
    <script src="assets/js/template-setting.js"></script>

    <!-- script js -->
    <script src="assets/js/script.js"></script>
    <script>
document.querySelector(".theme-form").addEventListener("submit", function(e) {
    let current = document.getElementById("inputpassword1").value;
    let newPass = document.getElementById("inputpassword2").value;
    let confirmPass = document.getElementById("inputpassword3").value;

    if (current === newPass) {
        e.preventDefault();
        alert("New password cannot be the same as current password.");
        return false;
    }

    if (newPass !== confirmPass) {
        e.preventDefault();
        alert("New password and confirmation do not match.");
        return false;
    }
});
</script>

</body>


</html>