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
                        <h3>Product List</h3>
                    </div>
                </div>
                <div class="col-lg-6"> 
                            <a href="/products/create" class="btn btn-primary mt-md-0 mt-2" style="float: right;">New Product</a>
                    <!--<ol class="breadcrumb pull-right">-->
                    <!--    <li class="breadcrumb-item">-->
                    <!--        <a href="/admin_home">-->
                    <!--            <i data-feather="home"></i>-->
                    <!--        </a>-->
                    <!--    </li>-->
                    <!--    <li class="breadcrumb-item active">Product List</li>-->
                    <!--</ol>-->
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
<!--        <div class="row">-->
            
<!--               @foreach($data as $item)-->
          
<!--            <div class="col-xl-4">-->
<!--                <div class="card">-->
<!--                    <div class="card-header">-->
<!--                         <a href="#">-->
<!--                                                <img class="avatar-img rounded me-2" src=" {{asset($item->image_url)}}" alt="{{$item->image_url}}" width="50" height="50">-->
<!--                                            </a>-->
<!--                    </div>-->
<!--                    <div class="card-body">-->
<!--                  {{ $item->name }}-->
                         
<!--                          <P>{{ $item->description }}-->
<!--                  </P><b>Rs.{{ $item->price }}</b><del>{{ $item->mrp }}</del>-->
<!--                                </div>-->
<!--                                <div class="card-footer">-->
                                    
<!--                                 Active   <label  for="status_{{$item->id}}" class="toggle-switch">-->
<!--  <input type="checkbox" class="form-check-input status-toggle" id="status_{{$item->id}}" onclick="changeStatus({{$item->id}})" {{ $item->is_active == 1 ? 'checked' : '' }} />-->
<!--  <span class="slider"></span>-->
<!--</label>-->


<!--                                                        <form action="{{ route('products.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this Product?')">-->
<!--    @csrf-->
<!--    @method('DELETE')-->
<!--    <button class="btn btn-sm btn-danger">-->
<!--        <i class="fa fa-trash font-primary"></i>-->
<!--    </button>-->
<!--</form>-->

<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
                        
<!--                         @endforeach-->
<!--                    </div>-->
                    
                    <div class="row products-admin ratio_asos">
                     @foreach($data as $item)       
                        <div class="col-xl-3 col-sm-6">
                            <div class="card">
                                <div class="card-body product-box">
                                    @if($item->spl == 1)
                                    <div style="float: right;">
                                        <span class="badge badge-warning">SPL</span>
                                    </div>
                                    @endif


                                    <div class="img-wrapper">
                                        <div class="front">
                                            <a href="javascript:void(0)" class="bg-size" style="background-image: url(&quot;https://admin.nayalyf.com/storage/app/public/{{$item->image_url}}&quot;); background-size: cover; background-position: center center; display: block;"><img   src="https://admin.nayalyf.com/storage/app/public/{{$item->image_url}}" alt="{{$item->image_url}}" class="img-fluid blur-up lazyload bg-img" alt="" style="display: none;"></a>
                                            <div class="product-hover">
                                                <ul>
                                                    <li><a  href="/products/{{$item->id}}/edit" class="btn"><i class="ti-pencil-alt"></i></a></li>
                                                    <li>
                                                        <a href="javascript:void(0)" class="btn delete-btn" data-bs-toggle="modal" data-bs-target="#delete_category" data-id="{{ $item->id }}"><i class="ti-trash"></i></a>
                                                    </li>
                                                  
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-detail">
                                            
                                        <a href="javascript:void(0)">
                                            <h6>  {{ $item->name }}</h6>
                                            <p>{{ $item->description }}</p>
                                        </a>
                                        <h4>Rs.{{ $item->price }} <del>{{ $item->mrp }}</del></h4>
                                        <hr>
                                        <div class="row">
                                            <div class="col-6">
                                         <label for="status_{{$item->id}}" class="toggle-switch"> 
  <input type="checkbox" class="form-check-input status-toggle" id="status_{{$item->id}}" onclick="changeStatus({{$item->id}})" {{ $item->is_active == 1 ? 'checked' : '' }} />
  <span class="slider"></span> 
</label></div>
<div class="col-6">Show Home</div>
</div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        	<div class="modal custom-modal fade" id="delete_category" role="dialog">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-body">
						<div class="form-header">
							<h3>Delete</h3>
							<p>Are you sure want to delete?</p>
						</div>
						<div class="modal-btn delete-action">
							<div class="row">
								<div class="col-6 text-end">
                                     <form action="{{ route('products.destroy', $item->id) }}" method="POST" class="btn btn-danger continue-btn">
    @csrf
    @method('DELETE')
    <button class="btn"> 
       Delete
    </button>
</form>


								</div>
								<div class="col-6">
									<a href="javascript:void(0);" data-bs-dismiss="modal" class="btn btn-primary cancel-btn">Cancel</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
        @endforeach
                    </div>
                  </div>
   
	
</div>

<script>
 




$(document).ready(function () {
    $('.delete-btn').click(function () {
        var productId = $(this).data('id'); // Get the product ID from the clicked button
        var deleteUrl = "/admin/adv_slider_delete/" + productId; // Construct the delete URL

        $('#confirmDelete').attr('href', deleteUrl); // Set the correct URL in the modal
    });
});
products/{id}/change-status

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