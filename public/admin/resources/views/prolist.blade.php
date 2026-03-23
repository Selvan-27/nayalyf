@extends('layout.admin') @section('content')
<div class="page-body">
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3> Product List </h3>
                    </div>
                </div>
                <div class="col-lg-6">
                    <ol class="breadcrumb pull-right">
                        <li class="breadcrumb-item">
                            <a href="/admin_home">
                                <i data-feather="home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active">Products</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row products-admin ratio_asos">
            <div class="col-xl-3 col-sm-6">
                <div class="card">
                    <div class="card-body product-box">
                        <div class="img-wrapper">
                        <div class="lable-block"><span class="lable3">In-Stock: 100</span> <span class="lable4">On Sale</span></div>
                            <div class="front">
                                <a href="javascript:void(0)"><img src="assets/images/products/1.jpg"
                                        class="img-fluid blur-up lazyload bg-img" alt=""></a>
                                <div class="product-hover">
                                    <ul>
                                        <li>
                                            <button class="btn" type="button" data-original-title=""
                                                title=""><i class="ti-pencil-alt"></i></button>
                                        </li>
                                        <li>
                                            <button class="btn"><i class="ti-trash"></i></button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="product-detail">
                            <div class="rating"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                    class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                    class="fa fa-star"></i></div>
                            <a href="javascript:void(0)">
                                <h6>UC Antioxidant Juice<br>500 ml</h6>
                            </a>
                            <h4>₹ 1249.00 <del>₹ 1650.00</del></h4>
                            <h4>RP: 600</h4>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6">
                <div class="card">
                    <div class="card-body product-box">
                        <div class="img-wrapper">
                        <div class="lable-block"><span class="lable3">In-Stock: 100</span> <span class="lable4">On Sale</span></div>
                            <div class="front">
                                <a href="javascript:void(0)"><img src="assets/images/products/2.jpg"
                                        class="img-fluid blur-up lazyload bg-img" alt=""></a>
                                <div class="product-hover">
                                    <ul>
                                        <li>
                                            <button class="btn" type="button" data-original-title=""
                                                title=""><i class="ti-pencil-alt"></i></button>
                                        </li>
                                        <li>
                                            <button class="btn"><i class="ti-trash"></i></button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="product-detail">
                            <div class="rating"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                    class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                    class="fa fa-star"></i></div>
                            <a href="javascript:void(0)">
                                <h6>UC Herbal Detox Tea<br>3100 Grams</h6>
                            </a>
                            <h4>₹ 349.00 <del>₹ 410.00</del></h4>
                            <h4>RP: 200</h4>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6">
                <div class="card">
                    <div class="card-body product-box">
                        <div class="img-wrapper">
                        <div class="lable-block"><span class="lable3">In-Stock: 100</span> <span class="lable4">On Sale</span></div>
                            <div class="front">
                                <a href="javascript:void(0)"><img src="assets/images/products/3.jpg"
                                        class="img-fluid blur-up lazyload bg-img" alt=""></a>
                                <div class="product-hover">
                                    <ul>
                                        <li>
                                            <button class="btn" type="button" data-original-title=""
                                                title=""><i class="ti-pencil-alt"></i></button>
                                        </li>
                                        <li>
                                            <button class="btn"><i class="ti-trash"></i></button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="product-detail">
                            <div class="rating"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                    class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                    class="fa fa-star"></i></div>
                            <a href="javascript:void(0)">
                                <h6>UC Dia Care Capsules<br>30 Softgel Capsules</h6>
                            </a>
                            <h4>₹ 650.00 <del>₹ 810.00</del></h4>
                            <h4>RP: 320</h4>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6">
                <div class="card">
                    <div class="card-body product-box">
                        <div class="img-wrapper">
                        <div class="lable-block"><span class="lable3">In-Stock: 100</span> <span class="lable4">On Sale</span></div>
                            <div class="front">
                                <a href="javascript:void(0)"><img src="assets/images/products/4.jpg"
                                        class="img-fluid blur-up lazyload bg-img" alt=""></a>
                                <div class="product-hover">
                                    <ul>
                                        <li>
                                            <button class="btn" type="button" data-original-title=""
                                                title=""><i class="ti-pencil-alt"></i></button>
                                        </li>
                                        <li>
                                            <button class="btn"><i class="ti-trash"></i></button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="product-detail">
                            <div class="rating"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                    class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                    class="fa fa-star"></i></div>
                            <a href="javascript:void(0)">
                                <h6>UC Multivitamin Capsules<br>30 Softgel Capsules</h6>
                            </a>
                            <h4>₹ 599.00 <del>₹ 749.00</del></h4>
                            <h4>RP: 280</h4>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6">
                <div class="card">
                    <div class="card-body product-box">
                        <div class="img-wrapper">
                        <div class="lable-block"><span class="lable3">In-Stock: 100</span> <span class="lable4">On Sale</span></div>
                            <div class="front">
                                <a href="javascript:void(0)"><img src="assets/images/products/5.jpg"
                                        class="img-fluid blur-up lazyload bg-img" alt=""></a>
                                <div class="product-hover">
                                    <ul>
                                        <li>
                                            <button class="btn" type="button" data-original-title=""
                                                title=""><i class="ti-pencil-alt"></i></button>
                                        </li>
                                        <li>
                                            <button class="btn"><i class="ti-trash"></i></button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="product-detail">
                            <div class="rating"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                    class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                    class="fa fa-star"></i></div>
                            <a href="javascript:void(0)">
                                <h6>UC Man Power Capsules<br>60 Capsules</h6>
                            </a>
                            <h4 style="color: #ff0000">Nill Stock</h4>
                            <h4 style="color: #ff0000">Nill Stock</h4>
                            
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6">
                <div class="card">
                    <div class="card-body product-box">
                        <div class="img-wrapper">
                        <div class="lable-block"><span class="lable3">In-Stock: 0</span> <span class="lable4">Nill Stock</span></div>
                            <div class="front">
                                <a href="javascript:void(0)"><img src="assets/images/products/6.jpg"
                                        class="img-fluid blur-up lazyload bg-img" alt=""></a>
                                <div class="product-hover">
                                    <ul>
                                        <li>
                                            <button class="btn" type="button" data-original-title=""
                                                title=""><i class="ti-pencil-alt"></i></button>
                                        </li>
                                        <li>
                                            <button class="btn"><i class="ti-trash"></i></button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="product-detail">
                            <div class="rating"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                    class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                    class="fa fa-star"></i></div>
                            <a href="javascript:void(0)">
                                <h6>UC Man Power Oil<br>30 ml</h6>
                            </a>
                            <h4 style="color: #ff0000">Nill Stock</h4>
                            <h4 style="color: #ff0000">Nill Stock</h4>
                            
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>


</div>
@stop