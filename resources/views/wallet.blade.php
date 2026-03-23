
@extends('layout')
@section('content')

    <!-- header start -->
    <header class="header">
        <div class="custom-container">
            <div class="head-content">
                <a href="#sidebar" class="sidebar-btn" data-bs-toggle="offcanvas">
                    <img style="max-width: 40px;" src="assets/images/logo/lo.png" alt="logo">
                </a>

                <a href="#" class="header-location">
                    <h6>{{Auth::user()->memberid?? ''}}</h6>

                    <div class="location-content">
                        <!--<img class="img-fluid location" src="assets/images/svg/location.svg" alt="location">-->
                        <h5>{{Auth::user()->name?? ''}}</h5>
                        <!--<i class="iconsax d-arrow" data-icon="chevron-down"></i>-->
                    </div>
                </a>
                <div class="ms-auto d-flex align-items-center gap-2">
                    <a href="/Orders">
                        <i class="iconsax icon-btn" data-icon="shopping-cart"></i>
                    </a>
                    <a href="/Notifications">
                        <i class="iconsax icon-btn notification-icon" data-icon="bell-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </header>
    <!-- header end -->

    <!-- empty cart section starts -->
    <section>
        <div class="custom-container">
            <div class="title">
                <div class="d-flex align-items-center gap-2">
                    <h3>Your Wallet Is Here!</h3>
                </div>
            </div>

            <div class="row g-3">
                <div class="col-6">
                    <div class="product-box" style="background-color: #0d3ff5;">
                        <div class="product-content">
                            <h5 style="color: #fff;">Total Earnings</h5>
                            <div class="bottom-content">
                                <h4 style="color: #fff;">₹ {{ $total_payout ?? 0 }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="product-box" style="background-color: #0d3ff5;">
                        <div class="product-content">
                            <h5 style="color: #fff;">Already Withdrew</h5>
                            <div class="bottom-content">
                                <h4 style="color: #fff;">₹  {{ $successfull_withdraw ?? 0 }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="product-box" style="background-color: #0d3ff5;">
                        <div class="product-content">
                            <h5 style="color: #fff;">Shopping Usage</h5>
                            <div class="bottom-content">
                                <h4 style="color: #fff;">₹ {{$orders ?? 0}}</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="product-box" style="background-color: #0d3ff5;">
                        <div class="product-content">
                            <h5 style="color: #fff;">Activation Usage</h5>
                            <div class="bottom-content">
                                <h4 style="color: #fff;">₹ {{$activation_amt ?? 0}}</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="product-box" style="background-color: #ffe00b;">
                        <div class="product-content">
                            <h2 style="color: #000;">Wallet Balance</h2>
                            <div class="bottom-content text-center">
                                <h2 style="color: #000;">₹ {{ $withdrawable_amount ?? 0 }}</h2>
                            </div>
                        </div>
                        <div class="text-center">
                            <a href="#success" class="p-2 btn btn-primary" data-bs-toggle="modal"><b>Withdraw Now!</b></a>
                        </div><br>
                    </div>
                </div>
            </div><br>
            <!--<div class="row text-center">-->
            <!--    <div class="col-6">-->
            <!--        <a href="#depo" class="p-2 btn btn-info w-100" data-bs-toggle="modal"><b>Wallet Deposit</b></a>-->
            <!--    </div>-->
            <!--    <div class="col-6">-->
            <!--        <a href="#transdepo" class="p-2 btn btn-info w-100" data-bs-toggle="modal"><b>Wallet Transfer</b></a>-->
            <!--    </div>-->
                
            <!--</div><br>-->
            <div class="row text-center">
                <div class="col-12">
                    <a href="#idc" class="p-2 btn btn-primary w-100" data-bs-toggle="modal"><b>Activate Member!</b></a>
                </div>
            </div>
                        <br><hr>

            <div class="title">
                <h3>Recent Transactions</h3>
                <a href="/Transactions" class=" btn theme-btn">View All</a>
            </div>

            <div class="row gy-3 gx-0">
                
    
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
     
                  @foreach($withdraw_success as $index => $withdraw)
    
                <div class="col-12">
                    <div class="product-box vertical-product" style="background-color:  @if($withdraw->status == 'success') #a1fdc0;
                    @elseif($withdraw->status == 'pending') #eff77e;
                    @else red
                    @endif ">
                        <div class="product-content">
                            <h6 style="color: #000;"> {{ $withdraw->updated_at ? \Carbon\Carbon::parse($withdraw->updated_at)->format('d-m-Y H:i') : '-' }}</h6>
                            <a href="#" class="product-top">
                                <h3 style="color: black;">Withdraw  @if($withdraw->status == 'success') Success
                    @elseif($withdraw->status == 'pending') Pending
                    @else  Request Denied
                    @endif</h3>
                                <p>Requested Date: {{ \Carbon\Carbon::parse($withdraw->created_at)->format('d-m-Y H:i') }}</p>
                                <p>Amount Transfered: ₹ {{ $withdraw->netpay }}</p>
                                <p>Service Charges: ₹ {{ $withdraw->service_charge }}</p>
                            </a>
                        </div>
                        <div class="see-all">
                            <h1 style="color: black;">₹ {{ $withdraw->payout }}</h1>
                        </div>
                    </div>
                </div>
                  @endforeach
                  
                                    @foreach($withdraw_pending as $index => $withdraw)
    
                <div class="col-12">
                    <div class="product-box vertical-product" style="background-color:  @if($withdraw->status == 'success') #a1fdc0;
                    @elseif($withdraw->status == 'pending') #eff77e;
                    @else red
                    @endif ">
                        <div class="product-content">
                            <!--<h6 style="color: #000;"> {{ $withdraw->updated_at ? \Carbon\Carbon::parse($withdraw->updated_at)->format('d-m-Y H:i') : '-' }}</h6>-->
                            <a href="#" class="product-top">
                                <h3 style="color: black;">Withdraw  @if($withdraw->status == 'success') Success;
                    @elseif($withdraw->status == 'pending') Pending
                    @else  Request Denied
                    @endif</h3>
                                <p>Requested Date: {{ \Carbon\Carbon::parse($withdraw->created_at)->format('d-m-Y H:i') }}</p>
                   
                            </a>
                        </div>
                        <div class="see-all">
                            <h1 style="color: black;">₹ {{ $withdraw->payout }}</h1>
                        </div>
                    </div>
                </div>
                  @endforeach
                  
                    @foreach($withdraw_cancel as $index => $withdraw)
    
                <div class="col-12">
                    <div class="product-box vertical-product" style="background-color: #fdb9b9">
                        <div class="product-content">
                            <h6 style="color: #000;"> {{ $withdraw->updated_at ? \Carbon\Carbon::parse($withdraw->updated_at)->format('d-m-Y H:i') : '-' }}</h6>
                            <a href="#" class="product-top">
                                <h3 style="color: black;">Withdraw  @if($withdraw->status == 'success') Success;
                    @elseif($withdraw->status == 'pending') Pending
                    @else  Request Denied
                    @endif</h3>
                                <p>Requested Date: {{ \Carbon\Carbon::parse($withdraw->created_at)->format('d-m-Y H:i') }}</p>
                   
                            </a>
                        </div>
                        <div class="see-all">
                            <h1 style="color: black;">₹ {{ $withdraw->payout }}</h1>
                        </div>
                    </div>
                </div>
                  @endforeach
                  
                <!--<div class="col-12">-->
                <!--    <div class="product-box vertical-product" style="background-color: #eff77e;">-->
                <!--        <div class="product-content">-->
                            
                <!--            <a href="#" class="product-top">-->
                <!--                <h3 class="white-nowrap" style="color: black;">Request In-Process</h3>-->
                <!--                <p style="color: #000;">Requested Date: 14/03/2025 10.00 AM</p>-->
                                
                                
                <!--            </a>-->
                <!--        </div>-->
                <!--        <div class="see-all">-->
                <!--            <h1 class="white-nowrap" style="color: black;">₹ 200</h1>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--</div>-->
                <!--<div class="col-12">-->
                <!--    <div class="product-box vertical-product" style="background-color: #f89996;">-->
                <!--        <div class="product-content">-->
                <!--            <h6 style="color: #000;">14/03/2025 10.00 AM</h6>-->
                <!--            <a href="#" class="product-top">-->
                <!--                <h3 class="white-nowrap" style="color: black;">Request Denied</h3>-->
                <!--                <p style="color: red;">Requested Date: 14/03/2025 10.00 AM</p>-->
                                
                <!--                <p style="color: red;">Network Failure</p>-->
                <!--            </a>-->
                <!--        </div>-->
                <!--        <div class="see-all">-->
                <!--            <h1 class="white-nowrap" style="color: black;">₹ 200</h1>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--</div>-->
            </div>
            
            

      

        </div><br><br>
    </section>

    <div class="modal fade centered-modal" tabindex="-1" id="success">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body" style="background: hsla(191, 60%, 89%, 1); border-radius: 15px;">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      <form method="post" action="withdraw_request">
                @csrf
                                     
									
                    <div class="d-grid align-content-center">
                        
                        <h3 class="text-center fw-normal mt-1" style="color: #000;"><b><u>Withdraw Now!</u></b></h3><br>
                        <h3 style="color: #000;">Your Wallet Balalnce Is ₹ {{ $withdrawable_amount ?? 0 }}.</h3><br>
                        <input type="number" name="wallet_ID" id="wallet_ID" placeholder="Enter Withdraw Amount"  required>
                        <p>Minimum Withdrawal Request Is ₹ 200/-</p><br>
                        <!--<a href="#successg" data-bs-toggle="modal" class="btn theme-btn  w-100 mt-3">Request Withdraw!</a>-->

                    </div>
                    
                      <button type="submit" class="btn theme-btn  w-100 mt-3"> Request Withdraw</button>
                      </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade centered-modal" tabindex="-1" id="successg">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="d-grid align-content-center">
                        <img class="img-fluid success-img mx-auto" src="assets/images/gif/successfully.gif"
                            alt="successfully" />
                        <h3 class="text-center title-color fw-normal mt-1">Request Submitted Successfully!</h3>
                        <a href="/UC_Wallet" data-bs-dismiss="modal" class="btn theme-btn  w-100 mt-3">Back To Wallet</a>

                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Activate modal starts -->
    <div class="modal element-modal fade" id="idc" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                
                <div class="modal-body">
                    <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="d-grid align-content-center">
                        <form method="post" action="activation_request">
                        @csrf
                         
                        <h3 class="text-center title-color fw-normal mt-1">Activate Member!</h3>
                        <p class="text-center" style="color: #000">Here, You Can Activate Any In-Active Member.</p><br>
                        <h3 class="text-center">Your Deposit Wallet Balalnce Is<br>₹ {{ $withdrawable_amount ?? 0 }}.</h3><br>
                        <input type="text" name="activation_id" placeholder="Enter In-Active Uniq ID"  oninput="getMemberdet(this.value)" >
                        <p id="memberName">Member Name: </p>
                                        <p id="id_status">Status:</p>
                        <button type="submit"  class="btn theme-btn  w-100 mt-3">Activate Now!</button>
                         </form>

                    </div>
                </div>
                </div>
                
            </div>
        </div>
    </div>
    <!-- Activate modal end -->
    
    <!-- transfer modal starts -->
    <div class="modal element-modal fade" id="transdepo" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                
                <div class="modal-body">
                    <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="d-grid align-content-center">
                        
                        <h3 class="text-center title-color fw-normal mt-1">Wallet Transfer!</h3>
                        <p class="text-center" style="color: #000">Here, You Can Transfer From Withdraw Wallet To Deposit Wallet.</p><br>
                        <h3 class="text-center">Your Withdraw Wallet Balalnce Is<br>₹ {{ $withdrawable_amount ?? 0 }}.</h3><br>
                        <input type="number" placeholder="Enter Amount">
                        
                        <a href="#"  class="btn theme-btn  w-100 mt-3">Transfer Now!</a>
                        

                    </div>
                </div>
                </div>
                
            </div>
        </div>
    </div>
    <!-- transfer modal end -->
    
     <!-- deposit modal starts -->
    <div class="modal element-modal fade" id="depo" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                
                <div class="modal-body">
                    <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="d-grid align-content-center">
                        
                        <h3 class="text-center title-color fw-normal mt-1">Wallet Deposit!</h3>
                        <p class="text-center" style="color: #000">Here, You Can Deposit In Your Wallet!</p><br>
                        <!--<h3 class="text-center">Your Wallet Balalnce Is [balance-income].</h3><br>-->
                        <input type="number" placeholder="Enter Deposit Amount">
                        <p>Minimum Deposit ₹ 500/-</p>
                        <!--<p>Status:</p>-->
                        <a href="#"  class="btn theme-btn  w-100 mt-3">Deposit Now!</a>
                        

                    </div>
                </div>
                </div>
                
            </div>
        </div>
    </div>
    <!-- deposit modal end -->
    
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form[action="withdraw_request"]');
    const walletInput = document.getElementById('wallet_ID');
    const wallet_balance = {{ $withdrawable_amount }}; // Laravel variable

    form.addEventListener('submit', function (e) {
        const amount = parseFloat(walletInput.value);

        if (isNaN(amount) || amount < 200) {
            e.preventDefault(); // Stop form submission
            Swal.fire({
                icon: 'warning',
                title: 'Minimum Withdrawal',
                text: 'Minimum withdrawal amount is ₹200.',
                confirmButtonText: 'OK'
            }).then(() => {
                walletInput.focus();
            });
            return;
        }

        if (amount > wallet_balance) {
            e.preventDefault(); // Stop form submission
            Swal.fire({
                icon: 'error',
                title: 'Low Balance',
                text: "You don't have enough balance to withdraw.",
                confirmButtonText: 'OK'
            }).then(() => {
                walletInput.focus();
            });
        }
    });
});
</script>

 <script>
     function getMemberdet(val){
          // alert(val);
          $.ajax({
                url: '/get_member_details',
                type: 'GET',
                data: {
                 _token: '{{ csrf_token() }}',
                 memberid: val
                },
                success: function(response) {
                 // Handle the response from the server
                 console.log(response);
                if(response.error) {
                     $('#memberName').text('Member Name: Not Found');
                      $('#id_status').text('Status: N/A');
                 } else {
                                           $('#memberName').text('Member Name: ' + response.name);
                      $('#id_status').text('Status: ' + response.activation_status);

                 }
                },
                error: function(xhr) {
                 // Handle any errors that occur during the request
                 console.error(xhr);
                }
          });
     }
      </script> 
    
    @endsection