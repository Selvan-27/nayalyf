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
                <h3>Your Hearty Booster Passive!</h3>
                <a href="/Dashboard" class="text-center"><img src="assets/images/icon/svg/card.svg"><h6>Account</h6></a>
            </div><br>
            

            
        </div>
    </header>
    <!-- header end -->

    <!-- section starts -->
    <section class="section-b-space">
        <div class="custom-container">
            <div class="row g-3">
                
                <div class="col-6">
                    <div class="product-box" style="background-color: #0d3ff5;">
                        <div class="product-content">
                            <h5 style="color: #fff;">Booster Count</h5>
                            <div class="bottom-content">
                                <h4 style="color: #fff;">😍 {{$spl_count}}</h4>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-6">
                    <div class="product-box" style="background-color: #ffe00b;">
                        <div class="product-content">
                            <h5 style="color: #000;">Booster Bonus</h5>
                            <div class="bottom-content text-center">
                                <h4 style="color: #000;">₹ {{$total}}</h4>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div><br><hr>
        </div>
    </section>

    <section class="custom-container">
        
        <div class="title">
                <h3>Know Your Boosters!</h3>
            </div>
        <div class="table table-responsive">
            <table id="recent-orders" class="table text-center">
                <thead>
                    <tr>
                        <th class="border-top-0">S.No</th>
                        <th class="border-top-0">Date</th>
                        <th class="border-top-0">Name</th>
                        <th class="border-top-0">ID</th>
                        <th class="border-top-0">Qty</th>
                        
                    </tr>
                </thead>
                 <tbody>
                    @php $total=0 @endphp
                    @foreach($data as $item)
                    @php $total+=$item->spl_count; @endphp
                    <tr>
                        <td class="text-truncate">{{ $loop->iteration }}</td>
                       
                        <td class="text-truncate">{{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y') }}</td>
                        <td class="text-truncate">{{$item->name}}</td>
                          <td class="text-truncate">{{$item->fromId}}</td>
                        <td class="text-truncate">{{$item->spl_count}}</td>
                        
                    </tr>
                    @endforeach
                   
                </tbody>
                <tfoot>
                   
                </tfoot>
            </table>
        </div>
    </section>
    <br><br><br><br><br><br>
            
    <!-- section ends -->


    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/iconsax-icon.js"></script>
    <script src="assets/js/template-setting.js"></script>
    <script src="assets/js/script.js"></script>
</body>

</html>