@extends('layout.admin') @section('content')
<div class="page-body">
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                       
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
               <div class="col-sm-6">
                <div class="card tab2-card">
                     <h3 style="text-align: center;padding: 25px 0px;"> Change MemberId </h3>
                    <div class="card-body">
                        @if (session('success1'))
    <div class="alert alert-success">
        {{ session('success1') }}
    </div>
@endif

@if (session('error2'))
    <div class="alert alert-danger">
        {{ session('error2') }}
    </div>
@endif

                          <form class="needs-validation user-add" method="POST" action="{{ route('change_memberid') }}">
    @csrf
                            <div class="form-group row">
                                <label for="validationCustom0"
                                    class="col-xl-3 col-md-4"><span>*</span> Member ID</label>
                                <div class="col-xl-8 col-md-7">
                                    <input class="form-control" name="Memberid" type="text" oninput="getMemberdet1(this.value)" class="form-control" required="">
              
                                </div>
                            </div>
                             <p id="memberName1">Name: </p>
                            <div class="form-group row">
                                 <label for="validationCustom0"
                                    class="col-xl-3 col-md-4"><span>*</span> New MemberID</label>
                                 <div class="col-xl-8 col-md-7">
                                      
                                    <input class="form-control" name="new_Memberid" type="text"  class="form-control" required="">
              
                                </div>
                                         
                                        
                            </div>
                            
                             <div class="pull-right">
                            <button type="submit" class="btn btn-primary">Update MemberID</button>
                        </div>
                        </form>
                            
                       
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card tab2-card">
                     <h3 style="text-align: center;padding: 25px 0px;"> Activate Members </h3>
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

                          <form class="needs-validation user-add" method="POST" action="{{ route('activation_request') }}">
    @csrf
                            <div class="form-group row">
                                <label for="validationCustom0"
                                    class="col-xl-3 col-md-4"><span>*</span> Member ID</label>
                                <div class="col-xl-8 col-md-7">
                                    <input class="form-control" name="Memberid" type="text" oninput="getMemberdet(this.value)" class="form-control" required="">
              
                                </div>
                            </div>
                            <div class="form-group row">
                                <!--<label for="validationCustom0"-->
                                <!--    class="col-xl-3 col-md-4"><span>*</span> Member Name</label>-->
                                <!--<div class="col-xl-8 col-md-7">-->
                                <!--    <input class="form-control" id="validationCustom0" type="text"-->
                                <!--        disabled>-->
                                <!--</div>-->
                                          <p id="memberName">Member Name: </p>
                                        <p id="id_status">Status:</p>
                            </div>
                            
                             <div class="pull-right">
                            <button type="submit" class="btn btn-primary">Activate Member</button>
                        </div>
                        </form>
                            
                       
                    </div>
                </div>
            </div>
         
            
            
        </div>
    </div>

</div>

 <script>
     
        function getMemberdet1(val){
          // alert(val);
          $.ajax({
                url: '/get_member_details',
                type: 'GET',
                data: {
                 _token: '{{ csrf_token() }}',
                 memberid: val
                },
                success: function(response) {
                 // Handle the response from the server
                 console.log(response);
                if(response.error) {
                     $('#memberName1').text('Member Name: Not Found');
                    //   $('#id_status').text('Status: N/A');
                 } else {
                                           $('#memberName1').text('Member Name: ' + response.name);
                    //   $('#id_status').text('Status: ' + response.activation_status);

                 }
                },
                error: function(xhr) {
                 // Handle any errors that occur during the request
                 console.error(xhr);
                }
          });
     }
     function getMemberdet(val){
          // alert(val);
          $.ajax({
                url: '/get_member_details',
                type: 'GET',
                data: {
                 _token: '{{ csrf_token() }}',
                 memberid: val
                },
                success: function(response) {
                 // Handle the response from the server
                 console.log(response);
                if(response.error) {
                     $('#memberName').text('Member Name: Not Found');
                      $('#id_status').text('Status: N/A');
                 } else {
                                           $('#memberName').text('Member Name: ' + response.name);
                      $('#id_status').text('Status: ' + response.activation_status);

                 }
                },
                error: function(xhr) {
                 // Handle any errors that occur during the request
                 console.error(xhr);
                }
          });
     }
      </script> 
      
@stop