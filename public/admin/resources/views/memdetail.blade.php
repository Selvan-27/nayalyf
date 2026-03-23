@extends('layout.admin') @section('content')
<div class="page-body">
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3> Member Details </h3>
                    </div>
                </div>
                <div class="col-lg-6">
                    <ol class="breadcrumb pull-right">
                        <li class="breadcrumb-item">
                            <a href="/admin_home">
                                <i data-feather="home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active">Members</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        
        <div class="row">
            <h4>Search By Member ID</h4>
            <form method="POST" action="/members_details">
                @csrf
                <div class="col-xl-8 col-md-6 xl-50">
                    <div class="card">    
                        <input type="text" name="member_id" class="form-control" placeholder="Enter Member ID" value="{{ $data['member_id'] ?? '' }}"> 
                    </div>
                </div>
                
                <div class="col-xl-4 col-md-6 xl-50">
                    <div class="card">
                        <button type="submit" class="btn btn-success">Search</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="row">
            <div class="col-xxl-3 col-md-6 xl-50">
                <div class="card o-hidden">
                    <div class="success-box card-body">
                        <div class="media static-top-widget align-items-center">
                            <div class="icons-widgets">
                                <div class="align-self-center text-center">
                                    <i data-feather="box" class="font-secondary"></i>
                                </div>
                            </div>
                            <div class="media-body media-doller">
                                <span class="m-0">Member Details</span>
                                <h5 class="mb-0" style="color: #000000">
                                    @if(isset($data['memberData']['member']) && $data['memberData']['member'])
                                        {{ $data['memberData']['member']->name ?? 'N/A' }} <br>
                                        <small>{{ $data['memberData']['member']->memberid ?? 'N/A' }}</small>
                                    @else
                                        No Member Found
                                    @endif
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-md-6 xl-50">
                <div class="card o-hidden">
                    <div class="success-box card-body">
                        <div class="media static-top-widget align-items-center">
                            <div class="icons-widgets">
                                <div class="align-self-center text-center">
                                    <i data-feather="message-square" class="font-success"></i>
                                </div>
                            </div>
                            <div class="media-body media-doller">
                                <span class="m-0">Sponsor Details</span>
                                <h5 class="mb-0" style="color: #000000">
                                    @if(isset($data['memberData']['sponsor']) && $data['memberData']['sponsor'])
                                        {{ $data['memberData']['sponsor']->name ?? 'N/A' }} <br>
                                        <small>{{ $data['memberData']['sponsor']->memberid ?? 'N/A' }}</small>
                                    @else
                                        No Sponsor Found
                                    @endif
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-md-6 xl-50">
                <div class="card o-hidden">
                    <div class="success-box card-body">
                        <div class="media static-top-widget align-items-center">
                            <div class="icons-widgets">
                                <div class="align-self-center text-center">
                                    <i data-feather="users" class="font-success"></i>
                                </div>
                            </div>
                            <div class="media-body media-doller">
                                <span class="m-0">Active From</span>
                                <h5 class="mb-0" style="color: #000000">
                                    @if(isset($data['memberData']['activation_date']) && $data['memberData']['activation_date'])
                                        {{ \Carbon\Carbon::parse($data['memberData']['activation_date'])->format('d/m/Y') }}
                                    @else
                                        Not Activated
                                    @endif
                                    @if(isset($data['memberData']['member']) && $data['memberData']['member'])
                                        <br><small>Sign-Up: {{ \Carbon\Carbon::parse($data['memberData']['member']->created_at)->format('d/m/Y') }}</small>
                                    @endif
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-md-6 xl-50">
                <div class="card o-hidden">
                    <div class="success-box card-body">
                        <div class="media static-top-widget align-items-center">
                            <div class="icons-widgets">
                                <div class="align-self-center text-center">
                                    <i data-feather="users" class="font-success"></i>
                                </div>
                            </div>
                            <div class="media-body media-doller">
                                <span class="m-0">Rank</span>
                                <h5 class="mb-0" style="color: #000000">
                                    {{ $data['memberData']['rank'] ?? 'Not Found' }}
                                    <br><small>Referrals: {{ count($data['memberData']['direct_referrals'] ?? []) }}</small>
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xxl-4 col-md-6 xl-50">
                <div class="card o-hidden">
                    <div class="success-box card-body">
                        <div class="media static-top-widget align-items-center">
                            <div class="icons-widgets">
                                <div class="align-self-center text-center">
                                    <i data-feather="activity" class="font-success"></i>
                                </div>
                            </div>
                            <div class="media-body media-doller">
                                <span class="m-0">Total Earnings</span>
                                <h3 class="mb-0" style="color: #000000">
                                    ₹ <span class="counter">{{ number_format($data['memberData']['total_earnings'] ?? 0, 2) }}</span>
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-4 col-md-6 xl-50">
                <div class="card o-hidden">
                    <div class="success-box card-body">
                        <div class="media static-top-widget align-items-center">
                            <div class="icons-widgets">
                                <div class="align-self-center text-center">
                                    <i data-feather="credit-card" class="font-success"></i>
                                </div>
                            </div>
                            <div class="media-body media-doller">
                                <span class="m-0">Withdrew</span>
                                <h3 class="mb-0" style="color: #000000">
                                    ₹ <span class="counter">{{ number_format($data['memberData']['total_withdrawn'] ?? 0, 2) }}</span>
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-4 col-md-6 xl-50">
                <div class="card o-hidden">
                    <div class="success-box card-body">
                        <div class="media static-top-widget align-items-center">
                            <div class="icons-widgets">
                                <div class="align-self-center text-center">
                                    <i data-feather="briefcase" class="font-success"></i>
                                </div>
                            </div>
                            <div class="media-body media-doller">
                                <span class="m-0">Wallet Balance</span>
                                <h3 class="mb-0" style="color: #000000">
                                    ₹ <span class="counter">{{ number_format($data['memberData']['wallet_balance'] ?? 0, 2) }}</span>
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        <div class="row">
            <div class="col-xxl-4 col-md-6 xl-50">
                <div class="card o-hidden">
                    <div class="success-box card-body">
                        <div class="media static-top-widget align-items-center">
                            <div class="icons-widgets">
                                <div class="align-self-center text-center">
                                    <i data-feather="users" class="font-success"></i>
                                </div>
                            </div>
                            <div class="media-body media-doller">
                                <span class="m-0">Ignite Bonus</span>
                                <h3 class="mb-0" style="color: #000000">
                                    ₹ <span class="counter">320</span><small>Count: 2</small>
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-4 col-md-6 xl-50">
                <div class="card o-hidden">
                    <div class="success-box card-body">
                        <div class="media static-top-widget align-items-center">
                            <div class="icons-widgets">
                                <div class="align-self-center text-center">
                                    <i data-feather="repeat" class="font-success"></i>
                                </div>
                            </div>
                            <div class="media-body media-doller">
                                <span class="m-0">Re-Ignite Bonus</span>
                                <h3 class="mb-0" style="color: #000000">
                                    ₹ <span class="counter">160</span><small>Count: 1</small>
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-4 col-md-6 xl-50">
                <div class="card o-hidden">
                    <div class="success-box card-body">
                        <div class="media static-top-widget align-items-center">
                            <div class="icons-widgets">
                                <div class="align-self-center text-center">
                                    <i data-feather="shopping-bag" class="font-success"></i>
                                </div>
                            </div>
                            <div class="media-body media-doller">
                                <span class="m-0">Repurchase Bonus</span>
                                <h3 class="mb-0" style="color: #000000">
                                    ₹ <span class="counter">40</span><small></small>
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        <div class="row">
            <div class="col-xxl-3 col-md-6 xl-50">
                <div class="card o-hidden">
                    <div class="success-box card-body">
                        <div class="media static-top-widget align-items-center">
                            <div class="icons-widgets">
                                <div class="align-self-center text-center">
                                    <i data-feather="box" class="font-secondary"></i>
                                </div>
                            </div>
                            <div class="media-body media-doller">
                                <span class="m-0">Team Performance Bonus</span>
                                <h3 class="mb-0" style="color: #000000">
                                    ₹ <span class="counter">9856</span><small> This Month</small>
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-md-6 xl-50">
                <div class="card o-hidden">
                    <div class="success-box card-body">
                        <div class="media static-top-widget align-items-center">
                            <div class="icons-widgets">
                                <div class="align-self-center text-center">
                                    <i data-feather="message-square" class="font-success"></i>
                                </div>
                            </div>
                            <div class="media-body media-doller">
                                <span class="m-0">Global Bonus</span>
                                <h3 class="mb-0" style="color: #000000">
                                    ₹ <span class="counter">893</span><small> This Month</small>
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-md-6 xl-50">
                <div class="card o-hidden">
                    <div class="success-box card-body">
                        <div class="media static-top-widget align-items-center">
                            <div class="icons-widgets">
                                <div class="align-self-center text-center">
                                    <i data-feather="users" class="font-success"></i>
                                </div>
                            </div>
                            <div class="media-body media-doller">
                                <span class="m-0">Fast Track Bonus</span>
                                <h3 class="mb-0" style="color: #000000">
                                    ₹ <span class="counter">5631</span><small> This Month</small>
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-md-6 xl-50">
                <div class="card o-hidden">
                    <div class="success-box card-body">
                        <div class="media static-top-widget align-items-center">
                            <div class="icons-widgets">
                                <div class="align-self-center text-center">
                                    <i data-feather="users" class="font-success"></i>
                                </div>
                            </div>
                            <div class="media-body media-doller">
                                <span class="m-0">Achievement Bonus</span>
                                <h3 class="mb-0" style="color: #000000">
                                    ₹ <span class="counter">5631</span><small> This Month</small>
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="card">
            <!--<div class="card-header">
                <a href="#" class="btn btn-primary mt-md-0 mt-2">Download Report</a>
            </div>-->

            <div class="card-body vendor-table">
                <h3>Direct Referrals of 
                    @if(isset($data['memberData']['member']) && $data['memberData']['member'])
                        {{ $data['memberData']['member']->name ?? 'N/A' }} | {{ $data['memberData']['member']->memberid ?? 'N/A' }}
                    @else
                        No Member Selected
                    @endif
                </h3>
                <table class="table-responsive text-center" id="basic-1">
                    <thead>
                        <tr>
                            <th>Member</th>
                            <th>Member ID</th>
                            <th>Rank</th>
                            <th>Refer Count</th>
                            <th>Active Date</th>
                            <th>Mobile</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($data['memberData']['direct_referrals']) && count($data['memberData']['direct_referrals']) > 0)
                            @foreach($data['memberData']['direct_referrals'] as $referral)
                                <tr>
                                    <td>
                                        <div class="d-flex vendor-list">
                                            <img src="assets/images/team/2.jpg" alt=""
                                                class="img-fluid img-40 rounded-circle blur-up lazyloaded">
                                            <span>{{ $referral->name ?? 'N/A' }}</span>
                                        </div>
                                    </td>
                                    <td>{{ $referral->memberid ?? 'N/A' }}</td>
                                    <td>
                                        @php
                                            $referralCount = \App\Models\mlm_plan::where('sponser_id', $referral->memberid)->count();
                                        @endphp
                                        @if($referralCount >= 10) Gold
                                        @elseif($referralCount >= 5) Silver  
                                        @elseif($referralCount >= 1) Distributor
                                        @else Member
                                        @endif
                                    </td>
                                    <td>{{ \App\Models\mlm_plan::where('sponser_id', $referral->memberid)->count() }}</td>
                                    <td>
                                        @if($referral->activationQueue)
                                            {{ \Carbon\Carbon::parse($referral->activationQueue->created_at)->format('d/m/Y') }}
                                        @else
                                            Not Active
                                        @endif
                                    </td>
                                    <td>{{ $referral->mobile ?? 'N/A' }}</td>
                                    <td>
                                        <div>
                                            <i class="fa fa-eye me-2 font-success"></i>
                                            <i class="fa fa-edit font-primary"></i>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7" class="text-center">No direct referrals found</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            
            
        </div>
    </div>
    <div class="container-fluid">
        <div class="card">
            <div class="row">
                <div class="col-xxl-4 col-md-6 xl-50">
                    <div class="card">
                        <div class="card-header">
                            <h5>Re-Birth IDs</h5>
                            <div class="card-header-right">
                                <ul class="list-unstyled card-option">
                                    <li><i class="icofont icofont-simple-left"></i></li>
                                    <li><i class="view-html fa fa-code"></i></li>
                                    <li>
                                        <i class="icofont icofont-maximize full-card"></i>
                                    </li>
                                    <li>
                                        <i class="icofont icofont-minus minimize-card"></i>
                                    </li>
                                    <li>
                                        <i class="icofont icofont-refresh reload-card"></i>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="user-status table-responsive latest-order-table">
                                <table class="table table-bordernone text-center">
                                    <thead>
                                        <tr>
                                            <th scope="col">Count</th>
                                            <th scope="col">ID No.</th>
                                            <th scope="col">Active From</th>
                                            <th scope="col">View</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(isset($data['memberData']['rebirth_ids']) && count($data['memberData']['rebirth_ids']) > 0)
                                            @foreach($data['memberData']['rebirth_ids'] as $index => $rebirth)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td class="digits">{{ $rebirth->memberid }}</td>
                                                    <td class="font-danger">{{ \Carbon\Carbon::parse($rebirth->created_at)->format('d/m/Y') }}</td>
                                                    <td><i class="fa fa-eye me-2 font-success"></i></td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="4" class="text-center">No Re-Birth IDs found</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                                <a href="order.html" class="btn btn-primary mt-4">View All RB IDs</a>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="col-xxl-4 col-md-6 xl-50">
                    <div class="card">
                        <div class="card-header">
                            <h5>Re-Purchase IDs</h5>
                            <div class="card-header-right">
                                <ul class="list-unstyled card-option">
                                    <li><i class="icofont icofont-simple-left"></i></li>
                                    <li><i class="view-html fa fa-code"></i></li>
                                    <li>
                                        <i class="icofont icofont-maximize full-card"></i>
                                    </li>
                                    <li>
                                        <i class="icofont icofont-minus minimize-card"></i>
                                    </li>
                                    <li>
                                        <i class="icofont icofont-refresh reload-card"></i>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="user-status table-responsive latest-order-table">
                                <table class="table table-bordernone text-center">
                                    <thead>
                                        <tr>
                                            <th scope="col">Count</th>
                                            <th scope="col">ID No.</th>
                                            <th scope="col">Active From</th>
                                            <th scope="col">View</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(isset($data['memberData']['repurchase_ids']) && count($data['memberData']['repurchase_ids']) > 0)
                                            @foreach($data['memberData']['repurchase_ids'] as $index => $repurchase)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td class="digits">{{ $repurchase->memberid }}</td>
                                                    <td class="font-danger">{{ \Carbon\Carbon::parse($repurchase->created_at)->format('d/m/Y') }}</td>
                                                    <td><i class="fa fa-eye me-2 font-success"></i></td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="4" class="text-center">No Re-Purchase IDs found</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                                <a href="order.html" class="btn btn-primary mt-4">View All RP IDs</a>
                            </div>
                        </div>


                    </div>
                </div>
                <div class="col-xxl-4 col-md-6 xl-50">
                    <div class="card">
                        <div class="card-header">
                            <h5>Fast Track IDs</h5>
                            <div class="card-header-right">
                                <ul class="list-unstyled card-option">
                                    <li><i class="icofont icofont-simple-left"></i></li>
                                    <li><i class="view-html fa fa-code"></i></li>
                                    <li>
                                        <i class="icofont icofont-maximize full-card"></i>
                                    </li>
                                    <li>
                                        <i class="icofont icofont-minus minimize-card"></i>
                                    </li>
                                    <li>
                                        <i class="icofont icofont-refresh reload-card"></i>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="user-status table-responsive latest-order-table">
                                <table class="table table-bordernone text-center">
                                    <thead>
                                        <tr>
                                            <th scope="col">Count</th>
                                            <th scope="col">ID No.</th>
                                            <th scope="col">Active From</th>
                                            <th scope="col">View</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(isset($data['memberData']['fast_track_ids']) && count($data['memberData']['fast_track_ids']) > 0)
                                            @foreach($data['memberData']['fast_track_ids'] as $index => $fasttrack)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td class="digits">{{ $fasttrack->memberid }}</td>
                                                    <td class="font-danger">{{ \Carbon\Carbon::parse($fasttrack->created_at)->format('d/m/Y') }}</td>
                                                    <td><i class="fa fa-eye me-2 font-success"></i></td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="4" class="text-center">No Fast Track IDs found</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                                <a href="order.html" class="btn btn-primary mt-4">View All FT IDs</a>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@stop