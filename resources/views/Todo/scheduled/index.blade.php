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
        .address-box {
            list-style: none;
        }

        .address-card {
            background: #fff;
            border-radius: 12px;
            padding: 15px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
            cursor: pointer;
            position: relative;
        }

        .address-card:hover {
            background: #f4f7ff;
            transform: translateY(-3px);
            box-shadow: 0 4px 14px rgba(0,0,0,0.1);
        }

        .address-card a {
            z-index: 2;
            position: relative;
        }
    </style>
    
    <body>
    <!-- loader start-->
    <div class="loader-wrapper" id="loader">
        <span class="loader"></span>
    </div>
    <!-- loader end -->

    <!-- header starts -->
    <header class="main-header">
        <div class="custom-container">
            <div class="header-panel">
                <a onclick="history.back();">
                    <img class="img-fluid icon-btn back-arrow" src="assets/images/svg/back-arrow.svg" alt="back-arrow">
                </a>
                <h3>Uniq ToDo Challenges</h3>
            </div>
        </div>
    </header>
    <!-- header end -->
<br>
    
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold">📅 Scheduled Calls</h3>
    <a href="{{ route('scheduled.create') }}" class="btn btn-gradient">➕ Schedule Call</a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="container py-4">
<div class="row g-4">
     <ul class="address-listing">
                
                  @forelse($scheduledCalls as $index => $call)
                    
                <li class="w-100 address-box">
                    <a  href="{{ route('scheduled.edit', $call->id) }}">
                    <div class="card address-card" >
                        <div class="d-flex justify-content-between align-items-start">
                          <span class="badge bg-primary">{{ $index + 1 }}</span>
                            <div>
                                <h4 class="fw-bold theme-color">{{ $call->name }}</h4>
                                <h6 class="fw-bold title-color">{{ $call->phone_number }}</h6>
                            </div>
                     
                            <!--<a href="{{ route('scheduled.edit', $call->id) }}" class="theme-color fw-medium" -->
                            <!--style="border: 1px solid; padding: 10px; border-radius: 30px">-->
                            <!--    <img src="assets/images/svg/edit.svg" alt="edit">-->
                            <!--</a>-->
                            <div class="address-content">
                            <p class="text-white-50 mb-2">strong>🗒️ Notes:</strong> {{ $call->notes ?? '—' }}</p>
                            <p class="mb-2"><strong>📆</strong> {{ \Carbon\Carbon::parse($call->scheduled_date)->format('d M Y, h:i A') }}</p>
                          
                        </div>
                        </div>
                        
                    </div>
                    </a>
                </li>
                  @empty
        <div class="col-12 text-center text-light mt-5">
            <p>No scheduled calls yet.</p>
        </div>
    @endforelse
            </ul>
            


</div>
</div>
    <!-- languages section end -->
        <div class="panel-space"></div>
    

    <!-- bootstrap js -->
    <script src="assets/js/bootstrap.bundle.min.js"></script>

    <!-- iconsax icon -->
    <script src="assets/js/iconsax-icon.js"></script>

    <!-- homescreen popup icon -->
    <script src="assets/js/homescreen-popup.js"></script>

    <!-- template-setting js -->
    <script src="assets/js/template-setting.js"></script>

    <!-- script js -->
    <script src="assets/js/script.js"></script>

    <script>
        const accordions = document.querySelectorAll('.accordion-header');
        accordions.forEach(header => {
            header.addEventListener('click', () => {
                header.classList.toggle('active');
                const content = header.nextElementSibling;
                if (content.classList.contains('show')) {
                    content.classList.remove('show');
                } else {
                    document.querySelectorAll('.accordion-content').forEach(c => c.classList.remove('show'));
                    document.querySelectorAll('.accordion-header').forEach(h => h.classList.remove('active'));
                    content.classList.add('show');
                    header.classList.add('active');
                }
            });
        });
    </script>


    

</body>

</html>
