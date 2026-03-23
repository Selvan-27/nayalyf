@extends('layout.admin') @section('content')
<div class="page-body">
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3> Create Members </h3>
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
        <div class="row">
            <div class="col-sm-7">
                <div class="card tab2-card">
                    <div class="card-body">
                        
                        <form class="needs-validation user-add" novalidate="">
                            <h4>Account Details</h4>
                            <div class="form-group row">
                                <label for="validationCustom0"
                                    class="col-xl-3 col-md-4"><span>*</span> Sponsor ID</label>
                                <div class="col-xl-8 col-md-7">
                                    <input class="form-control" id="validationCustom0" type="text"
                                        required="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="validationCustom0"
                                    class="col-xl-3 col-md-4"><span>*</span> Sponsor Name</label>
                                <div class="col-xl-8 col-md-7">
                                    <input class="form-control" id="validationCustom0" type="text"
                                        disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="validationCustom0"
                                    class="col-xl-3 col-md-4"><span>*</span> Full Name</label>
                                <div class="col-xl-8 col-md-7">
                                    <input class="form-control" id="validationCustom0" type="text"
                                        required="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="validationCustom1"
                                    class="col-xl-3 col-md-4"><span>*</span> Mobile Number</label>
                                <div class="col-xl-8 col-md-7">
                                    <input class="form-control" id="validationCustom1" type="text"
                                        required="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="validationCustom2"
                                    class="col-xl-3 col-md-4"><span>*</span> Email</label>
                                <div class="col-xl-8 col-md-7">
                                    <input class="form-control" id="validationCustom2" type="text"
                                        required="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="validationCustom3"
                                    class="col-xl-3 col-md-4"><span>*</span> Choose Password</label>
                                <div class="col-xl-8 col-md-7">
                                    <input class="form-control" id="validationCustom3"
                                        type="password" required="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="validationCustom4"
                                    class="col-xl-3 col-md-4"><span>*</span> Confirm
                                    Password</label>
                                <div class="col-xl-8 col-md-7">
                                    <input class="form-control" id="validationCustom4"
                                        type="password" required="">
                                </div>
                            </div>
                        </form>
                            
                        <div class="pull-right">
                            <button type="button" class="btn btn-primary">Create Member</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-5">
                <div class="card tab2-card">
                    <div class="card-body">
                        <form class="needs-validation user-add" novalidate="">
                            <h4>Registration Details</h4>
                            <div class="form-group row">
                                <label for="validationCustom0"
                                    class="col-xl-3 col-md-4"> Member ID</label>
                                <div class="col-xl-8 col-md-7">
                                    <input class="form-control" id="validationCustom0" type="text">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="validationCustom0"
                                    class="col-xl-3 col-md-4"> Member Name</label>
                                <div class="col-xl-8 col-md-7">
                                    <input class="form-control" id="validationCustom0" type="text">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="validationCustom3"
                                    class="col-xl-3 col-md-4">Password</label>
                                <div class="col-xl-8 col-md-7">
                                    <input class="form-control" id="text"
                                        type="password" >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="validationCustom0"
                                    class="col-xl-3 col-md-4"> Sponsor ID</label>
                                <div class="col-xl-8 col-md-7">
                                    <input class="form-control" type="text">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="validationCustom0"
                                    class="col-xl-3 col-md-4"> Sponsor Name</label>
                                <div class="col-xl-8 col-md-7">
                                    <input class="form-control" type="text">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@stop