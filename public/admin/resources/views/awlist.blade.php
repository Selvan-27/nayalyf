@extends('layout.admin') @section('content')
<div class="page-body">
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3> Award List </h3>
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
            <div class="col-xl-12">
                <div class="card tab2-card">
                    <div class="card-body">
                        <ul class="nav nav-tabs nav-material" id="top-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="b1-tab" data-bs-toggle="tab" href="#top-b1" role="tab"
                                    aria-controls="top-b1" aria-selected="true">BWD
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="b2-tab" data-bs-toggle="tab" href="#top-b2" role="tab"
                                    aria-controls="top-b2" aria-selected="false">SSD
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="b3-tab" data-bs-toggle="tab" href="#top-b3" role="tab"
                                    aria-controls="top-b3" aria-selected="false">GED
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="b4-tab" data-bs-toggle="tab" href="#top-b4" role="tab"
                                    aria-controls="top-b4" aria-selected="false">PD
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="b5-tab" data-bs-toggle="tab" href="#top-b5" role="tab"
                                    aria-controls="top-b5" aria-selected="false">DD
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="b6-tab" data-bs-toggle="tab" href="#top-b6" role="tab"
                                    aria-controls="top-b6" aria-selected="false">RD
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="b7-tab" data-bs-toggle="tab" href="#top-b7" role="tab"
                                    aria-controls="top-b7" aria-selected="false">UCA
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="b8-tab" data-bs-toggle="tab" href="#top-b8" role="tab"
                                    aria-controls="top-b8" aria-selected="false">DA
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="b9-tab" data-bs-toggle="tab" href="#top-b9" role="tab"
                                    aria-controls="top-b9" aria-selected="false">EA
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="b10-tab" data-bs-toggle="tab" href="#top-b10" role="tab"
                                    aria-controls="top-b10" aria-selected="false">TA
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="b11-tab" data-bs-toggle="tab" href="#top-b11" role="tab"
                                    aria-controls="top-b11" aria-selected="false">DDD
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="b12-tab" data-bs-toggle="tab" href="#top-b12" role="tab"
                                    aria-controls="top-b12" aria-selected="false">DED
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="b13-tab" data-bs-toggle="tab" href="#top-b13" role="tab"
                                    aria-controls="top-b13" aria-selected="false">DTD
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="b14-tab" data-bs-toggle="tab" href="#top-b14" role="tab"
                                    aria-controls="top-b14" aria-selected="false">CD
                                </a>
                            </li>

                        </ul>
                        <div class="tab-content" id="top-tabContent">
                            <div class="tab-pane fade show active" id="top-b1" role="tabpanel" aria-labelledby="b1-tab">
                                <h5 class="f-w-600">Bronze Wellness Distributor</h5>
                                <div class="card-body vendor-table">
                                    <table class="table-responsive text-center" id="basic-1">
                                        <thead>
                                            <tr>
                                                <th>Member</th>
                                                <th>1st Cut Off Date</th>
                                                <th>2nd Cut Off Date</th>
                                                <th>3rd Cut Off Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <div class="d-flex vendor-list">
                                                        <img src="assets/images/team/2.jpg" alt=""
                                                            class="img-fluid img-40 rounded-circle blur-up lazyloaded">
                                                        <span>Petey Cruiser <br><small>UC1020122</small></span>
                                                    </div>
                                                </td>
                                                <td>25/03/2025</td>
                                                <td>25/03/2025</td>
                                                <td>25/03/2025</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="top-b2" role="tabpanel" aria-labelledby="contact-top-tab">
                                <h5 class="f-w-600">SILVER STAR DISTRIBUTOR</h5>
                                <div class="card-body vendor-table">
                                    <table class="table-responsive text-center" id="basic-2">
                                        <thead>
                                            <tr>
                                                <th>Member</th>
                                                <th>1st Cut Off Date</th>
                                                <th>2nd Cut Off Date</th>
                                                <th>3rd Cut Off Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <div class="d-flex vendor-list">
                                                        <img src="assets/images/team/2.jpg" alt=""
                                                            class="img-fluid img-40 rounded-circle blur-up lazyloaded">
                                                        <span>Petey Cruiser <br><small>UC1020122</small></span>
                                                    </div>
                                                </td>
                                                <td>25/03/2025</td>
                                                <td>25/03/2025</td>
                                                <td>25/03/2025</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="top-b3" role="tabpanel" aria-labelledby="contact-top-tab">
                                <h5 class="f-w-600">GOLDEN ELITE DISTRIBUTOR</h5>
                                <div class="card-body vendor-table">
                                    <table class="table-responsive text-center" id="basic-3">
                                        <thead>
                                            <tr>
                                                <th>Member</th>
                                                <th>1st Cut Off Date</th>
                                                <th>2nd Cut Off Date</th>
                                                <th>3rd Cut Off Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <div class="d-flex vendor-list">
                                                        <img src="assets/images/team/2.jpg" alt=""
                                                            class="img-fluid img-40 rounded-circle blur-up lazyloaded">
                                                        <span>Petey Cruiser <br><small>UC1020122</small></span>
                                                    </div>
                                                </td>
                                                <td>25/03/2025</td>
                                                <td>25/03/2025</td>
                                                <td>25/03/2025</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="top-b4" role="tabpanel" aria-labelledby="contact-top-tab">
                                <h5 class="f-w-600">PLATINUM DISTRIBUTOR</h5>
                                <div class="card-body vendor-table">
                                    <table class="table-responsive text-center" id="basic-4">
                                        <thead>
                                            <tr>
                                                <th>Member</th>
                                                <th>1st Cut Off Date</th>
                                                <th>2nd Cut Off Date</th>
                                                <th>3rd Cut Off Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <div class="d-flex vendor-list">
                                                        <img src="assets/images/team/2.jpg" alt=""
                                                            class="img-fluid img-40 rounded-circle blur-up lazyloaded">
                                                        <span>Petey Cruiser <br><small>UC1020122</small></span>
                                                    </div>
                                                </td>
                                                <td>25/03/2025</td>
                                                <td>25/03/2025</td>
                                                <td>25/03/2025</td>
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
@stop