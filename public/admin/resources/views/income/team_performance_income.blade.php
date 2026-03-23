@extends('layout.admin') @section('content')
<div class="page-body">
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3> Team Performance Bonus List </h3>
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
            <!-- <div class="col-xl-4">
                <div class="card">
                    <div class="card-body">
                        <div class="profile-details text-center">
                            <img src="assets/images/dashboard/designer.jpg" alt=""
                                class="img-fluid img-90  blur-up lazyloaded">
                            <h5 class="f-w-600 mb-0">John deo</h5>
                            <span>johndeo@gmail.com</span>
                            <div class="social">
                                <div class="form-group btn-showcase">
                                    <button class="btn social-btn btn-fb d-inline-block"> <i
                                            class="fa fa-facebook"></i></button>
                                    <button class="btn social-btn btn-twitter d-inline-block"><i
                                            class="fa fa-google"></i></button>
                                    <button class="btn social-btn btn-google d-inline-block me-0"><i
                                            class="fa fa-twitter"></i></button>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="project-status">
                            <h5 class="f-w-600">Employee Status</h5>
                            <div class="media">
                                <div class="media-body">
                                    <h6>Performance<span class="pull-right">80%</span></h6>
                                    <div class="progress sm-progress-bar">
                                        <div class="progress-bar bg-primary" role="progressbar"
                                            style="width: 90%" aria-valuenow="25" aria-valuemin="0"
                                            aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="media">
                                <div class="media-body">
                                    <h6>Overtime <span class="pull-right">60%</span></h6>
                                    <div class="progress sm-progress-bar">
                                        <div class="progress-bar bg-secondary" role="progressbar"
                                            style="width: 60%" aria-valuenow="25" aria-valuemin="0"
                                            aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="media">
                                <div class="media-body">
                                    <h6>Leaves taken<span class="pull-right">70%</span></h6>
                                    <div class="progress sm-progress-bar">
                                        <div class="progress-bar bg-danger" role="progressbar"
                                            style="width: 70%" aria-valuenow="25" aria-valuemin="0"
                                            aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
            <div class="col-xl-12">
                <div class="card tab2-card">
                    <div class="card-body">
                        
                           <form method="get" action="/reports">
    <select name="board" class="form-select" onchange="this.form.submit()">
        <option value="">-- Select Board --</option>
        @for ($i = 1; $i <= 15; $i++)
            <option value="{{ $i }}" {{ request('board') == $i ? 'selected' : '' }}>
                Board {{ $i }}
            </option>
        @endfor
    </select>
    
    <input type="hidden" name="type" value="TEAM-PERFORMANCE">
</form>

                        
                        <div class="tab-content" id="top-tabContent">
                            <div class="tab-pane fade show active" id="top-b1" role="tabpanel" aria-labelledby="b1-tab">
                                <h5 class="f-w-600">Board {{ request('board')}}</h5>
                                <div class="card-body vendor-table">
                                    <table class="table-responsive text-center" id="basic-1">
                                        <thead>
                                            <tr>
                                                <th>Member</th>
                                                <th>Leg</th>
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
                                    <span>{{$item->fname}} <br><small>{{$item->fromId}}<br></small></span>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex vendor-list">
                                    <img src="assets/images/team/2.jpg" alt=""
                                        class="img-fluid img-40 rounded-circle blur-up lazyloaded">
                                    <span>{{$item->tname}}<br><small>{{$item->memberid}}<br></small></span>
                                </div>
                            </td>
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
                </div>
            </div>
        </div>
    </div>




</div>
@stop