@extends('layout.admin') @section('content')
<div class="page-body">
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3> Add cut-off</h3>
                    </div>
                </div>
                <div class="col-lg-6">
                    <ol class="breadcrumb pull-right">
                        <li class="breadcrumb-item">
                            <a href="/admin_home">
                                <i data-feather="home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active">Cut-Off</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row product-adding">
                                        
                                        <div class="col-xl-12">
                                            <form class="needs-validation add-product-form" method="post" action="/cutoff_insert">
                                                   @csrf
                                                <div class="form">
                                                    <div class="form-group mb-3 row">
                                                        <label for="cutoffname" class="col-xl-4 col-sm-4 mb-0">Cut-off Name :</label>
                                                        <div class="col-xl-8 col-sm-8">
                                                            <input class="form-control" name="cutoffname" type="text" required="">
                                                        </div>
                                                    </div> 
                                                    <div class="form-group mb-3 row">   
                                                        <div class="col-6">
                                                            <label for="cutoffstart">Start Date :</label>
                                                            <input class="form-control" name="cutoffstart" type="date" required="">
                                                        </div>
                                                        <div class="col-6">
                                                            <label for="cutoffend">End Date :</label>
                                                            <input class="form-control" name="cutoffend" type="date" required="">
                                                        </div>
                                                        
                                                    </div>
                                                   
                                                    
                                                </div>
                                                <button type="submit" class="btn btn-primary">Add Cut-Off</button>
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
                <!--<a href="#" class="btn btn-primary mt-md-0 mt-2">Download Report</a>-->
            </div>

            <div class="card-body vendor-table">
                
                <table class="table-responsive text-center" id="basic-1">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Date</th>
                            <th>Cut-Off Name</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                                               @foreach($data as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
             <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y') }}</td>
                            <td>{{$item['name']}}</td>
                          
                           <td>{{ \Carbon\Carbon::parse($item->from_date)->format('d-m-Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->to_date)->format('d-m-Y') }}</td>
                            <!--<td>{{$item['todate']}}</td>-->
                            <td style="color: green">{{$item['status']}}</td>
                            
                            @endforeach
                        <!--<tr>-->
                        <!--    <td>25/03/2025</td>-->
                        <!--    <td>2508</td>-->
                        <!--    <td>16/04/2025</td>-->
                        <!--    <td>30/04/2025</td>-->
                        <!--    <td>-->
                        <!--        <div>-->
                        <!--            <i class="fa fa-eye me-2 font-success"></i>-->
                        <!--            <i class="fa fa-edit font-primary"></i>-->
                        <!--        </div>-->
                        <!--    </td>-->
                        <!--</tr>-->
                    </tbody>
                </table>
            </div>
            
            
        </div>
    </div>


</div>
@stop