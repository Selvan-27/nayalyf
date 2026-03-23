@extends('layout.admin') @section('content')
<div class="page-body">
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3>Support tickets</h3>
                    </div>
                </div>
                <div class="col-lg-6">
                    <ol class="breadcrumb pull-right">
                        <li class="breadcrumb-item">
                            <a href="/admin_home">
                                <i data-feather="home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active">Cut-Off</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <form class="form-inline search-form search-box">
                            <div class="form-group">
                                <input class="form-control-plaintext" type="search" placeholder="Search..">
                            </div>
                        </form>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive table-desi">
                            <table class="table support-ticket-table all-package">
                                <thead>
                                    <tr>
                                        <th>Ticket Number</th>
                                        <th>Date</th>
                                        <th>Member</th>
                                        <th>Subject</th>
                                        <th>Status</th>
                                        <th>Option</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr>
                                        <td>#786</td>
                                        <td>25/09/2021</td>
                                        <td> <div class="d-flex vendor-list"> <span>Petey Cruiser<br>UC001670<br>UC Distributor</span> </div> </td>
                                        <td>Payment Related</td>
                                        <td class="order-warning"> <span>Pending</span> </td>
                                        <td>
                                            <a href="#detail" data-bs-toggle="modal"> <i class="fa fa-edit" title="Edit"></i> </a>
                                            
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>#786</td>
                                        <td>25/09/2021</td>
                                        <td> <div class="d-flex vendor-list"> <span>Petey Cruiser<br>UC001670<br>UC Distributor</span> </div> </td>
                                        <td>Order Related</td>
                                        <td class="order-success"> <span>Replied</span> </td>
                                        <td>
                                            <a href="#detail" data-bs-toggle="modal"> <i class="fa fa-edit" title="Edit"></i> </a>
                                            
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- The  Modal -->
            <div class="modal" id="detail">
                <div class="modal-dialog  modal-lg">
                    <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Ticket No: [ticket_no]</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">

                    
                        <div class="row mb-4 align-items-center">
                            <div class="col">
                                <h6>[member_name] [member_id]</h6>
                            </div>
                            <div class="col text-end">
                                <h6>Subject: [subject]</h6>
                            </div>
                            <div class="col-12">
                                <h6>[date_time]</h6>
                            </div>
                            <div class="col-12">
                                <h6>[message]</h6>
                            </div>
                        </div>
                        <div class="form">
                            <div class="form-group mb-3 row">
                                <label for="reply">Reply Message :</label>
                                <div class="col-12">
                                    <input class="form-control" id="reply" type="message" required="">
                                </div>
                            </div>
                        </div>

                        
                        
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-info" data-bs-dismiss="modal">Send Message</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>

                    </div>
                </div>
            </div>
            <!-- The  Modal -->






</div>
@stop