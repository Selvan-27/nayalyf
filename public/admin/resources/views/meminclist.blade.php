@extends('layout.admin') @section('content')
<div class="page-body">
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3> Members Income List</h3>
                    </div>
                </div>
                <div class="col-lg-6">
                    <ol class="breadcrumb pull-right">
                        <li class="breadcrumb-item">
                            <a href="index.html">
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
            <form method="GET" action="{{ url('/members_income_list') }}">
                <div class="row">
                    <div class="col-xxl-3 col-md-6 xl-50">
                        <div class="card">
                            <p>Select From Date</p> 
                            <input type="date" name="from_date" value="{{ $data['from_date'] ?? '' }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-xxl-3 col-md-6 xl-50">
                        <div class="card">
                            <p>Select To Date</p> 
                            <input type="date" name="to_date" value="{{ $data['to_date'] ?? '' }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-xxl-3 col-md-6 xl-50">
                        <div class="card">
                            <p></p>
                            <button type="submit" class="btn btn-success">Search</button>
                        </div>
                    </div>
                    <div class="col-xxl-3 col-md-6 xl-50">
                        <div class="card">
                            <p></p>
                            <a href="#" class="btn btn-primary mt-md-0 mt-2">Download Report</a>
                        </div>
                    </div>
                </div>
            </form>
            <div class="card-body vendor-table">
                <table class="table table-responsive" id="basic-1">
                    <thead>
                        <tr>
                            <th>Member Name</th>
                            <th>Member ID</th>
                            <th>Active Date</th>
                            <th>Signup Date</th>
                            <th>Sales Incentive</th>
                            <th>Ignite Bonus</th>
                            <th>Team Per. Bonus</th>
                            <th>Global Bonus</th>
                            <th>Fast Track Bonus</th>
                            <th>Achievement Bonus</th>
                            <th>RePurchase Bonus</th>
                            <th>Leader Level</th>
                            <th>Leader Martix</th>
                            <th>Total Income</th>
                            <th>Withdraw</th>
                             <th>Shopping Usage</th> 
                             <th>Activation Usage</th> 
                            <th>Wallet Balance</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($data['members']) && count($data['members']) > 0)
                            @foreach($data['members'] as $member)
                                <tr>
                                    <td>{{ $member['name'] }}</td>
                                    <td>{{ $member['memberid'] }}</td>
                                    <td>{{ $member['activation_date'] ? \Carbon\Carbon::parse($member['activation_date'])->format('d/m/Y') : 'N/A' }}</td>
                                    <td>{{ \Carbon\Carbon::parse($member['signup_date'])->format('d/m/Y') }}</td>
                                    <td>{{ number_format($member['sales_incentive'], 2) }}</td>
                                    <td>{{ number_format($member['ignite_bonus'], 2) }}</td>
                                    <td>{{ number_format($member['team_performance_bonus'], 2) }}</td>
                                    <td>{{ number_format($member['global_bonus'], 2) }}</td>
                                    <td>{{ number_format($member['fast_track_bonus'], 2) }}</td>
                                    <td>{{ number_format($member['achievement_bonus'], 2) }}</td>
                                    <td>{{ number_format($member['repurchase_bonus'], 2) }}</td>
                                    <td>{{ number_format($member['leader_level_bonus'], 2) }}</td>
                                    <td>{{ number_format($member['leader_matrix_bonus'], 2) }}</td>
                                    <td><strong>{{ number_format($member['total_income'], 2) }}</strong></td>
                                    <td>{{ number_format($member['withdraw_payout'], 2) }}</td>
                                    <td><strong>{{ number_format($member['from_income_wallet'], 2) }}</strong></td>
                                    <td><strong>{{ number_format($member['activation_amt'], 2) }}</strong></td>
                                    <td><strong>{{ number_format($member['wallet_balance'], 2) }}</strong></td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="13" class="text-center">No data found for the selected criteria.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@stop