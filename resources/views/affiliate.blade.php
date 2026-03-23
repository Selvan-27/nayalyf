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
        .wallet-box {
    border: 1px solid #ddd;
    padding: 15px;
    border-radius: 8px;
    cursor: pointer;
    background-color: #f9f9f9;
}

.wallet-box:hover {
    background-color: #f1f1f1;
}

.form-check-input {
    margin-top: 8px;
}

    </style>
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
            </div>
        </div>
    </header>
    <!-- header end -->

    <!-- signup section starts -->
    <section class="section-sm-t-space section-b-space">
         <form class="theme-form" onsubmit="return validateForm(event)" action="Upgrade_account" method="post"> 
         @csrf
        <div class="custom-container">
            
            <div class="auth-content text-center">
                <img class="img-fluid logo-sm" src="assets/images/logo/logo2.png" alt="logo-sm">
                <h1 class="title-color">Uniq Distributor Registration!</h1>
                <h5 class="fw-normal content-color mt-2">Upgrade your account, it takes less than a minute.</h5>
            </div>
           
                <div class="form-group">
                    <label class="form-label" for="membername">Full Name</label>
                    <input type="text" class="form-control wo-icon" name="membername" value="{{Auth::user()->name?? ''}}">
                </div>
                <div class="form-group">
                    <label class="form-label" for="inputmobile">Mobile Number</label>
                    <input type="number" class="form-control wo-icon" name="inputmobile" value="{{Auth::user()->mobile?? ''}}">
                </div>
                <div class="form-group">
                    <label class="form-label" for="inputemail">Email</label>
                    <input type="email" class="form-control wo-icon" name="inputemail" value="{{Auth::user()->real_email?? ''}}">
                </div>
                    
                
            
            <section class="section-t-space section-b-space">
                <div class="custom-container">
                    <div class="element-title mt-0">
                        <h3 class="theme-color">
                          <input class="form-check-input" type="checkbox" id="checkbox1">
                          I hereby apply for and authorize me as an authorized distributor of Uniq Connect Wellness Care.
                        </h3>
                        <h3 class="theme-color">
                          <input class="form-check-input" type="checkbox" id="checkbox2">
                          I confirm that I have read, understood, and agree to be bound by the 
                          <a href="/Affiliate_Terms">Terms & Conditions, Policies, and End-User License Agreement.</a>
                        </h3>

                    </div>
                </div>
            </section>
            
            <br><br><br>

            

            
        </div>
     
    </section>
           <!--<b>UpGrade To Distributor Account</b>-->
           
          
             
    
    <div class="fixed-btn-grp">
 
        <div class="custom-container">
            <button type="submit"  class="btn btn-success w-50">Online Payment</button>
            <!--<a href="#" class="btn btn-primary w-50" data-bs-toggle="modal" disabled>Use Uniq Wallet</a>-->
           <a href="#use_wallet" class="btn btn-primary w-50" data-bs-toggle="modal">Use Uniq Wallet</a>
        </div>
    </div>
        <div class="modal fade centered-modal" tabindex="-1" id="use_wallet">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body" style="background: hsla(191, 60%, 89%, 1); border-radius: 15px;">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      <form class="theme-form">
                @csrf
                                     
									
                  <div class="container">
    <h3 class="text-center fw-normal mt-1">
        <b><u>UpGrade Now!</u></b>
    </h3>

    <div class="mt-3">
        <div class="form-check wallet-box mb-3">
            <input class="form-check-input" 
                   type="radio" 
                   name="wallet_option" 
                   id="shoppingWallet" 
                   value="{{ $availablePV }}" 
                   checked>

            <label class="form-check-label w-100" for="shoppingWallet">
                <div class="d-flex justify-content-between align-items-center">
                    <span><b>Shopping Wallet</b></span>
                    <span>₹ {{ $availablePV }}</span>
                </div>
            </label>
        </div>

        <div class="form-check wallet-box">
            <input class="form-check-input" 
                   type="radio" 
                   name="wallet_option" 
                   id="incentiveWallet" 
                   value="{{ $ignite_payout + $unique_incentive_income ?? 0 }}">

            <label class="form-check-label w-100" for="incentiveWallet">
                <div class="d-flex justify-content-between align-items-center">
                    <span><b>Incentive Wallet</b></span>
                    <span>
                        ₹ {{ number_format($ignite_payout + $unique_incentive_income ?? 0) }}
                    </span>
                </div>
            </label>
        </div>
    </div>
</div>

                    
                      <button type="submit" class="btn theme-btn  w-100 mt-3"  onclick="return validateUpgrade()"> Request UpGrade</button>
                      </form>
                </div>
            </div>
        </div>
    </div>
     </form>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/iconsax-icon.js"></script>
    <script src="assets/js/template-setting.js"></script>
    <script src="assets/js/script.js"></script>
           <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
<script>
function validateUpgrade() {
    let selectedWallet = document.querySelector('input[name="wallet_option"]:checked');

    if (!selectedWallet) {
        alert("Please select a wallet.");
        return false;
    }

    let amount = parseFloat(selectedWallet.value);

    if (amount < 1600) {
        // alert("Minimum ₹1600 required to request upgrade.");
        
          Swal.fire({
                  icon: "error",
                  title: "Oops...",
                  text: "Minimum ₹1600 required to request upgrade",
                });
                
        return false;
    }

    return true; // form will submit
}
</script>

<script>
    
  function validateForm(event) {
    const checkbox1 = document.getElementById('checkbox1');
    const checkbox2 = document.getElementById('checkbox2');

    if (!checkbox1.checked || !checkbox2.checked) {
         Swal.fire({
                  icon: "error",
                  title: "Oops...",
                  text: "Please agree to both terms before submitting the form",
                });
                
     // alert("Please agree to both terms before submitting the form.");
      event.preventDefault(); // Prevent form from submitting
      return false;
    }

    return true; // Allow form to submit
  }
</script>

</html>