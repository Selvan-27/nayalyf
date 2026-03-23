@extends('layout.admin') @section('content')
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
    </div>

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row product-adding">
                                        
                                        <div class="col-xl-12">
                                            <form class="needs-validation add-product-form" novalidate="">
                                                <div class="form">
                                                    <div class="form-group row">
                                                        <label for="exampleFormControlSelect1"
                                                            class="col-xl-3 col-sm-4 mb-0">Select Category:</label>
                                                        <div class="col-xl-8 col-sm-7">
                                                            <select class="form-control digits"
                                                                id="exampleFormControlSelect1">
                                                                <option>UCWC</option>
                                                                <option>OFFER</option>
                                                                
                                                            </select>
                                                        </div>
                                                    </div>
                                                    
                                                </div>    
                                                <div class="form">
                                                    <div class="form-group mb-3 row">
                                                        <label for="validationCustomUsername" class="col-xl-3 col-sm-4 mb-0">Product Code :</label>
                                                        <div class="col-xl-8 col-sm-7">
                                                            <input class="form-control" id="validationCustomUsername" type="text" required="">
                                                        </div>
                                                        <div class="invalid-feedback offset-sm-4 offset-xl-3">Please choose Valid Code.</div>
                                                    </div>
                                                    <div class="form-group mb-3 row">
                                                        <label for="validationCustom01" class="col-xl-3 col-sm-4 mb-0">Name :</label>
                                                        <div class="col-xl-8 col-sm-7"> 
                                                            <input class="form-control" id="validationCustom01" type="text" required="">
                                                        </div>
                                                        <div class="valid-feedback">Looks good!</div>
                                                    </div>
                                                    
                                                    <div class="form-group mb-3 row">
                                                        <label for="validationCustom01" class="col-xl-3 col-sm-4 mb-0">Quantity :</label>
                                                        <div class="col-xl-8 col-sm-7"> 
                                                            <input class="form-control" id="validationCustom01" type="text" required="">
                                                        </div>
                                                        <div class="valid-feedback">Looks good!</div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-6">  
                                                            <div class="form-group mb-3 row">
                                                                <label for="validationCustom02" class="col-xl-3 col-sm-4 mb-0">Distributor Price (DP):</label>
                                                                <div class="col-xl-8 col-sm-7">
                                                                    <input class="form-control" id="validationCustom02" type="text" required="">
                                                                </div>
                                                                <div class="valid-feedback">Looks good!</div>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">  
                                                            <div class="form-group mb-3 row">
                                                                <label for="validationCustom02" class="col-xl-3 col-sm-4 mb-0">Retail Price (MRP):</label>
                                                                <div class="col-xl-8 col-sm-7">
                                                                    <input class="form-control" id="validationCustom02" type="text" required="">
                                                                </div>
                                                                <div class="valid-feedback">Looks good!</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-6">  
                                                            <div class="form-group mb-3 row">
                                                                <label for="validationCustom02" class="col-xl-3 col-sm-4 mb-0">Net Profit (NP):</label>
                                                                <div class="col-xl-8 col-sm-7">
                                                                    <input class="form-control" id="validationCustom02" type="text" required="">
                                                                </div>
                                                                <div class="valid-feedback">Looks good!</div>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">  
                                                            <div class="form-group mb-3 row">
                                                                <label for="validationCustom02" class="col-xl-3 col-sm-4 mb-0">Re-Purchase Value (RP) :</label>
                                                                <div class="col-xl-8 col-sm-7">
                                                                    <input class="form-control" id="validationCustom02" type="text" required="">
                                                                </div>
                                                                <div class="valid-feedback">Looks good!</div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    
                                                    
                                                    <div class="form-group row">
                                                        <label class="col-xl-3 col-sm-4">Add Description :</label>
                                                        <div class="col-xl-8 col-sm-7 description-sm">
                                                            <textarea id="editor1" name="editor1" cols="10" rows="4"></textarea>
                                                        </div>
                                                        <div class="offset-xl-3 offset-sm-4 mt-4">
                                                            
                                                            <button type="button" class="btn btn-dark">Upload Banner<br><small>(jpeg/png 1500x788)</small></button>
                                                            <button type="button" class="btn btn-dark">Upload Product Image<br><small>(jpeg/png 390x334)</small></button>
                                                            <button type="button" class="btn btn-dark">Upload Home Image<br><small>(jpeg/png 80x100)</small></button>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                                <button type="submit" class="btn btn-primary">Add Product</button>
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
                <a href="#" class="btn btn-primary mt-md-0 mt-2">Download Report</a>
            </div>

            <div class="card-body vendor-table">
                
                <table class="table-responsive text-center" id="basic-1">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Category</th>
                            <th>P.Code</th>
                            <th>P.Name</th>
                            <th>Quantity</th>
                            <th>DP</th>
                            <th>MRP</th>
                            <th>Profit</th>
                            <th>RV</th>
                            
                            <th>Description</th>
                            <th>Banner Image</th>
                            <th>Product Image</th>
                            <th>Home Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>25/03/2025</td>
                            <td>UCWC</td>
                            <td>UC01</td>
                            <td>UC Antioxidant Juice</td>
                            <td>500 ml</td>
                            <td>₹ 1249</td>
                            <td>₹ 1650</td>
                            <td>₹ 401</td>
                            <td>600</td>
                            
                            <td>UC Super Antioxidant Juice, Food Suppliment</td>
                            <td>
                                <div>
                                    <i class="fa fa-eye me-2 font-success"></i>
                                    <i class="fa fa-edit font-primary"></i>
                                </div>
                            </td>
                            <td>
                                <div>
                                    <i class="fa fa-eye me-2 font-success"></i>
                                    <i class="fa fa-edit font-primary"></i>
                                </div>
                            </td>
                            <td>
                                <div>
                                    <i class="fa fa-eye me-2 font-success"></i>
                                    <i class="fa fa-edit font-primary"></i>
                                </div>
                            </td>
                            <td>
                                <div>
                                    <i class="fa fa-eye me-2 font-success"></i>
                                    <i class="fa fa-edit font-primary"></i>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            
        </div>
    </div>


</div>
<script>
function changestatus(id) {
    var checkbox = document.getElementById('status_' + id);
    var status = checkbox.checked ? 'on' : 'off';
    var url = "/admin/sliderstatus/" + id;

    console.log('Changing status:', status); // Debugging

    $.ajax({
        url: url,
        type: 'POST',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'), // Fetch CSRF token from meta tag
            status: status
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Laravel requires this
        },
        success: function(response) {
            console.log('Success:', response);
        },
        error: function(xhr) {
            console.error('Error:', xhr.responseText);
        }
    });
}
</script>
@stop