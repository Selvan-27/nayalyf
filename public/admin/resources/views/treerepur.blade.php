@extends('layout.admin') @section('content')
<div class="page-body">
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3> Re-Purchase Tree </h3>
                    </div>
                </div>
                <div class="col-lg-6">
                    <ol class="breadcrumb pull-right">
                        <li class="breadcrumb-item">
                            <a href="/admin_home">
                                <i data-feather="home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active">Sales</li>
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
            <div class="col-lg-6">
                <div class="card">
                    <div class="row">
                        
                        <div class="col-xl-8 col-md-6 xl-50">
                            <div class="card">    
                                <input type="text" placeholder="Enter Member ID"> 
                            </div>
                        </div>
                        
                        <div class="col-xl-4 col-md-6 xl-50">
                            <div class="card">
                                <button class="btn btn-success">Search</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-2">
                <div class="card">
                    
                        <table class="table table-responsive text-center">
                            <thead>
                                <tr>
                                    <th>Level</th>
                                    <th>Members</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>3</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>3</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>3</td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>3</td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>3</td>
                                </tr>
                                <tr>
                                    <td>6</td>
                                    <td>3</td>
                                </tr>
                                <tr>
                                    <td>7</td>
                                    <td>3</td>
                                </tr>
                                <tr>
                                    <td>8</td>
                                    <td>3</td>
                                </tr>
                                <tr>
                                    <td>9</td>
                                    <td>3</td>
                                </tr>
                                <tr>
                                    <td>10</td>
                                    <td>3</td>
                                </tr>
                                <tr>
                                    <td>11</td>
                                    <td>3</td>
                                </tr>
                                <tr>
                                    <td>12</td>
                                    <td>3</td>
                                </tr>
                                <tr>
                                    <td>13</td>
                                    <td>3</td>
                                </tr>
                                <tr>
                                    <td>14</td>
                                    <td>3</td>
                                </tr>
                                
                            </tbody>
                        </table>
                    
                </div>
            </div>
            <div class="col-lg-10">
                <div class="card">
                    <div class="card-body vendor-table">
                        <table class="table table-responsive text-center">
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                    <p>UC10001</p></a>
                                </td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>

                            <tr>
                                <td></td>
                                <td>
                                    <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                    <p>UC10001</p></a>
                                </td>
                                <td></td>
                                <td></td>
                                <td>
                                    <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                    <p>UC10001</p></a>
                                </td>
                                <td></td>
                                <td></td>
                                <td>
                                    <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                    <p>UC10001</p></a>
                                </td>
                                <td></td>
                            </tr>

                            <tr>
                                <td>
                                    <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                    <p>UC10001</p></a>
                                </td>
                                <td>
                                    <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                    <p>UC10001</p></a>
                                </td>
                                <td>
                                    <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                    <p>UC10001</p></a>
                                </td>
                                <td>
                                    <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                    <p>UC10001</p></a>
                                </td>
                                <td>
                                    <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                    <p>UC10001</p></a>
                                </td>
                                <td>
                                    <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                    <p>UC10001</p></a>
                                </td>
                                <td>
                                    <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                    <p>UC10001</p></a>
                                </td>
                                <td>
                                    <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                    <p>UC10001</p></a>
                                </td>
                                <td>
                                    <a href="#"><img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">
                                    <p>UC10001</p></a>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        
        
        </div>
    
    
    
    </div>




</div>
@stop