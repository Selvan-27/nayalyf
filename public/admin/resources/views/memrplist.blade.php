@extends('layout.admin') @section('content')
<div class="page-body">
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3> Members Re-Purchase ID List </h3>
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
        <div class="card">
            <div class="card-header">
                <a href="#" class="btn btn-primary mt-md-0 mt-2">Download Report</a>
            </div>

            <div class="card-body vendor-table">
                
            <table class="table-responsive text-center" id="basic-1">
                    <thead>
                        <tr>
                            <th>Owner</th>
                            <th>RP ID No.</th>
                            <th>RP Active Date</th>
                            
                            <th>Team Per. Bonus</th>
                            <th>Global Bonus</th>
                            <th>Fast Track Bonus</th>
                            <th>Total Income</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($data['repurchase_members']) && count($data['repurchase_members']) > 0)
                            @foreach($data['repurchase_members'] as $member)
                            <tr>
                                <td>
                                    <div class="d-flex vendor-list">
                                        <img src="assets/images/team/2.jpg" alt=""
                                            class="img-fluid img-40 rounded-circle blur-up lazyloaded">
                                        <span>{{ $member->owner_name ?? 'N/A' }} <br><small>{{ $member->owner_memberid ?? 'N/A' }}<br>{{ $member->all_father_id ?? 'N/A' }}</small></span>
                                    </div>
                                </td>
                                <td>{{ $member->rp_id }}</td>
                                <td>{{ $member->activation_date ? \Carbon\Carbon::parse($member->activation_date)->format('d/m/Y') : 'Not Activated' }}</td>
                                <td>₹ {{ number_format($member->team_performance_bonus, 2) }}</td>
                                <td>₹ {{ number_format($member->global_bonus, 2) }}</td>
                                <td>₹ {{ number_format($member->fast_track_bonus, 2) }}</td>
                                <td>₹ {{ number_format($member->total_income, 2) }}</td>
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
                                <td colspan="8" class="text-center">No repurchase members found</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            
            
        </div>
    </div>




</div>
@stop