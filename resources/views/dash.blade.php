
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
                    <h6>{{ $member_id }}</h6>

                    <div class="location-content">
                        <!--<img class="img-fluid location" src="assets/images/svg/location.svg" alt="location">-->
                        <h5>{{ $member_name }}</h5>
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
                    <h3>Welcome Back!</h3>
                </div>
            </div>

            <div class="row g-3">
                <div class="col-12">
                    <div class="product-box vertical-product" style="background-color: #ffe00b;">
                        <div class="product-content">
                            <div class="product-top">
                                <h2 style="color: black;" class="nowarp">Mr./Ms.{{ $member_name }}</h2>
                                <h3 style="color: black;">{{ $member_id }}</h3>
                                <h4 style="color: black;">{{ $member_rank }}</h4>
                                <p style="color: green;">Active From {{ $active_date }}</p>
                            
                            </div>
                        </div>
                        <!--<div class="see-all">-->
                        <!--    <img src="{{ Auth::user()->profile_photo ? asset('profile/'.Auth::user()->profile_photo) : asset('assets/images/avatar/uc.png') }}" -->
                        <!--    style="max-width: 80px; height: 80px; border-radius: 50%; object-fit: cover; padding-right: 10px;">-->
                        <!--</div>-->
                    </div>
                </div>
                <div class="col-6">
                    <a href="/Ignite_Bonus"><div class="product-box" style="background-color: #0d3ff5;">
                        <div class="product-content">
                            <h5 style="color: #fff;">Ignite Incentive</h5><br>
                            <div class="bottom-content text-right">
                                <h4 class="text-right" style="color: #fff;">₹ {{ $ignite_payout ?? 0 }}</h4>
                                <div class="see-all">🤝</div>
                            </div>
                        </div>
                    </div></a>
                </div>
                <div class="col-6">
                    <a href="/Sales_Incentive"><div class="product-box" style="background-color: #0d3ff5;">
                        <div class="product-content">
                            <h5 style="color: #fff;">Sales Incentive</h5><br>
                            <div class="bottom-content">
                                <h4 style="color: #fff;">₹ {{ $unique_incentive_payout ?? 0 }}</h4>
                                <div class="see-all">🛒</div>
                            </div>
                        </div>
                    </div></a>
                </div>
                <div class="col-6">
                    <a href="Booster_Bonus"><div class="product-box" style="background-color: #0d3ff5;">
                        <div class="product-content">
                            <h5 style="color: #fff;">Booster Bonus</h5><br>
                            <div class="bottom-content">
                                <h4 style="color: #fff;">₹ {{$booster_income}}
