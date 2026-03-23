<!DOCTYPE html>
<html lang="en">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content=" ">
    <meta name="keywords" content=" ">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="assets/images/dashboard/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="assets/images/dashboard/favicon.png" type="image/x-icon">
    <title>Uniq Connect | Admin</title>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Work+Sans:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,500;1,600;1,700;1,800;1,900&amp;display=swap">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap">
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/themify-icons.css">
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/slick.css">
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/slick-theme.css">
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">

</head>

<body>

    <!-- page-wrapper Start-->
    <div class="page-wrapper">
        <div class="authentication-box">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 p-0 card-right"></div>
                    <div class="col-md-6 p-0 card-right">
                        <div class="card tab2-card card-login">
                            <div class="card-body">
                                <ul class="nav nav-tabs nav-material" id="top-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="top-profile-tab" data-bs-toggle="tab"
                                            href="#top-profile" role="tab" aria-controls="top-profile"
                                            aria-selected="true"><span class="icon-user me-2"></span>Admin Login</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="contact-top-tab" data-bs-toggle="tab"
                                            href="#top-contact" role="tab" aria-controls="top-contact"
                                            aria-selected="false"><span class="icon-unlock me-2"></span>Retrieve Password</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="top-tabContent">
                                    <div class="tab-pane fade show active" id="top-profile" role="tabpanel"
                                        aria-labelledby="top-profile-tab">
                                        <form class="form-horizontal auth-form">
                                            <div class="form-group">
                                                <input  name="" type="email"
                                                    class="form-control" placeholder="Username" id="exampleInputEmail1">
                                            </div>
                                            <div class="form-group">
                                                <input  name="" type="password"
                                                    class="form-control" placeholder="Password">
                                            </div>
                                            <!--<div class="form-terms">
                                                <div class="form-check mesm-2">
                                                    <input type="checkbox" class="form-check-input"
                                                        id="customControlAutosizing">
                                                    <label class="form-check-label ps-2"
                                                        for="customControlAutosizing">Remember me</label>
                                                    <a href="javascript:void(0)"
                                                        class="btn btn-default forgot-pass">Forgot Password!</a>
                                                </div>
                                            </div>-->
                                            <div class="form-button">
                                                <a href="/admin_home"><button class="btn btn-primary" type="">Login</button></a>
                                            </div>
                                            
                                        </form>
                                    </div>
                                    <div class="tab-pane fade" id="top-contact" role="tabpanel"
                                        aria-labelledby="contact-top-tab">
                                        <form class="form-horizontal auth-form">
                                            <div class="form-group">
                                                <input required="" name="login[email]" type="email"
                                                    class="form-control" placeholder="E-Mail"
                                                    id="exampleInputEmail12">
                                            </div>
                                            
                                            
                                            <div class="form-button">
                                                <button class="btn btn-primary" type="submit">Get Password</button>
                                            </div>
                                            
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 p-0 card-right"></div>
                </div>
                
            </div>
        </div>
    </div>

    
    <script src="assets/js/jquery-3.3.1.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/icons/feather-icon/feather.min.js"></script>
    <script src="assets/js/icons/feather-icon/feather-icon.js"></script>
    <script src="assets/js/sidebar-menu.js"></script>
    <script src="assets/js/slick.js"></script>
    <script src="assets/js/lazysizes.min.js"></script>
    <script src="assets/js/chat-menu.js"></script>
    <script src="assets/js/admin-script.js"></script>
    <script>
        $('.single-item').slick({
            arrows: false,
            dots: true
        });
    </script>

</body>
</html>