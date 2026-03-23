@extends('layout.admin')

@section('content')

<style>
    .toggle-switch {
  position: relative;
  display: inline-block;
  width: 50px;
  height: 28px;
}

.toggle-switch input {
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  background-color: #ccc;
  border-radius: 34px;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  transition: 0.4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 22px;
  width: 22px;
  left: 3px;
  bottom: 3px;
  background-color: white;
  border-radius: 50%;
  transition: 0.4s;
}

/* Checked styles */
.toggle-switch input:checked + .slider {
  background-color: #4CAF50;
}

.toggle-switch input:checked + .slider:before {
  transform: translateX(22px);
}

</style>
<div class="page-body">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3>{{ $data->name }} -  Product Edit</h3>
                    </div>
                </div>
                <div class="col-lg-6">
                    
                    <!--                   <div> -->
                    <!--                   <label  for="status_{{$data->id}}" class="toggle-switch">-->
                    <!--<input type="checkbox" class="form-check-input status-toggle" id="status_{{$data->id}}" onclick="changeStatus({{$data->id}})" {{ $data->is_active == 1 ? 'checked' : '' }} />-->
                    <!--<span class="slider"></span>-->
                    <!--</label></div>-->
                    
                    
                    <a href="/" class="btn btn-secondary mt-md-0 mt-2" style="float: right;">Back</a>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <form action="/products-edit/{{$data->id }}" method="POST" enctype="multipart/form-data">
            @csrf
          

            <div class="row">
                <div class="col-md-8">

                 <!-- <div class="row mb-4"> -->
            <div class="col-md-12" style="display:none;">
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
                    <div class="form-group mb-3" style="display:none;">
                        <label>Category</label>
                        <select name="category_id" class="form-control">
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ $data->category_id == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>


                <div class="container-fluid">
                   
                 
                
                
                    <!-- Product Name -->
                    <!--<div class="form-group mb-3">-->
                    <!--    <label>Product Name</label>-->
                    <!--    <input type="text" name="name" class="form-control" value="{{ old('name', $data->name) }}" required>-->
                    <!--</div>-->

                    <!-- Description -->
                    <!--<div class="form-group mb-3">-->
                    <!--    <label>Description</label>-->
                    <!--    <textarea name="description" class="form-control" rows="4">{{ old('description', $data->description) }}</textarea>-->
                    <!--</div>-->

   <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <!--<h4>Add Stock</h4>-->
                                <div class="card-body">
                                    <div class="row product-adding">
                                        
                                        <div class="col-xl-12">
                                            <form class="needs-validation add-product-form" action="/update_stock" method="POST" >
                                              @csrf
                                              
                                              <input type="hidden" name="name" class="form-control" value="{{ $data->name }}">
                                              <input type="hidden" name="description" class="form-control"  value="{{ $data->description }}">
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
                                                            class="col-xl-3 col-sm-4 mb-0">Main Product:</label>
                                                        <div class="col-xl-8 col-sm-7">
                                                            <select class="form-control digits"  id="main_pro" name="main_pro" required="" >
                                                                <option value="0">Select Product</option>
                                                                   @foreach ($products as $item )
                                                             
                                                                <option value="{{$item->id}}" {{ $item->id == $data->main_product ? 'selected' : '' }}>{{$item->name}}</option>
                                                                   @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>    
                                                <div class="form">
                                                    <div class="form-group mb-3 row">
                                                        <label for="validationCustomUsername" class="col-xl-3 col-sm-4 mb-0"> Quantity:</label>
                                                        <div class="col-xl-8 col-sm-7">
                                                            <input class="form-control"  type="number" required="" name="main_qty" placeholder="Enter Quantity">
                                                        </div>
                                                        
                                                    </div>
                                                   <!---Offerr-->
                                                     <div class="form">
                                                    <div class="form-group row">
                                                        <label for="exampleFormControlSelect1"
                                                            class="col-xl-3 col-sm-4 mb-0">Offer Product:</label>
                                                        <div class="col-xl-8 col-sm-7">
                                                            <select class="form-control digits"  id="exampleFormControlSelect1" name="offer_pro" required="">
                                                                <option value="0">Select Product</option>
                                                                   @foreach ($products as $item )
                                                             
                                                                <option value="{{$item->id}}"{{ $item->id == $data->offer_product ? 'selected' : '' }} >{{$item->name}}</option>
                                                                   @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>    
                                                <div class="form">
                                                    <div class="form-group mb-3 row">
                                                        <label for="validationCustomUsername" class="col-xl-3 col-sm-4 mb-0"> Quantity:</label>
                                                        <div class="col-xl-8 col-sm-7">
                                                            <input class="form-control"  type="number" required="" name="offer_qty" placeholder="Enter Quantity">
                                                        </div>
                                                        
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
                                                    
                                                    
                                                    <!--<div class="row">-->
                                                    <!--    <div class="col-6">  -->
                                                    <!--        <div class="form-group mb-3 row">-->
                                                    <!--            <label for="validationCustom02" class="col-xl-3 col-sm-4 mb-0">Mfg Date :</label>-->
                                                    <!--            <div class="col-xl-8 col-sm-7">-->
                                                    <!--                <input class="form-control" id="validationCustom02" type="date" required="" name="mfg_date">-->
                                                    <!--            </div>-->
                                                              
                                                    <!--        </div>-->
                                                    <!--    </div>-->
                                                    <!--    <div class="col-6">  -->
                                                    <!--        <div class="form-group mb-3 row">-->
                                                    <!--            <label for="validationCustom02" class="col-xl-3 col-sm-4 mb-0">Exp Date :</label>-->
                                                    <!--            <div class="col-xl-8 col-sm-7">-->
                                                    <!--                <input class="form-control" id="validationCustom02" type="date" required="" name="exp_date">-->
                                                    <!--            </div>-->
                                                              
                                                    <!--        </div>-->
                                                    <!--    </div>-->
                                                    <!--</div>-->
                                                 
                                                    
                                                 
                                                    
                                                </div>
                                                <!--<button type="submit" class="btn btn-primary">Update Stock</button>-->
                                            </form>
                                        </div>
                                    </div>
                                    
                                     <div class="row">
                        <div class="col-md-6 mb-3">
                            
                                        <!-- Main Image -->
                                    <div class="form-group mb-3">
                                    <label>Main Image</label><br>
                                    @if($data->image_url)
                                        <!-- <img src="{{ asset('storage/'.$data->image_url) }}" width="120" class="mb-2 rounded border"> -->
                                         <img src="{{ asset('storage/app/public/'.$data->image_url) }}" width="220" alt="{{ $data->image_url }}" class="mb-2 rounded border">
            
                                    @endif
                                    <input type="file" name="main_image" class="form-control mt-2">
                                    </div>
                        </div>
                        <div class="col-md-6 mb-3">
                                           <!-- Banner Image -->
                                <div class="form-group mb-3">
                                    <label>Banner Image</label><br>
                                    @if($data->cover_img)
                                        <!-- <img src="{{ asset('storage/'.$data->image_url) }}" width="120" class="mb-2 rounded border"> -->
                                         <img src="{{ asset('storage/app/public/'.$data->cover_img) }}" width="220" alt="{{ $data->cover_img }}" class="mb-2 rounded border">
            
                                    @endif
                                    <input type="file" name="cover_img" class="form-control mt-2">
                                </div>
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                   

                    <!-- Stock Quantity -->
                    <!-- <div class="form-group mb-3">
                        <label>Quantity</label>
                        <input type="number" name="quantity" class="form-control" value="{{ old('quantity', $data->stock->quantity ?? 0) }}">
                    </div> -->

                  

                   

                </div>
      <!--<div class="row">-->
      <!--      <div class="col-md-6 mb-3">-->
      <!--          <label for="HSN">HSN:</label>-->
      <!--          <input type="number" name="HSN"  class="form-control"  value="{{ old('HSN', $data->HSN) }}">-->
      <!--      </div>-->
      <!--      <div class="col-md-6 mb-3">-->
      <!--          <label for="CGST">CGST:</label>-->
      <!--          <input type="number" name="CGST"  class="form-control" value="{{ old('CGST', $data->CGST) }}">-->
      <!--      </div>-->
      <!--       </div>-->
      <!--         <div class="row">-->
      <!--      <div class="col-md-6 mt-3">-->
      <!--          <label for="SGST">SGST:</label>-->
      <!--          <input type="number" name="SGST"  class="form-control">-->
      <!--      </div>-->
            
      <!--       <div class="col-md-6 mt-3">-->
      <!--          <label for="TAX">TAX %:</label>-->
      <!--          <input type="number" name="TAX"  class="form-control">-->
      <!--      </div>-->
      <!--       </div>-->
      <!--          <div class="col-md-4">-->


                    

                     <!-- Status -->
      <!--              <div class="form-group mb-3">-->
      <!--                  <label>Status</label>-->
      <!--                  <select name="is_active" class="form-control">-->
      <!--                      <option value="1" {{ $data->is_active ? 'selected' : '' }}>Active</option>-->
      <!--                      <option value="0" {{ !$data->is_active ? 'selected' : '' }}>Inactive</option>-->
      <!--                  </select>-->
      <!--              </div>-->
      <!--          </div>-->
      <!--      </div>-->

            <button type="submit" class="btn btn-primary">Update Product</button>
        </form>
    </div>
</div>
<script>
function changeStatus(id) {
    var checkbox = document.getElementById('status_' + id);
    var status = checkbox.checked ? '1' : '0';

    var url = `/products/${id}/change-status`;

    fetch(url, {
        method: 'PATCH',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ status: status })
    })
    .then(response => response.json())
    .then(data => {
        console.log(data);
        //console.log(data.message);
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

</script>
@endsection
