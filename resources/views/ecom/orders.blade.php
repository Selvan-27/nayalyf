
@extends('layout')
@section('content')


    <header class="main-header">
        <div class="custom-container">
            <div class="header-panel">
                <a href="javascript:void(0);" onclick="handleBackButton()">
                    <img class="img-fluid icon-btn back-arrow" src="assets/images/svg/back-arrow.svg" alt="back-arrow">
                </a>
                <h3>Your Orders Are Here!</h3>
            </div>
        </div>
    </header>
    
    <!-- order section starts -->
    <section class="order-section section-b-space pt-0">
        <ul class="nav nav-Tabs order-tab custom-scrollbar px-20" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="active-tab" data-bs-toggle="tab" data-bs-target="#active-tab-pane"
                    type="button" role="tab">Order List</button>
            </li>
            <!--<li class="nav-item" role="presentation">-->
            <!--    <button class="nav-link" id="complete-tab" data-bs-toggle="tab" data-bs-target="#complete-tab-pane"-->
            <!--        type="button" role="tab">Complete</button>-->
            <!--</li>-->
            <!--<li class="nav-item" role="presentation">-->
            <!--    <button class="nav-link" id="cancelled-tab" data-bs-toggle="tab" data-bs-target="#cancelled-tab-pane"-->
            <!--        type="button" role="tab">Cancelled</button>-->
            <!--</li>-->
        </ul>
        
        <div class="custom-container">
        <form method="GET" action="{{ route('orders.index') }}">
    <div>
        <label for="search">Search</label>
        <input type="text" class="form-control wo-icon" name="search" value="{{ request('search') }}" placeholder="Search orders...">
    </div>

<div class="row">
    <div class="col-5"> 
        <label for="start_date">Start Date</label>
        <input type="date" class="form-control wo-icon" name="start_date" value="{{ request('start_date') }}">
    </div>

   <div class="col-5"> 
        <label for="end_date">End Date</label>
        <input type="date" class="form-control wo-icon" name="end_date" value="{{ request('end_date') }}">
    </div>

   <div class="col-2" style="margin-top: 20px;"> 
         <button type="submit" class="btn btn-small theme-btn order-btn" >Search</button>
    </div>
