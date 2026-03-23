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
                
                <h3>Create Your Profile</h3>
            </div>
        </div>
    </header>
    <!-- header end -->

    <!-- profile section starts -->
    <section class="pt-0">
        <div class="profile-background edit-profile-bg">
            <div class="profile-part mt-2">
                <div class="profile-image text-center">
                    <img id="output" class="img-fluid profile-pic" 
                         src="{{ Auth::user()->profile_photo ? asset('profile/'.Auth::user()->profile_photo) : asset('assets/images/avatar/uc.png') }}" alt="profile" width="120">
                
                    <i class="iconsax edit-icon" data-icon="camera"></i>
                
                    <input id="file" type="file" hidden>
                </div>
                <h3>{{Auth::user()->name?? ''}}</h3>
                <p>{{Auth::user()->memberid?? ''}}</p>
                <p>{{$member_rank}}</p>
            </div>
        </div>
        <div class="row gx-3 text-center">
            <div class="col">E-Mail<br>{{Auth::user()->real_email?? ''}}</div>
            <div class="col">Mobile<br>{{Auth::user()->mobile?? ''}}</div>
        </div><hr>
    </section>

    <section class="section-b-space">
        <div class="custom-container">
           <form class="theme-form profile-form" id="profile-form" method="POST" action="{{ route('profile_update') }}">
    @csrf
                
                <!--<div class="form-group">-->
                <!--    <label class="form-label" for="acname">Bank A/C Holder Name</label>-->
                <!--    <input type="text" class="form-control wo-icon" name="acname" Placeholder="Enter A/C Holder's Full Name" >-->
                <!--</div>-->

                <!--<div class="form-group">-->
                <!--    <label class="form-label" for="bankname">Bank Name</label>-->
                <!--    <input type="text" class="form-control wo-icon" name="bankname" Placeholder="Enter Bank Name" >-->
                <!--</div>-->

                
                <!--<div class="form-group">-->
                <!--    <label class="form-label" for="branchname">Branch Name</label>-->
                <!--    <input type="text" class="form-control wo-icon" name="branchname" Placeholder="Enter Bank's Branch Name" >-->
                <!--</div>-->

                <!--<div class="form-group">-->
                <!--    <label class="form-label" for="ifsc">IFSC Code</label>-->
                <!--    <input type="text" class="form-control wo-icon" name="ifsc" Placeholder="Enter IFSC Code" >-->
                <!--</div>-->
                <!--<div class="form-group">-->
                <!--    <label class="form-label" for="acnumber">Bank Account Number</label>-->
                <!--    <input type="number" class="form-control wo-icon" name="acnumber" Placeholder="Enter Bank Account Number" >-->
                <!--</div>-->

    <div class="form-group">
        <label class="form-label" for="acname">A/C Holder Name</label>
        <input type="text" class="form-control wo-icon" name="acname" id="acname"
            
               placeholder="Enter A/C Holder's Full Name" >
    </div>

    <div class="form-group">
        <label class="form-label" for="bankname">Bank Name</label>
        <input type="text" class="form-control wo-icon" name="bankname" id="bankname"
          
               placeholder="Enter Bank Name" >
    </div>

    <div class="form-group">
        <label class="form-label" for="branchname">Branch Name</label>
        <input type="text" class="form-control wo-icon" name="branchname" id="branchname"
             
               placeholder="Enter Bank's Branch Name" >
    </div>

    <div class="form-group">
        <label class="form-label" for="ifsc">IFSC Code</label>
        <input type="text" class="form-control wo-icon" name="ifsc" id="ifsc"
             
               placeholder="Enter IFSC Code" >
    </div>

    <div class="form-group">
        <label class="form-label" for="acnumber">Bank Account Number</label>
        <input type="number" class="form-control wo-icon" name="acnumber" id="acnumber"
            
               placeholder="Enter Bank Account Number" >
    </div>
    
                
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label class="form-label title-color">Gender</label>
                        </div>
                        <div class=" d-flex align-items-center gap-5">
                            <div class="form-check">
                                <input class="form-check-input ms-auto" type="radio" name="gender" value="Male"
                                    id="flexRadioDefault1">
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Male
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input ms-auto" type="radio" name="gender" value="Female"
                                    id="flexRadioDefault2" checked>
                                <label class="form-check-label" for="flexRadioDefault2">
                                    Female
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label class="form-label" for="memberdob">Date Of Birth </label>
                            <input type="date" class="form-control wo-icon" name="memberdob" >
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="inputaddress">Full Address</label>
                    <input type="text" class="form-control wo-icon" name="inputaddress" placeholder="Enter Door No., Street Name, Village Name">
                </div>

                
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label class="form-label" for="inputcode">Pincode</label>
                            <input type="Number" class="form-control wo-icon" name="inputcode" id="inputcode" placeholder="Enter Postal Pincode">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label class="form-label" for="membercity">City</label>
                            <input type="text" class="form-control wo-icon" id="city" name="inputcity"  placeholder="Your City">
                        </div>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-6">
                        <div class="form-group">
                            <label class="form-label" for="memberdistrict">District</label>
                            <input type="text" class="form-control wo-icon" id="district" name="memberdistrict" readonly="" placeholder="Your District">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label class="form-label" for="memberState">State</label>
                            <input type="text" class="form-control wo-icon" id="State" name="memberState" readonly="" placeholder="Your State">
                        </div>
                    </div>
                </div>
                
          
        </div>

        <div class="fixed-btn-grp">
            <div class="custom-container">
                <button type="submit" id="submit-button" class="btn btn-mid theme-btn w-100">Update Profile Details</button>
            </div>
        </div>
          </form>
    </section>


    <!-- panel-space start -->
    <div class="panel-space"></div>
    <!-- panel-space end -->
           <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
