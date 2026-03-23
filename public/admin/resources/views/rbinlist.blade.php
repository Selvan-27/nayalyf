@extends('layout.admin') @section('content')
<div class="page-body">
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3> Re-Ignite Bonus List </h3>
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
        <div class="card">
            <div class="card-header">
                <a href="#" class="btn btn-primary mt-md-0 mt-2">Download Report</a>
            </div>

            <div class="card-body vendor-table">
                
                <table class="table-responsive text-center" id="basic-1">
                    <thead>
                        <tr>
                            <th>Member</th>
                            <th>RB ID NO.</th>
                            <th>Achieve Date</th>
                            <th>Amount</th>
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
                            <td>RB10001</td>
                            <td>25/03/2025</td>
                            <td>₹ 160</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            
        </div>
    </div>




</div>
@stop