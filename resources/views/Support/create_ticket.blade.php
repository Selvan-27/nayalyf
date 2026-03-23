@extends('layout')
@section('content')

    <!-- header start -->
    <header class="main-header profile-header">
        <div class="custom-container">
            <div class="header-panel">
                <a href="#sidebar" class="sidebar-btn" data-bs-toggle="offcanvas">
                    <i class="iconsax" data-icon="text-align-left"></i>
                </a>
                <h3></h3>
            </div>
        </div>
    </header>
    <!-- header end -->

    <!-- profile section starts -->
    <section class="light-theme-bg">
        <div id="alert-container"></div>

        <div class="profile-background">
            <div class="profile-part">
                 <h1>New Support Ticket</h1>
                <!--<div class="profile-image">-->
                <!--    <img id="output" class="img-fluid profile-pic" src="assets/images/avatar/uc.png" alt="11">-->
                <!--    <i class="iconsax edit-icon" data-icon="camera"></i>-->
                <!--    <input id="file" type="file" onchange="loadFile(event)">-->
                <!--</div>-->
                

    </section>

    <section class="pt-0">
        <div class="profile-wrapper">
        

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('tickets.store') }}">
    @csrf

    <div class="form-group mb-3">
        <label for="issue_type">Issue Type</label>
        <select name="issue_type" id="issue_type" class="form-control" required>
            <option value="">Select Issue Type</option>
            <option value="Order Issue">Order Issue</option>
            <option value="Payment">Payment</option>
            <option value="Return">Return</option>
            <option value="Account">Account</option>
            <option value="Other">Other</option>
        </select>
    </div>

    <div class="form-group mb-3">
        <label for="subject">Subject</label>
        <input type="text" name="subject" class="form-control" required>
    </div>

    <div class="form-group mb-3">
        <label for="description">Message</label>
        <textarea name="description" class="form-control" rows="5" required></textarea>
    </div>

    <button type="submit" class="btn btn-mid theme-btn w-100">Submit Ticket</button>
</form>
        </div>
    </section>
    <!-- profile section ends -->
    

    
       <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // trigger file input when clicking icon
    $(".edit-icon").click(function(){
        $("#file").click();
    });

    // preview + upload image
    $("#file").change(function(event){
        var reader = new FileReader();
        reader.onload = function(){
            $("#output").attr("src", reader.result); // preview
        };
        reader.readAsDataURL(event.target.files[0]);

        // prepare formData
        var formData = new FormData();
        formData.append('file', event.target.files[0]);
        formData.append('_token', '{{ csrf_token() }}');

        $.ajax({
            url: "{{ route('profile.upload') }}",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response){
               
               Swal.fire({
                  icon: "success",
                  title: response.message,
                });

                // alert(response.message);
            },
            error: function(xhr){
               if (xhr.responseJSON && xhr.responseJSON.message) {
                    // alert(xhr.responseJSON.message);
                    
                     Swal.fire({
                  icon: "warning",
                  title: "Oops...",
                  text: xhr.responseJSON.message,
                });
                
                } else {
                    alert("Error: " + xhr.status + " " + xhr.statusText);
                }
                //alert("Upload failed!");
            }
        });
    });
</script>

    <!-- image change js -->
    <script src="assets/js/image-change.js"></script>

@endsection