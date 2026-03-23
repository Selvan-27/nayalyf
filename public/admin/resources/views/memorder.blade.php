@extends('layout.admin') @section('content')
<div class="page-body">
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3> Members Order List </h3>
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
        <div class="row">
            <div class="col-xl-12">
                <div class="card tab2-card">
                    <div class="card-body">
                        <ul class="nav nav-tabs nav-material" id="top-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="b1-tab" data-bs-toggle="tab" href="#top-b1" role="tab"
                                    aria-controls="top-b1" aria-selected="true">Starter Kit
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="b2-tab" data-bs-toggle="tab" href="#top-b2" role="tab"
                                    aria-controls="top-b2" aria-selected="false">Products
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="b3-tab" data-bs-toggle="tab" href="#top-b3" role="tab"
                                    aria-controls="top-b3" aria-selected="false">ID Card
                                </a>
                            </li>
                            
                        </ul>
                        <div class="tab-content" id="top-tabContent">
                            <div class="tab-pane fade show active" id="top-b1" role="tabpanel" aria-labelledby="b1-tab">
                                <h5 class="f-w-600">Starter Kit</h5>
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
                            <div class="tab-pane fade" id="top-b2" role="tabpanel" aria-labelledby="contact-top-tab">
                                <h5 class="f-w-600">Products</h5>
                                <div class="card">
                                    <div class="card-header">
                                        <a href="#" class="btn btn-primary mt-md-0 mt-2">Download Report</a>
                                        
                                    </div>

                                    <div class="card-body vendor-table">
                                        <table class="table-responsive text-center" id="basic-2">
                                            <thead>
                                                <tr>
                                                    <th>Update</th>
                                                    <th>Member</th>
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
                            <div class="tab-pane fade" id="top-b3" role="tabpanel" aria-labelledby="contact-top-tab">
                                <h5 class="f-w-600">ID Card</h5>
                                <div class="card">
                                    <div class="card-header">
                                        <a href="#" class="btn btn-primary mt-md-0 mt-2">Download Report</a>
                                        
                                    </div>

                                    <div class="card-body vendor-table">
                                        <table class="table-responsive text-center" id="basic-3">
                                            <thead>
                                                <tr>
                                                    <th>Update</th>
                                                    <th>Member</th>
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
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        
    </div>

    <!-- Button to Open the Modal -->



            <div class="right-sidebar" id="right_side_bar">
                <div>
                    <div class="container p-0">
                        <div class="modal-header p-l-20 p-r-20">
                            <div class="col-sm-8 p-0">
                                <h6 class="modal-title font-weight-bold">Order No</h6>
                            </div>
                            <div class="col-sm-4 text-end p-0">
                                <i class="me-2" data-feather="x"></i>
                            </div>
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
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#detail">Order Details</button>
                                        </div>
                                    </li>
                                    <li class="clearfix">
                                        <div class="about">
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#invoice">invoice</button>
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
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                    
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- The order detail Modal -->
            <div class="modal" id="detail">
                <div class="modal-dialog  modal-lg">
                    <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Order Details</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">

                    
                        <div class="row mb-4 align-items-center">
                            <div class="col">
                                <h6 class="fs-18 mb-0">Order ID: #22830</h6>
                            </div>
                            <div class="col text-end">
                                <button type="button" class="btn btn-secondary"><i class="ph-download-simple me-1 align-middle"></i> Print</button>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card" >
                                    <div class="card-body">
                                        <div class="d-flex gap-3">
                                            <div class="flex-grow-1">
                                                <h6 class="fs-18 mb-3">Customer Info</h6>
                                                <p class="mb-0 fw-medium">[member_name]</p>
                                                <p class="mb-1">[member_id]</p>
                                                <p class="mb-0">[member_address], [member_city] - [member_pincode]</p>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex gap-3">
                                            <div class="flex-grow-1">
                                                <h6 class="fs-18 mb-3">Shipping Address</h6>
                                                <p class="mb-0 fw-medium">[member_name]</p>
                                                
                                                <p class="mb-0">[member_address], [member_city] - [member_pincode]</p>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex gap-3">
                                            <div class="flex-grow-1">
                                                <h6 class="fs-18 mb-3">Billing Address</h6>
                                                <p class="mb-0 fw-medium">[member_name]</p>
                                                
                                                <p class="mb-0">[member_address], [member_city] - [member_pincode]</p>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive table-card">
                                        <table class="table align-middle table-nowrap mb-0">
                                            <thead class="text-muted table-light">
                                                <tr>
                                                    
                                                    <th scope="col">Product Name</th>
                                                    <th scope="col">Quantity</th>
                                                    <th scope="col">Offer</th>
                                                    <th scope="col">Amount</th>
                                                    <th scope="col" class="text-end">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>UC Antioxidant Juice </td>
                                                    <td>2</td>
                                                    <td>No</td>
                                                    <td>₹ 2498 </td>
                                                    <td class="text-end">₹ 2498.00</td>
                                                </tr>
                                                <tr>
                                                    <td>UC Antioxidant Juice </td>
                                                    <td>1</td>
                                                    <td>Yes</td>
                                                    <td>₹ 0 </td>
                                                    <td class="text-end">₹ 0</td>
                                                </tr>
                                                
                                                <tr>
                                                    <td colspan="3"></td>
                                                    <td colspan="2" class="p-0">
                                                        <table class="table table-borderless mb-0">
                                                            <tbody>
                                                                <tr>
                                                                    <td>Sub Total:</td>
                                                                    <td class="text-end">₹ 2498.00</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Estimated Tax (12.5%):</td>
                                                                    <td class="text-end">₹ 200.00</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Shipping Charge:</td>
                                                                    <td class="text-end">₹ 0.00</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Discount:</td>
                                                                    <td class="text-end">₹ 0.00</td>
                                                                </tr>
                                                                <tr class="border-top">
                                                                    <th>Total (USD) :</th>
                                                                    <th class="text-end">₹ 2498.00</th>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>

                    </div>
                </div>
            </div>
            <!-- The order detail Modal -->

            <!-- The invoice Modal -->
            <div class="modal" id="invoice">
                <div class="modal-dialog  modal-lg">
                    <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Invoice</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                    <div class="row align-items-center gy-3">
                        <div class="col-sm-7 text-center text-sm-start"> 
                            <img id="logo" src="assets/images/dashboard/uniqconnect-logo-black.png"> 
                        </div>
                        <div class="col-sm-5 text-center text-sm-end">
                            <h4 class="mb-0">Invoice</h4>
                            <p class="mb-0">Invoice Number - 16835</p>
                        </div>
                    </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-6 text-sm-end order-sm-1"> <strong>Pay To:</strong>
                                <address>
                               Uniq Connect Wellness Care<br />
                               #39, 1st Floor, 17th Main Road,<br />
                               Anna Nagar West, Chennai - 600 040
                                </address>
                            </div>
                            <div class="col-sm-6 order-sm-0"> <strong>Invoiced To:</strong>
                                <address>
                                [member_name]<br />
                                [member_address]<br />
                                [member_city]-[member_pincode]<br />
                                [member_state]
                                </address>
                            </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4 mb3">
                                    <strong>Payment Method:</strong>
                                    <p>Online Payment</p>
                                </div>
                                <div class="col-sm-4 mb3">
                                    <strong>Order No:</strong>
                                    <p>457876</p>
                                </div>
                                <div class="col-sm-4 text-sm-end">
                                    <strong>Order Date:</strong>
                                    <p>07/11/2020</p>
                                </div>
                            </div>
                            <div class="table-responsive">
                            <table class="table border mb-0">
                                <thead>
                                <tr class="bg-light">
                                    <td class="col-4"><strong>Product</strong></td>
                                    <td class="col-2"><strong>Quantity</strong></td>
                                    <td class="col-2 text-center"><strong>Base Fare</strong></td>
                                    
                                    <td class="col-2 text-end"><strong>Amount</strong></td>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>UC Antioxidant Juice</td>
                                    <td>2</td>
                                    <td class="text-center">₹ 2498.00</td>
                                    
                                    <td class="text-end">₹ 2498.00</td>
                                </tr>
                                
                                </tbody>
                            </table>
                            </div>
                            <div class="table-responsive">
                                <table class="table border border-top-0 mb-0">
                                <tr class="bg-light">
                                    <td colspan="3" class="text-end"><strong>Sub Total:</strong></td>
                                    <td class="col-sm-2 text-end">₹ 2498.00</td>
                                </tr>
                                <tr class="bg-light">
                                    <td colspan="3" class="text-end"><strong>GST:</strong><br>
                                    <span class="text-1">CGST - 9%<br>SGST - 9%</span></td>
                                    <td class="col-sm-2 text-end align-top">-₹ 395.80</td>
                                </tr>
                                <tr class="bg-light">
                                    <td colspan="3" class="text-end border-bottom-0"><strong>Total:</strong></td>
                                    <td class="col-sm-2 text-end border-bottom-0">₹ 2498.00</td>
                                </tr>
                                </table>
                            </div>
                            <br>
                            <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                <tr class="bg-light">
                                    <td class="text-center"><strong>Order Date</strong></td>
                                    <td class="text-center"><strong>Gateway</strong></td>
                                    <td class="text-center"><strong>Transaction ID</strong></td>
                                    <td class="text-center"><strong>Amount</strong></td>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="text-center">07/11/2020</td>
                                    <td class="text-center">Online </td>
                                    <td class="text-center">3912912704</td>
                                    <td class="text-center">₹ 2498.00</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-info" data-bs-dismiss="modal">Print</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>

                    </div>
                </div>
            </div>
            <!-- The invoice Modal -->



</div>
@stop