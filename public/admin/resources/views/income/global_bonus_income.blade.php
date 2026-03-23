@extends('layout.admin') @section('content')
<div class="page-body">
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3> Global Bonus List </h3>
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
            

            <div class="card-body vendor-table">
                
                

                <!--//----->
                <h5>Board {{ request('board')}}</h5>
               
                
                <table class="table-responsive text-center" id="basic-1">
                    <thead>
                        <tr>
                            <th>From Member</th>
                            <th>From ID</th>
                            <th>To Member</th>
                            <th>To ID</th>
                            <th>Achieve Date</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                          @foreach( $data as $item)
                        <tr>
                            
                            <td>{{$item->fname}}</td>
                            <td>{{$item->fromId}}</td>
                            <td>{{$item->tname}}</td>
                            <td>{{$item->memberid}}</td>
                            <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y') }}</td>
                            <td>{{$item->payout}}</td>
                        </tr>
                            @endforeach
                    </tbody>
                </table>
            </div>
            
            
        </div>
    </div>




</div>
@stop