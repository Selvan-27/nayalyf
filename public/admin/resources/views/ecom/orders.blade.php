@extends('layout.admin') @section('content')
<div class="page-body">
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3> Products Order List - {{Request::get('status')}}</h3>
                    </div>
                </div>
                <div class="col-lg-6">
                    <form method="get" action="/orders">
    <select name="type" class="form-select" onchange="this.form.submit()" disabled="">
        <!--<option value="">-- Select Board --</option>-->
            <option value="0" {{ request('type') == 0 ? 'selected' : '' }}> All Orders</option>
            <!--<option value="0" {{ request('type') == 0 ? 'selected' : '' }}> All Orders</option>-->
            <option value="1" {{ request('type') == 1 ? 'selected' : '' }}> Id Cards</option>
            <option value="2" {{ request('type') == 2 ? 'selected' : '' }}> Starter Kits</option>
       
    </select>
</form>

                        

                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12">
                <div class="card tab2-card">
                    <div class="card-body">
                        
                         <div class="btn-group btn-group-lg">
                          <a type="button" class="btn btn-primary" href="orders?status=pending">Pending</a>
                          <a type="button" class="btn btn-primary" href="orders?status=shipped">Shipped</a>
                          
                          <a type="button" class="btn btn-primary" href="orders?status=delivered">Delivered</a>
                          <a type="button" class="btn btn-primary" href="orders?status=cancelled">Cancelled</a>
                          </div> 

                        <!--<ul class="nav nav-tabs nav-material" id="top-tab" role="tablist">-->
                        <!--       <li class="nav-item">-->
                        <!--        <a class="nav-link active" id="b2-tab" data-bs-toggle="tab" href="#top-b2" role="tab"-->
                        <!--            aria-controls="top-b2" aria-selected="true">Pending-->
                        <!--        </a>-->
                        <!--    </li>-->
                        <!--    <li class="nav-item">-->
                        <!--        <a class="nav-link " id="b1-tab" data-bs-toggle="tab" href="#top-b1" role="tab"-->
                        <!--            aria-controls="top-b1" aria-selected="false">Delivered-->
                        <!--        </a>-->
                        <!--    </li>-->
                         
                        <!--    <li class="nav-item">-->
                        <!--        <a class="nav-link" id="b3-tab" data-bs-toggle="tab" href="#top-b3" role="tab"-->
                        <!--            aria-controls="top-b3" aria-selected="false">Cancelled-->
                        <!--        </a>-->
                        <!--    </li>-->
                            
                        <!--</ul>-->
                        @if(session('success'))
                        <div class="alert alert-success mt-3">
                            {{ session('success') }}
                        </div>
                        @endif  
                        @if(session('error'))
                        <div class="alert alert-danger mt-3">
                            {{ session('error') }}
                        </div>
                        @endif

                        <div class="tab-content" id="top-tabContent">
                            <div class="tab-pane fade show active" id="top-b2" role="tabpanel" aria-labelledby="contact-top-tab">
                                <!--<h5 class="f-w-600">Products</h5>-->
                                <div class="card">
                                    <div class="card-body vendor-table">
                                        <table class="table-responsive text-center" id="basic-1">
                                            <thead>
                                                <tr>
                                                    <!--<th>Update</th>-->
                                                    <th>#</th>
                                                    <th>Date</th> 
                                                    <th>Order No</th>
                                                    <th>Member</th>
                                                    <th>User Id</th>
                                                    <th>Total</th>
                                                    <th>Wallet</th>
                                                    <th>Payable</th>
                                                    <th>Payment</th>
                                                    <th>Order Status</th>
                                                    <th>Mode</th> 
                                                    <th>Invoice</th> 
                                                    <!--<th>Shipped On</th>-->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($data as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $item->created_at }}</td>
                                                    <td>{{ $item->order_id }}</td>
                                                    <td>{{$item->name}} | {{$item->mobile}}</td>
                                                    <td>{{ $item->user_id }}</td>
                                                    <td>{{ $item->total }}</td>
                                                    <td>{{ $item->from_income_wallet }}</td>
                                                    <td>{{ $item->payable }}</td>
                                                    <td>{{ $item->order_status }}</td>
                                                    <td>{{ $item->status }}</td>
                                                    <td>{{ $item->mode }}</td>
                                                    <td><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal{{$item->id}}">Update</button>
                                                        <a href="/invoice/{{$item->id}}" class="btn btn-success">Invoice</a>
                                                    </td>
                                                </tr>
                                                <div class="modal" id="myModal{{$item->id}}">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <!-- Modal Header -->
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Order Status update</h4>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                            </div>
                                                            <!-- Modal body -->
                                                            <div class="modal-body">
                                                                <form action="order_update/{{$item->id}}" method="POST">
                                                                @csrf
                                                                    <div class="row">
                                                                        <div class="col-md-6 mb-3">
                                                                            <label for="order_id" class="form-label">Order ID</label>
                                                                            <input type="text" class="form-control" id="order_id" name="order_id" value="{{ $item->order_id }}" readonly>
                                                                        </div>
                                                                        <div class="col-md-6 mb-3">
                                                                            <label for="user_id" class="form-label">User ID</label>
                                                                            <input type="text" class="form-control" id="user_id" name="user_id" value="{{ $item->user_id }}" readonly>  
                                                                        </div>
                                                                        <div class="col-md-6 mb-3">
                                                                            <label for="order_date" class="form-label">Order Date</label>
                                                                            <input type="text" class="form-control" id="order_date" name="order_date" value="{{ $item->created_at }}" readonly>
                                                                        </div>
                                                                        <div class="col-md-6 mb-3">
                                                                            <label for="order_value" class="form-label">Order Value</label>
                                                                            <input type="text" class="form-control" id="order_value" name="order_value" value="{{ $item->total }}" readonly>
                                                                        </div>
                                                                        <div class="col-md-12 mb-3">
                                                                            <label for="payment_method" class="form-label">Payment Method</label>
                                                                            <input type="text" class="form-control" id="payment_method" name="payment_method" value="{{ $item->payment_method }}" readonly> 
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-6 mb-3">
                                                                            <label for="pnr_number" class="form-label">PNR Number</label>
                                                                            <input type="text" class="form-control" id="pnr_number" name="pnr_number" value="{{ $item->pnr_number }}">
                                                                        </div>
                                                                        <div class="col-md-6 mb-3">
                                                                            <label for="courier_name" class="form-label">Courier Name</label>
                                                                            <input type="text" class="form-control" id="courier_name" name="courier_name" value="{{ $item->courier_name }}">
                                                                        </div>
                                                                        <div class="col-md-6 mb-3">
                                                                            <label for="track_link" class="form-label">Track Link</label>
                                                                            <input type="text" class="form-control" id="track_link" name="track_link" value="{{ $item->track_link }}">
                                                                        </div>
                                                                        <div class="col-md-6 mb-3">
                                                                            <label for="delivery_date" class="form-label">Delivery Date</label>
                                                                            <input type="date" class="form-control" id="delivery_date" name="delivery_date" value="{{ $item->delivery_date }}">
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="order_status" class="form-label">Order Status</label>
                                                                            <select class="form-select" id="order_status" name="order_status">
                                                                                <option value="pending" {{ $item->order_status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                                                <option value="shipped" {{ $item->order_status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                                                                                <option value="delivered" {{ $item->order_status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                                                                                <option value="cancelled" {{ $item->order_status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                                                            </select>   
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
            </div>
        </div>
    </div>

    <div class="container-fluid">
        
    </div>

    <!-- Button to Open the Modal -->




            <!-- The invoice Modal -->
            <div class="modal" id="invoice">
                <div class="modal-dialog  modal-lg">
                    <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Invoice</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                    <div class="row align-items-center gy-3">
                        <div class="col-sm-7 text-center text-sm-start"> 
                            <img id="logo" src="assets/images/dashboard/uniqconnect-logo-black.png"> 
                        </div>
                        <div class="col-sm-5 text-center text-sm-end">
                            <h4 class="mb-0">Invoice</h4>
                            <p class="mb-0">Invoice Number - 16835</p>
                        </div>
                    </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-6 text-sm-end order-sm-1"> <strong>Pay To:</strong>
                                <address>
                               Uniq Connect Wellness Care<br />
                               #39, 1st Floor, 17th Main Road,<br />
                               Anna Nagar West, Chennai - 600 040
                                </address>
                            </div>
                            <div class="col-sm-6 order-sm-0"> <strong>Invoiced To:</strong>
                                <address>
                                [member_name]<br />
                                [member_address]<br />
                                [member_city]-[member_pincode]<br />
                                [member_state]
                                </address>
                            </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4 mb3">
                                    <strong>Payment Method:</strong>
                                    <p>Online Payment</p>
                                </div>
                                <div class="col-sm-4 mb3">
                                    <strong>Order No:</strong>
                                    <p>457876</p>
                                </div>
                                <div class="col-sm-4 text-sm-end">
                                    <strong>Order Date:</strong>
                                    <p>07/11/2020</p>
                                </div>
                            </div>
                            <div class="table-responsive">
                            <table class="table border mb-0">
                                <thead>
                                <tr class="bg-light">
                                    <td class="col-4"><strong>Product</strong></td>
                                    <td class="col-2"><strong>Quantity</strong></td>
                                    <td class="col-2 text-center"><strong>Base Fare</strong></td>
                                    
                                    <td class="col-2 text-end"><strong>Amount</strong></td>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>UC Antioxidant Juice</td>
                                    <td>2</td>
                                    <td class="text-center">₹ 2498.00</td>
                                    
                                    <td class="text-end">₹ 2498.00</td>
                                </tr>
                                
                                </tbody>
                            </table>
                            </div>
                            <div class="table-responsive">
                                <table class="table border border-top-0 mb-0">
                                <tr class="bg-light">
                                    <td colspan="3" class="text-end"><strong>Sub Total:</strong></td>
                                    <td class="col-sm-2 text-end">₹ 2498.00</td>
                                </tr>
                                <tr class="bg-light">
                                    <td colspan="3" class="text-end"><strong>GST:</strong><br>
                                    <span class="text-1">CGST - 9%<br>SGST - 9%</span></td>
                                    <td class="col-sm-2 text-end align-top">-₹ 395.80</td>
                                </tr>
                                <tr class="bg-light">
                                    <td colspan="3" class="text-end border-bottom-0"><strong>Total:</strong></td>
                                    <td class="col-sm-2 text-end border-bottom-0">₹ 2498.00</td>
                                </tr>
                                </table>
                            </div>
                            <br>
                            <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                <tr class="bg-light">
                                    <td class="text-center"><strong>Order Date</strong></td>
                                    <td class="text-center"><strong>Gateway</strong></td>
                                    <td class="text-center"><strong>Transaction ID</strong></td>
                                    <td class="text-center"><strong>Amount</strong></td>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="text-center">07/11/2020</td>
                                    <td class="text-center">Online </td>
                                    <td class="text-center">3912912704</td>
                                    <td class="text-center">₹ 2498.00</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-info" data-bs-dismiss="modal">Print</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>

                    </div>
                </div>
            </div>
            <!-- The invoice Modal -->



</div>
@stop