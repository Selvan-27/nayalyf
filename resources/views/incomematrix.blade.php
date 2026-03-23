
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

    .tree {
      display: flex;
      flex-direction: column;
      align-items: center;
      min-width: 600px;
    }

    .node {
      background: #fff;
      color: #fff;
      padding: ;
      border-radius: 50%;
      margin: 5px;
      max-width: 50px;
      max-height: 50px;

      font-size: 10px;
      font-weight: bold;
    }

    .children {
      display: flex;
      justify-content: center;
      margin-top: 10px;
    }

    .branch {
      display: flex;
      flex-direction: column;
      align-items: center;
      margin: 0 15px;
    }

    .a {
        font-size: 10px;
    }

    /* responsive for mobile */
    @media (max-width: 480px) {
      .tree {
        min-width: 400px;
      }
      .node {
        min-width: 50px;
        font-size: 12px;
        padding: 6px 8px;
      }
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
                <h3>Leader Matrix, Uniqcally!</h3>
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
                                <h5 style="color: #fff;">Leader Matrix Bonus</h5>
                                <div class="bottom-content">
                                    <h4 style="color: #fff;">₹ 0</h4>
                                </div>
                            </div>
                            <div class="see-all">
                                <h6 style="color: #fff;" class="text-center">Matrix ID<br>0</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="form">
                    <div class="form-group row">
                        <label for="exampleFormControlSelect1" class="col-xl-3 col-sm-4 mb-0">Select ID</label>
                        <div class="col-xl-8 col-sm-6">
                            <select class="form-control digits"
                            id="exampleFormControlSelect1">
                            <option value="1">Board 1</option>
                            <option value="2">Board 2</option>
                            <option value="3">Board 3</option>
                            <option value="4">Board 4</option>
                            <option value="5">Board 5</option>
                        </select>
                        </div>
                    </div>
                </div> -->
                
            </div>
        </div>
    </section>
    
    

    <section class="custom-container">
        <div class="card">
            <div class="tree">
                @if(isset($matrix_data['tree_data']) && $matrix_data['tree_data'])
                    @php
                        function displayMatrixNode($node_data, $level = 0) {
                            if (!$node_data) return;
                            
                            $node = $node_data['node'];
                            $children = $node_data['children'];
                            
                            // Root node or any node - wrap in link for navigation
                            if ($level > 0) {
                                echo '<a href="/incomematrix?root=' . $node->memberid . '" style="text-decoration: none; color: inherit;">';
                            }
                            
                            echo '<div class="node">';
                            echo '<img style="border-radius: 50%; max-width: 100%;" src="assets/images/avatar/1.png" alt="">';
                            echo '</div>';
                            echo '<div class="a">' . ($node->FullName ?? 'N/A') . '<br>' . $node->memberid . '</div>';
                            
                            if ($level > 0) {
                                echo '</a>';
                            }
                            
                            if ($children && ($children['p1'] || $children['p2'] || $children['p3'])) {
                                echo '<div class="children">';
                                foreach (['p1', 'p2', 'p3'] as $pos) {
                                    if ($children[$pos]) {
                                        echo '<div class="branch">';
                                        displayMatrixNode($children[$pos], $level + 1);
                                        echo '</div>';
                                    } else {
                                        echo '<div class="branch">';
                                        echo '<div class="node"><img style="border-radius: 50%; max-width: 100%;" src="assets/images/avatar/1.png" alt=""></div>';
                                        echo '<div class="a">Empty</div>';
                                        echo '</div>';
                                    }
                                }
                                echo '</div>';
                            }
                        }
                    @endphp

                    @php displayMatrixNode($matrix_data['tree_data']); @endphp
                @else
                    <!-- Default static tree when no data -->
                    <!-- Root -->
                    <div class="node"><img style="border-radius: 50%; max-width: 100%;" src="assets/images/avatar/1.png" alt=""></div><div class="a">{{ Auth::user()->name ?? 'N/A' }}<br>{{ Auth::user()->memberid ?? 'UC10001' }}</div>

                    <!-- Level 2 -->
                    <div class="children">
                        <div class="branch">
                            <a href="#"><div class="node"><img style="border-radius: 50%; max-width: 100%;" src="assets/images/avatar/1.png" alt=""></div><div class="a">Empty</div></a>
                        </div>
                        <div class="branch">
                            <a href="#"><div class="node"><img style="border-radius: 50%; max-width: 100%;" src="assets/images/avatar/1.png" alt=""></div><div class="a">Empty</div></a>
                        </div>
                        <div class="branch">
                            <a href="#"><div class="node"><img style="border-radius: 50%; max-width: 100%;" src="assets/images/avatar/1.png" alt=""></div><div class="a">Empty</div></a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section><hr>
    
    <section class="custom-container">
        <div class="element-title mb-3">
            <h3 class="theme-color text-center">Leader Matrix Bonus Report</h3>
        </div>
        
             
         
        
        <div class="table table-responsive">
            <table id="recent-orders" class="table text-center">
                <thead>
                    <tr>
                        <th class="border-top-0">S.No</th>
                        <th class="border-top-0">Date</th>
                        <th class="border-top-0">From Id</th>
                        <th class="border-top-0">To Id</th>
                        <th class="border-top-0">Bonus</th>
                        
                    </tr>
                </thead>
                <tbody>
                     @foreach($data as  $item)
                       @php $total+=$item->payout; @endphp
                    <tr>
                        <td class="text-truncate">{{ $loop->iteration }}</td>
                        <td class="text-truncate">{{ $item->created_at}}</td>
                   
                        <td class="text-truncate">{{$item->fromId}}</td>
                        <td class="text-truncate">{{$item->memberid}}</td>
                        <td class="text-truncate">₹ {{$item->payout}}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th></th>
                        <th>Total Bonus</th>
                        <th></th>
                         <th>₹ {{$total}}</th>
                    </tr>
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