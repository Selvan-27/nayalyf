@extends('layout.admin') @section('content')
<div class="page-body">
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3> Members List</h3>
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
            <!--<div class="row">-->

            <!--    <div class="col-xxl-3 col-md-6 xl-50">-->
            <!--        <div class="card">-->
            <!--            <p>Select From Date</p> <input type="date">-->
            <!--        </div>-->
            <!--    </div>-->
            <!--    <div class="col-xxl-3 col-md-6 xl-50">-->
            <!--        <div class="card">-->
            <!--            <p>Select To Date</p> <input type="date">-->
            <!--        </div>-->
            <!--    </div>-->
            <!--    <div class="col-xxl-3 col-md-6 xl-50">-->
            <!--        <div class="card">-->
            <!--            <p></p>-->
            <!--            <button class="btn btn-success">Search</button>-->
            <!--        </div>-->
            <!--    </div>-->
            <!--    <div class="col-xxl-3 col-md-6 xl-50">-->
            <!--        <div class="card">-->
            <!--            <p></p>-->
            <!--            <a href="#" class="btn btn-primary mt-md-0 mt-2">Download Report</a>-->
            <!--        </div>-->
            <!--    </div>-->

            <!--</div>-->
            <div class="card-body vendor-table">
                <table class="table table-responsive" id="basic-1">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Status</th>
                            <th>Member</th>
                            <th>Sponsor</th>
                            <th>Refer Count</th>
                            <th>Active Date</th>
                            <th>Activation By</th>
                            <th>Mobile</th>
                            <th>Join Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
               <td style="color: green">{{$item['status'] ? 'Active' : 'Inactive'; }}</td>
                            <td>
                                <div class="d-flex vendor-list">
                                    <img src="assets/images/team/2.jpg" alt=""
                                        class="img-fluid img-40 rounded-circle blur-up lazyloaded">
                                    <span>{{$item['name']}} <br><small>{{$item['memberid']}}</small></span>
                                </div>
                            </td>
                              <td>
                                <div class="d-flex vendor-list">
                                    <img src="assets/images/team/2.jpg" alt=""
                                        class="img-fluid img-40 rounded-circle blur-up lazyloaded">
                                    <span>{{$item['sponsor_name']}} <br><small>{{$item['sponsor_id']}}</small></span>
                                </div>
                            </td>
                            <td>{{$item['refer_count']}}/{{$item['refer_count_total']}}</td>
                            <td>{{$item['activation_date']}}</td>
                            <td>{{$item['activation_by']}}</td>
                           
                            <td>{{$item['mobile']}}</td>
                            <td>{{$item['jdate']}}</td>
                            <td>
                                 <div>
                                    <!--<a href="/members_details?id={{$item['memberid']}}"><i class="fa fa-eye me-2 font-success"></i></a>-->
                                    <a href="/members_edit?q={{$item['memberid']}}"><i class="fa fa-edit font-primary"></i></a>
                                </div>
                                </td>
            </tr>
        @endforeach
        
        
                        <!--<tr>-->
                        <!--    <td style="color: green">Active</td>-->
                        <!--    <td>-->
                        <!--        <div class="d-flex vendor-list">-->
                        <!--            <img src="assets/images/team/2.jpg" alt=""-->
                        <!--                class="img-fluid img-40 rounded-circle blur-up lazyloaded">-->
                        <!--            <span>Petey Cruiser <br><small>UC1020122<br>UCD</small></span>-->
                        <!--        </div>-->
                        <!--    </td>-->
                        <!--    <td>-->
                        <!--        <div class="d-flex vendor-list">-->
                        <!--            <img src="assets/images/team/2.jpg" alt=""-->
                        <!--                class="img-fluid img-40 rounded-circle blur-up lazyloaded">-->
                        <!--            <span>Petey Cruiser <br><small>UC1020122<br>UCD</small></span>-->
                        <!--        </div>-->
                        <!--    </td>-->
                        <!--    <td>5/8</td>-->
                        <!--    <td>08/03/2025<br><small>SIGNUP: 08/03/2025</small></td>-->
                        <!--    <td>Admin</td>-->
                            
                        <!--    <td>8110011112</td>-->
                        <!--    <td>08/03/2025</td>-->
                        <!--    <td>-->
                        <!--        <div>-->
                        <!--            <a href="/members_details"><i class="fa fa-eye me-2 font-success"></i></a>-->
                        <!--            <a href="/members_edit"><i class="fa fa-edit font-primary"></i></a>-->
                        <!--        </div>-->
                        <!--    </td>-->
                        <!--</tr>-->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@stop