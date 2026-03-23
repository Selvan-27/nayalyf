@extends('layout.admin') @section('content')
<div class="page-body">
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3> Members Return List </h3>
                    </div>
                </div>
                <div class="col-lg-6">
                    <ol class="breadcrumb pull-right">
                        <li class="breadcrumb-item">
                            <a href="/admin_home">
                                <i data-feather="home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active">Orders</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <a href="#" class="btn btn-primary mt-md-0 mt-2">Download Report</a>
            </div>

            <div class="card-body vendor-table">
                
                <table class="table-responsive text-center" id="basic-1">
                    <thead>
                        <tr>
                            <th>Order Date</th>    
                            <th>Order No</th>
                            <th>Member</th>
                            <th>Member ID</th>
                            <th>Ruturn Status</th>
                            <th>Status Date</th>
                            <th>Order Value</th>
                            <th>Payment</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>25/03/2025</td>    
                            <td>OR24352</td>
                            <td>
                                <div class="d-flex vendor-list">
                                    <img src="assets/images/team/2.jpg" alt=""
                                        class="img-fluid img-40 rounded-circle blur-up lazyloaded">
                                    <span>Petey Cruiser</span>
                                </div>
                            </td>
                            <td>UC001670</td>
                            <td>In-Transt</td>
                            <td>25/03/2025</td> 
                            <td>₹ 1650.00</td>
                            <td>Pending</td>
                            
                        </tr>
                        <tr>
                            <td>25/03/2025</td>    
                            <td>OR24352</td>
                            <td>
                                <div class="d-flex vendor-list">
                                    <img src="assets/images/team/2.jpg" alt=""
                                        class="img-fluid img-40 rounded-circle blur-up lazyloaded">
                                    <span>Petey Cruiser</span>
                                </div>
                            </td>
                            <td>UC001670</td>
                            <td>Returned</td>
                            <td>25/03/2025</td> 
                            <td>₹ 1650.00</td>
                            <td>Online</td>
                            
                        </tr>
                    </tbody>
                </table>
            </div>
            
            
        </div>
    </div>




</div>
@stop