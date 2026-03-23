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
                <a onclick="history.back();">
                    <img class="img-fluid icon-btn back-arrow" src="assets/images/svg/back-arrow.svg" alt="back-arrow">
                </a>
                <h3>Transaction History</h3>
            </div>
        </div>
    </header>
    <!-- header end -->

    <!-- help section starts -->
    <section class="order-section pt-0">
        <ul class="nav nav-Tabs order-tab custom-scrollbar px-20" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="faqs-tab" data-bs-toggle="tab" data-bs-target="#faqs-tab-pane"
                    type="button" role="tab">Withdraw</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane"
                    type="button" role="tab">Activation</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="termss-tab" data-bs-toggle="tab" data-bs-target="#termss-tab-pane"
                    type="button" role="tab">Wallet Usage</button>
            </li>
        </ul>

        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="faqs-tab-pane" role="tabpanel" tabindex="0">
                <div class="custom-container">
                    <div class="table table-responsive">
                        <table id="recent-orders" class="table text-center">
                            <thead>
                                <tr>
                                    <th class="border-top-0">S.No</th>
                                    <th class="border-top-0">Requested Date</th>
                                    <th class="border-top-0">Requested Amount</th>
                                    <th class="border-top-0">Processed Date</th>
                                    <th class="border-top-0">Processed Amount</th>
                                    <th class="border-top-0">Platform Fee</th>
                                    <th class="border-top-0">Status</th>
                                    <th class="border-top-0">Remarks</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $total=0; @endphp
                                @foreach($withdraw as $index => $withdraw)
                                  @if($withdraw->status !== 'cancel')
        @php $total += $withdraw->payout; @endphp
    @endif
                                <tr>
                                    <td class="text-truncate">{{ $index + 1 }}</td>
                                    <td class="text-truncate">{{ \Carbon\Carbon::parse($withdraw->created_at)->format('d-m-Y H:i') }}</td>
                                    <td class="text-truncate">₹ {{ $withdraw->payout }}</td>
                                    <td class="text-truncate">
                                        {{ $withdraw->updated_at ? \Carbon\Carbon::parse($withdraw->updated_at)->format('d-m-Y H:i') : '-' }}
                                    </td>
                                    <td class="text-truncate">₹ {{ $withdraw->netpay }}</td>
                                    <td class="text-truncate">₹ {{ $withdraw->service_charge }}</td>
                                    <td class="text-truncate">
                                        <a class="
                                            @if($withdraw->status == 'success') link-success
                                            @elseif($withdraw->status == 'pending') link-warning
                                            @else link-danger
                                            @endif
                                        ">
                                            {{ ucfirst($withdraw->status) }}
                                        </a>
                                    </td>
                                    <td class="text-truncate">{{ $withdraw->remarks ?? '-' }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th>Total  </th>
                                    <th>Deducted</th>
                                    <th></th>
                                    <th>₹ {{$total}}</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    
                </div>
            </div>
            <div class="tab-pane fade" id="contact-tab-pane" role="tabpanel" tabindex="0">
                <div class="custom-container">
                    <div class="table table-responsive">
                        <table id="recent-orders" class="table text-center">
                            <thead>
                                <tr>
                                    <th class="border-top-0">S.No</th>
                                    <th class="border-top-0">Date</th>
                                    <th class="border-top-0">Activated ID</th>
                                    <th class="border-top-0">Member Name</th>
                                    <th class="border-top-0">Deducted Amount</th>
                                    <th class="border-top-0">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $total=0; @endphp
                                @foreach($activation as $index => $item)
                                
                                 @if($item->activation_status !== 'cancel')
        @php $total += 1600; @endphp
    @endif
                                <tr>
                                    <td class="text-truncate">{{ $index + 1 }}</td>
                                    <td class="text-truncate">{{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y H:i') }}</td>
                                    <td class="text-truncate">₹ {{ $item->activation_id }}</td>
                                    <th></th>
                                       <td class="text-truncate">₹ 1600</td>
                                     <td class="text-truncate">
                                        <a class="
                                            @if($item->activation_status == 'success') link-success
                                            @elseif($item->activation_status == 'pending') link-warning
                                            @else link-danger
                                            @endif
                                        ">
                                            {{ ucfirst($item->activation_status) }}
                                        </a>
                                    </td>
                                <tr>
                                @endforeach              
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th>Total  </th>
                                    <th></th>
                                    <th></th>
                                    <th>₹ {{$total}}</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                </div>
            </div>
            <div class="tab-pane fade" id="termss-tab-pane" role="tabpanel" tabindex="0">
                <div class="custom-container">
                    <div class="table table-responsive">
                        <table id="recent-orders" class="table text-center">
                            <thead>
                                <tr>
                                    <th class="border-top-0">S.No</th>
                                    <th class="border-top-0">Date</th>
                                    <th class="border-top-0">Order #</th>
                                    <th class="border-top-0">Used Amount</th>
                                    <th class="border-top-0">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $total=0; @endphp
                                @foreach($orders as $index => $order)
                                @php $total+=$order->from_income_wallet; @endphp
                                <tr>
                                    <td class="text-truncate">{{ $index + 1 }}</td>
                                    <td class="text-truncate">
                                        {{ \Carbon\Carbon::parse($order->created_at)->format('d-m-Y H:i') }}
                                    </td>
                                    <td class="text-truncate">{{ $order->order_id }}</td>
                                    <td class="text-truncate">₹ {{ $order->from_income_wallet }}</td>
                                    <td class="text-truncate">
                                        <a class="{{ $order->status == 'success' ? 'link-success' : 'link-danger' }}">
                                            {{ ucfirst($order->status) }}
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th>Total  </th>
                                    <th>Withdraw</th>
                                    <th>₹ {{$total}}</th>  <th></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>                    

                </div>
            </div>
        </div>
    </section>
    <!-- help section end -->

    <!-- bootstrap js -->
    <script src="assets/js/bootstrap.bundle.min.js"></script>

    <!-- iconsax icon -->
    <script src="assets/js/iconsax-icon.js"></script>

    <!-- template-setting js -->
    <script src="assets/js/template-setting.js"></script>

    <!-- script js -->
    <script src="assets/js/script.js"></script>
</body>

</html>