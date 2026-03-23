@extends('layout.admin') @section('content')
<div class="page-body">
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3> Team Performance Tree </h3>
                    </div>
                </div>
                <div class="col-lg-6">
                    <ol class="breadcrumb pull-right">
                        <li class="breadcrumb-item">
                            <a href="/admin_home">
                                <i data-feather="home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active">Income Report</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            
            <h4>Search By Member ID</h4>
          <form id="treeForm" method="get" action="/team_per_tree">
    @csrf
                <div class="col-xl-12 col-md-12">
                    <div class="row  mb-4">
                        <div class="col-4">
                <input type="text" id="root" name="root" class="form-control"
                       placeholder="Enter Member ID" value="{{ $_GET['root'] ?? '' }}">
            </div>
            <div class="col-4">
                <select id="root_no" name="root_no" class="form-control">
                    <option value="1" {{ ($_GET['root_no'] ?? '') == '1' ? 'selected' : '' }}>1</option>
                </select>
            </div>
            <div class="col-4">
                <button type="submit" class="btn btn-success">Search</button>
            </div>
                </div>
                
            </form>
        
            
            <div class="col-xl-12">
                <div class="card tab2-card">
                    <div class="card-body">
                        <ul class="nav nav-tabs nav-material" id="top-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="b1-tab" data-bs-toggle="tab" href="#top-b1" role="tab"
                                    aria-controls="top-b1" aria-selected="true">TP Board 1
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="b2-tab" data-bs-toggle="tab" href="#top-b2" role="tab"
                                    aria-controls="top-b2" aria-selected="false">TP Board 2
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="b3-tab" data-bs-toggle="tab" href="#top-b3" role="tab"
                                    aria-controls="top-b3" aria-selected="false">TP Board 3
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="b4-tab" data-bs-toggle="tab" href="#top-b4" role="tab"
                                    aria-controls="top-b4" aria-selected="false">TP Board 4
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="b5-tab" data-bs-toggle="tab" href="#top-b5" role="tab"
                                    aria-controls="top-b5" aria-selected="false">TP Board 5
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="b6-tab" data-bs-toggle="tab" href="#top-b6" role="tab"
                                    aria-controls="top-b6" aria-selected="false">TP Board 6
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="b7-tab" data-bs-toggle="tab" href="#top-b7" role="tab"
                                    aria-controls="top-b7" aria-selected="false">TP Board 7
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="b8-tab" data-bs-toggle="tab" href="#top-b8" role="tab"
                                    aria-controls="top-b8" aria-selected="false">TP Board 8
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="b9-tab" data-bs-toggle="tab" href="#top-b9" role="tab"
                                    aria-controls="top-b9" aria-selected="false">TP Board 9
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="b10-tab" data-bs-toggle="tab" href="#top-b10" role="tab"
                                    aria-controls="top-b10" aria-selected="false">TP Board 10
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="b11-tab" data-bs-toggle="tab" href="#top-b11" role="tab"
                                    aria-controls="top-b11" aria-selected="false">TP Board 11
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="b12-tab" data-bs-toggle="tab" href="#top-b12" role="tab"
                                    aria-controls="top-b12" aria-selected="false">TP Board 12
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="b13-tab" data-bs-toggle="tab" href="#top-b13" role="tab"
                                    aria-controls="top-b13" aria-selected="false">TP Board 13
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="b14-tab" data-bs-toggle="tab" href="#top-b14" role="tab"
                                    aria-controls="top-b14" aria-selected="false">TP Board 14
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="b15-tab" data-bs-toggle="tab" href="#top-b15" role="tab"
                                    aria-controls="top-b15" aria-selected="false">TP Board 15
                                </a>
                            </li>

                        </ul>
                        <div class="tab-content" id="top-tabContent">
                       @for ($i = 1; $i <= 15; $i++)
    <div class="tab-pane fade{{ $i == 1 ? ' show active' : '' }}" id="top-b{{ $i }}" role="tabpanel" aria-labelledby="b{{ $i }}-tab">
        <h5 class="f-w-600">TP Board {{ $i }}</h5>
        <div class="card-body vendor-table">
            <table class="table table-responsive text-center">
                @php
                    if (!function_exists('renderTreeRow')) {
                        function renderTreeRow($tree, $level = 0, $parentTreeNo = 1) {
                            // Root node (centered in the middle)
                            echo '<tr>';
                            for ($j = 0; $j < 4; $j++) echo '<td></td>';
                            
                            if ($tree && isset($tree['node'])) {
                                $node = $tree['node'];
                                $img = asset('assets/images/team/2.jpg');
                                echo '<td>';
                                echo '<a href="?root_' . $parentTreeNo . '=' . $node->memberid . '">';
                                echo '<img style="border-radius: 50%; max-width: 50%;" src="' . $img . '" alt=""><p>' . $node->memberid . '</p>';
                                echo '</a>';
                                echo '</td>';
                            } else {
                                $img = asset('assets/images/team/0.jpg');
                                echo '<td>';
                                echo '<img style="border-radius: 50%; max-width: 50%;" src="' . $img . '" alt=""><p>Empty</p>';
                                echo '</td>';
                            }
                            
                            for ($j = 0; $j < 4; $j++) echo '<td></td>';
                            echo '</tr>';
                            
                            // Children nodes (level 1)
                            echo '<tr>';
                            echo '<td></td>';
                            
                            $children = ($tree && isset($tree['children'])) ? $tree['children'] : [];
                            foreach (["p1", "p2", "p3"] as $pos) {
                                if (isset($children[$pos]) && $children[$pos]) {
                                    $child = $children[$pos];
                                    $node = $child['node'];
                                    $img = asset('assets/images/team/2.jpg');
                                    echo '<td>';
                                    echo '<a href="?root_' . $parentTreeNo . '=' . $node->memberid . '">';
                                    echo '<img style="border-radius: 50%; max-width: 50%;" src="' . $img . '" alt=""><p>' . $node->memberid . '</p>';
                                    echo '</a>';
                                    echo '</td>';
                                } else {
                                    $img = asset('assets/images/team/0.jpg');
                                    echo '<td>';
                                    echo '<img style="border-radius: 50%; max-width: 50%;" src="' . $img . '" alt=""><p>Empty</p>';
                                    echo '</td>';
                                }
                                
                                // Add empty cells between children
                                if ($pos != "p3") echo '<td></td><td></td>';
                            }
                            
                            echo '</tr>';
                            
                            // Grandchildren nodes (level 2)
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
                                            $img = asset('assets/images/team/2.jpg');
                                            echo '<td>';
                                            echo '<a href="?root_' . $parentTreeNo . '=' . $gchild->memberid . '">';
                                            echo '<img style="border-radius: 50%; max-width: 50%;" src="' . $img . '" alt=""><p>' . $gchild->memberid . '</p>';
                                            echo '</a>';
                                            echo '</td>';
                                        } else {
                                            $img = asset('assets/images/team/0.jpg');
                                            echo '<td>';
                                            echo '<img style="border-radius: 50%; max-width: 50%;" src="' . $img . '" alt=""><p>Empty</p>';
                                            echo '</td>';
                                        }
                                    }
                                } else {
                                    // Fill with 3 empty cells if no grandchildren
                                    for ($k = 0; $k < 3; $k++) {
                                        $img = asset('assets/images/team/0.jpg');
                                        echo '<td>';
                                        echo '<img style="border-radius: 50%; max-width: 50%;" src="' . $img . '" alt=""><p>Empty</p>';
                                        echo '</td>';
                                    }
                                }
                            }
                            echo '</tr>';
                        }
                    }
                @endphp
                @php
                    renderTreeRow($all_trees[$i], 0, $i);
                @endphp
            </table>
        </div>
    </div>
