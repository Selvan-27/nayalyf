@extends('layout.admin') @section('content')
<div class="page-body">
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3> Income  -  {{$income_type}}</h3>
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
                
                <table class="table-responsive text-center" id="basic-1">
                  <thead>
        <tr>
            @if(isset($data[0]))
                @foreach(array_keys((array) $data[0]) as $column)
                    <th>{{ ucfirst(str_replace('_', ' ', $column)) }}</th>
                @endforeach
            @endif
        </tr>
    </thead>
                  @foreach($data as $row)
            <tr>
                @foreach((array) $row as $value)
                    <td>{{ $value }}</td>
                @endforeach
            </tr>
        @endforeach
                </table>
             
            
            
        </div>
    </div>




</div>
@stop


<!--<thead>-->
<!--        <tr>-->
<!--            <th>ID</th>-->
<!--            <th>From ID</th>-->
<!--            <th>Member ID</th>-->
<!--            <th>Payout</th>-->
<!--            <th>TDS</th>-->
<!--            <th>Service Charge</th>-->
<!--            <th>Net Pay</th>-->
<!--            <th>Eligibility Date</th>-->
<!--            <th>Release Date</th>-->
<!--            <th>Others</th>-->
<!--            <th>Pack</th>-->
<!--            <th>Topup ID</th>-->
<!--            <th>R Type</th>-->
<!--            <th>Updated At</th>-->
<!--            <th>Created At</th>-->
<!--            <th>Name</th>-->
<!--        </tr>-->
<!--    </thead>-->
<!--    <tbody>-->
       
<!--    </tbody>-->