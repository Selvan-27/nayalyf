@extends('layout')
@section('content')

    <!-- header start -->
    <header class="main-header profile-header">
        <div class="custom-container">
            <div class="header-panel">
                
                <!--<a href="#sidebar" class="sidebar-btn" data-bs-toggle="offcanvas">-->
                <!--    <i class="iconsax" data-icon="text-align-left"></i>-->
                <!--</a>-->
                <!--<h3>Profile</h3>-->
            </div>
        </div>
    </header>
    <!-- header end -->

    <!-- profile section starts -->
    <section class="light-theme-bg">
        
        
        <div class="container">
            
            <div class="card">
                <div class="card-body">
        
                    @if($paymentstatus['success'])
                        <div class="text-center">
                            <img class="text-center" style="max-width: 300px; width: 100%; height: auto;" src="assets/images/emoji/s.webp"><br>
                        </div>
                        <h3 class="text-success text-center">✅ Payment Successful</h3><br>
                        <!--<p><strong>Message:</strong> {{ $paymentstatus['message'] }}</p>-->
                        <p><strong>Transaction ID:</strong> {{ $paymentstatus['data']['transactionId'] }}</p>
                        <p><strong>Amount:</strong> ₹{{ $paymentstatus['data']['amount'] }}</p>
                        <!--<p><strong>Status:</strong> {{ $paymentstatus['data']['state'] }}</p>-->
                        <p><strong>UPI Ref No:</strong> {{ $paymentstatus['data']['paymentInstrument']['utr'] ?? 'N/A' }}</p>
                        <p><strong>Payer VPA:</strong> {{ $paymentstatus['data']['paymentInstrument']['payerVpa'] ?? 'N/A' }}</p>
                        <a href="/Home" class="btn theme-btn w-100 auth-btn">Back To Home</a>
                    @else
                        <div class="text-center">
                            <img class="text-center" style="max-width: 300px; width: 100%; height: auto;" src="assets/images/emoji/f.webp"><br>
                        </div>
                        <h3 class="text-danger text-center">❌ Payment Failed</h3>
                        <p><strong>Message:</strong> {{ $paymentstatus['message'] }}</p>
                        <p><strong>Transaction ID:</strong> {{ $paymentstatus['data']['transactionId'] }}</p>
                        <p><strong>Amount:</strong> ₹{{ $paymentstatus['data']['amount'] }}</p>
                        <p><strong>Failure Code:</strong> {{ $paymentstatus['data']['responseCode'] }}</p>
                        <a href="/Home" class="btn theme-btn w-100 auth-btn">Back To Home</a>
                    @endif
        
                </div><br>
            </div>
        </div><br>

    </section> 
@endsection
