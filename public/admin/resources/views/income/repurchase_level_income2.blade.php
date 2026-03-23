@extends('layout.admin') @section('content')
<div class="page-body">
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3> Repurchase Level Bonus List </h3>
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
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                   
                                    <form method="get" action="/reports">
    <select name="slot" class="form-select" onchange="this.form.submit()">
        <option value="">-- Select Cut-Off --</option>
        @foreach ($repurchase_cutoff_slots as $option)
            <option value="{{ $option->id }}" {{ request('slot') == $option->id ? 'selected' : '' }}>
                 {{  $option->name }}
            </option>
        @endforeach
    </select>
    
    <input type="hidden" name="type" value="repurchase_level_income2">
</form>

                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                
                <div class="card-body vendor-table">
                    <div class="card-header">
                        <!--<a href="#" class="btn btn-primary mt-md-0 mt-2">Download Report</a>-->
                    </div>
                    <h3 class="text-center">Re-Purchase Level Income List</h3>
                                   <table class="table-responsive text-center" id="basic-1">
                    <thead>
                        <tr>
                         <td>fromId</td>
                            <th>To Member</th>
                              <th>level</th>
                            <th>Date</th>
                           
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                          @foreach( $data as $item)
                        <tr>
            
            
                                <td>{{$item->fromId}}</td>
                            <td>
                                <div class="d-flex vendor-list">
                                    <img src="assets/images/team/2.jpg" alt=""
                                        class="img-fluid img-40 rounded-circle blur-up lazyloaded">
                                    <span>{{$item->tname}}<br><small>{{$item->memberid}}<br></small></span>
                                </div>
                            </td>
                                 <td>{{$item->level}}</td>
                        <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y') }}</td>

                            <td>₹ {{$item->payout}}</td>
                        </tr>
                            @endforeach
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>




</div>
@stop