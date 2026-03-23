@extends('layout.admin') @section('content')
<div class="page-body">
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3> Sales Incentive List </h3>
                    </div>
                </div>
                <div class="col-lg-6">
                    <ol class="breadcrumb pull-right">
                        <li class="breadcrumb-item">
                            <a href="/admin_home">
                                <i data-feather="home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active">Income Report</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <form method="GET" action="/incentive" class="row g-3">
                    <div class="col-md-3">
                        <label for="from_date" class="form-label">From Date</label>
                        <input type="date" class="form-control" id="from_date" name="from_date" value="{{ request('from_date') }}">
                    </div>
                    <div class="col-md-3">
                        <label for="to_date" class="form-label">To Date</label>
                        <input type="date" class="form-control" id="to_date" name="to_date" value="{{ request('to_date') }}">
                    </div>
                    <div class="col-md-3 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary me-2">Filter</button>
                        <a href="/incentive" class="btn btn-secondary">Clear</a>
                    </div>
                </form>
            </div>
            <div class="card-body vendor-table">
                <table class="table-responsive text-center" id="basic-1">
                    <thead>
                        <tr>
                            <th>From Member</th>
                            <th>To Member</th>
                            <th>Achieve Date</th>
                            <th>Order ID</th>
                            <th>Order Value</th>
                            <th>%</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach( $data as $item)
                        <tr>
                            <td>
                                <div class="d-flex vendor-list">
                                    <span>{{$item->fname ?? 'N/A'}} <br><small>{{$item->fromId ?? 'N/A'}}<br></small></span>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex vendor-list">
                                    <span>{{$item->tname ?? 'N/A'}}<br><small>{{$item->memberid ?? 'N/A'}}<br></small></span>
                                </div>
                            </td>
                            <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y') }}</td>
                            <td>{{$item->order_id ?? 'N/A'}}</td>
                            <td>₹ {{ number_format($item->order_value ?? 0, 2) }}</td>
                            <td>{{ number_format($item->percentage ?? 0, 2) }}%</td>
                            <td>₹ {{number_format($item->payout ?? 0, 2)}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@stop