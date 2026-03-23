@extends('layout.admin') @section('content')
<style>
    h5{
        color: grey;
        background-color:orange ;
    }
</style>

  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-bs4.min.css" rel="stylesheet">



<div class="page-body">
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3> Add New Product</h3>
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


               
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-body">
                        
                                      
                                       <div class="container">
   {{-- Flash Messages --}}
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

@if ($errors->any())
    <div class="alert alert-warning">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <form action="{{ route('products.store') }}" method="POST" class="needs-validation add-product-form" enctype="multipart/form-data">
        @csrf

        {{-- Product Info Section --}}
        <h5 class="mt-4">📝 Product Information</h5>
          <div class="row mb-4">
            <div class="col-md-12">
                <label for="name">Product Type:</label>
             <select name="producttype" class="form-control">
                 <option value="products">All Premium Products</option>
                 <!--<option value="flashsale">Flash Sale</option>-->
                 <!--<option value="DOD">Deals of The Day</option>-->
                  <option value="business">Business Tools</option>
                 
                
            </select>     
            </div>
        </div>
            
        <div class="row mt-3">
            <div class="col-md-6">
                <label for="name">Product Name:</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label for="tag">span:</label>
                <input type="text" name="tag" class="form-control">
            </div>
            <div class="col-md-12 mt-3">
                <label for="description">Description:</label>
                  <div id="summernote"></div>
                <textarea name="description" class="form-control" id="summernote" rows="8" required> </textarea>
                 <textarea id="summernote">Hello <b>Summernote</b>!</textarea>
            </div>
            <div class="col-md-4 mt-3">
                <label for="price">Price:</label>
                <input type="number" name="price" step="0.01" class="form-control" required>
            </div>
            <div class="col-md-4 mt-3">
                <label for="mrp">MRP:</label>
                <input type="number" name="mrp" step="0.01" class="form-control">
            </div>
            <div class="col-md-4 mt-3">
                <label for="pv">PV:</label>
                <input type="number" name="pv" step="0.01" class="form-control">
            </div>
            <!--//------------------------->
            
            
            <div class="col-md-3 mt-3">
                <label for="HSN">HSN:</label>
                <input type="number" name="HSN"  class="form-control" required>
            </div>
            <div class="col-md-3 mt-3">
                <label for="CGST">CGST:</label>
                <input type="number" name="CGST"  class="form-control">
            </div>
            <div class="col-md-3 mt-3">
                <label for="SGST">SGST:</label>
                <input type="number" name="SGST"  class="form-control">
            </div>
            
             <div class="col-md-3 mt-3">
                <label for="TAX">TAX %:</label>
                <input type="number" name="TAX"  class="form-control">
            </div>
            <!----------------------------------->
           <div class="col-md-6 mt-3">
                <label for="category_id">Discount:</label>
              
                   <input type="number" id="discount" name="discount" class="form-control" >
                 
            </div>
              <div class="col-md-6 mt-3">
                <label for="dc">Delivery Charges:</label>
                <input type="number" name="dc"  id="dc" class="form-control">
            </div>
            <div class="col-md-6 mt-3">
                <label for="is_active">Status:</label>
                <select name="is_active" class="form-control">
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
            </div>
              <div class="col-md-6 mt-3">
                <label for="category_id">Category:</label>
              
                   <select name="category_id" class="form-control">
                @foreach(@$categories as $item)
                 <option value="{{$item->id}}">{{$item->name}}</option>
                 @endforeach
            </select> 
               
            </div>
        </div>


        {{-- Image Upload Section --}}
        <h5 class="mt-5">🖼️ Product Images</h5>
        <div class="row">
            <div class="col-md-6">
                <label for="main_image">Main Image:</label>
                <input type="file" name="main_image" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label for="images">Other Images:</label>
                <input type="file" name="images[]" class="form-control" multiple>
            </div>
             <div class="offset-xl-3 offset-sm-4 mt-4">
                        
                        <button type="button" class="btn btn-dark">Upload Banner<br><small>(jpeg/png 1500x788)</small></button>
                        <button type="button" class="btn btn-dark">Upload Product Image<br><small>(jpeg/png 390x334)</small></button>
                        <button type="button" class="btn btn-dark">Upload Home Image<br><small>(jpeg/png 80x100)</small></button>
                                                        </div>
        </div>

        {{-- Stock Section --}}
        <!--<h5 class="mt-5">📦 Stock Details</h5>-->
        <!--<div class="row">-->
        <!--    <div class="col-md-4">-->
        <!--        <label for="quantity">Stock Quantity:</label>-->
        <!--        <input type="number" name="quantity" class="form-control" required>-->
        <!--    </div>-->
        <!--</div>-->
        <!--        <div class="row mt-3">-->
        <!--        <div class="col-md-6">-->
        <!--            <label for="main_image">PKD Date:</label>-->
        <!--            <input type="date" name="pkd_date" class="form-control" required>-->
        <!--        </div>-->
        <!--        <div class="col-md-6">-->
        <!--            <label for="images">Expiry Date:</label>-->
        <!--            <input type="date" name="expiry_date" class="form-control" required>-->
        <!--        </div>-->
        <!--    </div>-->

        {{-- Submit Button --}}
        <div class="row mt-4">
            <div class="col-md-12">
                
                                                <button type="submit" class="btn btn-primary w-100">Add Product</button>
                <!--<button type="submit" class="btn btn-primary">Create Product</button>-->
            </div>
        </div>
    </form>
</div>

                                     
                                </div>
                            </div>
                        </div>
                    </div>
               

               
      
 <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

  <!-- Bootstrap JS -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

  <!-- Summernote JS -->
  <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-bs4.min.js"></script>


 <script>
    $(document).ready(function () {
      $('#summernote').summernote({
        placeholder: 'Start typing here...',
        height: 200,
        toolbar: [
          ['style', ['bold', 'italic', 'underline']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['insert', ['link', 'picture']],
          ['view', ['codeview']]
        ]
      });
    });
  </script>
  


</div></div>

@stop