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
                    <form>
                        <div class="form">
                            <div class="form-group row">
                                <label for="exampleFormControlSelect1"
                                    class="col-xl-3 col-sm-4 mb-0">Select Cut-Off:</label>
                                <div class="col-xl-8 col-sm-7">
                                    <select class="form-control digits" id="exampleFormControlSelect1">
                                        <option value="0">Select Cut-Off</option>
                                        <option value="1">25D1</option>
                                        <option value="2">25D2</option>
                                        <option value="3">25E1</option>
                                        <option value="4">25E2</option>
                                        
                                    </select>
                                </div>
                            </div>
                            
                        </div>
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
                        <a href="#" class="btn btn-primary mt-md-0 mt-2">Download Report</a>
                    </div>
                    <h3 class="text-center">[cut-off] Re-Purchase Level Income List</h3>
                    <table class="table table-responsive" id="basic-1">
                        <thead>
                            <tr>
                                
                                <th>Member</th>
                                <th>Cut-Off</th>
                                <th>Level 1 (₹ 40)</th>
                                <th>Level 2 (₹ 40)</th>
                                <th>Level 3 (₹ 30)</th>
                                <th>Level 3 (₹ 30)</th>
                                <th>Level 3 (₹ 30)</th>
                                <th>Level 3 (₹ 20)</th>
                                <th>Level 2 (₹ 10)</th>
                                <th>Level 1 (₹ 8)</th>
                                <th>Level 9 (₹ 8)</th>
                                <th>Level 10 (₹ 8)</th>
                                <th>Level 11 (₹ 8)</th>
                                <th>Level 12 (₹ 8)</th>
                                <th>Level 13 (₹ 5)</th>
                                <th>Level 14 (₹ 5)</th>
                                <th>Total Bonus</th>
                                
                                
                                
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="d-flex vendor-list">
                                        <img src="assets/images/team/2.jpg" alt=""
                                            class="img-fluid img-40 rounded-circle blur-up lazyloaded">
                                        <span>Petey Cruiser <br><small>UC1020122<br>UCD</small></span>
                                    </div>
                                </td>
                                <td>25D1<br>From: 01/Apr/2025<br>To: 15/Apr/2025</td>
                                <td>₹ 40<br>For 1 RP</td>
                                <td>₹ 40<br>For 1 RP</td>
                                <td>₹ 30<br>For 1 RP</td>
                                <td>₹ 30<br>For 1 RP</td>
                                <td>₹ 30<br>For 1 RP</td>
                                <td>₹ 20<br>For 1 RP</td>
                                <td>₹ 10<br>For 1 RP</td>
                                <td>₹ 8<br>For 1 RP</td>
                                <td>₹ 8<br>For 1 RP</td>
                                <td>₹ 8<br>For 1 RP</td>
                                <td>₹ 8<br>For 1 RP</td>
                                <td>₹ 8<br>For 1 RP</td>
                                <td>₹ 5<br>For 1 RP</td>
                                <td>₹ 5<br>For 1 RP</td>
                                <td>₹ 250</td>

                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>




</div>
@stop