@extends('layout.admin') @section('content')
<div class="page-body">
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3> Order List</h3>
                    </div>
                </div>
                <div class="col-lg-6">
                    <ol class="breadcrumb pull-right">
                        <li class="breadcrumb-item">
                            <a href="index.html">
                                <i data-feather="home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active">Orders</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="card">
            <div class="row">
                <!--<form method="GET" action="{{ route('pos.orderlist') }}">-->
                <!--    <div class="col-xxl-3 col-md-6 xl-50">-->
                <!--        <div class="card">-->
                <!--            <p>Select From Date</p> -->
                <!--            <input type="date" name="from_date" class="form-control">-->
                <!--        </div>-->
                <!--    </div>-->
                <!--    <div class="col-xxl-3 col-md-6 xl-50">-->
                <!--        <div class="card">-->
                <!--            <p>Select To Date</p> -->
                <!--            <input type="date" name="to_date" class="form-control">-->
                <!--        </div>-->
                <!--    </div>-->
                <!--</form>-->
                <!--<div class="col-xxl-3 col-md-6 xl-50">-->
                <!--    <div class="card">-->
                <!--        <p></p>-->
                <!--        <a href="/order-list" class="btn btn-primary mt-md-0 mt-2">Refresh</a>-->
                <!--    </div>-->

            </div>
            <div class="card-body vendor-table">
                <table class="table table-responsive" id="basic-1">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th>Date</th>
                            <th>Total Amount</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->user_id ?? 'N/A' }}</td>
                            <td>{{ $item->order_date }}</td>
                            <td>{{ $item->total }}</td>
                            <td>{{ $item->status }}</td>
                            <td><a href="/invoice/{{$item->id}}" class="btn btn-primary btn-sm">View Invoice</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>    
               
     
        
                  
            </div>
        </div>
    </div>
</div>
@stop