@extends('layout.admin') @section('content')
<div class="page-body">
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3> Cut-Off Offer </h3>
                    </div>
                </div>
                <div class="col-lg-6">
                    <ol class="breadcrumb pull-right">
                        <li class="breadcrumb-item">
                            <a href="/admin_home">
                                <i data-feather="home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active">Offers</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    
    <div class="card">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card">
                        <h3>Set Offer Date</h3>
                        
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card">
                        <h3>From</h3>
                        <input type="date">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card">
                        <h3>To</h3>
                        <input type="date">
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <h3>Main Product</h3>
                    <form>
                        <div class="form">
                            <div class="form-group row">
                                <label for="exampleFormControlSelect1" class="col-xl-3 col-sm-4 mb-0">Select
                                    Product:</label>
                                <div class="col-xl-8 col-sm-7">
                                    <select class="form-control digits" id="exampleFormControlSelect1">
                                        <option value="0">Select Product</option>
                                        <option value="1">UC Antioxidant Juice</option>
                                        <option value="2">UC Detox Tea</option>
                                        <option value="3">UC Dia Care Capsules</option>
                                        <option value="4">UC Multivitamin Capsules</option>

                                    </select>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            
            <div class="col-lg-6">
                <h3>Quantity</h3>
                <div class="card">
                    <form>
                        <div class="form">
                            <div class="form-group row">
                                <label for="exampleFormControlSelect1" class="col-xl-3 col-sm-4 mb-0">Enter Purchase
                                    Quantity:</label>
                                <div class="col-xl-8 col-sm-7">
                                    <input type="number" class="form-control">
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4">
                    <h3>Offer Product</h3>
                    <div class="card">
                        <form>
                            <div class="form">
                                <div class="form-group row">
                                    <label for="exampleFormControlSelect1" class="col-xl-3 col-sm-4 mb-0">Select
                                        Product:</label>
                                    <div class="col-xl-8 col-sm-7">
                                        <select class="form-control digits" id="exampleFormControlSelect1">
                                            <option value="0">Select Product</option>
                                            <option value="1">UC Antioxidant Juice</option>
                                            <option value="2">UC Detox Tea</option>
                                            <option value="3">UC Dia Care Capsules</option>
                                            <option value="4">UC Multivitamin Capsules</option>

                                        </select>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-4">
                    <h3>Quantity</h3>
                    <div class="card">
                        <form>
                            <div class="form">
                                <div class="form-group row">
                                    <label for="exampleFormControlSelect1" class="col-xl-3 col-sm-4 mb-0">Enter Offer
                                        Quantity:</label>
                                    <div class="col-xl-8 col-sm-7">
                                        <input type="number" class="form-control">
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-4">
                    <h3>Fix Offer %</h3>
                    <div class="card">
                        <form>
                            <div class="form">
                                <div class="form-group row">
                                    <label for="exampleFormControlSelect1" class="col-xl-3 col-sm-4 mb-0">Select %:</label>
                                    <div class="col-xl-8 col-sm-7">
                                        <select class="form-control digits" id="exampleFormControlSelect1">
                                            <option value="0">Select %</option>
                                            <option value="1">Free (100%)</option>
                                            <option value="2">90%</option>
                                            <option value="3">80%</option>
                                            <option value="4">70%</option>
                                            <option value="5">60%</option>
                                            <option value="6">50%</option>

                                        </select>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-header">
            <a href="#" class="btn btn-dark mt-md-0 mt-2">Upload Offer Image</a>
            <a href="#" class="btn btn-primary mt-md-0 mt-2">Set Cut-Off Offer</a>
        </div>

    </div><hr>


    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <a href="#" class="btn btn-primary mt-md-0 mt-2">Download Report</a>
            </div>

            <div class="card-body vendor-table">
                <h3 class="text-center" style="color: #ff0000">Cut-Off Offer Report</h3>
                <table class="table-responsive text-center" id="basic-1">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Main Product</th>
                            <th>Quantity</th>
                            <th>Offer Product</th>
                            <th>Quantity</th>
                            <th>%</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>From: 25/03/2025<br>To: 25/03/2025</td>
                            <td>UC Antioxidant Juice </td>
                            <td>2</td>
                            <td>UC Antioxidant Juice </td>
                            <td>1</td>
                            <td>Free (100%)</td>
                            <td>
                                <div>
                                    <a href="/members_details"><i class="fa fa-eye me-2 font-success"></i></a>
                                    <a href="/members_edit"><i class="fa fa-edit font-primary"></i></a>
                                </div>
                            </td>
                            
                        </tr>
                    </tbody>
                </table>
            </div>


        </div>
    </div>




</div>
@stop