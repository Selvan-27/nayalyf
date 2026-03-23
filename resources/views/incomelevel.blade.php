
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
    

    .card {
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      padding: 20px;
      overflow-x: auto; /* allow scroll if tree is wide */
      text-align: center;
    }

    .tree-avatar {
      border-radius: 50%;
      width: 75px !important;
      height: 75px !important;
      object-fit: cover;
      display: block;
      margin: 0 auto;
    }

    .tree-cell {
      width: 100px;
      height: 120px;
      vertical-align: top;
      padding: 10px;
    }

    .tree-cell p {
      margin: 5px 0;
      font-size: 12px;
      line-height: 1.2;
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
                <h3>Leadership, In Levels!</h3>
                <a href="/Dashboard" class="text-center"><img src="assets/images/icon/svg/card.svg"><h6>Account</h6></a>
            </div>
        </div>
    </header>
    <!-- header end -->

    <!-- section starts -->
    <section class="section-b-space">
        <div class="custom-container">
            <div class="row g-3 pt-3">
                <div class="col-12">
                    <div class="product-box" style="background-color: #0d3ff5;">
                        <div class="product-box vertical-product">
                            <div class="product-content">
                                <h5 style="color: #fff;">Level 1</h5>
                                <div class="bottom-content">
                                    <h4 style="color: #fff;">₹ {{$level1_payout ?? "0"}}</h4>
                                </div>
                            </div>
                            <div class="see-all">
                                <h6 style="color: #fff;" class="text-center">RP Count<br>{{$level1_repurchase_count?? "0"}}</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="product-box" style="background-color: #0d3ff5;">
                        <div class="product-box vertical-product">
                            <div class="product-content">
                                <h5 style="color: #fff;">Level 2</h5>
                                <div class="bottom-content">
                                    <h4 style="color: #fff;">₹ {{$level2_payout ?? "0"}}</h4>
                                </div>
                            </div>
                            <div class="see-all">
                                <h6 style="color: #fff;" class="text-center">RP Count<br>{{$level2_repurchase_count?? "0"}}</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="product-box" style="background-color: #0d3ff5;">
                        <div class="product-box vertical-product">
                            <div class="product-content">
                                <h5 style="color: #fff;">Level 3</h5>
                                <div class="bottom-content">
                                    <h4 style="color: #fff;">₹ {{$level3_payout ?? "0"}}</h4>
                                </div>
                            </div>
                            <div class="see-all">
                                <h6 style="color: #fff;" class="text-center">RP Count<br>{{$level3_repurchase_count?? "0"}}</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="product-box" style="background-color: #ffe00b;">
                        <div class="product-box vertical-product">
                            <div class="product-content">
                                <h5 style="color: #000;">Total Bonus</h5>
                                <div class="bottom-content">
                                    <h4 style="color: #000;">₹ {{$sum_of_level ?? "0"}}</h4>
                                </div>
                            </div>
                            <!-- <div class="see-all">
                                <h6 style="color: #fff;" class="text-center">RP Count<br>0</h6>
                            </div> -->
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </section>
    
    

    <hr>
    
    <section class="custom-container">
        <div class="element-title mb-3">
            <h3 class="theme-color text-center">Leader Level 1 Bonus Report</h3>
        </div>
        <div class="table table-responsive">
            <table id="recent-orders" class="table text-center">
                <thead>
                    <tr>
                        <th class="border-top-0">S.No</th>
                        <th class="border-top-0">Date</th>
                        <th class="border-top-0" style="white-space: nowrap;">Cut-Off 1</th>
                        <th class="border-top-0" style="white-space: nowrap;">Cut-Off 2</th>
                        <th class="border-top-0" style="white-space: nowrap;">Total RP IDs</th>
                        <th class="border-top-0" style="white-space: nowrap;">Carry Forward RP IDs</th>
                        <th class="border-top-0">Bonus</th>
                    </tr>
                </thead>
                <tbody>
                    
                    
                    @foreach($data as  $item)
                    <tr>
                        <td class="text-truncate">1.</td>
                        <td class="text-truncate">{{$item->created_at}}</td>
                        <td class="text-truncate"></td>
                        <td class="text-truncate"></td>
                        <td class="text-truncate"></td>
                        <td class="text-truncate"></td>
                        <td class="text-truncate">₹ {{$item->payout}}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <!--<tr>-->
                    <!--    <th></th>-->
                    <!--    <th>Total Bonus</th>-->
                    <!--    <th></th>-->
                    <!--    <th>₹ </th>-->
                    <!--</tr>-->
                </tfoot>
            </table>
        </div>
    </section><hr><br>

    <section class="custom-container">
        <div class="element-title mb-3">
            <h3 class="theme-color text-center">Leader Level 2 & 3 Bonus Report</h3>
        </div>
        <div class="table table-responsive">
            <table id="recent-orders" class="table text-center">
                <thead>
                    <tr>
                        <th class="border-top-0">S.No</th>
                        <th class="border-top-0">Date</th>
                        <th class="border-top-0">Level</th>
                        <th class="border-top-0">Bonus</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as  $item)
                      @php $payout =$item->payout ?? 0; $total+=$payout; @endphp
                    <tr>
                        <td class="text-truncate">1.</td>
                        <td class="text-truncate">{{$item->created_at}}</td>
                   
                        <td class="text-truncate">{{$item->level}}</td>
                        <td class="text-truncate">₹ {{$item->payout}}</td>
                    </tr>
                    @endforeach
                </tbody>
                @isset($total)
                <tfoot>
                    <tr>
                        <th></th>
                        <th>Total Bonus</th>
                        
                         <th>₹ {{$total ?? '0'}}</th>
                    </tr>
                </tfoot>
                @endisset
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