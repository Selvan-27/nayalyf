@extends('layout.admin') @section('content')
<div class="page-body">
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3> Members Fast Track ID List </h3>
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
                            <th>FT ID No.</th>
                            <th>FT Active Date</th>
                            <th>Fast Track 1 Bonus</th>
                            <th>Achieve Date</th>
                            <th>Fast Track 2 Bonus</th>
                            <th>Achieve Date</th>
                            <th>Total Income</th>
                            <th>FT Rebirths</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($data['fast_track_members']) && count($data['fast_track_members']) > 0)
                            @foreach($data['fast_track_members'] as $member)
                            <tr>
                                <td>
                                    <div class="d-flex vendor-list">
                                        <img src="assets/images/team/2.jpg" alt=""
                                            class="img-fluid img-40 rounded-circle blur-up lazyloaded">
                                        <span>{{ $member->owner_name ?? 'N/A' }} <br><small>{{ $member->owner_id ?? 'N/A' }}</small></span>
                                    </div>
                                </td>
                                <td>{{ $member->ft_id }}</td>
                                <td>{{ $member->ft_active_date ? \Carbon\Carbon::parse($member->ft_active_date)->format('d/m/Y') : 'N/A' }}</td>
                                <td>₹ {{ number_format($member->fast_track_1_bonus, 2) }}</td>
                                <td>{{ $member->fast_track_1_date ? \Carbon\Carbon::parse($member->fast_track_1_date)->format('d/m/Y') : 'N/A' }}</td>
                                <td>₹ {{ number_format($member->fast_track_2_bonus, 2) }}</td>
                                <td>{{ $member->fast_track_2_date ? \Carbon\Carbon::parse($member->fast_track_2_date)->format('d/m/Y') : 'N/A' }}</td>
                                <td>₹ {{ number_format($member->total_income, 2) }}</td>
                                <td>
                                    @if(count($member->ft_rebirths) > 0)
                                        @foreach($member->ft_rebirths as $rebirth)
                                            {{ $rebirth }}<br>
                                        @endforeach
                                    @else
                                        N/A
                                    @endif
                                </td>
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
                                <td colspan="10" class="text-center">No fast track members found</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            
            
            
        </div>
    </div>




</div>
@stop