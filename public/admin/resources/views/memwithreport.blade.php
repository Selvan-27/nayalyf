@extends('layout.admin') @section('content')
<div class="page-body">
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3> Members Withdraw Report</h3>
                    </div>
                </div>
                <div class="col-lg-6">
                    <ol class="breadcrumb pull-right">
                        <li class="breadcrumb-item">
                            <a href="/admin_home">
                                <i data-feather="home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active">Members</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="card">
            <div class="row">

                <div class="col-xxl-4 col-md-6 xl-50">
                    <div class="card">
                        <p>Select From Date</p> <input type="date">
                    </div>
                </div>
                <div class="col-xxl-4 col-md-6 xl-50">
                    <div class="card">
                        <p>Select To Date</p> <input type="date">
                    </div>
                </div>
                <div class="col-xxl-4 col-md-6 xl-50">
                    <div class="card">
                        <p></p>
                        <button class="btn btn-success">Search</button>
                    </div>
                </div>

            </div>
            <div class="card-header">


                <a href="#" class="btn btn-primary mt-md-0 mt-2">Download Report</a>
            </div>


            <div class="card-body vendor-table">
                <table class="table table-responsive text-center" id="basic-1">
                    <thead>
                        <tr>
                            <th>Member</th>
                            <th>Request Amount</th>
                            <th>Request Date</th>
                            <th>Action Date</th>
                            <th>Transfered Amount</th>
                            <th>10% Deduction</th>
                            <th>Remarks</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="d-flex vendor-list">
                                    <img src="assets/images/team/2.jpg" alt=""
                                        class="img-fluid img-40 rounded-circle blur-up lazyloaded">
                                    <span>Petey Cruiser <br><small>UC1020122<br>UCWC Distributor</small></span>
                                </div>
                            </td>
                            <td>₹ 1000</td>
                            <td>08/03/2025</td>
                            <td>08/03/2025</td>
                            <td>₹ 900</td>
                            <td>₹ 100</td>
                            <td>Done</td>
                            
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@stop