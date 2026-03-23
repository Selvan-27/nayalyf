@extends('layout.admin') @section('content')
<div class="page-body">
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3> Leader Matrix Tree </h3>
                    </div>
                </div>
                <div class="col-lg-6">
                    <ol class="breadcrumb pull-right">
                        <li class="breadcrumb-item">
                            <a href="/admin_home">
                                <i data-feather="home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active">Tree Report</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            
             <h4>Search By Member ID</h4>
          <form id="treeForm" method="get" action="/leader_matrix_tree">
    @csrf
                <div class="col-xl-12 col-md-12">
                    <div class="row  mb-4">
                        <div class="col-6">
                <input type="text" id="root_1" name="root_1" class="form-control"
                       placeholder="Enter Member ID" value="{{ $_GET['root_1'] ?? '' }}">
            </div>
            <div class="col-6">
                <button type="submit" class="btn btn-success">Search</button>
            </div>
                </div>
                
            </form>
            
            
            <div class="col-xl-12">
                <div class="card tab2-card">
                    <div class="card-body">
                        <h5 class="f-w-600">Leader Matrix Tree</h5>
                        <div class="card-body vendor-table">
                            <table class="table table-responsive text-center">
                                @php
                                    if (!function_exists('renderLeaderMatrixTreeRow')) {
                                        function renderLeaderMatrixTreeRow($tree, $level = 0) {
                                            // Root node (centered in the middle)
                                            echo '<tr>';
                                            for ($j = 0; $j < 5; $j++) echo '<td></td>';
                                            
                                            if ($tree && isset($tree['node'])) {
                                                $node = $tree['node'];
                                                $img = asset('assets/images/team/2.jpg');
                                                echo '<td>';
                                                echo '<a href="?root_1=' . $node->memberid . '">';
                                                    echo '<img src="' . $img . '" alt=""><p>' . $node->memberid . '</p>';
                                                echo '</a>';
                                                echo '</td>';
                                            } else {
                                                $img = asset('assets/images/team/0.jpg');
                                                echo '<td>';
                                                echo '<img src="' . $img . '" alt=""><p>Vacant</p>';
                                                echo '</td>';
                                            }
                                            
                                            for ($j = 0; $j < 5; $j++) echo '<td></td>';
                                            echo '</tr>';
                                            
                                            // Children nodes (level 1) - slightly left aligned
                                            echo '<tr>';
                                            echo '<td></td><td></td>';
                                            
                                            $children = ($tree && isset($tree['children'])) ? $tree['children'] : [];
                                            foreach (["p1", "p2", "p3"] as $pos) {
                                                if (isset($children[$pos]) && $children[$pos]) {
                                                    $child = $children[$pos];
                                                    $node = $child['node'];
                                                    $img = asset('assets/images/team/2.jpg');
                                                    echo '<td>';
                                                    echo '<a href="?root_1=' . $node->memberid . '">';
                                                    echo '<img src="' . $img . '" alt=""><p>' . $node->memberid . '</p>';
                                                    echo '</a>';
                                                    echo '</td>';
                                                } else {
                                                    $img = asset('assets/images/team/0.jpg');
                                                    echo '<td>';
                                                    echo '<img src="' . $img . '" alt=""><p>Vacant</p>';
                                                    echo '</td>';
                                                }
                                                
                                                // Add spacing between children
                                                if ($pos != "p3") echo '<td></td>';
                                            }
                                            
                                            echo '<td></td><td></td>';
                                            echo '</tr>';
                                            
                                            // Grandchildren nodes (level 2) - right aligned
                                            echo '<tr>';
                                            $grandchildren = [];
                                            foreach (["p1", "p2", "p3"] as $pos) {
                                                if (isset($children[$pos]) && $children[$pos] && isset($children[$pos]['children'])) {
                                                    $grandchildren[$pos] = $children[$pos]['children'];
                                                } else {
                                                    $grandchildren[$pos] = null;
                                                }
                                            }
                                            
                                            echo '<td></td>';
                                            foreach (["p1", "p2", "p3"] as $pos) {
                                                if ($grandchildren[$pos]) {
                                                    foreach (["p1", "p2", "p3"] as $gpos) {
                                                        if (isset($grandchildren[$pos][$gpos]) && $grandchildren[$pos][$gpos]) {
                                                            $gchild = $grandchildren[$pos][$gpos]['node'];
                                                            $img = asset('assets/images/team/2.jpg');
                                                            echo '<td>';
                                                            echo '<a href="?root_1=' . $gchild->memberid . '">';
                                                            echo '<img src="' . $img . '" alt=""><p>' . $gchild->memberid . '</p>';
                                                            echo '</a>';
                                                            echo '</td>';
                                                        } else {
                                                            $img = asset('assets/images/team/0.jpg');
                                                            echo '<td>';
                                                            echo '<img src="' . $img . '" alt=""><p>Vacant</p>';
                                                            echo '</td>';
                                                        }
                                                    }
                                                } else {
                                                    // Fill with 3 empty cells if no grandchildren
                                                    for ($k = 0; $k < 3; $k++) {
                                                        $img = asset('assets/images/team/0.jpg');
                                                        echo '<td>';
                                                        echo '<img src="' . $img . '" alt=""><p>Vacant</p>';
                                                        echo '</td>';
                                                    }
                                                }
                                            }
                                            echo '<td></td>';
                                            echo '</tr>';
                                        }
                                    }
                                    $tree = $all_trees[1] ?? null;
                                    renderLeaderMatrixTreeRow($tree, 0);
                                @endphp
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<style>
/* Custom CSS for Leader Matrix Tree Alignment */
.vendor-table .table {
    width: 100%;
    table-layout: fixed;
    margin: 0 auto;
    border-collapse: separate;
    border-spacing: 10px;
}

.vendor-table .table td {
    text-align: center !important;
    vertical-align: middle !important;
    padding: 15px 10px;
    border: none;
    position: relative;
}

.vendor-table .table tr {
    display: table-row;
}

.vendor-table .table td img {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid #fff;
    box-shadow: 0 2px 8px rgba(0,0,0,0.15);
    transition: all 0.3s ease;
}

.vendor-table .table td img:hover {
    transform: scale(1.1);
    box-shadow: 0 4px 16px rgba(0,0,0,0.25);
}

.vendor-table .table td p {
    margin-top: 8px;
    font-weight: 600;
    color: #2c3e50;
    font-size: 12px;
}

.vendor-table .table td a {
    text-decoration: none;
    display: inline-block;
    transition: all 0.3s ease;
}

.vendor-table .table td a:hover {
    transform: translateY(-3px);
}

/* Tree connection lines */
.vendor-table .table tr:nth-child(1) td:nth-child(5):after {
    content: '';
    position: absolute;
    bottom: -20px;
    left: 50%;
    width: 2px;
    height: 20px;
    background: #6c757d;
    transform: translateX(-50%);
}

.vendor-table .table tr:nth-child(2):before {
    content: '';
    position: absolute;
    top: -10px;
    left: 15%;
    right: 15%;
    height: 2px;
    background: #6c757d;
    z-index: -1;
}
</style>
@endsection