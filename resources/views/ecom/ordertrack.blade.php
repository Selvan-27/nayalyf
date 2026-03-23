<!DOCTYPE html>
<html lang="en">


<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="uniqconnect">
    <meta name="keywords" content="uniqconnect">
    <meta name="author" content="uniqconnect">
    <link rel="manifest" href="manifest.json">
    <link rel="icon" href="{{asset('assets/images/logo/favicon.png')}}" type="image/x-icon">
    <title>Uniq Connect</title>
    <link rel="apple-touch-icon" href="{{asset('assets/images/logo/favicon.png')}}">
    <meta name="theme-color" content="#2777FC">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="uniqconnect">
    <meta name="msapplication-TileImage" content="{{asset('assets/images/logo/favicon.png')}}">
    <meta name="msapplication-TileColor" content="#FFFFFF">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="{{asset('assets/css/br-hendrix.css')}}">
    <link rel="stylesheet" type="text/css" id="rtl-link" href="{{asset('assets/css/vendors/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/swiper-bundle.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/iconsax.css')}}">
    <link rel="stylesheet" id="change-link" type="text/css" href="{{asset('assets/css/style.css')}}">
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
                <a href="/Orders">
                    <img class="img-fluid icon-btn back-arrow" src="{{asset('assets/images/svg/back-arrow.svg')}}" alt="back-arrow">
                </a>
                <h3>Track Order</h3>
            </div>
        </div>
    </header>
    <!-- header end -->

    <!-- track order section starts -->
    <section class="section-sm-t-space">
        <div class="custom-container">
            <div class="order-section">
                <div class="product-box vertical-product" style="background-color: #a1fdc0;">
                                
                    <div class="product-content">
                        <h5 class="title-color white-nowrap">Order No: {{$orders->order_id}} </h5>
                        <h6 class="content-color quantity-content">Date: {{ $orders->created_at->format('d-m-Y') }} | Qty:1</h6>
                        <div class="bottom-content">
                            <h5 class="price">₹  {{$orders->total}}</h5>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </section>

    <div class="order-details section-t-space">
        <div class="custom-container">
            <h4>Order Details</h4>
        </div>
    </div>

    <section class="section-sm-t-space">
        <ul class="order-details-list">
            <li>
                <h5 class="fw-medium content-color">Expected Delivery Date</h5>
                <h5 class="fw-medium title-color">{{ $orders->created_at->copy()->addDay(5)->format('d-m-Y') }}</h5>
            </li>
            <li>
                <h5 class="fw-medium content-color">Tracking ID</h5>
                <h5 class="fw-medium title-color">
                    {{ $orders->pnr_number ? $orders->pnr_number : 'In Progress' }}
                
                </h5>
            </li>
        </ul>
    </section>

    <section class="section-b-space">
        <div class="custom-container">
            <div class="order-status">
                <div class="status-head">
                    <h5 class="fw-medium content-color">Order Status</h5>
                </div>
                <div class="status-body">
                    <ul class="status-list">
                        <li class="status-box completed">
                            <div class="status-icon">
                                <img class="img-fluid tick-icon" src="{{asset('assets/images/svg/check.svg')}}" alt="check">
                            </div>
                            <div class="status-details">
                                <div class="status-content">
                                    <h6 class="fw-medium title-color">Order Placed</h6>
                                    <h6 class="fw-medium content-color mt-2"> {{$orders->created_at->format('d-m-Y, h:i:s A')}}</h6>
                                </div>
                                <i class="iconsax icon" data-icon="clipboard-text-1"></i>
                            </div>
                        </li>
                       <li class="status-box  completed">
                            <div class="status-icon">
                                <img class="img-fluid tick-icon" src="{{asset('assets/images/svg/check.svg')}}" alt="check">
                            </div>
                            <div class="status-details">
                                <div class="status-content">
                                    <h6 class="fw-medium title-color">Order In Progress</h6>
                                    <h6 class="fw-medium content-color mt-2">{{$orders->created_at->format('d-m-Y, h:i:s A')}}</h6>
                                </div>
                                <i class="iconsax icon" data-icon="box"></i>
                            </div>
                        </li>
                        <li class="status-box @if($orders->status === 'shipped') completed @endif @if($orders->status === 'delivered') completed @endif">
                            <div class="status-icon">
                                <img class="img-fluid icon" src="{{asset('assets/images/svg/check.svg')}}" alt="check">
                            </div>
                            <div class="status-details">
                                <div class="status-content">
                                    <h6 class="fw-medium title-color">Order Shipping</h6>
                                    <h6 class="fw-medium content-color mt-2"> Expected {{ $orders->created_at->copy()->addDay()->format('d-m-Y') }}</h6>
                                </div>
                                <i class="iconsax icon" data-icon="truck-tick"></i>
                            </div>
                        </li>
                        <li class="status-box @if($orders->status === 'delivered') completed @endif">
                            <div class="status-icon">
                                <img class="img-fluid icon" src="{{asset('assets/images/svg/check.svg')}}" alt="check">
                            </div>
                            <div class="status-details">
                                <div class="status-content">
                                    <h6 class="fw-medium title-color">Order Delivery</h6>
                                    <h6 class="fw-medium content-color mt-2">Expected {{ $orders->created_at->copy()->addDay(5)->format('d-m-Y') }}</h6>
                                </div>
                                <i class="iconsax icon" data-icon="box-tick"></i>
                            </div>
                        </li>
                    </ul>
                </div>
                
                
            </div>
        </div>
    </section>
    <div class="fixed-btn-grp">
         @php
            use Carbon\Carbon;

            $orderAgeInHours = Carbon::parse($orders->created_at)->diffInHours(Carbon::now());
            $st=$orders->status;
        @endphp
    @if($st=== "pending")