@endfor
                            <div class="tab-pane fade" id="top-b2" role="tabpanel" aria-labelledby="contact-top-tab">
                                <h5 class="f-w-600">TP Board 2</h5>
                                <div class="card-body vendor-table">
                                <table class="table table-responsive text-center">
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td></td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td></td>
                                    </tr>
                
                                    <tr>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                    </tr>
                                </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="top-b3" role="tabpanel" aria-labelledby="contact-top-tab">
                                <h5 class="f-w-600">TP Board 3</h5>
                                <div class="card-body vendor-table">
                                <table class="table table-responsive text-center">
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td></td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td></td>
                                    </tr>
                
                                    <tr>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                    </tr>
                                </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="top-b4" role="tabpanel" aria-labelledby="contact-top-tab">
                                <h5 class="f-w-600">TP Board 4</h5>
                                <div class="card-body vendor-table">
                                <table class="table table-responsive text-center">
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td></td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td></td>
                                    </tr>
                
                                    <tr>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                    </tr>
                                </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="top-b5" role="tabpanel" aria-labelledby="contact-top-tab">
                                <h5 class="f-w-600">TP Board 5</h5>
                                <div class="card-body vendor-table">
                                <table class="table table-responsive text-center">
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td></td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td></td>
                                    </tr>
                
                                    <tr>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                    </tr>
                                </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="top-b6" role="tabpanel" aria-labelledby="contact-top-tab">
                                <h5 class="f-w-600">TP Board 6</h5>
                                <div class="card-body vendor-table">
                                <table class="table table-responsive text-center">
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td></td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td></td>
                                    </tr>
                
                                    <tr>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                    </tr>
                                </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="top-b7" role="tabpanel" aria-labelledby="contact-top-tab">
                                <h5 class="f-w-600">TP Board 7</h5>
                                <div class="card-body vendor-table">
                                <table class="table table-responsive text-center">
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td></td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td></td>
                                    </tr>
                
                                    <tr>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                    </tr>
                                </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="top-b8" role="tabpanel" aria-labelledby="contact-top-tab">
                                <h5 class="f-w-600">TP Board 8</h5>
                                <div class="card-body vendor-table">
                                <table class="table table-responsive text-center">
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td></td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td></td>
                                    </tr>
                
                                    <tr>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                    </tr>
                                </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="top-b9" role="tabpanel" aria-labelledby="contact-top-tab">
                                <h5 class="f-w-600">TP Board 9</h5>
                                <div class="card-body vendor-table">
                                <table class="table table-responsive text-center">
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td></td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td></td>
                                    </tr>
                
                                    <tr>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                    </tr>
                                </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="top-b10" role="tabpanel" aria-labelledby="contact-top-tab">
                                <h5 class="f-w-600">TP Board 10</h5>
                                <div class="card-body vendor-table">
                                <table class="table table-responsive text-center">
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td></td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td></td>
                                    </tr>
                
                                    <tr>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                    </tr>
                                </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="top-b11" role="tabpanel" aria-labelledby="contact-top-tab">
                                <h5 class="f-w-600">TP Board 12</h5>
                                <div class="card-body vendor-table">
                                <table class="table table-responsive text-center">
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td></td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td></td>
                                    </tr>
                
                                    <tr>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                    </tr>
                                </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="top-b12" role="tabpanel" aria-labelledby="contact-top-tab">
                                <h5 class="f-w-600">TP Board 12</h5>
                                <div class="card-body vendor-table">
                                <table class="table table-responsive text-center">
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td></td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td></td>
                                    </tr>
                
                                    <tr>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                    </tr>
                                </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="top-b13" role="tabpanel" aria-labelledby="contact-top-tab">
                                <h5 class="f-w-600">TP Board 13</h5>
                                <div class="card-body vendor-table">
                                <table class="table table-responsive text-center">
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td></td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td></td>
                                    </tr>
                
                                    <tr>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                    </tr>
                                </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="top-b14" role="tabpanel" aria-labelledby="contact-top-tab">
                                <h5 class="f-w-600">TP Board 14</h5>
                                <div class="card-body vendor-table">
                                <table class="table table-responsive text-center">
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td></td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td></td>
                                    </tr>
                
                                    <tr>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                    </tr>
                                </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="top-b15" role="tabpanel" aria-labelledby="contact-top-tab">
                                <h5 class="f-w-600">TP Board 15</h5>
                                <div class="card-body vendor-table">
                                <table class="table table-responsive text-center">
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td></td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td></td>
                                    </tr>
                
                                    <tr>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                        <td>
                                            <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                            <p>UC10001</p></a>
                                        </td>
                                    </tr>
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

<script>
document.getElementById('treeForm').addEventListener('submit', function (e) {
    e.preventDefault(); // stop normal form submit

    let root    = document.getElementById('root').value;
    let root_no = document.getElementById('root_no').value;
    if(root && root_no){
        // redirect with concatenated param
        window.location.href = `/team_per_tree?root_${root_no}=${encodeURIComponent(root)}`;
    }
});
</script>

@stop