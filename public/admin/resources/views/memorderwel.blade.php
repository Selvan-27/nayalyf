@extends('layout.admin') @section('content')
<div class="page-body">
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3> Starter Kit Order List </h3>
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
                            <th>Update</th>
                            <th>Member</th>
                            <th>Sponsor</th>
                            <th>Order No</th>
                            <th>Order Date</th> 
                            <th>Order Value</th>
                            <th>Payment</th>
                            <th>Order Status</th>
                            <th>Shipped On</th>
                            <th>PNR No.</th>
                            <th>Courier Name</th>
                            <th>Track Link</th>

                            <th>Delivered On</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><li>
                                    <a href="javascript:void(0)">
                                        <i class="right_side_toggle" data-feather="message-square"></i>
                                        
                                    </a>
                                </li>
                            </td>
                            <td>
                                <div class="d-flex vendor-list">
                                    <img src="assets/images/team/2.jpg" alt=""
                                        class="img-fluid img-40 rounded-circle blur-up lazyloaded">
                                    <span>Petey Cruiser<br>UC001670<br>UC Distributor</span>
                                </div>
                            </td>    
                            <td>
                                <div class="d-flex vendor-list">
                                    <img src="assets/images/team/2.jpg" alt=""
                                        class="img-fluid img-40 rounded-circle blur-up lazyloaded">
                                    <span>Petey Cruiser<br>UC001670<br>UC Distributor</span>
                                </div>
                            </td>     
                            <td>OR24352</td>
                            <td>25/03/2025</td>
                            <td>₹ 1650.00</td>
                            <td>UC Wallet</td>
                            <td>In-Transt</td>
                            <td>25/03/2025</td>
                            <td>PCR54623687</td>
                            <td>Professional</td>
                            <td>https://track....com</td>
                            

                            <td>----</td>
                            
                        </tr>
                        
                    </tbody>
                </table>
            </div>
            
            
        </div>
    </div>
            <div class="right-sidebar" id="right_side_bar">
                <div>
                    <div class="container p-0">
                        <div class="modal-header p-l-20 p-r-20">
                            <div class="col-sm-8 p-0">
                                <h6 class="modal-title font-weight-bold">Order No</h6>
                            </div>
                            <!-- <div class="col-sm-4 text-end p-0">
                                <i class="me-2" data-feather="settings"></i>
                            </div> -->
                        </div>
                    </div>
                    <!-- <div class="friend-list-search mt-0">
                        <input type="text" placeholder="order_no" disabled>
                        
                    </div> -->
                    <div class="p-l-30 p-r-30 friend-list-name">
                        <div class="chat-box">
                            <div class="people-list friend-list">
                                <ul class="list">
                                    <li class="clearfix">
                                        <img class="rounded-circle user-image blur-up lazyloaded"
                                            src="assets/images/team/2.jpg" alt="">
                                        <div class="status-circle online"></div>
                                        <div class="about">
                                            <div class="name">Vincent Porter</div>
                                            <div class="memberid">UC100001</div>
                                        </div>
                                        
                                        
                                    </li>
                                    <li class="clearfix">
                                        <div class="about">
                                            <a href="#" class="btn btn-primary mt-md-0 mt-2">Print Order Details</a>
                                        </div>
                                    </li>
                                    <li class="clearfix">
                                        <div class="about">
                                            <a href="#" class="btn btn-primary mt-md-0 mt-2">Print Invoice</a>
                                        </div>
                                    </li>
                                    <li class="clearfix">
                                        <div class="about">
                                            <input type="text" placeholder="Courier Name" required>
                                            <input type="text" placeholder="PNR Number">
                                            <input type="text" placeholder="Track Link"><br>
                                            <a href="#" class="btn btn-primary mt-md-0 mt-2">Courier Send</a>
                                        </div>
                                    </li>
                                    <li class="clearfix">
                                        <div class="about">
                                            <a href="#" class="btn btn-primary mt-md-0 mt-2">Confirm Delivery</a>
                                        </div>
                                    </li>
                                    
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



</div>
@stop