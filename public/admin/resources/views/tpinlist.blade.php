@extends('layout.admin') @section('content')
<div class="page-body">
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3> Team Performance Bonus List </h3>
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
            <!-- <div class="col-xl-4">
                <div class="card">
                    <div class="card-body">
                        <div class="profile-details text-center">
                            <img src="assets/images/dashboard/designer.jpg" alt=""
                                class="img-fluid img-90  blur-up lazyloaded">
                            <h5 class="f-w-600 mb-0">John deo</h5>
                            <span>johndeo@gmail.com</span>
                            <div class="social">
                                <div class="form-group btn-showcase">
                                    <button class="btn social-btn btn-fb d-inline-block"> <i
                                            class="fa fa-facebook"></i></button>
                                    <button class="btn social-btn btn-twitter d-inline-block"><i
                                            class="fa fa-google"></i></button>
                                    <button class="btn social-btn btn-google d-inline-block me-0"><i
                                            class="fa fa-twitter"></i></button>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="project-status">
                            <h5 class="f-w-600">Employee Status</h5>
                            <div class="media">
                                <div class="media-body">
                                    <h6>Performance<span class="pull-right">80%</span></h6>
                                    <div class="progress sm-progress-bar">
                                        <div class="progress-bar bg-primary" role="progressbar"
                                            style="width: 90%" aria-valuenow="25" aria-valuemin="0"
                                            aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="media">
                                <div class="media-body">
                                    <h6>Overtime <span class="pull-right">60%</span></h6>
                                    <div class="progress sm-progress-bar">
                                        <div class="progress-bar bg-secondary" role="progressbar"
                                            style="width: 60%" aria-valuenow="25" aria-valuemin="0"
                                            aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="media">
                                <div class="media-body">
                                    <h6>Leaves taken<span class="pull-right">70%</span></h6>
                                    <div class="progress sm-progress-bar">
                                        <div class="progress-bar bg-danger" role="progressbar"
                                            style="width: 70%" aria-valuenow="25" aria-valuemin="0"
                                            aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
            <div class="col-xl-12">
                <div class="card tab2-card">
                    <div class="card-body">
                        <ul class="nav nav-tabs nav-material" id="top-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="b1-tab" data-bs-toggle="tab" href="#top-b1" role="tab"
                                    aria-controls="top-b1" aria-selected="true">Board 1
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="b2-tab" data-bs-toggle="tab" href="#top-b2" role="tab"
                                    aria-controls="top-b2" aria-selected="false">Board 2
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="b3-tab" data-bs-toggle="tab" href="#top-b3" role="tab"
                                    aria-controls="top-b3" aria-selected="false">Board 3
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="b4-tab" data-bs-toggle="tab" href="#top-b4" role="tab"
                                    aria-controls="top-b4" aria-selected="false">Board 4
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="b5-tab" data-bs-toggle="tab" href="#top-b5" role="tab"
                                    aria-controls="top-b5" aria-selected="false">Board 5
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="b6-tab" data-bs-toggle="tab" href="#top-b6" role="tab"
                                    aria-controls="top-b6" aria-selected="false">Board 6
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="b7-tab" data-bs-toggle="tab" href="#top-b7" role="tab"
                                    aria-controls="top-b7" aria-selected="false">Board 7
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="b8-tab" data-bs-toggle="tab" href="#top-b8" role="tab"
                                    aria-controls="top-b8" aria-selected="false">Board 8
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="b9-tab" data-bs-toggle="tab" href="#top-b9" role="tab"
                                    aria-controls="top-b9" aria-selected="false">Board 9
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="b10-tab" data-bs-toggle="tab" href="#top-b10" role="tab"
                                    aria-controls="top-b10" aria-selected="false">Board 10
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="b11-tab" data-bs-toggle="tab" href="#top-b11" role="tab"
                                    aria-controls="top-b11" aria-selected="false">Board 11
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="b12-tab" data-bs-toggle="tab" href="#top-b12" role="tab"
                                    aria-controls="top-b12" aria-selected="false">Board 12
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="b13-tab" data-bs-toggle="tab" href="#top-b13" role="tab"
                                    aria-controls="top-b13" aria-selected="false">Board 13
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="b14-tab" data-bs-toggle="tab" href="#top-b14" role="tab"
                                    aria-controls="top-b14" aria-selected="false">Board 14
                                </a>
                            </li>

                        </ul>
                        <div class="tab-content" id="top-tabContent">
                            <div class="tab-pane fade show active" id="top-b1" role="tabpanel" aria-labelledby="b1-tab">
                                <h5 class="f-w-600">Board 1</h5>
                                <div class="card-body vendor-table">
                                    <table class="table-responsive text-center" id="basic-1">
                                        <thead>
                                            <tr>
                                                <th>Member</th>
                                                <th>Leg</th>
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
                                                <td>Leg A</td>
                                                <td>25/03/2025</td>
                                                <td>₹ 200</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="top-b2" role="tabpanel" aria-labelledby="contact-top-tab">
                                <h5 class="f-w-600">Board 2</h5>
                                <div class="card-body vendor-table">
                                    <table class="table-responsive text-center" id="basic-2">
                                        <thead>
                                            <tr>
                                                <th>Member</th>
                                                <th>Leg</th>
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
                                                <td>Leg A</td>
                                                <td>25/03/2025</td>
                                                <td>₹ 400</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="top-b3" role="tabpanel" aria-labelledby="contact-top-tab">
                                <h5 class="f-w-600">Board 3</h5>
                                <div class="card-body vendor-table">
                                    <table class="table-responsive text-center" id="basic-3">
                                        <thead>
                                            <tr>
                                                <th>Member</th>
                                                <th>Leg</th>
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
                                                <td>Leg A</td>
                                                <td>25/03/2025</td>
                                                <td>₹ 400</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="top-b4" role="tabpanel" aria-labelledby="contact-top-tab">
                                <h5 class="f-w-600">Board 4</h5>
                                <div class="card-body vendor-table">
                                    <table class="table-responsive text-center" id="basic-4">
                                        <thead>
                                            <tr>
                                                <th>Member</th>
                                                <th>Leg</th>
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
                                                <td>Leg A</td>
                                                <td>25/03/2025</td>
                                                <td>₹ 400</td>
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