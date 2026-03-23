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
                <h3>Grow Together, Globally!</h3>
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
                                <h5 style="color: #fff;">Global Bonus</h5>
                                <div class="bottom-content">
                                    <h4 style="color: #fff;">₹ {{ $global_bonus_payout ?? 0 }}</h4>
                                </div>
                            </div>
                            <div class="see-all">
                                <!-- <h6 style="color: #fff;">0 Re-Birth</h6> -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form">
                    <div class="form-group row">
                        <label for="exampleFormControlSelect1" class="col-xl-3 col-sm-4 mb-0">Select ID</label>
                        <div class="col-xl-8 col-sm-6">
                            <select class="form-control digits" id="exampleFormControlSelect1" onchange="changeSelectedId()">
                                @foreach($data['related_ids'] as $id_info)
                                    <option value="{{ $id_info['memberid'] }}" 
                                        {{ $data['selected_member_id'] == $id_info['memberid'] ? 'selected' : '' }}>
                                        {{ $id_info['memberid'] }} ({{ $id_info['type'] }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </section>
    <section class="pt-2">
        <ul class="categories-slider custom-scrollbar">
            @for ($i = 1; $i <= 5; $i++)
            @php
                $is_active = $data['all_trees_status'][$i] === 'active';
                $is_current = $data['current_tree_no'] == $i;
                $bg_color = $is_active ? '#02a132' : '#ff7f50';
                $status_text = $is_active ? 'Active' : 'In-Active';
            @endphp
            <!--<li>-->
            <!--    <a href="{{ $is_active ? '/Global_Bonus?tree_no=' . $i . '&selected_id=' . $data['selected_member_id'] . '&root=' . $data['selected_member_id'] : '#' }}" class="category-box">-->
            <!--        <div class="category-box-img align-content-center text-center"-->
            <!--            style="background-color: {{ $bg_color }}; border-radius: 10%; {{ $is_current ? 'border: 3px solid #fff;' : '' }}">-->
            <!--            <h6 style="color: #fff;"> Board {{ $i }} </h6>-->
            <!--            <p style="color: #fff; font-style: italic;">{{ $status_text }}</p>-->
            <!--        </div>-->
            <!--        <h5></h5>-->
            <!--    </a>-->
            <!--</li>-->
            @endfor

            <!-- <li>
                <a href="#" class="category-box">
                    <div class="category-box-img align-content-center text-center"
                        style="background-color: #6f42c1; border-radius: 10%;">
                        <h6 style="color: #fff;"> View Rebirths </h6>
                        <p style="color: #fff; font-style: italic;">All Boards</p>
                    </div>
                    <h5></h5>
                </a>
            </li> -->
        </ul>
    </section><hr>
    

    <section class="custom-container">
        <div class="card">
            @if($data['tree_data'])
                <h5 class="text-center mb-3">Global Tree Board {{ $data['current_tree_no'] }}</h5>
                <table class="table table-responsive text-center">
                    @php
                        function renderGlobalTreeRow($tree, $current_tree_no, $login_id) {
                            // Root node (centered)
                            echo '<tr>';
                            for ($j = 0; $j < 4; $j++) echo '<td></td>';
                            
                            if ($tree && isset($tree['node'])) {
                                $node = $tree['node'];
                                $member_name = $node->FullName ?? 'N/A';
                                echo '<td class="tree-cell">';
                                echo '<a href="/Global_Bonus?tree_no=' . $current_tree_no . '&selected_id=' . $login_id . '&root=' . $node->memberid . '">';
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
                                    echo '<a href="/Global_Bonus?tree_no=' . $current_tree_no . '&selected_id=' . $login_id . '&root=' . $node->memberid . '">';
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
                                            echo '<a href="/Global_Bonus?tree_no=' . $current_tree_no . '&selected_id=' . $login_id . '&root=' . $gchild->memberid . '">';
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
                        
                        renderGlobalTreeRow($data['tree_data'], $data['current_tree_no'], $data['selected_member_id']);
                    @endphp
                </table>
            @else
                <div class="text-center py-5">
                    <h5 class="text-muted">Global Board {{ $data['current_tree_no'] }} is not active yet</h5>
                    <p class="text-muted">Complete previous boards to activate this board</p>
                </div>
            @endif
        </div>
    </section><hr>
    
    <section class="custom-container">
        <div class="element-title mb-3">
            <h3 class="theme-color text-center">Global Bonus Report</h3>
        </div>
        
            <!--<div class="form">-->
            <!--    <div class="form-group row">-->
            <!--        <label for="exampleFormControlSelect1" class="col-12">Select Board</label>-->
            <!--        <div class="col-12">-->
            <!--            <select class="form-control digits"-->
            <!--                id="exampleFormControlSelect1">-->
            <!--                <option value="1">Board 1</option>-->
            <!--                <option value="2">Board 2</option>-->
            <!--                <option value="3">Board 3</option>-->
            <!--                <option value="4">Board 4</option>-->
            <!--                <option value="5">Board 5</option>-->
            <!--            </select>-->
            <!--        </div>-->
            <!--    </div>-->
            <!--</div><br>-->
        
        
        <div class="table table-responsive">
            <table id="recent-orders" class="table text-center">
                <thead>
                    <tr>
                        <th class="border-top-0">S.No</th>
                        <th class="border-top-0">Date</th>
                        <th class="border-top-0">FromId</th>
                        <th class="border-top-0">Bonus</th>
                        
                    </tr>
                </thead>
                <tbody>
                    @php $total=0 @endphp
                    @foreach($data['tbl_list'] as $item)
                    @php $total+=$item->payout; @endphp
                    <tr>
                        <td class="text-truncate">{{ $loop->iteration }}</td>
                       
                        <td class="text-truncate">{{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y') }}</td>
                          <td class="text-truncate">{{$item->fromId}}</td>
                        <td class="text-truncate">₹ {{$item->payout}}</td>
                        
                    </tr>
                    @endforeach
                   
                </tbody>
                <tfoot>
                    <tr>
                        <th></th>
                        <th>Total Bonus</th>
                        
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
    
    <script>
        function changeSelectedId() {
            const selectedId = document.getElementById('exampleFormControlSelect1').value;
            const currentTreeNo = {{ $data['current_tree_no'] }};
            
            // Redirect to the same page with new selected_id and reset root to selected_id
            window.location.href = '/Global_Bonus?tree_no=' + currentTreeNo + '&selected_id=' + selectedId + '&root=' + selectedId;
        }
    </script>
</body>

</html>