</div>    

  
</form>
</div>
        <div class="custom-container">
                                    @if ($message = Session::get('error'))
									<p class="alert alert-danger">
									{{ $message }}
									</p>
									@endif
									@if ($message = Session::get('success'))
									<p class="alert alert-success">
								   
								   {{ $message }}
									</p>
									@endif
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade  show active pt-3" id="active-tab-pane" role="tabpanel" tabindex="0">
                    <div class="row gy-3 gx-0">
                        
                           @foreach($pending as  $data)
                                         
                        <div class="col-12">
                            <div class="product-box vertical-product" style="background-color: #a1fdc0;">
                                
                                <div class="product-content">
                                    <h5 class="title-color white-nowrap">Order No: {{$data->order_id}} </h5>
                                    <h6 class="content-color quantity-content">Date: {{$data->created_at}}</h6>
                                    <div class="bottom-content">
                                        <h5 class="price">₹ {{$data->total}}</h5>
                                    </div>
                                    <div class="bottom-content">
                                        <a href="#" class="btn btn-small btn-primary  view-items" data-id="{{ $data->id }}">📝 View</a>
                                        <a href="/Track_Order/{{$data->order_id}}" class="btn theme-btn order-btn see-all">📦 Track</a>
                                    </div>
                                </div>
                                
                                
                            </div>
                                
                        </div>
                        <!--------Model product-box--------------------->
                        
                            <div class="modal element-modal fade" id="itemsTableModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header p-2">
                                            <h2 class="modal-title" id="exampleModalLabel">Ordered Product Details</h2>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="table table-responsive ">
                                                    <table id="itemsTable" class="table">
                                                        <thead>
                                                        <tr class="text-center">
                                                            <th class="border-top-0">Products</th>
                                                            <th class="border-top-0">Qty</th>
                                                            <th class="border-top-0">Price</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                      
                                                        </tbody>
                                                    </table>
                        
                                                    </div>
                                                </div>
                                        
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
       <!--------End Model product-box------------------->
                        @endforeach
                        
                    </div>
                    <br>
                    <div class="row gy-3 gx-0">
                                            @foreach($delivered as  $data)
                                         
                        <div class="col-12">
                            <div class="product-box vertical-product" style="background-color: #a1fdc0;">
                                
                                <div class="product-content">
                                    <h5 class="title-color white-nowrap">Order No: {{$data->order_id}} </h5>
                                    <h6 class="content-color quantity-content">Date: {{$data->created_at}}</h6>
                                    <div class="bottom-content">
                                        <h5 class="price">₹ {{$data->total}}</h5>
                                    </div>
                                </div>
                                <!--<a href="#" class="btn btn-primary view-items" data-id="{{ $data->id }}">View </a><br><br><br><br>-->
                                 <a href="/Invoice/{{$data->id}}" class="btn btn-small theme-btn order-btn">Invoice</a>
                            </div>
                        </div>
                     <!--------Model product-box--------------------->
                        
                            <div class="modal element-modal fade" id="itemsTableModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header p-2">
                                            <h2 class="modal-title" id="exampleModalLabel">Ordered Product Details</h2>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                        <div class="card">
                                        <div class="card-body">
                                            <div class="table table-responsive ">
                                                <table id="itemsTable" class="table">
                                                    <thead>
                                                        <tr class="text-center">
                                                            <th class="border-top-0">Products</th>
                                                            <th class="border-top-0">Qty</th>
                                                            <th class="border-top-0">Price</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                      
                                                    </tbody>
                                                  
                        
                                                </table>
                        
                                            </div>
                                        </div>
                                        
                                    </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
       <!--------End Model product-box------------------->
                          @endforeach
                       
                        
                    </div>
                    <br>
                    <div class="row gy-3 gx-0">
                         @foreach($cancelled as  $data)
                                         
                        <div class="col-12">
                           <div class="product-box vertical-product" style="background-color: #ffafaf;">
                                
                                <div class="product-content">
                                    <h5 class="title-color white-nowrap">Order No: {{$data->order_id}} </h5>
                                    <h6 class="content-color quantity-content">Date: {{$data->created_at}}</h6>
                                    <div class="bottom-content">
                                        <h5 class="price">₹ {{$data->total}}</h5>
                                    </div>
                                </div>
                                         <!--<a href="/Invoice/{{$data->order_id}}" class="btn btn-small theme-btn order-btn">Invoice</a>-->
                            </div>
                        </div>
                      
                      @endforeach
                    </div>
                    
                </div>
                
            <!--------End Model product-box------------------->
                <!--<div class="tab-pane fade pt-3" id="complete-tab-pane" role="tabpanel" tabindex="0">-->
                    
                <!--</div>-->
            
            <!--------End Model product-box------------------->
                <!--<div class="tab-pane fade pt-3" id="cancelled-tab-pane" role="tabpanel" tabindex="0">-->
                    
                <!--</div>-->
            </div>
        </div>
    </section>
    <!-- order section end -->
    
       <!-- <ul class="nav nav-Tabs order-tab custom-scrollbar px-20" id="myTab" role="tablist">-->
       <!--     <li class="nav-item" role="presentation">-->
       <!--         <button class="nav-link active" id="active-tab" data-bs-toggle="tab" data-bs-target="#active-tab-pane"-->
       <!--             type="button" role="tab">Active</button>-->
       <!--     </li>-->
       <!--     <li class="nav-item" role="presentation">-->
       <!--         <button class="nav-link" id="complete-tab" data-bs-toggle="tab" data-bs-target="#complete-tab-pane"-->
       <!--             type="button" role="tab">Complete</button>-->
       <!--     </li>-->
       <!--     <li class="nav-item" role="presentation">-->
       <!--         <button class="nav-link" id="cancelled-tab" data-bs-toggle="tab" data-bs-target="#cancelled-tab-pane"-->
       <!--             type="button" role="tab">Cancelled</button>-->
       <!--     </li>-->
       <!-- </ul>-->
       <!-- <div class="custom-container">-->
       <!--                             @if ($message = Session::get('error'))-->
							<!--		<p class="alert alert-danger">-->
							<!--		{{ $message }}-->
							<!--		</p>-->
							<!--		@endif-->
							<!--		@if ($message = Session::get('success'))-->
							<!--		<p class="alert alert-success">-->
								   
							<!--	   {{ $message }}-->
							<!--		</p>-->
							<!--		@endif-->
       <!--     <div class="tab-content" id="myTabContent">-->
       <!--         <div class="tab-pane fade  show active pt-3" id="active-tab-pane" role="tabpanel" tabindex="0">-->
       <!--             <div class="row gy-3 gx-0">-->
                        
       <!--                    @foreach($pending as  $data)-->
                                         
       <!--                 <div class="col-12">-->
       <!--                     <div class="product-box vertical-product" style="background-color: #a1fdc0;">-->
                                
       <!--                         <div class="product-content">-->
       <!--                             <h5 class="title-color white-nowrap">Order No: {{$data->order_id}} </h5>-->
       <!--                             <h6 class="content-color quantity-content">Date: {{$data->created_at}}</h6>-->
       <!--                             <div class="bottom-content">-->
       <!--                                 <h5 class="price">₹ {{$data->total}}</h5>-->
       <!--                             </div>-->
       <!--                             <div class="bottom-content">-->
       <!--                                 <a href="#" class="btn btn-small btn-primary  view-items" data-id="{{ $data->id }}">📝 View</a>-->
       <!--                                 <a href="/Track_Order/{{$data->order_id}}" class="btn theme-btn order-btn see-all">📦 Track</a>-->
       <!--                             </div>-->
       <!--                         </div>-->
                                
                                
       <!--                     </div>-->
                                
       <!--                 </div>-->
                        <!--------Model product-box--------------------->
                        
       <!--                     <div class="modal element-modal fade" id="itemsTableModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">-->
       <!--                         <div class="modal-dialog modal-dialog-centered">-->
       <!--                             <div class="modal-content">-->
       <!--                                 <div class="modal-header p-2">-->
       <!--                                     <h2 class="modal-title" id="exampleModalLabel">Ordered Product Details</h2>-->
       <!--                                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>-->
       <!--                                 </div>-->
       <!--                                 <div class="modal-body">-->
       <!--                                     <div class="card">-->
       <!--                                         <div class="card-body">-->
       <!--                                             <div class="table table-responsive ">-->
       <!--                                             <table id="itemsTable" class="table">-->
       <!--                                                 <thead>-->
       <!--                                                 <tr class="text-center">-->
       <!--                                                     <th class="border-top-0">Products</th>-->
       <!--                                                     <th class="border-top-0">Qty</th>-->
       <!--                                                     <th class="border-top-0">Price</th>-->
       <!--                                                 </tr>-->
       <!--                                                 </thead>-->
       <!--                                                 <tbody>-->
                                                      
       <!--                                                 </tbody>-->
       <!--                                             </table>-->
                        
       <!--                                             </div>-->
       <!--                                         </div>-->
                                        
       <!--                                     </div>-->
       <!--                                 </div>-->
       <!--                             </div>-->
       <!--                         </div>-->
       <!--                     </div>-->
       <!--------End Model product-box------------------->
       <!--                 @endforeach-->
                        
       <!--             </div>-->
       <!--         </div>-->
                
            <!--------End Model product-box------------------->
       <!--         <div class="tab-pane fade pt-3" id="complete-tab-pane" role="tabpanel" tabindex="0">-->
       <!--             <div class="row gy-3 gx-0">-->
       <!--                                     @foreach($delivered as  $data)-->
                                         
       <!--                 <div class="col-12">-->
       <!--                     <div class="product-box vertical-product" style="background-color: #a1fdc0;">-->
                                
       <!--                         <div class="product-content">-->
       <!--                             <h5 class="title-color white-nowrap">Order No: {{$data->order_id}} </h5>-->
       <!--                             <h6 class="content-color quantity-content">Date: {{$data->created_at}}</h6>-->
       <!--                             <div class="bottom-content">-->
       <!--                                 <h5 class="price">₹ {{$data->total}}</h5>-->
       <!--                             </div>-->
       <!--                         </div>-->
                                <!--<a href="#" class="btn btn-primary view-items" data-id="{{ $data->id }}">View </a><br><br><br><br>-->
       <!--                          <a href="/Invoice/{{$data->id}}" class="btn btn-small theme-btn order-btn">Invoice</a>-->
       <!--                     </div>-->
       <!--                 </div>-->
                     <!--------Model product-box--------------------->
                        
       <!--                     <div class="modal element-modal fade" id="itemsTableModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">-->
       <!--                         <div class="modal-dialog modal-dialog-centered">-->
       <!--                             <div class="modal-content">-->
       <!--                                 <div class="modal-header p-2">-->
       <!--                                     <h2 class="modal-title" id="exampleModalLabel">Ordered Product Details</h2>-->
       <!--                                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>-->
       <!--                                 </div>-->
       <!--                                 <div class="modal-body">-->
       <!--                                 <div class="card">-->
       <!--                                 <div class="card-body">-->
       <!--                                     <div class="table table-responsive ">-->
       <!--                                         <table id="itemsTable" class="table">-->
       <!--                                             <thead>-->
       <!--                                                 <tr class="text-center">-->
       <!--                                                     <th class="border-top-0">Products</th>-->
       <!--                                                     <th class="border-top-0">Qty</th>-->
       <!--                                                     <th class="border-top-0">Price</th>-->
       <!--                                                 </tr>-->
       <!--                                             </thead>-->
       <!--                                             <tbody>-->
                                                      
       <!--                                             </tbody>-->
                                                  
                        
       <!--                                         </table>-->
                        
       <!--                                     </div>-->
       <!--                                 </div>-->
                                        
       <!--                             </div>-->
       <!--                                 </div>-->
       <!--                             </div>-->
       <!--                         </div>-->
       <!--                     </div>-->
       <!--------End Model product-box------------------->
       <!--                   @endforeach-->
                       
                        
       <!--             </div>-->
       <!--         </div>-->
            
            <!--------End Model product-box------------------->
       <!--         <div class="tab-pane fade pt-3" id="cancelled-tab-pane" role="tabpanel" tabindex="0">-->
       <!--             <div class="row gy-3 gx-0">-->
       <!--                  @foreach($cancelled as  $data)-->
                                         
       <!--                 <div class="col-12">-->
       <!--                    <div class="product-box vertical-product" style="background-color: #ffafaf;">-->
                                
       <!--                         <div class="product-content">-->
       <!--                             <h5 class="title-color white-nowrap">Order No: {{$data->order_id}} </h5>-->
       <!--                             <h6 class="content-color quantity-content">Date: {{$data->created_at}}</h6>-->
       <!--                             <div class="bottom-content">-->
       <!--                                 <h5 class="price">₹ {{$data->total}}</h5>-->
       <!--                             </div>-->
       <!--                         </div>-->
                                         <!--<a href="/Invoice/{{$data->order_id}}" class="btn btn-small theme-btn order-btn">Invoice</a>-->
       <!--                     </div>-->
       <!--                 </div>-->
                      
       <!--               @endforeach-->
       <!--             </div>-->
       <!--         </div>-->
       <!--     </div>-->
       <!-- </div>-->


    <script>
