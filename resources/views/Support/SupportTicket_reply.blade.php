
@extends('layout')
@section('content')

<style>
    .message-bubble {
    max-width: 70%;
    padding: 10px 15px;
    border-radius: 15px;
    word-wrap: break-word;
}

.user-bubble {
    background-color: #1877f2;
    color: white;
    border-bottom-right-radius: 0;
}

.admin-bubble {
    background-color: #e4e6eb;
    color: black;
    border-bottom-left-radius: 0;
}

</style>
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

    <!-- profile section starts -->
    <section class="light-theme-bg">
        <div id="alert-container"></div>

        <div class="profile-background">
            <div class="profile-part">
                 <!--<h1>Support Ticket</h1>-->
                <h2>Ticket: {{ $ticket->subject }}</h2>
    <p><strong>Status:</strong> {{ ucfirst($ticket->status) }}</p>
    <p><strong>Issue Type:</strong> {{ ucfirst($ticket->issue_type) }}</p>
                

    </section>



        <div class="custom-container">
            <div class="review-box p-0 border-0 shadow-none">
                <div class="review-body pt-0">
                   <div class="container">
   

    <hr>
<h4>Conversation</h4>

<div class="border p-3 mb-3" style="background: #f9f9f9; max-height: 400px; overflow-y: auto;">
    @forelse ($messages as $message)
        <div class="d-flex mb-3 {{ $message->sender_role == 'User' ? 'justify-content-end' : 'justify-content-start' }}">
            <div class="message-bubble {{ $message->sender_role == 'User' ? 'user-bubble' : 'admin-bubble' }}">
                <strong>{{ $message->sender_role == 'Admin' ? ucfirst($message->sender_role)  : '' ;}}</strong>
                <p class="mb-1">{{ $message->message }}</p>
                <small class="text-muted d-block text-end">{{ $message->created_at->format('Y-m-d H:i') }}</small>
            </div>
        </div>
    @empty
        <p class="text-center text-muted">No messages yet.</p>
    @endforelse
</div>


    <h4>Reply</h4>
    <form action="{{ route('tickets.reply', $ticket->ticket_id) }}" method="POST">
        @csrf

        <div class="form-group">
            <textarea name="message" class="form-control" rows="4" required></textarea>
        </div>

        <button type="submit" class="btn btn-success mt-2">Send Reply</button>
    </form>
</div>
                </div>
            </div>

           


           
               
                <!--<li>-->
                <!--    <div class="review-head">-->
                <!--        <img src="assets/images/avatar/2.png" class="img-fluid review-avatar" alt="">-->
                <!--        <div class="review-content">-->
                <!--            <div class="review-top">-->
                <!--                <h5 class="fw-medium">Kathryn Murphy</h5>-->

                <!--                <h6 class="content-color">1 hour ago</h6>-->
                <!--            </div>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--    <p>The smart phone work just as well as everyone told me they would.</p>-->
                <!--    <div class="d-flex align-items-center gap-1">-->
                <!--        <ul class="rating-wrap d-flex align-items-center gap-1">-->
                <!--            <li class=" m-0 p-0 border-0">-->
                <!--                <img class="img-fluid star" src="assets/images/svg/star-fill.svg" alt="star-fill">-->
                <!--            </li>-->
                <!--            <li class=" m-0 p-0 border-0">-->
                <!--                <img class="img-fluid star" src="assets/images/svg/star-fill.svg" alt="star-fill">-->
                <!--            </li>-->
                <!--            <li class=" m-0 p-0 border-0">-->
                <!--                <img class="img-fluid star" src="assets/images/svg/star-fill.svg" alt="star-fill">-->
                <!--            </li>-->
                <!--            <li class=" m-0 p-0 border-0">-->
                <!--                <img class="img-fluid star" src="assets/images/svg/star-fill.svg" alt="star-fill">-->
                <!--            </li>-->
                <!--            <li class=" m-0 p-0 border-0">-->
                <!--                <img class="img-fluid star" src="assets/images/svg/star-fill.svg" alt="star">-->
                <!--            </li>-->
                <!--        </ul>-->
                <!--        <h5 class="content-color mt-2">5.0</h5>-->
                <!--    </div>-->
                <!--    <div class="img-box">-->
                <!--        <img src="assets/images/product-details/2.png" class="img-fluid" alt="">-->
                <!--        <img src="assets/images/product-details/4.png" class="img-fluid" alt="">-->
                <!--    </div>-->
                <!--</li>-->
       
            </ul>
        </div>
    
    <!-- cart buttons end -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

   
@endsection