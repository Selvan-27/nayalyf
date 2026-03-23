
@extends('layout')
@section('content')


    <!-- header start -->
    <header class="main-header">
        <div class="custom-container">
            <div class="header-panel">
                <a href="#sidebar" class="sidebar-btn" data-bs-toggle="offcanvas">
                    <i class="iconsax" data-icon="text-align-left"></i>
                </a>
                <h3>SUPPORT TICKET</h3>
                
            </div>
        </div>
    </header>
    <!-- header end -->


        <div class="custom-container">
              
            <div class="review-box p-0 border-0 shadow-none">
                <a href="/ticket-new" class="btn theme-btn w-100" >NEW TICKET</a>
            </div>

           


            <ul class="review-wrapper">
                 @foreach($tickets as $ticket)
                 
                  <li>
                    <div class="review-head">
                        <img src="assets/images/avatar/1.png" class="img-fluid review-avatar" alt="">
                        <div class="review-content">
                            <div class="review-top">
                                <div>
                                <h5 class="fw-medium">{{ $ticket->subject }}</h5>
                                 <p class="content-color">{{ $ticket->updated_at->diffForHumans() }}</p>
                                </div>
                                <div>
                               
                                <h6>{{ $ticket->status }}</h6>
                                <a href="{{ route('tickets.show') }}?id={{$ticket->ticket_id}}" class="btn btn-small theme-btn order-btn">Reply</a>
                            </div></div>
                        </div>
                    </div>
                    <p>{{ $ticket->description }}</p>
                   
                </li>
                @endforeach
             
       
            </ul>
        </div>
    
    <!-- cart buttons end -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

   
@endsection