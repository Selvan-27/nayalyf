@extends('layout.admin') @section('content')
<div class="page-body">
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3> Support Ticket List</h3>
                    </div>
                </div>
                <div class="col-lg-6">
                    <ol class="breadcrumb pull-right">
                        <li class="breadcrumb-item">
                            <a href="index.html">
                                <i data-feather="home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active">SupportTicket</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="card">
            <div class="row">
                <!--<form method="GET" action="{{ route('pos.orderlist') }}">-->
                <!--    <div class="col-xxl-3 col-md-6 xl-50">-->
                <!--        <div class="card">-->
                <!--            <p>Select From Date</p> -->
                <!--            <input type="date" name="from_date" class="form-control">-->
                <!--        </div>-->
                <!--    </div>-->
                <!--    <div class="col-xxl-3 col-md-6 xl-50">-->
                <!--        <div class="card">-->
                <!--            <p>Select To Date</p> -->
                <!--            <input type="date" name="to_date" class="form-control">-->
                <!--        </div>-->
                <!--    </div>-->
                <!--</form>-->
                <!--<div class="col-xxl-3 col-md-6 xl-50">-->
                <!--    <div class="card">-->
                <!--        <p></p>-->
                <!--        <a href="/order-list" class="btn btn-primary mt-md-0 mt-2">Refresh</a>-->
                <!--    </div>-->

            </div>
            <div class="card-body vendor-table">
                <table class="table table-responsive" id="basic-1">
                    <thead>
                        <tr>
                             <th>Ticket ID</th>
                <th>User</th>
                <th>Subject</th>
                <th>Status</th>
                <th>Created</th>
                <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                          @foreach ($tickets as $ticket)
                <tr>
                    <td>{{ $ticket->ticket_id }}</td>
                    <td>{{ $ticket->user->name ?? 'N/A' }}</td>
                    <td>{{ $ticket->subject }}</td>
                    <td>{{ ucfirst($ticket->status) }}</td>
                    <td>{{ $ticket->created_at->format('Y-m-d') }}</td>
                    <td><a href="{{ route('admin.support.show') }}?id={{$ticket->ticket_id}}" class="btn btn-sm btn-primary">View</a></td>
                </tr>
            @endforeach
                    </tbody>
                </table>    
               
      {{ $tickets->links() }}
        
                  
            </div>
        </div>
    </div>
</div>
@stop