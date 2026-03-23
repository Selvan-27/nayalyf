@extends('layout.admin') @section('content')
<div class="page-body">
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3> Member Edit </h3>
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
        <!--<div class="row">-->
        <!--    <h4>Search By Member ID</h4>-->
        <!--    <div class="col-xl-8 col-md-6 xl-50">-->
        <!--        <div class="card">    -->
        <!--            <input type="text"> -->
        <!--        </div>-->
        <!--    </div>-->
            
        <!--    <div class="col-xl-4 col-md-6 xl-50">-->
        <!--        <div class="card">-->
        <!--            <button class="btn btn-success">Search</button>-->
        <!--        </div>-->
        <!--    </div>-->
        <!--</div>-->
            
                            @if(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                            @endif
                            
                             <form action="profile_update" method="post">
            <div class="col-sm-12">
                <div class="card card-table" style="border: 1px solid;">
                    <div class="card-body">
                       
                            @csrf
                            <!--<p class="alert alert-danger"></p>-->
                            <!--<p class="alert alert-success"></p>-->
                            <div class="row">
                                    <!-- Member Name & ID -->
                                <div class="col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label for="name">Member Name:</label>
                                        <input type="text"  name="name" class="form-control" value="{{$users->name}}">
                                    </div>
                                </div>
                                
                                <div class="col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label for="memberid">Member ID:</label>
                                        <input type="text" id="memberid" name="memberid" readonly="" class="form-control" value="{{$users->memberid}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label for="real_email">Email:</label>
                                        <input type="text" id="real_email" value="{{$users->real_email}}" name="real_email" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label for="mobile">Mobile:</label>
                                        <input type="text" id="mobile" value="{{$users->mobile}}" name="mobile" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label for="sponsor_name">Sponsor Name:</label>
                                        <input type="text" id="sponsor_name" value=" " name="sponsor_name" disabled class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label for="promo">Sponsor ID:</label>
                                        <input type="text" id="promo" value=" " name="promo" disabled class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label for="created_at">Joined Date:</label>
                                        <input type="text" id="jdate" value="{{$users->jdate}}" name="created_at" disabled class="form-control">
                                    </div>
                                        </div>
                                <div class="col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label>Active Date:</label>
                                        <input type="text" disabled class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label for="Password">Existing Password:</label>
                                        <input type="text" id="Password"  name="Password" class="form-control" readonly="" value="{{$users->pwd}}">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label for="new_pwd">New Password:</label>
                                        <input type="text" id="new_pwd" name="new_pwd" class="form-control">
                                    </div>
                                </div>
                                
                            </div>
                      
 
                      
                    </div><hr>
                    <div class="card-body">
                        <h3>Banking Details</h3>
                    
                            <!--<p class="alert alert-danger"></p>-->
                            <!--<p class="alert alert-success"></p>-->
                            <div class="row">
                                    <!-- Member Name & ID -->
                                <div class="col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label for="bank_Name">A/C Holder Name:</label>
                                        <input type="text"  name="bank_Name" class="form-control" value="{{$users->bank_Name}}">
                                    </div>
                                </div>
                                
                                <div class="col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label for="account_Number">Account Number:</label>
                                        <input type="text"  name="account_Number"  class="form-control" value="{{$users->account_Number}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label for="branch_Name">Branch:</label>
                                        <input type="text" id="branch_Name"  name="branch_Name" class="form-control" value="{{$users->branch_Name}}">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label for="ifsc_Code">IFSC Code:</label>
                                        <input type="text" id="ifsc_Code"  name="ifsc_Code" class="form-control" value="{{$users-> ifsc_Code }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label for="upi_id">UPI ID:</label>
                                        <input type="text" id="upi_id"  name="upi_id"  class="form-control" value="{{$users->upi_id}}">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label for="upi_number">UPI Number:</label>
                                        <input type="text" id="upi_number"  name="upi_number"  class="form-control" value="{{$users->upi_number}}">
                                    </div>
                                </div>
                            </div>
                            
                            <br>
                            <div class="row">
                                <div class="col-xxl-12 col-sm-12 ">
                                    <button type="submit" class="btn btn-primary mt-4 btn-block">Update Profile Details</button>
                                </div>
                        
                            </div>
                      
                    </div>
                </div>
                
            </div>
            
              </form>
            
            
        </div>
    </div>
</div>
@stop