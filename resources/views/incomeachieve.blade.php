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
      width: 60px !important;
      height: 60px !important;
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
                <h3>Your Team, You Ignited!</h3>
                <a href="/Dashboard" class="text-center"><img src="assets/images/icon/svg/card.svg"><h6>Account</h6></a>
            </div><br>
        </div>
    </header>
    <!-- header end -->

    <!-- section starts -->
    <section class="section-b-space">
        <div class="custom-container">
            <div class="row g-3">
                @foreach($data['achievement_levels']['levels'] as $level_data)
                <div class="col-6">
                    <div class="product-box" style="background-color: #0d3ff5;">
                        <div class="product-box vertical-product">
                            <div class="product-content">
                                <h5 style="color: #fff;">Level {{ $level_data['level'] }}</h5>
                                <div class="bottom-content">
                                    <h4 style="color: #fff;">₹ {{ number_format($level_data['total_amount']) }}</h4>
                                </div>
                            </div>
                            <div class="see-all">
                                <h6 style="color: #fff;">{{ number_format($level_data['amount_per_bonus']) }} X {{ $level_data['bonuses_earned'] }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                
                <div class="col-6">
                    <div class="product-box" style="background-color: #ffe00b;">
                        <div class="product-content">
                            <h5 style="color: #000;">Total Bonus</h5>
                            <div class="bottom-content text-center">
                                <h4 style="color: #000;">₹ {{ number_format($data['achievement_levels']['total_earned']) }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div><br><hr>
            <section class="custom-container">
                <div class="card">
                    @if($data['tree_data'])
                        <h5 class="text-center mb-3">Achievement Tree</h5>
                        <table class="table table-responsive text-center">
                            @php
                                function renderAchievementTreeRow($tree, $login_id) {
                                    // Root node (centered)
                                    echo '<tr>';
                                    for ($j = 0; $j < 4; $j++) echo '<td></td>';
                                    
                                    if ($tree && isset($tree['node'])) {
                                        $node = $tree['node'];
                                        $member_name = $node->FullName ?? 'N/A';
                                        echo '<td class="tree-cell">';
                                        echo '<a href="/Achievement_Bonus?selected_id=' . $login_id . '&root=' . $node->memberid . '">';
                                        echo '<img class="tree-avatar" src="assets/images/avatar/1.png" alt="">';
                                        echo '<p>' . $node->memberid . '</p><p>' . $member_name . '</p>';
                                        echo '</a>';
                                        echo '</td>';
                                    } else {
                                        echo '<td class="tree-cell">';
                                        echo '<img class="tree-avatar" src="assets/images/avatar/0.jpg" alt="">';
                                        echo '<p>Vacant</p>';
                                        echo '</td>';
                                    }
                                    
                                    for ($j = 0; $j < 4; $j++) echo '<td></td>';
                                    echo '</tr>';
                                    
                                    // Children level (3 nodes)
                                    echo '<tr>';
                                    echo '<td></td>';
                                    $children = ($tree && isset($tree['children'])) ? $tree['children'] : [];
                                    foreach (["p1", "p2", "p3"] as $pos) {
                                        if (isset($children[$pos]) && $children[$pos]) {
                                            $child = $children[$pos];
                                            $node = $child['node'];
                                            $member_name = $node->FullName ?? 'N/A';
                                            echo '<td class="tree-cell">';
                                            echo '<a href="/Achievement_Bonus?selected_id=' . $login_id . '&root=' . $node->memberid . '">';
                                            echo '<img class="tree-avatar" src="assets/images/avatar/1.png" alt="">';
                                            echo '<p>' . $node->memberid . '</p><p>' . $member_name . '</p>';
                                            echo '</a>';
                                            echo '</td>';
                                        } else {
                                            echo '<td class="tree-cell">';
                                            echo '<img class="tree-avatar" src="assets/images/avatar/0.jpg" alt="">';
                                            echo '<p>Vacant</p>';
                                            echo '</td>';
                                        }
                                        if ($pos != "p3") echo '<td></td><td></td>';
                                    }
                                    echo '</tr>';
                                    
                                    // Grandchildren level (9 nodes)
                                    echo '<tr>';
                                    $grandchildren = [];
                                    foreach (["p1", "p2", "p3"] as $pos) {
                                        if (isset($children[$pos]) && $children[$pos] && isset($children[$pos]['children'])) {
                                            $grandchildren[$pos] = $children[$pos]['children'];
                                        } else {
                                            $grandchildren[$pos] = null;
                                        }
                                    }
                                    
                                    foreach (["p1", "p2", "p3"] as $pos) {
                                        if ($grandchildren[$pos]) {
                                            foreach (["p1", "p2", "p3"] as $gpos) {
                                                if (isset($grandchildren[$pos][$gpos]) && $grandchildren[$pos][$gpos]) {
                                                    $gchild = $grandchildren[$pos][$gpos]['node'];
                                                    $gmember_name = $gchild->FullName ?? 'N/A';
                                                    echo '<td class="tree-cell">';
                                                    echo '<a href="/Achievement_Bonus?selected_id=' . $login_id . '&root=' . $gchild->memberid . '">';
                                                    echo '<img class="tree-avatar" src="assets/images/avatar/1.png" alt="">';
                                                    echo '<p>' . $gchild->memberid . '</p><p>' . $gmember_name . '</p>';
                                                    echo '</a>';
                                                    echo '</td>';
                                                } else {
                                                    echo '<td class="tree-cell">';
                                                    echo '<img class="tree-avatar" src="assets/images/avatar/0.jpg" alt="">';
                                                    echo '<p>Vacant</p>';
                                                    echo '</td>';
                                                }
                                            }
                                        } else {
                                            // Fill with 3 empty cells if no grandchildren
                                            for ($k = 0; $k < 3; $k++) {
                                                echo '<td class="tree-cell">';
                                                echo '<img class="tree-avatar" src="assets/images/avatar/0.jpg" alt="">';
                                                echo '<p>Vacant</p>';
                                                echo '</td>';
                                            }
                                        }
                                    }
                                    echo '</tr>';
                                }
                                
                                renderAchievementTreeRow($data['tree_data'], $data['selected_member_id']);
                            @endphp
                        </table>
                    @else
                        <div class="text-center py-5">
                            <h5 class="text-muted">Achievement Tree is not active yet</h5>
                            <p class="text-muted">Complete required levels to activate achievement tree</p>
                        </div>
                    @endif
                </div>
            </section><hr>
            <div class="row gy-3 gx-0">
                <div class="title">
                    <h3>Your Achievement Bonus Report!</h3>
                </div>
                <div class="card">
                <div class="table table-responsive">
                    <table id="recent-orders" class="table text-center">
                        <thead>
                            <tr>
                                <th class="border-top-0">Level</th>
                                <th class="border-top-0">Members</th>
                                <th class="border-top-0">1st Bonus</th>
                                <th class="border-top-0">2nd Bonus</th>
                                <th class="border-top-0">3rd Bonus</th>
                                <th class="border-top-0">4th Bonus</th>
                                <th class="border-top-0">5th Bonus</th>
                                <th class="border-top-0">6th Bonus</th>
                                <th class="border-top-0">7th Bonus</th>
                                <th class="border-top-0">8th Bonus</th>
                                <th class="border-top-0">9th Bonus</th>
                                <th class="border-top-0">10th Bonus</th>
                                <th class="border-top-0">11th Bonus</th>
                                <th class="border-top-0">12th Bonus</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data['achievement_levels']['levels'] as $level_data)
                            <tr>
                                <td class="text-truncate">{{ $level_data['level'] }}</td>
                                <td class="text-truncate">{{ $level_data['actual'] }}/{{ number_format($level_data['target']) }}</td>
                                @for($i = 1; $i <= 12; $i++)
                                <td class="text-truncate">
                                    @if($i <= $level_data['bonuses_earned'])
                                        {{ date('d-m-Y') }}
                                    @else
                                        -
                                    @endif
                                </td>
                                @endfor
                            </tr>
                            @endforeach
                        </tbody>
                        

                    </table>

                </div>
                </div>
                
                
                
            </div>



        </div>
    </section>
    <!-- section ends -->


    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/iconsax-icon.js"></script>
    <script src="assets/js/template-setting.js"></script>
    <script src="assets/js/script.js"></script>
    
    <script>
        function changeSelectedId() {
            const selectedId = document.getElementById('exampleFormControlSelect1').value;
            
            // Redirect to the same page with new selected_id and reset root to selected_id
            window.location.href = '/Achievement_Bonus?selected_id=' + selectedId + '&root=' + selectedId;
        }
    </script>
</body>

</html>