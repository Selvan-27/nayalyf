@extends('layout')
@section('content')

    <!-- header start -->
    <header class="main-header profile-header">
        <div class="custom-container">
            <div class="header-panel">
                <a href="#sidebar" class="sidebar-btn" data-bs-toggle="offcanvas">
                    <i class="iconsax" data-icon="text-align-left"></i>
                </a>
                <h3>Profile</h3>
            </div>
        </div>
    </header>
    <!-- header end -->

    <!-- profile section starts -->
    <section class="light-theme-bg">
        <div class="profile-background">
            <div class="profile-part">
                <div class="profile-image">
                    <img id="output" class="img-fluid profile-pic" src="assets/images/avatar/uc.png" alt="11">
                    <i class="iconsax edit-icon" data-icon="camera"></i>
                    <input id="file" type="file" onchange="loadFile(event)">
                </div>
                <h3>{{Auth::user()->name?? ''}}</h3>
                <p>{{Auth::user()->memberid?? ''}}</p>
                
            </div>
        </div><br><br>
    </section>

    <section class="pt-0">
        <div class="profile-wrapper">
            <ul class="profile-listing">
                <li>
                    <a href="#center" data-bs-toggle="modal">
                        <div class="profile-box color-1">
                            <img class="img-fluid icon" src="assets/images/svg/edit.svg" alt="box">
                        </div>
                        <h5>Details</h5>
                    </a>
                </li>
                <!--<li>-->
                <!--    <a href="#idc" data-bs-toggle="modal">-->
                <!--        <div class="profile-box color-3">-->
                <!--            <img class="img-fluid icon" src="assets/images/svg/card.svg" alt="coupon">-->
                <!--        </div>-->
                <!--        <h5>ID Card</h5>-->
                <!--    </a>-->
                <!--</li>-->
                <li>
                    <a href="/Upgrade">
                        <div class="profile-box color-3">
                            <img class="img-fluid icon" src="assets/images/svg/review.svg" alt="review">
                        </div>
                        <h5>Upgrade</h5>
                    </a>
                </li>
                <li>
                    <a href="/UC_Help">
                        <div class="profile-box color-2">
                            <img class="img-fluid icon" src="assets/images/svg/help.svg" alt="help">
                        </div>
                        <h5>Help</h5>
                    </a>
                </li>
            </ul>

            <ul class="account-listing">
                <li>
                    <a href="/Address" class="account-link">
                        <h5>Manage Addresses</h5>
                        <i class="iconsax icon" data-icon="chevron-right"></i>
                    </a>
                </li>
                <!--<li>-->
                <!--    <a href="/Awards" class="account-link">-->
                <!--        <h5>Award Details</h5>-->
                <!--        <i class="iconsax icon" data-icon="chevron-right"></i>-->
                <!--    </a>-->
                <!--</li>-->
                <!-- <li>
                    <a href="payment-method.html" class="account-link">
                        <h5>Payment Methods</h5>
                        <i class="iconsax icon" data-icon="chevron-right"></i>
                    </a>
                </li> -->

                <li>
                    <a href="/Change_Password" class="account-link">
                        <h5>Change Account Password</h5>
                        <i class="iconsax icon" data-icon="chevron-right"></i>
                    </a>
                </li>
                 <li>
                    <a href="/Terms" class="account-link">
                        <h5>Terms & Policies</h5>
                        <i class="iconsax icon" data-icon="chevron-right"></i>
                    </a>
                </li>
                <li>
                    <a href="/logout" data-bs-toggle="offcanvas" class="account-link">
                        <h5>Logout</h5>
                        <i class="iconsax icon" data-icon="chevron-right"></i>
                    </a>
                </li>
            </ul>
        </div>
    </section>
    <!-- profile section ends -->
    
    <!-- registration details modal starts -->
    <div class="modal element-modal fade" id="center" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header p-2">
                    <h2 class="modal-title" id="exampleModalLabel">Registration Details</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body text-center">
                            <div class="row gx-3 align-items-center mb-3">
                                <div class="col">Mr./Ms. {{$user->name}}<br>{{$user->memberid}}</div>

                            </div>

                            <div class="row gx-3 align-items-center mb-3">
                                <div class="col">Signed On<br>{{$user->created_at}}</div>
                                <div class="col">Account Type<br>General User</div>
                            </div>
                            <hr>
                            <div class="row gx-3 align-items-center mb-3">
                                <div class="col">E-Mail<br>{{$user->real_email}}</div>
                                <div class="col">Mobile<br>{{$user->mobile}}</div>
                            </div><hr>
                            <div class="row gx-3 align-items-center mb-3">
                                <div class="col">Sponsor Name<br>{{$sponsor->name?? ''}}</div>
                                <div class="col">Sponsor ID<br>{{$sponsor->memberid?? ''}}</div>
                            </div>
                            <div class="row gx-3 align-items-center mb-3">
                                <div class="col">Sponsor Contact Number<br>{{$sponsor->mobile?? ''}}</div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- registration details modal end -->

    <!-- ID Card modal starts -->
    <div class="modal element-modal fade" id="idc" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header p-2">
                    <h2 class="modal-title" id="exampleModalLabel">ID Card Details</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body text-center">
                            <div class="profile-background">
                                <div class="profile-part">
                                    <div class="profile-image">
                                        <img id="output" class="img-fluid profile-pic" src="assets/images/avatar/uc.png" alt="11">
                                    </div>
                                    
                                    <h3>{{Auth::user()->name?? ''}}</h3>
                                    <p>{{Auth::user()->memberid?? ''}}</p>
                                    <p>[member-rank]</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="/ID_Card_Form" class="btn theme-btn p-2">Apply For New ID Card</a>
                </div>
            </div>
        </div>
    </div>
    <!-- ID Card modal end -->

    <!-- logout offcanvas start -->
    <div class="offcanvas offcanvas-bottom success-offcanvas" tabindex="-1" id="logout">
        <div class="offcanvas-header pt-0 px-0">
            <h5 class="offcanvas-title" id="offcanvasExampleLabel">Logout</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>

        <div class="offcanvas-body text-center p-0 pt-3 pb-4">
            <h5 class="fw-medium title-color">Are you sure you want to log out?</h5>
        </div>
        <div class="offcanvas-foorter d-flex align-items-center gap-3 shadow-none">
            <a href="/Profile" class="btn white-btn w-50">Cancel</a>
            <a href="/" class="btn theme-btn w-50">Logout</a>
        </div>
    </div>
    <!-- logout offcanvas end -->

    

    

    <!-- image change js -->
    <script src="assets/js/image-change.js"></script>

@endsection