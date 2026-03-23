@extends('layout.admin') @section('content')
<div class="page-body">
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3> Members Deposit List</h3>
                    </div>
                </div>
                <div class="col-lg-6">
                    <ol class="breadcrumb pull-right">
                        <li class="breadcrumb-item">
                            <a href="index.html">
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
            <!--<div class="row">-->

            <!--    <div class="col-xxl-3 col-md-6 xl-50">-->
            <!--        <div class="card">-->
            <!--            <p>Select From Date</p> <input type="date">-->
            <!--        </div>-->
            <!--    </div>-->
            <!--    <div class="col-xxl-3 col-md-6 xl-50">-->
            <!--        <div class="card">-->
            <!--            <p>Select To Date</p> <input type="date">-->
            <!--        </div>-->
            <!--    </div>-->
            <!--    <div class="col-xxl-3 col-md-6 xl-50">-->
            <!--        <div class="card">-->
            <!--            <p></p>-->
            <!--            <button class="btn btn-success">Search</button>-->
            <!--        </div>-->
            <!--    </div>-->
            <!--    <div class="col-xxl-3 col-md-6 xl-50">-->
            <!--        <div class="card">-->
            <!--            <p></p>-->
            <!--            <a href="#" class="btn btn-primary mt-md-0 mt-2">Download Report</a>-->
            <!--        </div>-->
            <!--    </div>-->

            <!--</div>-->
            <div class="card-body vendor-table">
                <table class="table table-responsive" id="basic-1">
                    <thead>
                        <tr>
                            
                            <th>Member</th>
                            <th>Deposit Amount</th>
                            <th>Deposit Date</th>
                            <th>Payment Mode</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            
                            <td>
                                <div class="d-flex vendor-list">
                                    <img src="assets/images/team/2.jpg" alt=""
                                        class="img-fluid img-40 rounded-circle blur-up lazyloaded">
                                    <span>Petey Cruiser <br><small>UC1020122<br>UCD</small></span>
                                </div>
                            </td>
                            
                            <td>₹ 10000</td>
                            <td>08/03/2025</td>
                            <td>Admin</td>
                            
                        </tr>
                        <tr>
                            
                            <td>
                                <div class="d-flex vendor-list">
                                    <img src="assets/images/team/2.jpg" alt=""
                                        class="img-fluid img-40 rounded-circle blur-up lazyloaded">
                                    <span>Petey Cruiser <br><small>UC1020122<br>UCD</small></span>
                                </div>
                            </td>
                            
                            <td>₹ 5000</td>
                            <td>08/03/2025</td>
                            <td>PhonePe</td>
                            
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@stop