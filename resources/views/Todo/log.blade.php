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
    <link rel="icon" href="/assets/images/logo/favicon.png" type="image/x-icon">
    <title>Uniq Connect</title>
    <link rel="apple-touch-icon" href="assets/images/logo/favicon.png">
    <meta name="theme-color" content="#2777FC">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="Uniq Connect">
    <meta name="msapplication-TileImage" content="/assets/images/logo/favicon.png">
    <meta name="msapplication-TileColor" content="#FFFFFF">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="/assets/css/br-hendrix.css">
    <link rel="stylesheet" type="text/css" id="rtl-link" href="/assets/css/vendors/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/vendors/swiper-bundle.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/vendors/iconsax.css">
    <link rel="stylesheet" id="change-link" type="text/css" href="/assets/css/style.css">
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

</head>

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
                <h3>Your Contacts</h3>
            </div>
        </div>
    </header>
    <br>
    
<div class="card card-custom p-4 fade-in">
    <h4 class="fw-bold mb-3">
        📜 Schedule Log for <span class="text-info">{{ $contact->name }}</span>
    </h4>

    <div class="mb-3">
        <p><strong>Phone:</strong> {{ $contact->phone_number }}</p>
        <p>
            <strong>Status:</strong> 
            <span class="badge 
                {{ $contact->status == 'Active' ? 'badge-active' : 
                   ($contact->status == 'On Hold' ? 'badge-onhold' : 'badge-inactive') }}">
                {{ $contact->status }}
            </span>
        </p>
    </div>

    @if ($scheduledCalls->isEmpty())
        <p class="text-light">No scheduled calls found for this contact.</p>
    @else
        <div class="table-responsive">
            <table class="table table-striped table-borderless align-middle">
                <thead>
                    <tr class="text-white">
                        <th>#</th>
                        <th>Date & Time</th>
                        <th>Notes</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($scheduledCalls as $index => $call)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ \Carbon\Carbon::parse($call->scheduled_date)->format('d M Y, h:i A') }}</td>
                            <td>{{ $call->notes ?? '—' }}</td>
                            <td>
                                @php
                                    $badge = $call->status == 'Completed' ? 'badge-active' :
                                              ($call->status == 'Overdue' ? 'badge-overdue' : 'badge-pending');
                                @endphp
                                <span class="badge {{ $badge }}">{{ $call->status }}</span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    <div class="mt-3">
        <a href="{{ route('contacts.index') }}" class="btn btn-light">⬅️ Back to Contacts</a>
    </div>
</div>
    <!-- panel-space start -->
    <div class="panel-space"></div>
    <!-- panel-space end -->

    

   
    <!-- bootstrap js -->
    <script src="/assets/js/bootstrap.bundle.min.js"></script>

    <!-- iconsax icon -->
    <script src="/assets/js/iconsax-icon.js"></script>

    <!-- homescreen popup icon -->
    <script src="assets/js/homescreen-popup.js"></script>

    <!-- template-setting js -->
    <script src="assets/js/template-setting.js"></script>

    <!-- script js -->
    <script src="/assets/js/script.js"></script>
   

</body>

</html>
