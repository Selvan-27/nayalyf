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
                <a onclick="history.back();">
                    <img class="img-fluid icon-btn back-arrow" src="assets/images/svg/back-arrow.svg" alt="back-arrow">
                </a>
                <h3>Manage Address</h3>
            </div>
        </div>
    </header>
    <!-- header end -->

    
    <!--<div class="panel-space"></div>-->
    <a href="#add-address" class="btn theme-btn w-100" data-bs-toggle="offcanvas">Add New Address</a>
    <!-- languages section starts -->
    <section class="section-sm-t-space section-b-space">
        <div class="row gy-3">
               @foreach($data as $item)
            <div class="col-12">
                <div class="product-box vertical-product" 
                style="
                        background-image: linear-gradient(to right, #ffecd2 0%, #fcb69f 100%);
                        border-radius: 16px;
                        box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
                        backdrop-filter: blur(5px);
                        -webkit-backdrop-filter: blur(5px);
                        border: 1px solid rgba(255, 166, 166, 1);
                        padding-right: 30px;
                        padding-left: 30px;">
                 
                    <div class="product-content">
                        <!--<div class="see-all">-->
                        <!--    <input -->
                        <!--        class="form-check-input" -->
                        <!--        type="checkbox" -->
                        <!--        id="flexCheckDefault1" -->
                        <!--        style="border: #000 solid;" -->
                        <!--        onchange="toggleText(this)"-->
                        <!--    >-->
                        <!--    <span id="checkboxText"> Choose Address</span>-->
                        <!--</div>-->
                        <br>
                        <h2 class="title-color white-nowrap">{{$item->full_name}}</h2>
                        <h4>{{$item->mobile_no}}</h4>
                        <p>{{$item->street_address}}</p>
                        <p>{{$item->city}}, {{$item->district}}, {{$item->state}}</p>
                        <p>{{$item->pincode}}</p>
                        <div class="bottom-content">
                            <a href="#change-address_{{ $item->id }}" data-bs-toggle="offcanvas" class="btn theme-color fw-medium">📝 Edit</a>
                            <a href="/delete-address/{{$item->id}}"  class="btn theme-color fw-medium remove-address"  data-id="{{$item->id}}">❌ Remove</a>
                        </div>
                    </div>
                 
                    
                </div>
            </div>
               <div class="offcanvas offcanvas-bottom filter-offcanvas" tabindex="-1" id="change-address_{{ $item->id }}">
                        <div class="offcanvas-header">
                            <h3>Change Address</h3>
                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>
                        <form class="theme-form" action="{{ url('update-address/'.$item->id) }}" method="post">
                            @csrf
                            <div class="offcanvas-body">
                           
                               <div class="form-group">
                                    <label class="form-label" for="full_name">Full Name</label>
                                    <input type="text" class="form-control wo-icon" name="full_name"  value="{{$item->full_name?? ''}}">
                                </div>
                
                                <div class="form-group">
                                    <label class="form-label" for="inputaddress">Street Address</label>
                                    <input type="text" class="form-control wo-icon" name="street_address" placeholder="Enter address" value="{{$item->street_address?? ''}}">
                                </div>
                                     <div class="form-group">
                                    <label class="form-label" for="inputcity">Mobile No</label>
                                    <input type="text" class="form-control wo-icon" name="mobile_no"  value="{{$item->mobile_no?? ''}}">
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="inputcity">City</label>
                                    <input type="text" class="form-control wo-icon" name="city"  value="{{$item->city?? ''}}">
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="inputcode">Pin Code</label>
                                    <input type="number" class="form-control wo-icon" name="pincode"  value="{{$item->pincode?? ''}}">
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="form-label" for="memberdistrict">District</label>
                                            <input type="text" class="form-control wo-icon" name="district"  value="{{$item->district?? ''}}">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="form-label" for="memberState">State</label>
                                            <input type="text" class="form-control wo-icon" name="state" value="{{$item->state?? ''}}">
                                        </div>
                                    </div>
                                </div>
                           
                            </div>
                            <div class="btn-grp d-flex gap-3 mt-4">
                               <a data-bs-dismiss="offcanvas" class="btn white-btn w-50">CANCEL</a>
                               <button href="javascript:void(0)" type="submit" class="btn theme-btn w-50">UPDATE</button>
                            </div>
                        </form>
                    </div>
              @endforeach
        </div>
    </section>
    <!-- languages section end -->


    <!-- change address offcanvas start -->
    <div class="offcanvas offcanvas-bottom filter-offcanvas" tabindex="-1" id="add-address">
        <div class="offcanvas-header">
            <h3>Add New Address</h3>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
         <form class="theme-form" method="POST" action="{{ route('add-address') }}">
             @csrf
        <div class="offcanvas-body">
                
                
                   <div class="form-group">
                    <label class="form-label" for="full_name">Full Name</label>
                    <input type="text" class="form-control wo-icon" name="full_name" placeholder="Enter Full Name">
                </div>


                <div class="form-group">
                    <label class="form-label" for="inputaddress">Street Address</label>
                    <input type="text" class="form-control wo-icon" name="inputaddress" placeholder="Enter Street address">
                </div>

                <div class="form-group">
                    <label class="form-label" for="inputcity">Mobile</label>
                    <input type="text" class="form-control wo-icon" name="mobile_no" placeholder="Enter Mobile No">
                </div>
                <div class="form-group">
                    <label class="form-label" for="inputcity">City</label>
                    <input type="text" class="form-control wo-icon" name="inputcity" id="inputcity" placeholder="Enter city">
                </div>
                <div class="form-group">
                    <label class="form-label" for="inputcode">Pin Code</label>
                    <input type="number" class="form-control wo-icon" name="inputcode" id="inputcode" placeholder="Enter Pincode">
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
        <div class="btn-grp d-flex gap-3 mt-4">
            <a data-bs-dismiss="offcanvas" class="btn white-btn w-50">Cancel</a>
            <button href="javascript:void(0)" type="submit" class="btn theme-btn w-50">Save</button>
        </div>
         </form>
    </div>
    <!-- change address offcanvas end -->

    <!-- center modal starts -->
    <!--<div class="modal element-modal fade" id="center" tabindex="-1" aria-labelledby="exampleModalLabel"-->
    <!--    aria-hidden="true">-->
    <!--    <div class="modal-dialog modal-dialog-centered">-->
    <!--        <div class="modal-content">-->
    <!--            <div class="modal-header p-2">-->
    <!--                <h2 class="modal-title" id="exampleModalLabel">Confirm Delete</h2>-->
    <!--                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>-->
    <!--            </div>-->
                <!-- <div class="modal-body">
    <!--                <p>Are You Sure !</p>-->
    <!--            </div> -->
    <!--            <div class="modal-footer">-->
    <!--                <a href="element-modal.html" class="btn outline-btn p-2" data-bs-dismiss="modal">No</a>-->
    <!--                <a href="element-modal.html" class="btn theme-btn p-2">Yes</a>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</div>-->
    <!-- center modal end -->

    <!-- panel-space start -->
    <!-- <div class="panel-space"></div> -->
    <!-- panel-space end -->
    
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
    <script>
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".remove-address").forEach(function (button) {
        button.addEventListener("click", function (e) {
            e.preventDefault(); // stop default link action
            let orderId = this.getAttribute("data-id");
            let url = this.getAttribute("href");

            Swal.fire({
                title: 'Are you sure?',
                text: "You want to Delete this Address!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, Delete it!',
                cancelButtonText: 'No, keep it'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirect to delete url
                    window.location.href = url;
                }
            });
        });
    });
});
</script>

</body>

</html>