function handleBackButton() {
    const urlParams = new URLSearchParams(window.location.search);
    const backto = urlParams.get('backto');

    if (backto) {
        // Navigate to the backto path (ensure it starts with a slash)
        const path = backto.startsWith('/') ? backto : '/' + backto;
        window.location.href = path;
    } else {
        // Fallback: go back in browser history
        window.history.back();
    }
}
</script>

<script>
document.querySelectorAll('.view-items').forEach(button => {
    button.addEventListener('click', function () {
        let orderId = this.getAttribute('data-id');

        fetch(`/orders/${orderId}/items`)
            .then(res => res.json())
            .then(data => {

                let total = 0;
                let tbody = document.querySelector('#itemsTable tbody');
                tbody.innerHTML = '';

                data.forEach(item => {

                    total += item.item_price * item.quantity;

                    let subName = item.sub_product_name ? 
                        `<br><small class="text-muted">(${item.sub_product_name})</small>` 
                        : '';

                    tbody.innerHTML += `
                        <tr>
                            <td>${item.product_name} ${subName}</td>
                            <td>${item.quantity}</td>
                            <td>₹ ${item.item_price}</td>
                        </tr>
                    `;
                });

                // Add total row
                tbody.innerHTML += `
                    <tr class="fw-bold">
                        <td colspan="2" class="text-end">Total:</td>
                        <td>₹${total}</td>
                    </tr>
                `;

                const modal = new bootstrap.Modal(document.getElementById('itemsTableModel'));
                modal.show();
            });
    });
});
</script>

@endsection