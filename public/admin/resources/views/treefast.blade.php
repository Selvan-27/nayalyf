@extends('layout.admin') @section('content')
<div class="page-body">
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3> Fast Track Tree </h3>
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
                            @for ($i = 1; $i <= 2; $i++)
                                <li class="nav-item">
                                    <a class="nav-link{{ $i == 1 ? ' active' : '' }}" id="b{{ $i }}-tab" data-bs-toggle="tab" href="#top-b{{ $i }}" role="tab" aria-controls="top-b{{ $i }}" aria-selected="{{ $i == 1 ? 'true' : 'false' }}">Fast Track Board {{ $i }}</a>
                                </li>
                            @endfor
                        </ul>
                        <div class="tab-content" id="top-tabContent">
                            @for ($i = 1; $i <= 2; $i++)
                                <div class="tab-pane fade{{ $i == 1 ? ' show active' : '' }}" id="top-b{{ $i }}" role="tabpanel" aria-labelledby="b{{ $i }}-tab">
                                    <h5 class="f-w-600">Fast Track Board {{ $i }}</h5>
                                    <div class="card-body vendor-table">
                                        <table class="table table-responsive text-center">
                                            @php
                                                if (!function_exists('renderFastTrackTreeRow')) {
                                                    function renderFastTrackTreeRow($tree, $level = 0, $parentTreeNo = 1) {
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
                                                            echo '<img style="border-radius: 50%; max-width: 50%;" src="' . $img . '" alt=""><p>Vacant</p>';
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
                                                                echo '<img style="border-radius: 50%; max-width: 50%;" src="' . $img . '" alt=""><p>Vacant</p>';
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
                                                                        echo '<img style="border-radius: 50%; max-width: 50%;" src="' . $img . '" alt=""><p>Vacant</p>';
                                                                        echo '</td>';
                                                                    }
                                                                }
                                                            } else {
                                                                // Fill with 3 empty cells if no grandchildren
                                                                for ($k = 0; $k < 3; $k++) {
                                                                    $img = asset('assets/images/team/0.jpg');
                                                                    echo '<td>';
                                                                    echo '<img style="border-radius: 50%; max-width: 50%;" src="' . $img . '" alt=""><p>Vacant</p>';
                                                                    echo '</td>';
                                                                }
                                                            }
                                                        }
                                                        echo '</tr>';
                                                    }
                                                }
                                                $tree = $all_trees[$i] ?? null;
                                                renderFastTrackTreeRow($tree, 0, $i);
                                            @endphp
                                        </table>
                                    </div>
                                </div>
                            @endfor
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




</div>

<style>
/* Custom CSS for Fast Track Tree Alignment */
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
    width: 100%;
}

/* Tree node styling */
.vendor-table .table td img {
    display: block;
    margin: 0 auto 8px auto;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    transition: transform 0.2s ease;
}

.vendor-table .table td img:hover {
    transform: scale(1.1);
}

.vendor-table .table td a {
    text-decoration: none;
    color: #333;
    font-weight: 500;
    display: block;
}

.vendor-table .table td a:hover {
    color: #007bff;
}

.vendor-table .table td p {
    margin: 0;
    font-size: 12px;
    font-weight: 500;
}

/* Center the entire table within its container */
.card-body.vendor-table {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 30px 20px;
    min-height: 400px;
}

/* Make sure Bootstrap responsive table doesn't break centering */
.table-responsive {
    display: block;
    width: 100%;
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
    margin: 0 auto;
}

/* Force center alignment for all table content */
.table.text-center td,
.table.text-center th {
    text-align: center !important;
    vertical-align: middle !important;
}

/* Special styling for Fast Track trees */
.vendor-table .table td img {
    border: 2px solid #28a745;
}

.vendor-table .table td a:hover img {
    border-color: #007bff;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .vendor-table .table td img {
        max-width: 40px !important;
        height: auto !important;
    }
    
    .vendor-table .table td {
        padding: 10px 5px;
        font-size: 11px;
    }
}
</style>

<script>
document.getElementById('treeForm').addEventListener('submit', function (e) {
    e.preventDefault(); // stop normal form submit

    let root    = document.getElementById('root').value;
    let root_no = document.getElementById('root_no').value;

    if(root && root_no){
        // redirect with concatenated param
        window.location.href = `/fast_track_tree?root_${root_no}=${encodeURIComponent(root)}`;
    }
});
</script>
@stop