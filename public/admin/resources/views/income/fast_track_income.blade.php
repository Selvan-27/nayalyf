@extends('layout.admin') @section('content')
<div class="page-body">
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3> Fasttrack Level Bonus List </h3>
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
                <!--<a href="#" class="btn btn-primary mt-md-0 mt-2">Download Report</a>-->
            </div>

            <div class="card-body vendor-table">
                
                <form method="get" action="/reports">
    <select name="board" class="form-select" onchange="this.form.submit()">
        <option value="">-- Select Board --</option>
        @for ($i = 1; $i <= 2; $i++)
            <option value="{{ $i }}" {{ request('board') == $i ? 'selected' : '' }}>
                Board {{ $i }}
            </option>
        @endfor
    </select>
    
    <input type="hidden" name="type" value="fast_track_income">
</form>

                <!--//----->
                
                <table class="table-responsive text-center" id="basic-1">
                    <thead>
                        <tr>
                      
                            <th>Member</th>
                            <th>Achieve Date</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                          @foreach( $data as $item)
                        <tr>
                            
                            <td>
                                <div class="d-flex vendor-list">
                                    <img src="assets/images/team/2.jpg" alt=""
                                        class="img-fluid img-40 rounded-circle blur-up lazyloaded">
                                    <span>{{$item->tname}}<br><small>{{$item->memberid}}<br></small></span>
                                </div>
                            </td>
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
@stop