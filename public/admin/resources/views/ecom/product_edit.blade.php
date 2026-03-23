@extends('layout.admin')

@section('content')
<div class="page-body">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3>Edit Product</h3>
                    </div>
                </div>
                <div class="col-lg-6">
                    <a href="{{ route('products.index') }}" class="btn btn-secondary mt-md-0 mt-2" style="float: right;">Back</a>
                </div>
            </div>
        </div>
   

      <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-body">
                        
                                      
                                       <div class="container">
        <form action="{{ route('products.update', $data->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-8">

                 <!-- <div class="row mb-4"> -->
            <div class="col-md-12">
                <label for="name">Product Type:</label>
             <select name="producttype" class="form-control">
                 <option value="product" {{ $data->producttype == 'product' ? 'selected' : '' }}>All Premium Products</option>
                 <option value="business" {{ $data->producttype == 'business' ? 'selected' : '' }}>Business Tools</option>
                 <!--<option value="flashsale">Flash Sale</option>-->
                 <!--<option value="DOD">Deals of The Day</option>-->
                  <!-- <option value="business">Business Tools</option> -->
                 
                
            </select>     
            </div>
        <!-- </div> -->

         <!-- Category -->
                    <div class="form-group mb-3">
                        <label>Category</label>
                        <select name="category_id" class="form-control">
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ $data->category_id == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Product Name -->
                    <div class="form-group mb-3">
                        <label>Product Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $data->name) }}" required>
                    </div>

                    <!-- Description -->
                    <div class="form-group mb-3">
                        <label>Description</label>
                        <textarea name="description" class="form-control" rows="4">{{ old('description', $data->description) }}</textarea>
                    </div>

                    <!-- Price / MRP -->
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Price</label>
                            <input type="number" name="price" class="form-control" step="0.01" value="{{ old('price', $data->price) }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>MRP</label>
                            <input type="number" name="mrp" class="form-control" step="0.01" value="{{ old('mrp', $data->mrp) }}">
                        </div>
                    </div>

                    <!-- PV and Tag -->
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>PV</label>
                            <input type="number" name="pv" class="form-control" value="{{ old('pv', $data->pv) }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Tag</label>
                            <input type="text" name="tag" class="form-control" value="{{ old('tag', $data->tag) }}">
                        </div>
                    </div>

                    <!-- Stock Quantity -->
                    <!-- <div class="form-group mb-3">
                        <label>Quantity</label>
                        <input type="number" name="quantity" class="form-control" value="{{ old('quantity', $data->stock->quantity ?? 0) }}">
                    </div> -->

                  

                   

                </div>
      <div class="row">
            <div class="col-md-6 mb-3">
                <label for="HSN">HSN:</label>
                <input type="number" name="HSN"  class="form-control"  value="{{ old('HSN', $data->HSN) }}">
            </div>
            <div class="col-md-6 mb-3">
                <label for="CGST">CGST:</label>
                <input type="number" name="CGST"  class="form-control" value="{{ old('CGST', $data->CGST) }}">
            </div>
             </div>
               <div class="row">
            <div class="col-md-6 mt-3">
                <label for="SGST">SGST:</label>
                <input type="number" name="SGST"  class="form-control" value="{{ old('SGST', $data->SGST) }}">
            </div>
            
             <div class="col-md-6 mt-3">
                <label for="TAX">TAX %:</label>
                <input type="number" name="TAX"  class="form-control" value="{{ old('TAX', $data->TAX) }}">
            </div>
             </div>
              <div class="col-md-6 mt-3">
                <label for="dc">Delivery Charges:</label>
                <input type="number" name="dc"  id="dc" class="form-control" value="{{ old('dc', $data->dc) }}">
            </div>
            
              <div class="col-md-6 mt-3">
                <label for="discount">Discount (Inactive User):</label>
                <input type="number" name="discount"  id="discount" class="form-control" value="{{ old('discount', $data->discount) }}">
            </div>
            <div class="row">
                <div class="col-md-4">

                    <!-- Main Image -->
                    <div class="form-group mb-3">
                        <label>Main Image</label><br>
                        @if($data->image_url)
                            <!-- <img src="{{ asset('storage/'.$data->image_url) }}" width="120" class="mb-2 rounded border"> -->
                             <img src="{{ asset('storage/app/public/'.$data->image_url) }}" width="120" alt="{{ $data->image_url }}" class="mb-2 rounded border">

                        @endif
                        <input type="file" name="main_image" class="form-control mt-2">
                    </div>
                    
                    
                    </div>
 <div class="col-md-4">
                    <!-- Gallery Images -->
                    <div class="form-group mb-3">
                        <label>Gallery Images</label><br>
                        @if($data->galleries && $data->galleries->count())
                            <div class="d-flex flex-wrap gap-2 mb-2">
                                @foreach($data->galleries as $gallery)
                                    <div class="position-relative">
                                        <img src="{{ asset('storage/'.$gallery->image_url) }}" width="100" class="rounded border mb-1">
                                        
                                    </div>
                                @endforeach
                            </div>
                        @endif
                        <input type="file" name="images[]" class="form-control" multiple>
                    </div>
                    
                    </div>
                        </div>
                     <div class="col-md-4">

                    <!-- Main Image -->
                    <div class="form-group mb-3">
                        <label>Banner Image</label><br>
                        @if($data->image_url)
                            <!-- <img src="{{ asset('storage/'.$data->image_url) }}" width="120" class="mb-2 rounded border"> -->
                             <img src="{{ asset('storage/app/public/'.$data->cover_img) }}" width="120" alt="{{ $data->cover_img }}" class="mb-2 rounded border">

                        @endif
                        <input type="file" name="cover_img" class="form-control mt-2">
                    </div>
                    
                    </div>
                    

                     <!-- Status -->
                    <div class="form-group mb-3">
                        <label>Status</label>
                        <select name="is_active" class="form-control">
                            <option value="1" {{ $data->is_active ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ !$data->is_active ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Update Product</button>
        </form>
    </div>
</div>
    </div>
</div>

 </div>
  </div>
@endsection