<div class="custom-container">
     
      

        @if($orderAgeInHours < 5)
            <a href="/Cancel-order/{{$orders->id}}" 
               class="btn theme-btn w-100 cancel-order" 
               data-id="{{$orders->id}}">
               Cancel Order
            </a>
        @endif
           
</div>


          
            <!--<a href="#center" class="btn theme-btn w-100" data-bs-toggle="modal">Center Modal</a>-->

            <div class="title">
                <p>You Can Cancel<br>This Order Within</p>
                <p class="title-timer" id="timer"></p>
                <!--<p>You Can Cancel This Order Within 5 hours. </p>-->
                <!--<div class="d-flex align-items-center gap-1">-->
                    
                <!--    <div class="title-timer" id="clock">-->
                <!--        <i class="iconsax clock" data-icon="clock"> </i>-->

                <!--        <div class="counter">-->
                <!--            <span class="hours"></span>-->
                <!--        </div>-->
                <!--        <div class="counter">-->
                <!--            <span class="minutes"></span>-->
                <!--        </div>-->
                <!--        <div class="counter">-->
                <!--            <span class="seconds"></span>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--</div>-->
            </div>
         @endif    
    </div>

    <!-- center modal starts -->
    <!--<div class="modal element-modal fade" id="cancel-order" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">-->
    <!--    <div class="modal-dialog modal-dialog-centered">-->
    <!--        <div class="modal-content">-->
    <!--            <div class="modal-header p-2">-->
    <!--                <h2 class="modal-title" id="exampleModalLabel">Cancel Order?</h2>-->
    <!--                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>-->
    <!--            </div>-->
    <!--            <div class="modal-body">-->
    <!--                <p>Are You Sure To Cancel This Order </p>-->
    <!--            </div>-->
    <!--            <div class="modal-footer">-->
    <!--                <a href="#" class="btn outline-btn p-2" data-bs-dismiss="modal">No</a>-->
    <!--                <a href="#" class="btn theme-btn p-2">Yes</a>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</div>-->
    <!-- center modal end -->
    
    

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".cancel-order").forEach(function (button) {
        button.addEventListener("click", function (e) {
            e.preventDefault(); // stop default link action
            let orderId = this.getAttribute("data-id");
            let url = this.getAttribute("href");

            Swal.fire({
                title: 'Are you sure?',
                text: "You want to cancel this order!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, cancel it!',
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


<script>
    
    let limit = 5 * 60 * 60; // 5 hours in seconds


let time2 = {{$orders_from_seconds}}; // 5 hours in seconds

let time=limit-time2;
//  let time = {{$orders_from_seconds}}; // order age in seconds
    
function formatTime(seconds) {
    let h = Math.floor(seconds / 3600);
    let m = Math.floor((seconds % 3600) / 60);
    let s = seconds % 60;

    return (
        String(h).padStart(2, '0') + ":" +
        String(m).padStart(2, '0') + ":" +
        String(s).padStart(2, '0')
    );
}

let countdown = setInterval(function() {
    document.getElementById("timer").innerHTML = formatTime(time);
    time--;

    if (time < 0) {
        clearInterval(countdown);
        document.getElementById("timer").innerHTML = "You Can Cancel This Order Within 5 hours.!";
    }
}, 1000);
</script>

    <!-- bootstrap js -->
    <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/js/iconsax-icon.js')}}"></script>
    <script src="{{asset('assets/js/template-setting.js')}}"></script>
    <script src="{{asset('assets/js/script.js')}}"></script>
    <script src="{{asset('assets/js/timer.js')}}"></script>
</body>

</html>