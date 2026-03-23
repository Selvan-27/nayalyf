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
                <h3>Re-Purchases Rocks!</h3>
                <a href="/Dashboard" class="text-center"><img src="assets/images/icon/svg/card.svg"><h6>Account</h6></a>
            </div><br>
            

            
        </div>
    </header>
    <!-- header end -->

    <!-- section starts -->
    <section class="section-b-space">
        <div class="custom-container">
            <div class="row g-3">
                
                <div class="col-12">
                    <div class="product-box" style="background-color: #ffe00b;">
                        <div class="product-content">
                            <h5 style="color: #000;">Re-Purchase Level Bonus</h5>
                            <div class="bottom-content text-center">
                                <h4 style="color: #000;">₹ {{ $repurchase_level_payout ?? 0 }}</h4>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div><br><hr>
            <!-- <div class="row gy-3 gx-0">
                <div class="title">
                    <h3>Your Achievement Tree!</h3>
                </div>
                <div class="element-title mb-3">
                    <h3 class="theme-color text-center">[member_id]</h3>
                </div>
                <div class="elements-tab">
                    <ul class="nav nav-pills tab-style3 w-100 mt-0" id="myTab" role="tablist">
                        <li class="nav-item w-50" role="presentation">
                            <button class="nav-link active" id="la-tab" data-bs-toggle="tab"
                                data-bs-target="#la-tab-pane" type="button" role="tab" aria-controls="la-tab-pane"
                                aria-selected="true"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/avatar/1.png" alt="">UC154933</button>
                        </li>
                        <li class="nav-item w-50" role="presentation">
                            <button class="nav-link" id="lb-tab" data-bs-toggle="tab"
                                data-bs-target="#lb-tab-pane" type="button" role="tab" aria-controls="lb-tab-pane"
                                aria-selected="false"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/avatar/1.png" alt="">UC154933</button>
                        </li>
                        <li class="nav-item w-50" role="presentation">
                            <button class="nav-link" id="lc-tab" data-bs-toggle="tab"
                                data-bs-target="#lc-tab-pane" type="button" role="tab" aria-controls="lc-tab-pane"
                                aria-selected="false" ><img style="border-radius: 50%; max-width: 50%;" src="assets/images/avatar/1.png" alt="">UC154933</button>
                        </li>
                    </ul><br>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade p-2 show active" id="la-tab-pane" role="tabpanel"
                            aria-labelledby="la-tab" tabindex="0">
                            <table class="table table-responsive text-center">
                                <tr>
                                    <td></td>
                                    <td>
                                        <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/avatar/1.png" alt="">
                                        <p>UC10001</p></a>
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/avatar/1.png" alt="">
                                        <p>UC10001</p></a>
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/avatar/1.png" alt="">
                                        <p>UC10001</p></a>
                                    </td>
                                    <td></td>
                                </tr>
            
                                <tr>
                                    <td>
                                        <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/avatar/1.png" alt="">
                                        <p>UC10001</p></a>
                                    </td>
                                    <td>
                                        <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/avatar/1.png" alt="">
                                        <p>UC10001</p></a>
                                    </td>
                                    <td>
                                        <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/avatar/1.png" alt="">
                                        <p>UC10001</p></a>
                                    </td>
                                    <td>
                                        <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/avatar/1.png" alt="">
                                        <p>UC10001</p></a>
                                    </td>
                                    <td>
                                        <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/avatar/1.png" alt="">
                                        <p>UC10001</p></a>
                                    </td>
                                    <td>
                                        <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/avatar/1.png" alt="">
                                        <p>UC10001</p></a>
                                    </td>
                                    <td>
                                        <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/avatar/1.png" alt="">
                                        <p>UC10001</p></a>
                                    </td>
                                    <td>
                                        <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/avatar/1.png" alt="">
                                        <p>UC10001</p></a>
                                    </td>
                                    <td>
                                        <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/avatar/1.png" alt="">
                                        <p>UC10001</p></a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="tab-pane fade p-2" id="lb-tab-pane" role="tabpanel" aria-labelledby="lb-tab"
                            tabindex="0">
                            <table class="table table-responsive text-center">
                                <tr>
                                    <td></td>
                                    <td>
                                        <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/avatar/1.png" alt="">
                                        <p>UC10001</p></a>
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/avatar/1.png" alt="">
                                        <p>UC10001</p></a>
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/avatar/1.png" alt="">
                                        <p>UC10001</p></a>
                                    </td>
                                    <td></td>
                                </tr>
            
                                <tr>
                                    <td>
                                        <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/avatar/1.png" alt="">
                                        <p>UC10001</p></a>
                                    </td>
                                    <td>
                                        <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/avatar/1.png" alt="">
                                        <p>UC10001</p></a>
                                    </td>
                                    <td>
                                        <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/avatar/1.png" alt="">
                                        <p>UC10001</p></a>
                                    </td>
                                    <td>
                                        <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/avatar/1.png" alt="">
                                        <p>UC10001</p></a>
                                    </td>
                                    <td>
                                        <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/avatar/1.png" alt="">
                                        <p>UC10001</p></a>
                                    </td>
                                    <td>
                                        <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/avatar/1.png" alt="">
                                        <p>UC10001</p></a>
                                    </td>
                                    <td>
                                        <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/avatar/1.png" alt="">
                                        <p>UC10001</p></a>
                                    </td>
                                    <td>
                                        <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/avatar/1.png" alt="">
                                        <p>UC10001</p></a>
                                    </td>
                                    <td>
                                        <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/avatar/1.png" alt="">
                                        <p>UC10001</p></a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="tab-pane fade p-2" id="lc-tab-pane" role="tabpanel" aria-labelledby="lc-tab"
                            tabindex="0">
                            <table class="table table-responsive text-center">
                                <tr>
                                    <td></td>
                                    <td>
                                        <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/avatar/1.png" alt="">
                                        <p>UC10001</p></a>
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/avatar/1.png" alt="">
                                        <p>UC10001</p></a>
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/avatar/1.png" alt="">
                                        <p>UC10001</p></a>
                                    </td>
                                    <td></td>
                                </tr>
            
                                <tr>
                                    <td>
                                        <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/avatar/1.png" alt="">
                                        <p>UC10001</p></a>
                                    </td>
                                    <td>
                                        <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/avatar/1.png" alt="">
                                        <p>UC10001</p></a>
                                    </td>
                                    <td>
                                        <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/avatar/1.png" alt="">
                                        <p>UC10001</p></a>
                                    </td>
                                    <td>
                                        <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/avatar/1.png" alt="">
                                        <p>UC10001</p></a>
                                    </td>
                                    <td>
                                        <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/avatar/1.png" alt="">
                                        <p>UC10001</p></a>
                                    </td>
                                    <td>
                                        <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/avatar/1.png" alt="">
                                        <p>UC10001</p></a>
                                    </td>
                                    <td>
                                        <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/avatar/1.png" alt="">
                                        <p>UC10001</p></a>
                                    </td>
                                    <td>
                                        <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/avatar/1.png" alt="">
                                        <p>UC10001</p></a>
                                    </td>
                                    <td>
                                        <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/avatar/1.png" alt="">
                                        <p>UC10001</p></a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div><hr> -->
            <div class="row gy-3 gx-0">
                <div class="title">
                    <h3>Repurchase Level Bonus Report!</h3>
                </div>
                <div class="form">
                    <div class="form-group row">
                        <label for="exampleFormControlSelect1"
                            class="col-xl-3 col-sm-4 mb-0">Select Cut-Off:</label>
                         <div class="col-xl-8 col-sm-7">
                        <select class="form-control digits" id="exampleFormControlSelect1" onchange="changeSelectedId()">
                             <option>select option</option>
                            @foreach($data['related_ids'] as $id_info)
                                <option value="{{ $id_info['id'] }}" 
                                    {{ $data['selected_member_id'] == $id_info['name'] ? 'selected' : '' }}>
                                    {{ $id_info['name'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    </div>
                    
                </div> 
                <div class="table table-responsive">
                    <table id="recent-orders" class="table text-center">
                        <thead>
                            <tr>
                                <th class="border-top-0">Level</th>
                                <th class="border-top-0">RP IDs</th>
                                <th class="border-top-0">Bonus</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($data['level']) && count($data['level']) > 0)
                                @foreach($data['level'] as $item)
                                <tr>
                                    <td class="text-truncate">{{ $item['level'] }}</td>
                                    <td class="text-truncate">{{ $item['count'] }}</td>
                                    <td class="text-truncate">₹ {{ $item['amount'] }}</td>
                                </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="3" class="text-center">No data available</td>
                                </tr>
                            @endif
                        
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Total</th>
                                <th>{{ $data['count'] ?? 0 }}</th>
                                <th>₹ {{ $data['total_amount'] ?? 0.00 }}</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                
                
                
            </div>
 <div class="table table-responsive">
                    <table id="recent-orders" class="table text-center">
                        <thead>
                            <tr>
                                <th class="border-top-0">S.No</th>
                                <th class="border-top-0">RP IDs</th>
                                <th class="border-top-0">Date</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($repurchase_members) && count($repurchase_members) > 0)
                                @foreach($repurchase_members as $item)
                                <tr>
                                    <td class="text-truncate">{{ $loop->iteration }}</td>
                                    <td class="text-truncate">{{ $item->rp_id }}</td>
                                    <td class="text-truncate">{{ $item->activation_date }}</td>
                                </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="3" class="text-center">No ID's available</td>
                                </tr>
                            @endif
                        
                        </tbody>
                       
                    </table>
                </div>
               


        </div>
    </section>
    <!-- section ends -->

    <script>
        function changeSelectedId() {
            const selectedId = document.getElementById('exampleFormControlSelect1').value;
            
            // Redirect to the same page with new selected_id and reset root to selected_id
            window.location.href = '/Repurchase_Level_Bonus?selected_id=' + selectedId + '&root=' + selectedId;
        }
    </script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/iconsax-icon.js"></script>
    <script src="assets/js/template-setting.js"></script>
    <script src="assets/js/script.js"></script>
</body>

</html>