</h4>
                                <div class="see-all">❤️</div>
                            </div>
                        </div>
                    </div></a>
                </div>
                <div class="col-6">
                    <a href="/Team_Performance_Bonus"><div class="product-box" style="background-color: #0d3ff5;">
                        <div class="product-content">
                            <h5 style="color: #fff;">Team Performance<br>Bonus</h5>
                            <div class="bottom-content">
                                <h4 style="color: #fff;">₹ {{ $team_performance_payout ?? 0 }}</h4>
                                <div class="see-all">🧑‍🤝‍🧑</div>
                            </div>
                        </div>
                    </div></a>
                </div>
                <div class="col-6">
                    <a href="/Global_Bonus"><div class="product-box" style="background-color: #0d3ff5;">
                        <div class="product-content">
                            <h5 style="color: #fff;">Global Matrix<br>Bonus</h5>
                            <div class="bottom-content">
                                <h4 style="color: #fff;">₹ {{ $global_bonus_payout ?? 0 }}</h4>
                                <div class="see-all">🌍</div>
                            </div>
                        </div>
                    </div></a>
                </div>
                <div class="col-6">
                    <a href="/Fast_Track_Bonus"><div class="product-box" style="background-color: #0d3ff5;">
                        <div class="product-content">
                            <h5 style="color: #fff;">Fast Track<br>Bonus</h5>
                            <div class="bottom-content">
                                <h4 style="color: #fff;">₹ {{ $fast_track_payout ?? 0 }}</h4>
                                <div class="see-all">⏩</div>
                            </div>
                        </div>
                    </div></a>
                </div>
                <div class="col-6">
                    <a href="/Achievement_Bonus"><div class="product-box" style="background-color: #0d3ff5;">
                        <div class="product-content">
                            <h5 style="color: #fff;">Achievement<br>Bonus</h5>
                            <div class="bottom-content">
                                <h4 style="color: #fff;">₹ {{ $achievement_payout ?? 0 }}</h4>
                                <div class="see-all">🏆</div>
                            </div>
                        </div>
                    </div></a>
                </div>
                <div class="col-6">
                    <a href="/Repurchase_Level_Bonus"><div class="product-box" style="background-color: #0d3ff5;">
                        
                            <div class="product-content">
                                <h5 style="color: #fff;">Re-Purchase<br>Level Bonus</h5>
                                <div class="bottom-content">
                                    <h4 style="color: #fff;">₹ {{ $repurchase_level_payout ?? 0 }}</h4>
                                    <div class="see-all">🎚️</div>
                                </div>
                            </div>
                            
                    </div></a>
                </div>
                <div class="col-6">
                    <a href="/Leader_Level"><div class="product-box" style="background-color: #0d3ff5;">
                        <div class="product-content">
                            <h5 style="color: #fff;">Leader Level<br>Bonus</h5>
                            <div class="bottom-content">
                                <h4 style="color: #fff;">₹ 0</h4>
                                <div class="see-all">🏅</div>
                            </div>
                        </div>
                    </div></a>
                </div>
                <div class="col-6">
                    <a href="/Leader_Matrix"><div class="product-box" style="background-color: #0d3ff5;">
                        <div class="product-content">
                            <h5 style="color: #fff;">Leader Matrix<br>Bonus</h5>
                            <div class="bottom-content">
                                <h4 style="color: #fff;">₹ 0</h4>
                                <div class="see-all">🎖️</div>
                            </div>
                        </div>
                    </div></a>
                </div>
                
                <div class="col-12">
                    <a href="/UC_Wallet"><div class="product-box" style="background: linear-gradient(90deg,rgba(205, 255, 41, 1) 0%, rgba(161, 255, 200, 1) 50%, rgba(255, 237, 33, 1) 100%);">
                        <div class="product-content">
                            <h5 style="color: #000000;">Total Earnings</h5><br>
                            <div class="bottom-content">
                                <h4 style="color: #000000;">₹ {{ $total_payout ?? 0 }}</h4>
                                <div class="see-all">💳</div>
                            </div>
                        </div>
                    </div></a>
                </div>
                
                
            </div>
        </div>
    </section>

    <!--<section>-->
    <!--    <div class="custom-container">-->
    <!--        <div class="title">-->
    <!--            <div class="d-flex align-items-center gap-2">-->
    <!--                <h3>Your Re-Birth & Re-Purchase IDs!</h3>-->
    <!--            </div>-->
    <!--        </div><br>-->
    <!--        <div class="row g-3">-->
    <!--            <div class="col-6">-->
    <!--                <button class="p-2 btn btn-primary w-100"><b>{{$is_active}}</b></button>-->
    <!--            </div>-->
    <!--            <div class="col-6">-->
    <!--                <button class="p-2 btn btn-info w-100"><b>RP975242</b></button>-->
    <!--            </div>-->
    <!--            <div class="col-6">-->
    <!--                <button class="p-2 btn btn-info w-100"><b>RP175392</b></button>-->
    <!--            </div>-->
    <!--            <div class="col-6">-->
    <!--                <button class="p-2 btn btn-info w-100"><b>RP496278</b></button>-->
    <!--            </div>-->
                
    <!--        </div>-->
    <!--    </div>-->
    <!--</section><br><br>-->
    <br><br>

    

    
   
   
@endsection