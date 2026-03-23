@extends('layout.admin') @section('content')
<div class="page-body">
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3> Product Inventry</h3>
                    </div>
                </div>
                <div class="col-lg-6">
                    <ol class="breadcrumb pull-right">
                        <li class="breadcrumb-item">
                            <a href="/admin_home">
                                <i data-feather="home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active">Products</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        
        <!-- <div class="row">
            <h4>Search By Member ID</h4>
            <div class="col-xl-8 col-md-6 xl-50">
                <div class="card">    
                    <input type="text"> 
                </div>
            </div>
            
            <div class="col-xl-4 col-md-6 xl-50">
                <div class="card">
                    <button class="btn btn-success">Search</button>
                </div>
            </div>
        </div> -->
        <!-- <div class="row">
            <div class="col-xxl-3 col-md-6 xl-50">
                <div class="card o-hidden">
                    <div class="success-box card-body">
                        <div class="media static-top-widget align-items-center">
                            <div class="icons-widgets">
                                <div class="align-self-center text-center">
                                    <i data-feather="box" class="font-secondary"></i>
                                </div>
                            </div>
                            <div class="media-body media-doller">
                                <span class="m-0">Member Details</span>
                                <h5 class="mb-0" style="color: #000000">
                                    [member_name]<small> [member_id]</small>
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-md-6 xl-50">
                <div class="card o-hidden">
                    <div class="success-box card-body">
                        <div class="media static-top-widget align-items-center">
                            <div class="icons-widgets">
                                <div class="align-self-center text-center">
                                    <i data-feather="message-square" class="font-success"></i>
                                </div>
                            </div>
                            <div class="media-body media-doller">
                                <span class="m-0">Sponsor Details</span>
                                <h5 class="mb-0" style="color: #000000">
                                    [sponsor_name]<small> [sponsor_id]</small>
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-md-6 xl-50">
                <div class="card o-hidden">
                    <div class="success-box card-body">
                        <div class="media static-top-widget align-items-center">
                            <div class="icons-widgets">
                                <div class="align-self-center text-center">
                                    <i data-feather="users" class="font-success"></i>
                                </div>
                            </div>
                            <div class="media-body media-doller">
                                <span class="m-0">Active From</span>
                                <h5 class="mb-0" style="color: #000000">
                                    [active_date]<small> Sign-Up: [signup_date]</small>
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-md-6 xl-50">
                <div class="card o-hidden">
                    <div class="success-box card-body">
                        <div class="media static-top-widget align-items-center">
                            <div class="icons-widgets">
                                <div class="align-self-center text-center">
                                    <i data-feather="users" class="font-success"></i>
                                </div>
                            </div>
                            <div class="media-body media-doller">
                                <span class="m-0">Rank</span>
                                <h5 class="mb-0" style="color: #000000">
                                    [member_rank]<small> Referrals: [refer_count]</small>
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
        <div class="row">
            <div class="col-xxl-4 col-md-6 xl-50">
                <div class="card o-hidden">
                    <div class="success-box card-body">
                        <div class="media static-top-widget align-items-center">
                            
                            <div class="media-body media-doller">
                                <span class="m-0">UCWC<br>UC Antioxidant Juice</span>
                                <h3 class="mb-0" style="color: #000000">
                                    In-Stock:<span class="counter">30</span><small></small>
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-4 col-md-6 xl-50">
                <div class="card o-hidden">
                    <div class="success-box card-body">
                        <div class="media static-top-widget align-items-center">
                            
                            <div class="media-body media-doller">
                                <span class="m-0">UCWC<br>UC Detox Tea</span>
                                <h3 class="mb-0" style="color: #000000">
                                    In-Stock:<span class="counter">30</span><small></small>
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-4 col-md-6 xl-50">
                <div class="card o-hidden">
                    <div class="success-box card-body">
                        <div class="media static-top-widget align-items-center">
                            
                            <div class="media-body media-doller">
                                <span class="m-0">UCWC<br>UC Dia Care Capsules</span>
                                <h3 class="mb-0" style="color: #000000">
                                    In-Stock:<span class="counter">30</span><small></small>
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xxl-4 col-md-6 xl-50">
                <div class="card o-hidden">
                    <div class="success-box card-body">
                        <div class="media static-top-widget align-items-center">
                            
                            <div class="media-body media-doller">
                                <span class="m-0">UCWC<br>UC Multivitamin Capsules</span>
                                <h3 class="mb-0" style="color: #000000">
                                    In-Stock:<span class="counter">30</span><small></small>
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-4 col-md-6 xl-50">
                <div class="card o-hidden">
                    <div class="success-box card-body">
                        <div class="media static-top-widget align-items-center">
                            
                            <div class="media-body media-doller">
                                <span class="m-0">UCWC<br>UC ManPower Capsules</span>
                                <h3 class="mb-0" style="color:rgb(255, 0, 0)">
                                    In-Stock:<span class="counter">0</span><small></small>
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-4 col-md-6 xl-50">
                <div class="card o-hidden">
                    <div class="success-box card-body">
                        <div class="media static-top-widget align-items-center">
                            
                            <div class="media-body media-doller">
                                <span class="m-0">UCWC<br>UC ManPower Oil</span>
                                <h3 class="mb-0" style="color:rgb(255, 0, 0)">
                                    In-Stock:<span class="counter">0</span><small></small>
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <h4>Add Stock</h4>
                                <div class="card-body">
                                    <div class="row product-adding">
                                        
                                        <div class="col-xl-12">
                                            <form class="needs-validation add-product-form" novalidate="">
                                                <div class="form">
                                                    <div class="form-group row">
                                                        <label for="exampleFormControlSelect1"
                                                            class="col-xl-3 col-sm-4 mb-0">Select Category:</label>
                                                        <div class="col-xl-8 col-sm-7">
                                                            <select class="form-control digits"
                                                                id="exampleFormControlSelect1">
                                                                <option value="0">Select Category</option>
                                                                <option value="0">UCWC</option>
                                                                
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div> 
                                                <div class="form">
                                                    <div class="form-group row">
                                                        <label for="exampleFormControlSelect1"
                                                            class="col-xl-3 col-sm-4 mb-0">Select Product:</label>
                                                        <div class="col-xl-8 col-sm-7">
                                                            <select class="form-control digits"
                                                                id="exampleFormControlSelect1">
                                                                <option value="0">Select Product</option>
                                                                <option value="1">UC Antioxidant Juice</option>
                                                                <option value="2">UC Detox Tea</option>
                                                                <option value="3">UC Dia Care Capsules</option>
                                                                <option value="4">UC Multivitamin Capsules</option>
                                                                <option value="5">UC ManPower Capsules</option>
                                                                
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>    
                                                <div class="form">
                                                    <div class="form-group mb-3 row">
                                                        <label for="validationCustomUsername" class="col-xl-3 col-sm-4 mb-0">Total Quantity:</label>
                                                        <div class="col-xl-8 col-sm-7">
                                                            <input class="form-control" id="validationCustomUsername" type="text" required="">
                                                        </div>
                                                        
                                                    </div>
                                                    <div class="form-group mb-3 row">
                                                        <label for="validationCustom01" class="col-xl-3 col-sm-4 mb-0">Mfg Name:</label>
                                                        <div class="col-xl-8 col-sm-7"> 
                                                            <input class="form-control" id="validationCustom01" type="text" required="">
                                                        </div>
                                                        <div class="valid-feedback">Looks good!</div>
                                                    </div>
                                                    
                                                    
                                                    <div class="row">
                                                        <div class="col-6">  
                                                            <div class="form-group mb-3 row">
                                                                <label for="validationCustom02" class="col-xl-3 col-sm-4 mb-0">Mfg Date :</label>
                                                                <div class="col-xl-8 col-sm-7">
                                                                    <input class="form-control" id="validationCustom02" type="text" required="">
                                                                </div>
                                                                <div class="valid-feedback">Looks good!</div>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">  
                                                            <div class="form-group mb-3 row">
                                                                <label for="validationCustom02" class="col-xl-3 col-sm-4 mb-0">Exp Date :</label>
                                                                <div class="col-xl-8 col-sm-7">
                                                                    <input class="form-control" id="validationCustom02" type="text" required="">
                                                                </div>
                                                                <div class="valid-feedback">Looks good!</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-6">  
                                                            <div class="form-group mb-3 row">
                                                                <label for="validationCustom02" class="col-xl-3 col-sm-4 mb-0">Batch No :</label>
                                                                <div class="col-xl-8 col-sm-7">
                                                                    <input class="form-control" id="validationCustom02" type="text" required="">
                                                                </div>
                                                                <div class="valid-feedback">Looks good!</div>
                                                            </div>
                                                        </div>
                                                        
                                                    </div>

                                                    
                                                    
                                                    <!-- <div class="form-group row">
                                                        <label class="col-xl-3 col-sm-4">Add Description :</label>
                                                        <div class="col-xl-8 col-sm-7 description-sm">
                                                            <textarea id="editor1" name="editor1" cols="10" rows="4"></textarea>
                                                        </div>
                                                        <div class="offset-xl-3 offset-sm-4 mt-4">
                                                            
                                                            <button type="button" class="btn btn-dark">Upload Banner<br><small>(jpeg/png 1500x788)</small></button>
                                                            <button type="button" class="btn btn-dark">Upload Product Image<br><small>(jpeg/png 390x334)</small></button>
                                                            <button type="button" class="btn btn-dark">Upload Home Image<br><small>(jpeg/png 80x100)</small></button>
                                                        </div>
                                                    </div> -->
                                                    
                                                </div>
                                                <button type="submit" class="btn btn-primary">Add Stock</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
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
                            <th>Category</th>
                            <th>Product</th>
                            
                            <th>Quantity</th>
                            <th>Mfg Name</th>
                            <th>Mfg Date</th>
                            <th>Exp Date</th>
                            <th>Batch No</th>
                            
                            
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>25/03/2025</td>
                            <td>UCWC</td>
                            
                            <td>UC Antioxidant Juice</td>
                            <td>100</td>
                            <td>Vistara</td>
                            <td>25/03/2025</td>
                            <td>25/03/2025</td>
                            <td>BN009</td>
                            
                            
                            <td>
                                <div>
                                    <i class="fa fa-eye me-2 font-success"></i>
                                    <i class="fa fa-edit font-primary"></i>
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