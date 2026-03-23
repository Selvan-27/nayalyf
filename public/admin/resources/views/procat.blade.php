@extends('layout.admin') @section('content')
<div class="page-body">
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3> Add New Category</h3>
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
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row product-adding">
                                        
                                        <div class="col-xl-12">
                                            <!--<form class="needs-validation add-product-form" novalidate="">-->
                                                  <form action="{{ route('categories.store') }}" method="POST"  enctype="multipart/form-data">
        @csrf  
                                                <div class="form">
                                                    <div class="form-group mb-3 row">
                                                        <label for="validationCustomUsername" class="col-xl-3 col-sm-4 mb-0">Category Name :</label>
                                                        <div class="col-xl-8 col-sm-7">
                                                            <input class="form-control" name="name" type="text" required="">
                                                        </div>
                                                       
                                                    </div>
                                                     <div class="form-group mb-3 row">
                                                        <label for="validationCustomUsername" class="col-xl-3 col-sm-4 mb-0">Category Image :</label>
                                                        <div class="col-xl-8 col-sm-7">
                                                            <input class="form-control" name="image" type="file" required="">
                                                        </div>
                                                       
                                                       
                                                       
                                                    </div>
                                                    
                                                </div>
                                                <button type="submit" class="btn btn-primary">Add Category</button>
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
            <!--<div class="card-header">-->
            <!--    <a href="#" class="btn btn-primary mt-md-0 mt-2">Download Report</a>-->
            <!--</div>-->

            <div class="card-body vendor-table">
                
                <table class="table-responsive text-center" id="basic-1">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Category Name</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                         @foreach($data as $category)
            <tr>
                 <td>{{ $category->created_at->format('d-m-Y') }}</td>
               
 <td>{{ $category->name; }}</td>
                <td> <img src="{{ asset('storage/app/public/' . $category->image) }}" alt="Category Image" width="80"> </td>
                <td>
                    <a  class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#myModal{{$category->id}}" > <i class="fa fa-eye me-2 font-success"></i>Edit</a>
                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this category?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">  <i class="fa fa-edit font-primary"></i> Delete</button>
                    </form>
                </td>
            </tr>
                <div class="modal" id="myModal{{$category->id}}">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Modal Heading</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
       <form action="{{ route('categories.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" value="{{ $category->name }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control">{{ $category->description }}</textarea>
        </div>

        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" name="is_active" value="1" {{ $category->is_active ? 'checked' : '' }}>
            <label class="form-check-label">Active</label>
        </div>

       
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Update</button>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>
  </form>
            
    </div>
  </div>
</div>
            @endforeach
                    </tbody>
                </table>
            </div>
            
        
             
        </div>
    </div>


</div>
@stop