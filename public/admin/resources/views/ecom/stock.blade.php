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
        

        <div class="row">

            @foreach ($data as $item )

            <div class="col-xxl-3 col-md-6 xl-50">
                <div class="card" style="border: 1px solid;">
                    <div class="success-box card-body">
                        <div class="media static-top-widget align-items-center">
                            
                            <div class="media-body media-doller">
                                <span class="m-0">{{$item->product_name}}</span>
                                  <h5>Total : {{$item->total_stock}}</h5>
                                <h3 class="mb-0" style="color: #000000">
                                    In-Stock:<span class="counter">{{$item->available_qty}}</span><small></small>
                                </h3>
                              
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @endforeach
          
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
                                            <form class="needs-validation add-product-form" action="/update_stock" method="POST" >
                                              @csrf
                                              @session('message')
                                              <div class="alert alert-success">
                                                  {{session('message')}} </div>
                                              @endsession
                                              @session('error')
                                              <div class="alert alert-danger">
                                                  {{session('error')}} </div>      @endsession            
                                                <div class="form">
                                                    <div class="form-group row">
                                                        <label for="exampleFormControlSelect1"
                                                            class="col-xl-3 col-sm-4 mb-0">Select Product:</label>
                                                        <div class="col-xl-8 col-sm-7">
                                                            <select class="form-control digits"  id="exampleFormControlSelect1" name="product_id" required="">
                                                                <option value="0">Select Product</option>
                                                                   @foreach ($products as $item )
                                                             
                                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                                                   @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>    
                                                <div class="form">
                                                    <div class="form-group mb-3 row">
                                                        <label for="validationCustomUsername" class="col-xl-3 col-sm-4 mb-0">Total Quantity:</label>
                                                        <div class="col-xl-8 col-sm-7">
                                                            <input class="form-control"  type="number" required="" name="quantity" placeholder="Enter Quantity">
                                                        </div>
                                                        
                                                    </div>
                                                    <div class="form-group mb-3 row">
                                                        <label for="validationCustom01" class="col-xl-3 col-sm-4 mb-0">Mfg Name:</label>
                                                        <div class="col-xl-8 col-sm-7"> 
                                                            <input class="form-control" id="validationCustom01" name="mfg_name" type="text" required="">
                                                        </div>
                                                      
                                                    </div>
                                                    
                                                    
                                                    <div class="row">
                                                        <div class="col-6">  
                                                            <div class="form-group mb-3 row">
                                                                <label for="validationCustom02" class="col-xl-3 col-sm-4 mb-0">Mfg Date :</label>
                                                                <div class="col-xl-8 col-sm-7">
                                                                    <input class="form-control" id="validationCustom02" type="date" required="" name="mfg_date">
                                                                </div>
                                                              
                                                            </div>
                                                        </div>
                                                        <div class="col-6">  
                                                            <div class="form-group mb-3 row">
                                                                <label for="validationCustom02" class="col-xl-3 col-sm-4 mb-0">Exp Date :</label>
                                                                <div class="col-xl-8 col-sm-7">
                                                                    <input class="form-control" id="validationCustom02" type="date" required="" name="exp_date">
                                                                </div>
                                                              
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-6">  
                                                            <div class="form-group mb-3 row">
                                                                <label for="validationCustom02" class="col-xl-3 col-sm-4 mb-0">Batch No :</label>
                                                                <div class="col-xl-8 col-sm-7">
                                                                    <input class="form-control" id="validationCustom02" type="text" required="" name="batch_no">
                                                                </div>
                                                              
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
                                                <button type="submit" class="btn btn-primary">Update Stock</button>
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
                {{-- <a href="#" class="btn btn-primary mt-md-0 mt-2">Download Report</a> --}}
            </div>
          @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif


            <div class="card-body vendor-table">                
                <table class="table-responsive text-center" id="basic-1">
                    <thead>
                        <tr>
                            <th>Date</th>
                            {{-- <th>Category</th> --}}
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
                    @foreach ($stocks_list as $item )
                        <tr>
                        <td>{{$item->created_at}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->quantity}}</td>
                        <td>{{ $item->mfg_name}}</td>
                        <td>{{ $item->mfg_date}}</td>
                        <td>{{ $item->exp_date}}</td>
                        <td>{{ $item->batch_no}}</td>   
                         <td>
                                <div class="d-flex">
                                    {{-- <a href="/edit_product/{{$item->id}}" class="btn btn-primary me-2">Edit</a> --}}
                                    <form action="/delete_stock/{{$item->id}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
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