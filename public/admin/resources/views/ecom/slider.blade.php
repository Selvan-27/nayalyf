@extends('layout.admin') @section('content')

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
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3> slider  List </h3>
                    </div>
                </div>
                <div class="col-lg-6">
                    <ol class="breadcrumb pull-right">
                        <li class="breadcrumb-item">
                            <a href="/admin_home">
                                <i data-feather="home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active">sliders</li>
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
                                            <!--<form class="needs-validation add-product-form" novalidate="">-->
                                                  <form action="{{ route('sliders.store') }}" method="POST" enctype="multipart/form-data">
        @csrf  
                                                <div class="form">
                                                    <div class="form-group mb-3 row">
                                                        <label for="validationCustomUsername" class="col-xl-3 col-sm-4 mb-0">Image (Size 1500X788):</label>
                                                        <div class="col-xl-8 col-sm-7">
                                                            <input class="form-control" name="image_url" type="file" required="">
                                                        </div>
                                                       
                                                    </div>
                                                      <div class="form-group mb-3 row">
                                                        <label for="validationCustomUsername" class="col-xl-3 col-sm-4 mb-0">alt text :</label>
                                                        <div class="col-xl-8 col-sm-7">
                                                            <input class="form-control" name="alt_text" type="text" required="">
                                                        </div>
                                                       
                                                    </div>
                                                   
                                                    
                                                </div>
                                                <button type="submit" class="btn btn-primary">submit</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    <div class="container-fluid">

                    
                    
                    <table class="table table-bordered mt-4">
                    <thead class="table-dark">
                    <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Status</th>
                    <th>Created</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($data as $product)
                    <tr>
                    <td>{{ $product->id }}</td>
                    <td>
                    @if($product->image_url)
                    <img src="https://admin.uniqconnectwc.com/storage/app/public/{{$product->image_url }}" alt="Image" width="50">
                    @else
                    N/A
                    @endif
                    </td>
                    <td>
                    <span class="badge bg-{{ $product->is_active ? 'success' : 'danger' }}">
                    {{ $product->is_active ? 'Active' : 'Inactive' }}
                    </span>
                    </td>
                    <td>  <label  for="status_{{$product->id}}" class="toggle-switch">
                    <input type="checkbox" class="form-check-input status-toggle" id="status_{{$product->id}}" onclick="changeStatus({{$product->id}})" {{ $product->is_active == 1 ? 'checked' : '' }} />
                    <span class="slider"></span>
                    </label></td>
                    
                    <td>{{ $product->created_at->format('Y-m-d') }}</td>
                    <td>
                                            <!--<a href="javascript:void(0);" class="btn btn-sm btn-info editSliderBtn"-->
                                            <!--   data-id="{{$product->id}}" data-name="{{$product->image_url}}" data-image="{{ asset($product->image_url) }}"-->
                                            <!--   data-bs-toggle="modal" data-bs-target="#editSliderModal">-->
                                            <!--    <i class="far fa-edit"></i>-->
                                            <!--</a>-->
                                            <a onclick="delete_btn('{{$product->id}}')" class="btn btn-sm btn-info editSliderBtn"
                                               >
                                                <i class="far fa-edit"></i>
                                            </a>
                                            </td>
                    </tr>
                    @empty
                    <tr>
                    <td colspan="10" class="text-center">No Sliders found.</td>
                    </tr>
                   
                    @endforelse
                    </tbody>
                    </table>
                    
                 
                  </div>
   
	
		</div>
</div>

<script>
    
    function delete_btn(sliderId) {
        // alert(sliderId);
    $.ajax({
    url: '/sliders/' + sliderId,
    type: 'DELETE',
    data: {
        _token: '{{ csrf_token() }}'
    },
    success: function(response) {
        alert("Deleted successfully");
        location.reload();
    }
});

}
</script>
<script>
 


   $(document).ready(function () {
    // When the edit button is clicked, populate the modal with the category data
    $('.editSliderBtn').click(function () {
        var categoryId = $(this).data('id');  // Get the ID from the clicked button
        var categoryName = $(this).data('name');  // Get the name from the clicked button
        var categoryImage = $(this).data('image');  // Get the image URL from the clicked button

        // Set the form's action URL to include the category ID
        var formAction = "/sliders/" + categoryId;
        $('#editCategoryForm').attr('action', formAction);

        // Set the category ID in the hidden input
        $('#category_id').val(categoryId);

        // Set the category name in the input field
        $('#category_name').val(categoryName);

        // Update the image preview (if the image exists)
        if (categoryImage) {
            $('#preview_image').attr('src', categoryImage);
        } else {
            $('#preview_image').attr('src', '/images/default-image.jpg');  // Default image if none exists
        }
    });
});



$(document).ready(function () {
    $('.delete-btn').click(function () {
        var productId = $(this).data('id'); // Get the product ID from the clicked button
        var deleteUrl = "/admin/adv_slider_delete/" + productId; // Construct the delete URL

        $('#confirmDelete').attr('href', deleteUrl); // Set the correct URL in the modal
    });
});


function changeStatus(id) {
    var checkbox = document.getElementById('status_' + id);
    var status = checkbox.checked ? '1' : '0';

    var url = `/sliders/${id}/change-status`;

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
        console.log(data.message);
    })
    .catch(error => {
        console.error('Error:', error);
    });
}


function changestatus0(id) {
        // Get the checkbox element
        var checkbox = document.getElementById('status_' + id);
        var status = checkbox.checked ? 'on' : 'off';   
        
        var url = `/products/${id}/StatusUpdate`;
        console.log('Changing status:', status); 
        // Send AJAX request to update the product status
        $.ajax({
            url: url, // The route to handle the status change
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}', // CSRF token for security
                product_id: id, // Product ID
                status: status // New status ('on' or 'off')
            },
            success: function(response) {
                if (response.success) {
                    // Optionally display a success message or change the UI
                    console.log('Status updated successfully');
                } else {
                    // If something went wrong, revert the checkbox state
                    checkbox.checked = !checkbox.checked;
                    alert('Failed to update status');
                }
            },
            error: function(xhr, status, error) {
                // Handle any errors that occur during the request
                checkbox.checked = !checkbox.checked; // Revert checkbox state
                alert('Error updating status');
            }
        });
    }


</script>
@stop