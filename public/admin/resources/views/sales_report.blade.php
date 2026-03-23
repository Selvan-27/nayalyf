@extends('layout.admin') @section('content')
<div class="page-body">
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3> Day Wise Sales Report </h3>
                    </div>
                </div>
                <div class="col-lg-6">
                    <ol class="breadcrumb pull-right">
                        <li class="breadcrumb-item">
                            <a href="/admin_home">
                                <i data-feather="home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active">Sales</li>
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
                            <th>Date</th>
                            <th> Member</th>
                            <th>UC Antioxidant Juice</th>
                            <th>UC Detox Tea</th>
                            <th>UC Dia Care</th>
                            <th>UC Multivitamin</th>
                            <th>UC ManPower Caps</th>
                            <th>UC ManPower Oil</th>
                            <th>Amount</th>
                            <th>Payment</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>25/03/2025</td>
                            <td>
                                <div class="d-flex vendor-list">
                                    <img src="assets/images/team/2.jpg" alt=""
                                        class="img-fluid img-40 rounded-circle blur-up lazyloaded">
                                    <span>Petey Cruiser <br><small>UC1020122<br>UCWC Distributor</small></span>
                                </div>
                            </td>
                            <td>Purchase: 2<br>Offer: 0</td>
                            <td>Purchase: 0<br>Offer: 0</td>
                            <td>Purchase: 0<br>Offer: 0</td>
                            <td>Purchase: 0<br>Offer: 0</td>
                            <td>Purchase: 0<br>Offer: 0</td>
                            <td>Purchase: 0<br>Offer: 0</td>
                            <td>₹ 2498</td>
                            <td>UC Wallet</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>




</div>
@stop