@extends('layout.admin') @section('content')
<div class="page-body">
        
                          
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3> {{request('mode')}} - products Dates</h3>
                    </div>
                </div>
                <div class="col-lg-6">
                  <div class="btn-group btn-group-lg" style="float: right;">
                          <a type="button" class="btn btn-info text-white" href="cutoff_dates?mode=cutoff">Cut-Off</a>
                          <a type="button" class="btn btn-info text-white" href="cutoff_dates?mode=flashsale">Flash Sale</a>
                          
                    
                          </div>
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
                                            <form class="needs-validation add-product-form" method="post" action="/cutoff_products_dates_insert">
                                                   @csrf
                                                <div class="form">
                                               <input type="hidden" name="mode" value="{{ request('mode')=="cutoff" ? 'cutoff' : 'flashsale'}}">
                                                    <div class="form-group mb-3 row">   
                                                        <div class="col-6">
                                                            <label for="cutoffstart">Start Date :</label>
                                                            <input class="form-control" name="cutoffstart" type="date" required="">
                                                        </div>
                                                        @if(request('mode')=="cutoff")
                                                        
                                                        <div class="col-6">
                                                            <label for="cutoffend">End Date :</label>
                                                            <input class="form-control" name="cutoffend" type="date" required="">
                                                        </div>
                                                        
                                                        
                                                        @endif    
                                                    </div>
                                                   
                                                    
                                                </div>
                                                <button type="submit" class="btn btn-primary"> submit</button>
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
                
                <table class="table-responsive text-center" id="basic-1">
                    <thead>
                        <tr>
                            <th>#</th>
                           
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                                               @foreach($data as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
       
                            <!--<td>{{$item['name']}}</td>-->
                          
                           <td>{{ \Carbon\Carbon::parse($item->from_date)->format('d-m-Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->to_date)->format('d-m-Y') }}</td>
                            <!--<td>{{$item['todate']}}</td>-->
                            <td>
                                <form method="POST" action="/cutoff_products_dates_delete/{{ $item->id }}">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this cutoff date?');">Delete</button>
                                </form>
                            </td>
            </tr>
                            
                            @endforeach
                      
                    </tbody>
                </table>
            </div>
            
            
        </div>
    </div>


</div>
@stop