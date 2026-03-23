@extends('layout.admin') @section('content')
<div class="page-body">
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3> Product Wise Sales Report</h3>
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
        <div class="row">
            <div class="col-xl-12">
                <div class="card tab2-card">
                    <div class="card-body">
                        <ul class="nav nav-tabs nav-material" id="top-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="b1-tab" data-bs-toggle="tab" href="#top-b1" role="tab"
                                    aria-controls="top-b1" aria-selected="true">UC Antioxidant Juice
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="b2-tab" data-bs-toggle="tab" href="#top-b2" role="tab"
                                    aria-controls="top-b2" aria-selected="false">UC Detox Tea
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="b3-tab" data-bs-toggle="tab" href="#top-b3" role="tab"
                                    aria-controls="top-b3" aria-selected="false">UC Dia Care
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="b4-tab" data-bs-toggle="tab" href="#top-b4" role="tab"
                                    aria-controls="top-b4" aria-selected="false">UC Multivitamin
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="b5-tab" data-bs-toggle="tab" href="#top-b5" role="tab"
                                    aria-controls="top-b5" aria-selected="false">UC ManPower
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content" id="top-tabContent">
                            <div class="tab-pane fade show active" id="top-b1" role="tabpanel" aria-labelledby="b1-tab">
                                <h5 class="f-w-600">UC Antioxidant Juice</h5>
                                <div class="card-header">
                                    <a href="#" class="btn btn-primary mt-md-0 mt-2">Download Report</a>
                                </div>
                                <div class="card-body vendor-table">
                                    <table class="table-responsive text-center" id="basic-1">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Stock In-Hand</th>
                                                <th>Stock Added</th>
                                                <th>Member</th>
                                                <th>Order No.</th>
                                                <th>Purchase Quanitity</th>
                                                <th>Offer Quanitity</th>
                                                <th>Stock In-Balance</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>25/03/2025</td>
                                                <td>30</td>
                                                <td>0</td>
                                                <td>
                                                    <div class="d-flex vendor-list">
                                                        <img src="assets/images/team/2.jpg" alt=""
                                                            class="img-fluid img-40 rounded-circle blur-up lazyloaded">
                                                        <span>Petey Cruiser <br><small>UC1020122<br>UCWC Distributor</small></span>
                                                    </div>
                                                </td>
                                                <td>OR343456</td>
                                                <td>2</td>
                                                <td>1</td>
                                                <td>27</td>
                                            </tr>
                                            <tr>
                                                <td>25/03/2025</td>
                                                <td>27</td>
                                                <td>100</td>
                                                <td>
                                                   --
                                                </td>
                                                <td>-</td>
                                                <td>0</td>
                                                <td>0</td>
                                                <td>127</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="top-b2" role="tabpanel" aria-labelledby="contact-top-tab">
                                <h5 class="f-w-600">UC Detox Tea</h5>
                                <div class="card-header">
                                    <a href="#" class="btn btn-primary mt-md-0 mt-2">Download Report</a>
                                </div>
                                <div class="card-body vendor-table">
                                    <table class="table-responsive text-center" id="basic-2">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Stock In-Hand</th>
                                                <th>Stock Added</th>
                                                <th>Member</th>
                                                <th>Order No.</th>
                                                <th>Purchase Quanitity</th>
                                                <th>Offer Quanitity</th>
                                                <th>Stock In-Balance</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>25/03/2025</td>
                                                <td>30</td>
                                                <td>0</td>
                                                <td>
                                                    <div class="d-flex vendor-list">
                                                        <img src="assets/images/team/2.jpg" alt=""
                                                            class="img-fluid img-40 rounded-circle blur-up lazyloaded">
                                                        <span>Petey Cruiser <br><small>UC1020122<br>UCWC Distributor</small></span>
                                                    </div>
                                                </td>
                                                <td>OR343456</td>
                                                <td>2</td>
                                                <td>1</td>
                                                <td>27</td>
                                            </tr>
                                            <tr>
                                                <td>25/03/2025</td>
                                                <td>27</td>
                                                <td>100</td>
                                                <td>
                                                   --
                                                </td>
                                                <td>-</td>
                                                <td>0</td>
                                                <td>0</td>
                                                <td>127</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="top-b3" role="tabpanel" aria-labelledby="contact-top-tab">
                                <h5 class="f-w-600">UC Dia Care</h5>
                                <div class="card-header">
                                    <a href="#" class="btn btn-primary mt-md-0 mt-2">Download Report</a>
                                </div>
                                <div class="card-body vendor-table">
                                    <table class="table-responsive text-center" id="basic-3">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Stock In-Hand</th>
                                                <th>Stock Added</th>
                                                <th>Member</th>
                                                <th>Order No.</th>
                                                <th>Purchase Quanitity</th>
                                                <th>Offer Quanitity</th>
                                                <th>Stock In-Balance</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>25/03/2025</td>
                                                <td>30</td>
                                                <td>0</td>
                                                <td>
                                                    <div class="d-flex vendor-list">
                                                        <img src="assets/images/team/2.jpg" alt=""
                                                            class="img-fluid img-40 rounded-circle blur-up lazyloaded">
                                                        <span>Petey Cruiser <br><small>UC1020122<br>UCWC Distributor</small></span>
                                                    </div>
                                                </td>
                                                <td>OR343456</td>
                                                <td>2</td>
                                                <td>1</td>
                                                <td>27</td>
                                            </tr>
                                            <tr>
                                                <td>25/03/2025</td>
                                                <td>27</td>
                                                <td>100</td>
                                                <td>
                                                   --
                                                </td>
                                                <td>-</td>
                                                <td>0</td>
                                                <td>0</td>
                                                <td>127</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="top-b4" role="tabpanel" aria-labelledby="contact-top-tab">
                                <h5 class="f-w-600">UC Multivitamin</h5>
                                <div class="card-header">
                                    <a href="#" class="btn btn-primary mt-md-0 mt-2">Download Report</a>
                                </div>
                                <div class="card-body vendor-table">
                                    <table class="table-responsive text-center" id="basic-4">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Stock In-Hand</th>
                                                <th>Stock Added</th>
                                                <th>Member</th>
                                                <th>Order No.</th>
                                                <th>Purchase Quanitity</th>
                                                <th>Offer Quanitity</th>
                                                <th>Stock In-Balance</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>25/03/2025</td>
                                                <td>30</td>
                                                <td>0</td>
                                                <td>
                                                    <div class="d-flex vendor-list">
                                                        <img src="assets/images/team/2.jpg" alt=""
                                                            class="img-fluid img-40 rounded-circle blur-up lazyloaded">
                                                        <span>Petey Cruiser <br><small>UC1020122<br>UCWC Distributor</small></span>
                                                    </div>
                                                </td>
                                                <td>OR343456</td>
                                                <td>2</td>
                                                <td>1</td>
                                                <td>27</td>
                                            </tr>
                                            <tr>
                                                <td>25/03/2025</td>
                                                <td>27</td>
                                                <td>100</td>
                                                <td>
                                                   --
                                                </td>
                                                <td>-</td>
                                                <td>0</td>
                                                <td>0</td>
                                                <td>127</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="top-b5" role="tabpanel" aria-labelledby="contact-top-tab">
                                <h5 class="f-w-600">UC ManPower</h5>
                                <div class="card-header">
                                    <a href="#" class="btn btn-primary mt-md-0 mt-2">Download Report</a>
                                </div>
                                <div class="card-body vendor-table">
                                    <table class="table-responsive text-center" id="basic-5">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Stock In-Hand</th>
                                                <th>Stock Added</th>
                                                <th>Member</th>
                                                <th>Order No.</th>
                                                <th>Purchase Quanitity</th>
                                                <th>Offer Quanitity</th>
                                                <th>Stock In-Balance</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>25/03/2025</td>
                                                <td>30</td>
                                                <td>0</td>
                                                <td>
                                                    <div class="d-flex vendor-list">
                                                        <img src="assets/images/team/2.jpg" alt=""
                                                            class="img-fluid img-40 rounded-circle blur-up lazyloaded">
                                                        <span>Petey Cruiser <br><small>UC1020122<br>UCWC Distributor</small></span>
                                                    </div>
                                                </td>
                                                <td>OR343456</td>
                                                <td>2</td>
                                                <td>1</td>
                                                <td>27</td>
                                            </tr>
                                            <tr>
                                                <td>25/03/2025</td>
                                                <td>27</td>
                                                <td>100</td>
                                                <td>
                                                   --
                                                </td>
                                                <td>-</td>
                                                <td>0</td>
                                                <td>0</td>
                                                <td>127</td>
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