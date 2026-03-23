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
                <h3>Fast, Faster, Fastest Earnings!</h3>
                <a href="/Dashboard" class="text-center"><img src="assets/images/icon/svg/card.svg"><h6>Account</h6></a>
            </div>
        </div>
    </header>
    <!-- header end -->

    <!-- section starts -->
    <section class="section-b-space">
        <div class="custom-container">
            <div class="row g-3 pt-3">
                <div class="form">
                    <div class="form-group row">
                        <label for="memberIdSelect"
                            class="col-xl-3 col-sm-4 mb-0">Select ID</label>
                        <div class="col-xl-8 col-sm-6">
                            <select class="form-control digits"
                                id="memberIdSelect" onchange="changeSelectedId()">
                                @foreach($data['related_ids'] as $id_info)
                                    <option value="{{ $id_info['memberid'] }}" 
                                        {{ $id_info['memberid'] == $data['selected_member_id'] ? 'selected' : '' }}>
                                        {{ $id_info['memberid'] }} - ({{ $id_info['type'] }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="product-box" style="background-color: #ffe00b;">
                        <div class="product-box vertical-product">
                            <div class="product-content">
                                <h5 style="color: #000;">Fast Track<br>Board 1 Bonus</h5>
                                <div class="bottom-content">
                                    <h4 style="color: #000;">₹ {{ number_format($data['fast_track_income']['board1_income'] ?? 0) }}</h4>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="product-box" style="background-color: #ffe00b;">
                        <div class="product-box vertical-product">
                            <div class="product-content">
                                <h5 style="color: #000;">Fast Track<br>Board 2 Bonus</h5>
                                <div class="bottom-content">
                                    <h4 style="color: #000;">₹ {{ number_format($data['fast_track_income']['board2_income'] ?? 0) }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="product-box" style="background-color: #0d3ff5;">
                        <div class="product-box vertical-product">
                            <div class="product-content">
                                <h5 style="color: #fff;">Fast Track<br>Total Bonus</h5>
                                <div class="bottom-content">
                                    <h4 style="color: #fff;">₹ {{ number_format($data['fast_track_income']['total_income'] ?? 0) }}</h4>
                                </div>
                            </div>
                            <div class="see-all text-center">
                                <h6 style="color: #fff;">Re-Births</h6>
                                <h6 style="color: #fff;">{{ $data['fast_track_income']['rebirth_count'] ?? 0 }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div><br><hr>
            
            <section class="custom-container">
        <div class="elements-tab">
            <ul class="nav nav-pills tab-style3 w-100 mt-0" id="myTab" role="tablist">
                <li class="nav-item w-50" role="presentation">
                    <button class="nav-link {{ $data['current_tree_no'] == 1 ? 'active' : '' }}" id="board1-tab" data-bs-toggle="tab"
                        data-bs-target="#board1-tab-pane" type="button" role="tab" aria-controls="board1-tab-pane"
                        aria-selected="{{ $data['current_tree_no'] == 1 ? 'true' : 'false' }}" 
                        onclick="window.location.href='{{ url('/Fast_Track_Bonus?selected_id=' . $data['selected_member_id'] . '&tree_no=1&root=' . $data['root_member_id']) }}'">
                        Board 1
                        @if($data['all_trees_status'][1] === 'active')
                            <span style="color: green;">●</span>
                        @else
                            <span style="color: red;">●</span>
                        @endif
                    </button>
                </li>
                <li class="nav-item w-50" role="presentation">
                    <button class="nav-link {{ $data['current_tree_no'] == 2 ? 'active' : '' }}" id="board2-tab" data-bs-toggle="tab"
                        data-bs-target="#board2-tab-pane" type="button" role="tab" aria-controls="board2-tab-pane"
                        aria-selected="{{ $data['current_tree_no'] == 2 ? 'true' : 'false' }}"
                        onclick="window.location.href='{{ url('/Fast_Track_Bonus?selected_id=' . $data['selected_member_id'] . '&tree_no=2&root=' . $data['root_member_id']) }}'">
                        Board 2
                        @if($data['all_trees_status'][2] === 'active')
                            <span style="color: green;">●</span>
                        @else
                            <span style="color: red;">●</span>
                        @endif
                    </button>
                </li>
                
            </ul><br>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade p-2 show active" id="board1-tab-pane" role="tabpanel"
                    aria-labelledby="board1-tab" tabindex="0">
                    
                    @if($data['all_trees_status'][$data['current_tree_no']] === 'active' && $data['tree_data'])
                        <div class="tree-container" style="min-height: 200px;">
                            <h5 class="text-center mb-3">Fast Track Board {{ $data['current_tree_no'] }} Tree</h5>
                            
                            <?php 
                            function renderFastTreeRow($tree_data, $selected_member_id, $current_tree_no, $root_member_id) {
                                if (!$tree_data || !$tree_data['node']) return '';
                                
                                $node = $tree_data['node'];
                                $children = $tree_data['children'];
                                
                                $output = '<table class="table table-borderless text-center tree-table" style="width: 100%;">';
                                
                                // Root node
                                $output .= '<tr>';
                                $output .= '<td colspan="9" class="tree-cell">';
                                if ($node->memberid !== $root_member_id) {
                                    $output .= '<a href="' . url('/Fast_Track_Bonus?selected_id=' . $selected_member_id . '&tree_no=' . $current_tree_no . '&root=' . $node->memberid) . '">';
                                }
                                $output .= '<img src="assets/images/avatar/1.png" alt="avatar" class="tree-avatar">';
                                $output .= '<p class="tree-id">' . ($node->FullName ?? $node->memberid) . '</p>';
                                if ($node->memberid !== $root_member_id) {
                                    $output .= '</a>';
                                }
                                $output .= '</td>';
                                $output .= '</tr>';
                                
                                // Children row  
                                $output .= '<tr>';
                                $output .= '<td></td>';
                                
                                foreach (['p1', 'p2', 'p3'] as $pos) {
                                    if (isset($children[$pos]) && $children[$pos]['node']) {
                                        $child = $children[$pos]['node'];
                                        $output .= '<td colspan="2" class="tree-cell">';
                                        $output .= '<a href="' . url('/Fast_Track_Bonus?selected_id=' . $selected_member_id . '&tree_no=' . $current_tree_no . '&root=' . $child->memberid) . '">';
                                        $output .= '<img src="assets/images/avatar/1.png" alt="avatar" class="tree-avatar">';
                                        $output .= '<p class="tree-id">' . ($child->FullName ?? $child->memberid) . '</p>';
                                        $output .= '</a>';
                                        $output .= '</td>';
                                        if ($pos !== 'p3') $output .= '<td></td>';
                                    } else {
                                        $output .= '<td colspan="2" class="tree-cell">';
                                        $output .= '<div class="empty-slot">';
                                        $output .= '<img src="assets/images/avatar/default.png" alt="empty" class="tree-avatar" style="opacity: 0.3;">';
                                        $output .= '<p class="tree-id">Empty</p>';
                                        $output .= '</div>';
                                        $output .= '</td>';
                                        if ($pos !== 'p3') $output .= '<td></td>';
                                    }
                                }
                                
                                $output .= '<td></td>';
                                $output .= '</tr>';
                                $output .= '</table>';
                                
                                return $output;
                            }
                            ?>
                            
                            {!! renderFastTreeRow($data['tree_data'], $data['selected_member_id'], $data['current_tree_no'], $data['root_member_id']) !!}
                        </div>
                    @else
                        <div class="text-center p-4">
                            <h5>Board {{ $data['current_tree_no'] }} - {{ $data['all_trees_status'][$data['current_tree_no']] === 'active' ? 'No Tree Data' : 'Inactive' }}</h5>
                            <p>{{ $data['all_trees_status'][$data['current_tree_no']] === 'active' ? 'Tree data not available' : 'This board is not active for the selected member' }}</p>
                        </div>
                    @endif
                </div>
            </div>
            
            <style>
            .tree-container {
                overflow-x: auto;
                padding: 10px;
            }
            .tree-table {
                min-width: 300px;
                margin: 0 auto;
            }
            .tree-cell {
                padding: 8px;
                text-align: center;
                vertical-align: middle;
            }
            .tree-avatar {
                width: 50px;
                height: 50px;
                border-radius: 50%;
                margin-bottom: 5px;
            }
            .tree-id {
                font-size: 12px;
                margin: 0;
                font-weight: bold;
            }
            .empty-slot {
                opacity: 0.5;
            }
            </style>
        </div>
        
    </section>

            <section>
                <div class="custom-container">
                    
                   
                        
                        
                    <div class="title">
                        <div class="d-flex align-items-center gap-2">
                            <h3>Your Fast Track IDs!</h3>
                        </div>
                    </div><br>
                      <table id="recent-orders" class="table text-center">
                            <thead>
                                <tr>
                                    <th class="border-top-0">S.No</th>
                                    <th class="border-top-0">ID</th>
                                   
                                    <th class="border-top-0">Board 1</th>
                                    <th class="border-top-0">Board 2</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data['related_ids'] as $index => $id_info)
                                <tr>
                                    <td class="text-truncate">{{ $index + 1 }}</td>
                                    <td class="text-truncate">
                                        @if($id_info['type'] === 'Login ID')
                                            {{ $id_info['memberid'] }}
                                        @elseif($id_info['type'] === 'Rebirth ID')
                                            {{ $id_info['memberid'] }}
                                        @else
                                            {{ $id_info['memberid'] }}
                                        @endif
                                    </td>
                                    <td class="text-truncate">
                                        ₹ {{ number_format($id_info['board1_payout'] ?? 0) }}
                                    </td>
                                    <td class="text-truncate">
                                        ₹ {{ number_format($id_info['board2_payout'] ?? 0) }}
                                    </td>
                                </tr>
                                @endforeach    
                                @if(count($data['related_ids']) === 0)
                                    <tr>
                                        <td colspan="4" class="text-center">No Fast Track IDs found</td>
                                    </tr>
                                @endif
                            </tbody>
                          
                        </table>
                    <!--<div class="row g-3">-->
                    <!--    @foreach($data['related_ids'] as $index => $id_info)-->
                    <!--        <div class="col-6">-->
                    <!--            @if($id_info['type'] === 'Login ID')-->
                    <!--                <button class="p-2 btn btn-primary w-100"><b>{{ $id_info['memberid'] }}</b></button>-->
                    <!--            @elseif($id_info['type'] === 'Rebirth ID')-->
                    <!--                <button class="p-2 btn btn-info w-100"><b>{{ $id_info['memberid'] }}</b></button>-->
                    <!--            @else-->
                    <!--                <button class="p-2 btn btn-warning w-100"><b>{{ $id_info['memberid'] }}</b></button>-->
                    <!--            @endif-->
                    <!--        </div>-->
                    <!--    @endforeach-->
                        
                    <!--    @if(count($data['related_ids']) === 0)-->
                    <!--        <div class="col-12">-->
                    <!--            <p class="text-center">No Fast Track IDs found</p>-->
                    <!--        </div>-->
                    <!--    @endif-->
                    <!--</div>-->
                </div>
            </section>
            

            <!-- <div class="row gy-3 gx-0">
                <div class="col-12">
                    <a href="#"><div class="product-box vertical-product" style="background-color: #ffd7aa;">
                        <div class="product-content">
                            <h6 style="color: red;">Cycle In-Progress...</h6>
                            <a href="#" class="product-top">
                                <h3 class="title-color white-nowrap">FT100001</h3>
                                <p>Active Date: 14/03/2025 10.00 AM</p>
                                <p>FT Board 1 Bonus: ₹ 320 (date)</p>
                                <p>FT Board 2 Bonus: ₹ 0 (date)</p>
                            
                            </a>
                        </div>
                        <div class="see-all">
                            <img src="assets/images/avatar/ft.png" class="product-img" alt="">
                        </div>
                    </div></a>
                </div>
                <div class="col-12">
                    <a href="#"><div class="product-box vertical-product" style="background-color: #a1fdc0;">
                        <div class="product-content">
                            <h6 style="color: green;">Cycle Completed</h6>
                            <a href="#" class="product-top">
                                <h3 class="title-color white-nowrap">FT100002</h3>
                                <p>Active Date: 14/03/2025 10.00 AM</p>
                                <p>FT Board 1 Bonus: ₹ 320 (date)</p>
                                <p>FT Board 2 Bonus: ₹ 320 (date)</p>
                            
                            </a>
                        </div>
                        <div class="see-all">
                            <img src="assets/images/avatar/ft.png" class="product-img" alt="">
                        </div>
                    </div></a>
                </div>
                <div class="col-12">
                    <a href="#"><div class="product-box vertical-product" style="background-color: #a1fdc0;">
                        <div class="product-content">
                            <h6 style="color: green;">Cycle Completed</h6>
                            <a href="#" class="product-top">
                                <h3 class="title-color white-nowrap">UC100002</h3>
                                <p>Active Date: 14/03/2025 10.00 AM</p>
                                <p>FT Board 1 Bonus: ₹ 320 (date)</p>
                                <p>FT Board 2 Bonus: ₹ 320 (date)</p>
                            
                            </a>
                        </div>
                        <div class="see-all">
                            <img src="assets/images/avatar/uc.png" class="product-img" alt="">
                        </div>
                    </div></a>
                </div>
            </div> -->



        </div>
    </section><br><br><br><br><br>
    <!-- section ends -->


    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/iconsax-icon.js"></script>
    <script src="assets/js/template-setting.js"></script>
    <script src="assets/js/script.js"></script>
    
    <script>
    function changeSelectedId() {
        const select = document.getElementById('memberIdSelect');
        const selectedId = select.value;
        const currentTreeNo = {{ $data['current_tree_no'] }};
        const rootMemberId = '{{ $data['root_member_id'] }}';
        
        // Redirect to the same page with new selected ID
        window.location.href = '/Fast_Track_Bonus?selected_id=' + selectedId + '&tree_no=' + currentTreeNo + '&root=' + selectedId;
    }
    </script>
</body>

</html>