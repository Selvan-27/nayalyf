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

    <!-- header starts -->
    <header class="main-header">
        <div class="custom-container">
            <div class="header-panel">
                <a href="{{ route('Home') }}">
                    <img class="img-fluid icon-btn back-arrow" src="assets/images/svg/back-arrow.svg" alt="back-arrow">
                </a>
                <h3>Welcome kit Address Update</h3>
            </div>
        </div>
    </header>
    <!-- header end -->

    
    <!--<div class="panel-space"></div>-->
    <a href="#add-address" class="btn theme-btn w-100" data-bs-toggle="offcanvas">Add New Address</a>
    <!-- languages section starts -->
 <section>
  <section class="section-sm-t-space section-b-space">
    <div class="row gy-3" style="padding-left:20px;padding-right:20px;">
    <form class="theme-form" action="{{ url('update-address-kit') }}" method="post">
                            @csrf
                            <div class="offcanvas-body">
                           
                               <div class="form-group">
                                    <label class="form-label" for="full_name">Full Name</label>
                                    <input type="text" class="form-control wo-icon" name="full_name" >
                                </div>
                
                                <div class="form-group">
                                    <label class="form-label" for="inputaddress">Street Address</label>
                                    <input type="text" class="form-control wo-icon" name="street_address" placeholder="Enter address">
                                </div>
                                     <div class="form-group">
                                    <label class="form-label" for="inputcity">Mobile No</label>
                                    <input type="text" class="form-control wo-icon" name="mobile_no" >
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="inputcity">City</label>
                                    <input type="text" class="form-control wo-icon" name="city" >
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="inputcode">Pin Code</label>
                                    <input type="number" class="form-control wo-icon" name="pincode" >
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="form-label" for="memberdistrict">District</label>
                                            <input type="text" class="form-control wo-icon" name="district" >
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="form-label" for="memberState">State</label>
                                            <input type="text" class="form-control wo-icon" name="state" >
                                        </div>
                                    </div>
                                </div>
                           
                            </div>
                            <div class="btn-grp d-flex gap-3 mt-4">
                               <a data-bs-dismiss="offcanvas" class="btn white-btn w-50">CANCEL</a>
                               <button href="javascript:void(0)" type="submit" class="btn theme-btn w-50">UPDATE</button>
                            </div>
                        </form>
                         <div class="panel-space"></div>
                         </div>
 </section>

    <!-- change address offcanvas start -->
 
   
    <!-- bootstrap js -->
    <script src="assets/js/bootstrap.bundle.min.js"></script>

    <!-- iconsax icon -->
    <script src="assets/js/iconsax-icon.js"></script>

    

    <!-- template-setting js -->
    <script src="assets/js/template-setting.js"></script>

    <!-- script js -->
    <script src="assets/js/script.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
           <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function(){
            $('#inputcode').on('input',function(e){
                var pin = e.target.value;
                //alert(pin);
                $.ajax({
                    url:'https://api.postalpincode.in/pincode/'+pin,
                    type:"GET",
                    dataType:"json",
                    success:function(data){
                        console.log(data[0].PostOffice[0].District);
                        console.log(data[0].PostOffice[0].State);
                        $('#district').val(data[0].PostOffice[0].District);
                        $('#State').val(data[0].PostOffice[0].State);
                    }
                });
            });
        });
    </script>
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>

</body>

</html>