document.getElementById("profile-form").addEventListener("submit", function(e) {
    e.preventDefault(); // stop form submit until validation passes
        
    
        let button = document.getElementById("submit-button");
        button.disabled = true;

        this.submit();
    
});
</script>


<script>
  document.getElementById("placeOrderBtn").addEventListener("click", function () {
    // Get cart data from localStorage
    const cart = JSON.parse(localStorage.getItem("Ecart")) || [];

    if (cart.length === 0) {
    //   alert("Cart is empty!");
      Swal.fire({
                icon: 'error',
                title: 'Cart is empty!',
                // text: "You have select Delivery Address.",
                confirmButtonText: 'OK'
      }).then(() => {
                 window.location.href = "/UC_Shop";
            });
            return;
    }
    
    
    // let selected = document.querySelector('delivery_address');
    let selected = document.getElementById('delivery_address').value
    // alert(selected);
    if (selected==0) {
         Swal.fire({
                icon: 'error',
                title: 'No Delivery address selected!',
                text: "You have select Delivery Address.",
                confirmButtonText: 'OK'
            });
            
        // alert("No Delivery address selected!");
         return;
    }
       let cartTotal = JSON.parse(localStorage.getItem("Ecart_total")) || {};
        
     let grand_total= cartTotal.grand_total; 
      let total_price= cartTotal.total_price; 
      let totalPV= cartTotal.totalPV; 
      let delivery_charge= cartTotal.delivery_charge; 
      let totalWallet= cartTotal.wallet; 


    // Calculate total
    const total = cart.reduce((sum, item) => sum + item.total, 0);
    let csrfToken = $('meta[name="csrf-token"]').attr("content");
    // Example payload (customize as needed)
    const orderData = {
      cart: cart,
      total: total_price,
      grand_total:grand_total,
      totalPV: totalPV, // Replace with actual user ID or null
      delivery_charge: delivery_charge, // Replace with actual user ID or null
      totalWallet: totalWallet, // Replace with actual user ID or null
      address_id: selected // Replace with real address ID
    };


  });
</script>


<script>
    // trigger file input when clicking icon
    $(".edit-icon").click(function(){
        $("#file").click();
    });

    // preview + upload image
    $("#file").change(function(event){
        var reader = new FileReader();
        reader.onload = function(){
            $("#output").attr("src", reader.result); // preview
        };
        reader.readAsDataURL(event.target.files[0]);

        // prepare formData
        var formData = new FormData();
        formData.append('file', event.target.files[0]);
        formData.append('_token', '{{ csrf_token() }}');

        $.ajax({
            url: "{{ route('profile.upload') }}",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response){
               
               Swal.fire({
                  icon: "success",
                  title: response.message,
                });

                // alert(response.message);
            },
            error: function(xhr){
               if (xhr.responseJSON && xhr.responseJSON.message) {
                    // alert(xhr.responseJSON.message);
                    
                     Swal.fire({
                  icon: "error",
                  title: "Oops...",
                  text: xhr.responseJSON.message,
                });
                
                } else {
                    alert("Error: " + xhr.status + " " + xhr.statusText);
                }
                //alert("Upload failed!");
            }
        });
    });
</script>
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
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/iconsax-icon.js"></script>
    <script src="assets/js/template-setting.js"></script>
    <script src="assets/js/image-change.js"></script>
    <script src="assets/js/script.js"></script>
</body>

</html>