@extends('layout.admin') @section('content')
<div class="page-body">
        
                          
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <!--<h3> {{request('mode')}} - products Dates</h3>-->
                    </div>
                </div>
                <div class="col-lg-6">
                  <!--<div class="btn-group btn-group-lg" style="float: right;">-->
                  <!--        <a type="button" class="btn btn-info text-white" href="cutoff_dates?mode=cutoff">Cut-Off</a>-->
                  <!--        <a type="button" class="btn btn-info text-white" href="cutoff_dates?mode=flashsale">Flash Sale</a>-->
                          
                    
                  <!--        </div>-->
                </div>
            </div>
        </div>
    </div>


                  
                          
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row product-adding">
                                        
                                        <div class="col-xl-12">
                                            <form class="needs-validation add-product-form" method="post" action="/option_update_value">
                                                   @csrf
                                                <div class="form">
                                               <input type="hidden" name="id" value="{{$data['id']}}">
                                                    <div class="form-group mb-3 row">   
                                                        <div class="col-10">
                                                            <label for="cutoffstart">Discount(%) :</label>
                                                            <input class="form-control" name="value" type="number" required="" value="{{$data['value']}}">
                                                        </div>
                                                  
                                                    </div>
                                                   
                                                    
                                                </div>
                                                <button type="submit" class="btn btn-primary"> submit</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>




</div>
@stop