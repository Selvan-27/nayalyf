@extends('layout.admin') @section('content')
<div class="page-body">
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3> Members Withdraw Request List</h3>
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


                <!--<a href="#" class="btn btn-primary mt-md-0 mt-2">Download Report</a>-->
            </div>
  @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

            <div class="card-body vendor-table">
                <table class="table table-responsive text-center" id="basic-1">
                    <thead>
                        <tr>
                            <th>Member</th>
                            <th>Request Amount</th>
                            <th>Request Date</th>
                            <th>10% Deduction</th>
                            <th>To Transfer</th>
                            
                            <th>Remarks</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                   
                             @foreach( $data as $item)
                        <tr>
            
                            <td>
                                <div class="d-flex vendor-list">
                                    <img src="assets/images/team/2.jpg" alt=""
                                        class="img-fluid img-40 rounded-circle blur-up lazyloaded">
                                    <span>{{$item->tname}}<br><small>{{$item->memberid}}<br></small></span>
                                </div>
                            </td>
                               
                                    <td>₹ {{$item->payout}}</td>
                        <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y') }}</td>

                         
                              <td>₹ {{$item->service_charge}}</td>
                                <td>₹ {{$item->netpay}}</td>
                      
                          
                            
                            <td>{{$item->remarks?? ''}}</td>
                              <td> {{$item->status}}</td>
                        </tr>
                          @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@stop