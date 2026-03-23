<!DOCTYPE html>
<html lang="en">


<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Uniq Connect">
    <meta name="keywords" content="Uniq Connect">
    <meta name="author" content="Uniq Connect">
    <link rel="manifest" href="manifest.json">
    <link rel="icon" href="assets/images/logo/favicon.png" type="image/x-icon">
    <title>Uniq Connect</title>
    <link rel="apple-touch-icon" href="assets/images/logo/favicon.png">
    <meta name="theme-color" content="#2777FC">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="Uniq Connect">
    <meta name="msapplication-TileImage" content="assets/images/logo/favicon.png">
    <meta name="msapplication-TileColor" content="#FFFFFF">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="assets/css/br-hendrix.css">
    <link rel="stylesheet" type="text/css" id="rtl-link" href="assets/css/vendors/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/swiper-bundle.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/iconsax.css">
    <link rel="stylesheet" id="change-link" type="text/css" href="assets/css/style.css">

    <style>
   

    .grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 30px 18px;
            max-width: 1000px;
            margin: auto;
        }

        .day-box {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
        }

        .day-title {
            font-weight: bold;
            font-size: 18px;
        }

        .icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            color: white;
        }

        .green { background: #138a36; }
        .red { background: #d62828; }
        .gray { background: #666; }

        /* ===== Tablet ===== */
        @media (max-width: 768px) {
            .icon {
                width: 48px;
                height: 48px;
                font-size: 22px;
            }

            .day-title {
                font-size: 14px;
            }

            .grid {
                gap: 22px 10px;
            }
        }

        /* ===== Small Mobile ===== */
        @media (max-width: 480px) {
            .icon {
                width: 38px;
                height: 38px;
                font-size: 18px;
            }

            .day-title {
                font-size: 12px;
            }

            .grid {
                gap: 18px 6px;
            }

            body {
                padding: 15px;
            }
        }
    </style>

    <!-- Wellness Care Challenge -->
    <style>
    @keyframes wellPulse {
        0% {
            transform: scale(1);
            box-shadow: 0 0 0 0 rgba(46,164,79,0.45);
        }
        50% {
            transform: scale(1.08);
            box-shadow: 0 0 0 22px rgba(46,164,79,0);
        }
        100% {
            transform: scale(1);
            box-shadow: 0 0 0 0 rgba(46,164,79,0);
        }
    }
    </style>
    <!-- Wellness Care Challenge -->


    <!-- Heart Care Challenge -->
    <style>
    @keyframes heartBeat {
        0%   { transform: scale(1); }
        14%  { transform: scale(1.18); }
        28%  { transform: scale(1); }
        42%  { transform: scale(1.18); }
        70%  { transform: scale(1); }
        100% { transform: scale(1); }
    }
    </style>
    <!-- Heart Care Challenge -->


    <!-- Dia Care Challenge -->
    <style>
    /* breathing background */
    @keyframes glucoseBreath {
        0%,100% {
            box-shadow:0 0 0 0 rgba(80,150,255,0.35);
        }
        50% {
            box-shadow:0 0 0 24px rgba(80,150,255,0);
        }
    }

    /* glucose pulse */
    @keyframes glucosePulse {
        0%   { transform: scale(1); }
        50%  { transform: scale(1.18); }
        100% { transform: scale(1); }
    }

    /* outer ring */
    @keyframes glucoseRing {
        0% {
            transform: scale(0.85);
            opacity:0.7;
        }
        80% {
            transform: scale(1.35);
            opacity:0;
        }
        100% {
            opacity:0;
        }
    }
    </style>
    <!-- Dia Care Challenge -->

    <!-- Buttons Challenge -->
    <style>
        .dose-btn-neo{
            position:relative;
            width:100%;
            padding:16px 20px;
            font-size:16px;
            font-weight:500;
            color:#b6ff00;
            background:#0b0f0b;
            border:none;
            border-radius:999px;
            cursor:pointer;
            letter-spacing:.5px;
            overflow:visible;
            transition:transform .25s ease, opacity .25s ease;
        }

        /* neon running border */
        .dose-btn-neo::before{
            content:"";
            position:absolute;
            inset:-2px;
            border-radius:999px;
            padding:2px;
            background:linear-gradient(90deg,#b6ff00,#00e5ff,#b6ff00);
            background-size:300% 100%;
            animation:neonRun 3s linear infinite;
            -webkit-mask:
                linear-gradient(#000 0 0) content-box,
                linear-gradient(#000 0 0);
            -webkit-mask-composite:xor;
                    mask-composite:exclude;
        }

        /* glow */
        .dose-btn-neo::after{
            content:"";
            position:absolute;
            inset:0;
            border-radius:999px;
            box-shadow:0 0 18px rgba(182,255,0,.6);
            opacity:.8;
            z-index:-1;
        }

        /* text + tick */
        .btn-text{ position:relative; z-index:2; }
        .btn-tick{
            position:absolute;
            inset:0;
            display:flex;
            align-items:center;
            justify-content:center;
            font-size:20px;
            opacity:0;
            transform:scale(.5);
        }

        /* success morph */
        .dose-btn-neo.success .btn-text{ opacity:0; }
        .dose-btn-neo.success .btn-tick{
            opacity:1;
            transform:scale(1);
            transition:all .35s ease;
        }

        /* disabled */
        .dose-btn-neo:disabled{
            cursor:not-allowed;
            opacity:.6;
        }

        /* 🎆 PARTICLES */
        .burst{
            pointer-events:none;
            position:absolute;
            inset:0;
        }

        .burst i{
            position:absolute;
            width:6px;
            height:6px;
            border-radius:50%;
            background:#b6ff00;
            opacity:0;
        }

        .burst.active i{
            animation:particleExplode .8s ease-out forwards;
        }

        /* animations */
        @keyframes neonRun{
            0%{background-position:0% 50%;}
            100%{background-position:300% 50%;}
        }

        @keyframes particleExplode{
            0%{
                transform:translate(0,0) scale(1);
                opacity:1;
            }
            100%{
                transform:translate(var(--x), var(--y)) scale(.3);
                opacity:0;
            }
        }
        </style>
    <!-- Buttons Challenge -->
    



<style>
.week-grid {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    gap: 15px;
}

.day-card {
    border: 1px solid #ddd;
    padding: 15px;
    text-align: center;
    border-radius: 10px;
    background: #f9f9f9;
}

.day-title {
    font-weight: bold;
    margin-bottom: 10px;
}

.icon {
    font-size: 22px;
    margin: 5px 0;
}

.completed {
    background: #e6ffe6;
}

.missed {
    background: #ffe6e6;
}
</style>

</head>

<body>
    <!-- loader start-->
    <div class="loader-wrapper" id="loader">
        <span class="loader"></span>
    </div>
    <!-- loader end -->

    <!-- header start -->
    <header class="main-header">
        <div class="custom-container">
            <div class="header-panel">
                <a href="/Home">
                    <img class="img-fluid icon-btn back-arrow" src="assets/images/svg/back-arrow.svg" alt="back-arrow">
                </a>
                <h3>Healthy Challenge, Healthy Life!</h3>
                <a href="empty-notification.html" class="color-theme-color fw-normal fs-14 mt-1"></a>
            </div>
        </div>
    </header>
    <!-- header end -->


    <!-- Wellness Care Challenge -->
    <section class="section-sm-t-space section-b-space">
        <div class="custom-container">
            <div class="card" style="border-radius:18px; overflow:hidden; box-shadow:0 10px 30px rgba(0,0,0,0.08);">
                
                <div class="card-body" style="text-align:center; padding:40px 20px;">
                    <h4 class="card-title" style="margin-bottom:30px; font-weight:700;">
                        Wellness Care Challenge
                    </h4>

                    <!-- Holistic Wellness Animation -->
                    <div style="display:flex; justify-content:center; align-items:center;">
                        
                        <div style="
                            width:160px;
                            height:160px;
                            border-radius:50%;
                            position:relative;
                            background:radial-gradient(circle at center, #eaffea 0%, #c6f7d0 60%, #a8e6b0 100%);
                            box-shadow:0 0 0 0 rgba(46,164,79,0.4);
                            animation:wellPulse 2.8s infinite ease-in-out;
                            display:flex;
                            align-items:center;
                            justify-content:center;
                            font-size:42px;
                        ">
                            🌿
                        </div>

                    </div>

                    <p style="
                        margin-top:22px;
                        color:#666;
                        max-width:520px;
                        margin-left:auto;
                        margin-right:auto;
                        line-height:1.6;
                    ">
                        <strong>Embrace Holistic Wellness</strong><br>
                        Nourish Your Body, Calm Your Mind, & Energize Your Life<br>
                        With Uniq Connect's Wellness Care Challenge.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!-- Wellness Care Challenge -->


    <!-- Heart Care Challenge -->
    <section class="section-sm-t-space section-b-space">
        <div class="custom-container">
            <div class="card" style="border-radius:18px; overflow:hidden; box-shadow:0 10px 30px rgba(0,0,0,0.08);">
                
                <div class="card-body" style="text-align:center; padding:40px 20px;">
                    <h4 class="card-title" style="margin-bottom:30px; font-weight:700;">
                        Heart Care Challenge
                    </h4>

                    <!-- Heartbeat Wellness Animation -->
                    <div style="display:flex; justify-content:center; align-items:center;">
                        
                        <div style="
                            width:160px;
                            height:160px;
                            border-radius:50%;
                            position:relative;
                            background:radial-gradient(circle at center, #ffeaea 0%, #ffc9c9 60%, #ffb3b3 100%);
                            display:flex;
                            align-items:center;
                            justify-content:center;
                            font-size:44px;
                            animation:heartBeat 1.2s infinite ease-in-out;
                        ">
                            💓
                        </div>

                    </div>

                    <p style="
                        margin-top:22px;
                        color:#666;
                        max-width:520px;
                        margin-left:auto;
                        margin-right:auto;
                        line-height:1.6;
                    ">
                        <strong>Protect Your Heart Naturally</strong><br>
                        Strengthen Your Cardiovascular Health, Improve Circulation,<br>
                        & Live Stronger With Uniq Connect's Heart Care Challenge.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!-- Heart Care Challenge -->

    <!-- Diabetic Care Challenge -->
    <section class="section-sm-t-space section-b-space">
        <div class="custom-container">
            <div class="card" style="border-radius:18px; overflow:hidden; box-shadow:0 10px 30px rgba(0,0,0,0.08);">
                
                <div class="card-body" style="text-align:center; padding:40px 20px;">
                    <h4 class="card-title" style="margin-bottom:30px; font-weight:700;">
                        Diabetic Care Challenge
                    </h4>

                    <!-- Glucose Wellness Animation -->
                    <div style="display:flex; justify-content:center; align-items:center;">
                        
                        <div style="
                            width:180px;
                            height:180px;
                            border-radius:50%;
                            position:relative;
                            background:radial-gradient(circle at center, #88c0ff 0%, #cfe6ff 55%, #b3d7ff 100%);
                            display:flex;
                            align-items:center;
                            justify-content:center;
                            box-shadow:0 0 0 0 rgba(80,150,255,0.35);
                            animation:glucoseBreath 3s infinite ease-in-out;
                        ">

                            <!-- Sugar drop icon -->
                            <span style="
                                font-size:60px;
                                display:inline-block;
                                animation:glucosePulse 1.6s infinite ease-in-out;
                                filter: drop-shadow(0 6px 10px rgba(0,120,255,0.25));
                            ">🩸</span>

                            <!-- Pulse Ring -->
                            <span style="
                                position:absolute;
                                width:100%;
                                height:100%;
                                border-radius:50%;
                                border:3px solid rgba(80,150,255,0.35);
                                animation:glucoseRing 2.6s infinite ease-out;
                            "></span>

                        </div>

                    </div>

                    <p style="
                        margin-top:24px;
                        color:#666;
                        max-width:520px;
                        margin-left:auto;
                        margin-right:auto;
                        line-height:1.6;
                    ">
                        <strong>Balance Your Blood Sugar Naturally</strong><br>
                        Support Healthy Glucose Levels, Boost Metabolism & Live Better<br>
                        With Uniq Connect's Diabetic Care Challenge.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!-- Diabetic Care Challenge -->
@php
    $currentHour = now()->format('H');
@endphp

@if($currentHour >= 6 && $currentHour < 18)

  <!-- Morning challemge Button-->
  
    <section class="section-sm-t-space section-b-space">
    <div class="custom-container">
           <button id="doseBtn-mrng" class="dose-btn-neo" onclick="completeDose('Morning')">
                <span class="btn-text">🌞 Morning Dose Completed!</span>
                <span class="btn-tick">✓ Welldone</span>
                <span class="burst"></span>
            </button>
        </div>
    </section>
       <!-- Morning challenge Button -->


@else

   <!-- Evening challemge button-->
   
     <section class="section-sm-t-space section-b-space">
        <div class="custom-container">
            <button id="doseBtn-nit" class="dose-btn-neo" onclick="completeDose_ni8('night')">
                <span class="btn-text">🌙 Evening Dose Completed</span>
                <span class="btn-tick">✓ Congrats, Today Streak Completed!</span>
                <span class="burst"></span>
            </button>
        </div>
    </section>
     <!--Evening challenge Button -->
    
@endif

  
 


    
    


    
    




    
<div class="week-grid">
@foreach($week as $day)
    @php
        $item = $day['data'];
    @endphp

    <div class="day-card {{ ($item && $item->morning_opened && $item->night_opened) ? 'completed' : '' }}">
        
        <div class="day-title">
            {{ $day['date']->format('D') }} <br>
            {{ $day['date']->format('d M') }}
        </div>

        <div>
            <i>🌅 Morning</i>
            <span class="icon">
                {{ $item && $item->morning_opened ? '👍' : '👎' }}
            </span>
        </div>

        <div>
            <i>🌙 Night</i>
            
            <span class="icon">
                {{ $item && $item->night_opened ? '👍' : '👎' }}
            </span>
        </div>

    </div>
@endforeach
</div>
    
    


    <!-- days streak starts -->
    <section class="section-sm-t-space section-b-space">
        <div class="custom-container">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Your Days Streak</h4>
                    
                    <hr>
                    <div class="grid">

                       @foreach($datas as $index => $item)
                        <div class="day-box">
                            <div class="day-title">
                                Day {{ $index + 1 }}
                            </div>
                    
                            <div class="icon {{ $item->morning_opened ? 'green' : 'red' }} ">
                                {{ $item->morning_opened ? '👍' : '👎' }}
                            </div>
                    
                            <div class="icon {{ $item->night_opened ? 'green' : 'red' }} ">
                                {{ $item->night_opened ? '👍' : '👎' }}
                            </div>
                        </div>
                    @endforeach

                       
                    </div>
                </div>
            </div>
            
        </div>
    </section>
    <!-- days streak ends -->

    <!-- progress starts -->
    <section class="section-sm-t-space section-b-space">
        <div class="custom-container">
            <div class="element-title">
                <h3 class="theme-color">Your Challenge Progress count {{$tot_count}} ||  {{ round($tot_count*28/100)}} % </h3>
            </div>

            <div class="progressbar-list">
                <div class="progress mt-2" role="progressbar" aria-label="Basic example" aria-valuenow="{{round($tot_count*28/100)}}"
                    aria-valuemin="0" aria-valuemax="100">
                    <div class="progress-bar progress-bar-striped progress-bar-animated  w-25"></div>
                </div>
            </div>
        </div>
    </section>
    <!-- progress ends -->

    <!-- Rules & Regulations starts -->
    <section class="section-sm-t-space section-b-space">
        <div class="custom-container">
            <div class="card" style="border-radius:18px; overflow:hidden; box-shadow:0 12px 40px rgba(0,0,0,0.08); backdrop-filter:blur(10px); background:rgba(255,255,255,0.7); border:1px solid rgba(255,255,255,0.4);">
                
                <div class="card-body" style="padding:30px 24px;">
                    
                    <h4 style="font-weight:700; margin-bottom:18px; text-align:center;">
                        📜 Challenge Rules & Regulations
                    </h4>

                    <ul style="
                        margin:0;
                        padding-left:0;
                        list-style:none;
                        color:#555;
                        line-height:1.6;
                        font-size:14.5px;
                    ">
                        <li style="margin-bottom:10px;">
                            • Members must purchase the required product package to start the challenge.
                        </li>

                        <li style="margin-bottom:10px;">
                            • The product must be consumed twice daily — morning and evening.
                        </li>

                        <li style="margin-bottom:10px;">
                            • After each dose, members must click the respective Morning and Evening challenge buttons.
                        </li>

                        <li style="margin-bottom:10px;">
                            • All clicks are automatically recorded for verification.
                        </li>

                        <li style="margin-bottom:10px;">
                            • Rewards are eligible only for members who complete at least <strong>80% of the challenge</strong>.
                        </li>

                        <li>
                            • Eligible members will receive one additional set of the same product at free of cost - as <strong>Reward!</strong>.
                        </li>
                    </ul>

                    <div style="
                        margin-top:18px;
                        padding:14px 16px;
                        border-radius:12px;
                        background:linear-gradient(135deg,#eafff3,#f4fffb);
                        border:1px solid #c8f5dc;
                        font-size:14px;
                        color:#2e7d32;
                        text-align:center;
                        font-weight:600;
                    ">
                        ✅ Stay consistent. Track daily. Earn your wellness reward!
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- Rules & Regulations ends -->



    <div class="fixed-btn-grp">
        <div class="custom-container">
            <a href="payment.html" class="btn btn-mid theme-btn w-100">Continue </a>
        </div>
    </div>
    <!-- checkout section ends -->

    <!-- panel-space start -->
    <div class="panel-space"></div>
    <!-- panel-space end -->


    


    <!-- bootstrap js -->
    <script src="assets/js/bootstrap.bundle.min.js"></script>

    <!-- iconsax icon -->
    <script src="assets/js/iconsax-icon.js"></script>

    <!-- template-setting js -->
    <script src="assets/js/template-setting.js"></script>
    
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- script js -->
    <script src="assets/js/script.js"></script>

    <script>
        function createParticles(container){
            container.innerHTML = "";
            for(let i=0;i<14;i++){
                const p = document.createElement("i");

                const angle = Math.random()*360;
                const radius = 60 + Math.random()*40;
                const x = Math.cos(angle*Math.PI/180)*radius + "px";
                const y = Math.sin(angle*Math.PI/180)*radius + "px";

                p.style.setProperty("--x", x);
                p.style.setProperty("--y", y);
                p.style.left = "50%";
                p.style.top = "50%";

                container.appendChild(p);
            }
        }

 function completeDose(val) {

    $.ajax({
        url: "{{ route('challenge.morning') }}",
        type: "POST",
        data: {
            id: val,
            _token: "{{ csrf_token() }}"
        },
        success: function(response){
            console.log(response);
            $('#doseBtn-mrng').prop('disabled', true);
        },
        error: function(xhr){
            console.log(xhr.responseText);
        }
    });

}

 function completeDose_ni8(val) {

    $.ajax({
        url: "{{ route('challenge.night') }}",
        type: "POST",
        data: {
            id: val,
            _token: "{{ csrf_token() }}"
        },
        success: function(response){
            console.log(response);
            $('#doseBtn-nit').prop('disabled', true);
        },
        error: function(xhr){
            console.log(xhr.responseText);
        }
    });

}

function test(){
 const burst = btn.querySelector(".burst");

    if (btn.disabled) return;

    btn.classList.add("success");
    btn.disabled = true;

    createParticles(burst);
    burst.classList.add("active");
}
    </script>


    
</body>

</html>