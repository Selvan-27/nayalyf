@extends('layout.admin') @section('content')
<div class="page-body">
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3> Fix % For Sale Incentive </h3>
                    </div>
                </div>
                <div class="col-lg-6">
                    <ol class="breadcrumb pull-right">
                        <li class="breadcrumb-item">
                            <a href="/admin_home">
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
        <div class="row">
            <div class ="col-sm-3"></div>
            <div class="col-sm-6">
                <div class="card tab2-card">
                    <div class="card-body">
                        @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                          <form class="needs-validation user-add" method="POST" action="{{ route('store.incentive.percentage') }}">
                    @csrf
                            <div class="form-group row">
                                <label for="validationCustom0"
                                    class="col-xl-3 col-md-4"> Enter % <span>*</span></label>
                                <div class="col-xl-8 col-md-7">
                                    <input class="form-control" name="percentage" type="number" step="0.01" min="0" max="100" class="form-control" required="">
              
                                </div>
                            </div>
                            
                            
                             <div class="pull-right">
                            <button type="submit" class="btn btn-primary">Fix</button>
                        </div>
                        </form>
                            
                       
                    </div>
                </div>
            </div>
            <div class ="col-sm-3"></div>
            
            
        </div>
        
        <div class="card-body vendor-table">
            <table class="table table-responsive" id="basic-1">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Date</th>
                        <th>%</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ date('Y-m-d H:i:s', strtotime($item->created_at)) }}</td>
                        <td>{{ $item->percentage }}%</td>
                        <td>
                             <div>
                                <a href="{{ route('delete.incentive.percentage', $item->id) }}" 
                                   onclick="return confirm('Are you sure you want to delete this record?')"
                                   title="Delete">
                                    <i class="fa fa-trash font-danger"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>

@stop