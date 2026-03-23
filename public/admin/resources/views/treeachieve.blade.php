@extends('layout.admin') @section('content')
<div class="page-body">
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Achievement Tree</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="">Reports</a></li>
                        <li class="breadcrumb-item active">Achievement Tree</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->

    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-2">
                <div class="card">
                    
                        <table class="table table-responsive text-center">
                            <thead>
                                <tr>
                                    <th>Level</th>
                                    <th>Members</th>
                                </tr>
                            </thead>
                            <tbody>
                                @for($i = 1; $i <= 15; $i++)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $level_counts[$i] ?? 0 }}</td>
                                </tr>
                                @endfor
                            </tbody>
                        </table>
                    
                </div>
            </div>
            <div class="col-sm-10">
                <div class="card">
                    <div class="card-header">
                        <h5>Achievement Tree Structure</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="default-according">
                                    <div class="default-according" id="accordionoc">
                                        <div class="card">
                                            <div class="card-header" id="headingoc">
                                                <h5 class="mb-0">
                                                    <button class="btn btn-link ps-0" data-bs-toggle="collapse" data-bs-target="#collapseoc" aria-expanded="true" aria-controls="collapseoc">
                                                        Achievement Board
                                                    </button>
                                                </h5>
                                            </div>
                                            <div class="collapse show" id="collapseoc" aria-labelledby="headingoc" data-bs-parent="#accordionoc">
                                                <div class="card-body vendor-table">
                                                <table class="table table-responsive text-center">
                                                    @php
                                                        $tree = $all_trees[1] ?? null;
                                                        if (!function_exists('renderAchievementTreeRow')) {
                                                            function renderAchievementTreeRow($tree, $level = 0) {
                                                                echo '<tr>';
                                                                if ($tree && isset($tree['node'])) {
                                                                    $node = $tree['node'];
                                                                    echo '<td colspan="9" style="text-align: center;">';
                                                                    echo '<a href="?root_1=' . ($node->memberid ?? '') . '"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt=""><p>' . ($node->memberid ?? '') . '</p></a>';
                                                                    echo '</td>';
                                                                } else {
                                                                    echo '<td colspan="9" style="text-align: center;">';
                                                                    echo '<img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/0.jpg" alt=""><p>Vacant</p>';
                                                                    echo '</td>';
                                                                }
                                                                echo '</tr>';
                                                                
                                                                // Level 1: Show 3 children
                                                                if ($tree && isset($tree['children'])) {
                                                                    echo '<tr>';
                                                                    foreach (["p1", "p2", "p3"] as $pos) {
                                                                        $child = $tree['children'][$pos] ?? null;
                                                                        echo '<td colspan="3" style="text-align: center;">';
                                                                        if ($child && isset($child['node'])) {
                                                                            $node = $child['node'];
                                                                            echo '<a href="?root_1=' . ($node->memberid ?? '') . '"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt=""><p>' . ($node->memberid ?? '') . '</p></a>';
                                                                        } else {
                                                                            echo '<img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/0.jpg" alt=""><p>Vacant</p>';
                                                                        }
                                                                        echo '</td>';
                                                                    }
                                                                    echo '</tr>';
                                                                    
                                                                    // Level 2: Show 9 grandchildren (3 for each position)
                                                                    echo '<tr>';
                                                                    foreach (["p1", "p2", "p3"] as $pos) {
                                                                        $child = $tree['children'][$pos] ?? null;
                                                                        if ($child && isset($child['children'])) {
                                                                            foreach (["p1", "p2", "p3"] as $pp) {
                                                                                $gchild = $child['children'][$pp] ?? null;
                                                                                echo '<td>';
                                                                                if ($gchild && isset($gchild['node'])) {
                                                                                    $node = $gchild['node'];
                                                                                    echo '<a href="?root_1=' . ($node->memberid ?? '') . '"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt=""><p>' . ($node->memberid ?? '') . '</p></a>';
                                                                                } else {
                                                                                    echo '<img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/0.jpg" alt=""><p>Vacant</p>';
                                                                                }
                                                                                echo '</td>';
                                                                            }
                                                                        } else {
                                                                            echo '<td><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/0.jpg" alt=""><p>Vacant</p></td>';
                                                                            echo '<td><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/0.jpg" alt=""><p>Vacant</p></td>';
                                                                            echo '<td><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/0.jpg" alt=""><p>Vacant</p></td>';
                                                                        }
                                                                    }
                                                                    echo '</tr>';
                                                                } else {
                                                                    // Show all vacant for level 1 and 2
                                                                    echo '<tr>';
                                                                    for ($i = 0; $i < 3; $i++) {
                                                                        echo '<td colspan="3" style="text-align: center;"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/0.jpg" alt=""><p>Vacant</p></td>';
                                                                    }
                                                                    echo '</tr>';
                                                                    echo '<tr>';
                                                                    for ($i = 0; $i < 9; $i++) {
                                                                        echo '<td><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/0.jpg" alt=""><p>Vacant</p></td>';
                                                                    }
                                                                    echo '</tr>';
                                                                }
                                                            }
                                                        }
                                                        renderAchievementTreeRow($tree);
                                                    @endphp
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
</div>
@endsection
