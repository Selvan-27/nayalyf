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
                <a href="/">
                    <img class="img-fluid icon-btn back-arrow" src="assets/images/svg/back-arrow.svg" alt="back-arrow">
                </a>
            </div>
        </div>
    </header>
    <!-- header end -->

    <!-- signup section starts -->
    <section class="section-sm-t-space section-b-space">
        <div class="custom-container">
            <div class="auth-content text-center">
                <img class="img-fluid logo-sm" src="assets/images/logo/logo2.png" alt="logo-sm">
                <h1 class="title-color">Uniq Registration!</h1>
                <h5 class="fw-normal content-color mt-2">Create your account, it takes less than a minute.</h5>
            </div>
  
<!-- Add SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<form class="theme-form" method="POST" id="register-form" action="{{ route('register') }}">

    
    @csrf
    <div class="form-group">
        <div class="row">
            <div class="col-6"> 
                <input type="text" name="sponsorname" class="form-control w-100" 
                       placeholder="Sponsor Name" value="{{ request()->get('sponsorname') ?? 'UCWC' }}" {{ request()->get('sponsorname') ?? 'style=display:none;' }}  readonly>
            </div>     
            <div class="col-6"> 
                <input type="text" name="sponcer_id" id="sponcer_id" class="form-control w-100" 
                       placeholder="Sponsor ID" value="{{ request()->get('sponcer_id') ?? 'UC100001' }}" {{ request()->get('sponsorname') ?? 'style=display:none;' }}> 
            </div> 
        </div>     
    </div>

    <div class="form-group">
        <label class="form-label" for="name">Full Name</label>
        <input type="text" class="form-control wo-icon" name="name" id="name" placeholder="Enter Full Name">
    </div>

    <div class="form-group">
        <label class="form-label" for="mobile_no">Mobile Number</label>
        <input type="number" class="form-control wo-icon" name="mobile_no" id="mobile_no" placeholder="Enter Mobile Number">
    </div>

    <div class="form-group">
        <label class="form-label" for="email">Email</label>
        <input type="email" class="form-control wo-icon" name="email" id="email" placeholder="Enter E-Mail">
    </div>

    <div class="form-group">
        <div class="row">
            <div class="col-6"> 
                <a type="button" onclick="getotp()" class="btn btn-outline-dark w-100 btn-rounded text-center">Get OTP</a>
            </div>     
            <div class="col-6"> 
                <input type="number" name="inputOTP" id="OTP" class="form-control w-100" placeholder="Enter OTP">
            </div> 
        </div> 
        @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

        <p id="msg" style="padding: 5px 30px;color: blue;"></p>
    </div>    

    <div class="form-group">
        <label class="form-label" for="password">Password</label>
        <input type="password" class="form-control wo-icon" name="password" id="password" placeholder="Enter Password">
    </div>

    <div class="form-group">
        <label class="form-label" for="password_confirmation">Confirm Password</label>
        <input type="password" class="form-control wo-icon" name="password_confirmation" id="password_confirmation" placeholder="Re-Enter Password">
    </div>
    
    <button type="submit" class="btn theme-btn w-100 auth-btn" id="submit-button">
        <span id="button-text">Create an account</span>
        <span id="btn-loader" style="display: none;">⏳</span>
    </button>
</form>



           

            <h5 class="content-color fw-normal text-center mt-24">Already have an
                account? <a href="/" class="theme-color">Sign in</a>
            </h5>
        </div>
    </section>
    
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/iconsax-icon.js"></script>
    <script src="assets/js/template-setting.js"></script>
    <script src="assets/js/script.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    


<script>
document.getElementById("register-form").addEventListener("submit", function(e) {
    e.preventDefault(); // stop default submit until validated

    let fields = [
        {id: "sponcer_id", name: "Sponsor ID"},
        {id: "name", name: "Full Name"},
        {id: "mobile_no", name: "Mobile Number"},
        {id: "email", name: "Email"},
        {id: "OTP", name: "OTP"},
        {id: "password", name: "Password"},
        {id: "password_confirmation", name: "Confirm Password"}
    ];

    // check for empty fields
    for (let field of fields) {
        let value = document.getElementById(field.id).value.trim();
        if (value === "") {
            Swal.fire({
                icon: "warning",
                title: "Missing Information",
                text: field.name + " is required!",
                confirmButtonColor: "#3085d6"
            });
            return; // stop form submission
        }
    }




 // password validation
    let pass = document.getElementById("password").value.trim();
    let cpass = document.getElementById("password_confirmation").value.trim();
    if (pass.length < 6) {
        Swal.fire({
            icon: "error",
            title: "Weak Password",
            text: "Password must be at least 6 characters long.",
            confirmButtonColor: "#d33"
        });
        return;
    }
    
    // check password match
    if (pass !== cpass) {
        Swal.fire({
            icon: "error",
            title: "Password Mismatch",
            text: "Password and Confirm Password do not match.",
            confirmButtonColor: "#d33"
        });
        return;
    }

    // disable button + show loader
    let button = document.getElementById("submit-button");
    button.disabled = true;
    document.getElementById("button-text").style.display = "none";
    document.getElementById("btn-loader").style.display = "inline-block";

    // finally submit form
    this.submit();
});
</script>

    <script>
 function getotp() {
     let name = document.getElementById("name").value.trim();
    let email = document.getElementById("email").value.trim();
    let mobile = document.getElementById("mobile_no").value.trim();

 if (mobile === "" || email === "") {
         Swal.fire({
                  icon: "error",
                  title: "Oops...",
                  text: "Please fill in all required fields",
                });
            
 }        
   // mobile validation
  
    let mobilePattern = /^[6-9]\d{9}$/; // starts with 6,7,8,9 and total 10 digits
    if (!mobilePattern.test(mobile)) {
        Swal.fire({
            icon: "error",
            title: "Invalid Mobile Number",
            text: "Mobile number must be 10 digits and start with 9, 8, 7, or 6.",
            confirmButtonColor: "#d33"
        });
        return;
    }
    

    // email validation
 
    let allowedDomains = ["@gmail.com", "@yahoo.com", "@outlook.com", "@hotmail.com"];
    let validEmail = allowedDomains.some(domain => email.endsWith(domain));
    if (!validEmail) {
        Swal.fire({
            icon: "error",
            title: "Invalid Email",
            text: "Only Gmail, Yahoo, Outlook, or Hotmail addresses are allowed.",
            confirmButtonColor: "#d33"
        });
        return;
    }

   
    //  $.ajax({
    //     url: 'https://jettcrypto.in/check-exists-mail',
    //     type: 'GET',
    //     data: {
    //         _token: '{{ csrf_token() }}', // Include CSRF token
    //         email: email,
    //     },
    //     success: function(response) {
    //         console.log(response);
            
    //         if(response.message==200){
                //----SEND OTP
         
                 $.ajax({
        url: 'https://uniqconnectwc.com/send-OTP',
        type: 'GET',
        data: {
            _token: '{{ csrf_token() }}', // Include CSRF token
            name: name,
            mobile:mobile,
            email: email
        },
        success: function(response) {
            console.log(response);
            $('#msg').text(response.message).fadeIn().delay(3000).fadeOut();
        },
        error: function(xhr) {
            // Handle error
            console.error('An error occurred:', xhr.responseText);
        }
    });
    
                //----
    //         }else{
    //             $('#success-message').text(response.message).fadeIn().delay(3000).fadeOut();
    //             $('#email').val("");
    //         }
            
    //     },
    //     error: function(xhr) {
    //         // Handle error
    //         console.error('An error occurred:', xhr.responseText);
    //     }
    // });

}

    </script>
</body>


</html>