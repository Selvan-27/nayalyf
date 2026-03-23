<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="assets/images/favicon.png" type="image/x-icon" />
    <link rel="shortcut icon" href="assets/images/favicon.png" type="image/x-icon" />
    <title>Uniq Connect | Admin</title>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Work+Sans:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,500;1,600;1,700;1,800;1,900&amp;display=swap" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/font-awesome.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/flag-icon.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/icofont.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/prism.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/chartist.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/bootstrap.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/datatables.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/date-picker.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/drapzone.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/jsgrid.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/owlcarousel.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/slick-theme.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/slick.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/themify-icons.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}" />
    
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/3.2.2/css/buttons.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.css">


  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- Select2 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <!-- Select2 JS -->
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  
      <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.js"></script>
    
    <style>
    .vendor-table table {
        display: block;
    }
</style>
</head>

<body>
    <!-- page-wrapper Start-->
    <div class="page-wrapper">
        <!-- Page Header Start-->
        <div class="page-main-header">
            <div class="main-header-right row">
                <div class="main-header-left d-lg-none w-auto">
                    <div class="logo-wrapper">
                        <a href="/admin_home">
                            <img class="blur-up lazyloaded d-block d-lg-none"
                                src="assets/images/dashboard/uniqconnect-logo-black.png" alt="" />
                        </a>
                    </div>
                </div>
                <div class="mobile-sidebar w-auto">
                    <div class="media-body text-end switch-sm">
                        <label class="switch">
                            <a href="javascript:void(0)">
                                <i id="sidebar-toggle" data-feather="align-left"></i>
                            </a>
                        
                    </div>
                </div>
                
                <div class="nav-right col">
                    <ul class="nav-menus">
                    </label><h3>Uniq Connect Admin Panel</h3>
                        <!--<li>
                            <form class="form-inline search-form">
                                <div class="form-group">
                                    <input class="form-control-plaintext" type="search" placeholder="Search..">
                                    <span class="d-sm-none mobile-search">
                                        <i data-feather="search"></i>
                                    </span>
                                </div>
                            </form>
                        </li>-->
                        <li>
                            <a class="text-dark" href="#!" onclick="javascript:toggleFullScreen()">
                                <i data-feather="maximize-2"></i>
                            </a>
                        </li>
                        <!--<li class="onhover-dropdown">
                            <a class="txt-dark" href="javascript:void(0)">
                                <h6>EN</h6>
                            </a>
                            <ul class="language-dropdown onhover-show-div p-20">
                                <li>
                                    <a href="javascript:void(0)" data-lng="en">
                                        <i class="flag-icon flag-icon-is"></i>English</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)" data-lng="es">
                                        <i class="flag-icon flag-icon-um"></i>Spanish</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)" data-lng="pt">
                                        <i class="flag-icon flag-icon-uy"></i>Portuguese</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)" data-lng="fr">
                                        <i class="flag-icon flag-icon-nz"></i>French</a>
                                </li>
                            </ul>
                        </li>
                        <li class="onhover-dropdown">
                            <i data-feather="bell"></i>
                            <span class="badge badge-pill badge-primary pull-right notification-badge">3</span>
                            <span class="dot"></span>
                            <ul class="notification-dropdown onhover-show-div p-0">
                                <li>Notification <span class="badge badge-pill badge-primary pull-right">3</span></li>
                                <li>
                                    <div class="media">
                                        <div class="media-body">
                                            <h6 class="mt-0">
                                                <span>
                                                    <i class="shopping-color" data-feather="shopping-bag"></i>
                                                </span>Your order ready for Ship..!
                                            </h6>
                                            <p class="mb-0">Lorem ipsum dolor sit amet, consectetuer.</p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="media">
                                        <div class="media-body">
                                            <h6 class="mt-0 txt-success">
                                                <span>
                                                    <i class="download-color font-success" data-feather="download"></i>
                                                </span>Download Complete
                                            </h6>
                                            <p class="mb-0">Lorem ipsum dolor sit amet, consectetuer.</p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="media">
                                        <div class="media-body">
                                            <h6 class="mt-0 txt-danger">
                                                <span>
                                                    <i class="alert-color font-danger" data-feather="alert-circle"></i>
                                                </span>250 MB trash files
                                            </h6>
                                            <p class="mb-0">Lorem ipsum dolor sit amet, consectetuer.</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="txt-dark"><a href="javascript:void(0)">All</a> notification</li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                <i class="right_side_toggle" data-feather="message-square"></i>
                                <span class="dot"></span>
                            </a>
                        </li>
                        <li class="onhover-dropdown">
                            <div class="media align-items-center">
                                <img class="align-self-center pull-right img-50 blur-up lazyloaded"
                                    src="assets/images/dashboard/user3.jpg" alt="header-user" />
                                <div class="dotted-animation">
                                    <span class="animate-circle"></span>
                                    <span class="main-circle"></span>
                                </div>
                            </div>
                            <ul class="profile-dropdown onhover-show-div p-20 profile-dropdown-hover">
                                <li>
                                    <a href="javascript:void(0)">
                                        <i data-feather="user"></i>Edit Profile
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">
                                        <i data-feather="mail"></i>Inbox
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">
                                        <i data-feather="lock"></i>Lock Screen
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">
                                        <i data-feather="settings"></i>Settings
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">
                                        <i data-feather="log-out"></i>Logout
                                    </a>
                                </li>
                            </ul>
                        </li>-->
                    </ul>
                    <div class="d-lg-none mobile-toggle pull-right">
                        <i data-feather="more-horizontal"></i>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page Header Ends -->

        <!-- Page Body Start-->
        <div class="page-body-wrapper">
            <!-- Page Sidebar Start-->

            <div class="page-sidebar">
                <div class="main-header-left d-none d-lg-block">
                    <div class="logo-wrapper">
                        <a href="/admin_home">
                            <img class="d-none d-lg-block blur-up lazyloaded"
                                src="assets/images/dashboard/uniqconnect-logo.png" alt="" />
                        </a>
                    </div>
                </div>
                <div class="sidebar custom-scrollbar">
                    <a href="javascript:void(0)" class="sidebar-back d-lg-none d-block"><i class="fa fa-times"
                            aria-hidden="true"></i></a>
                    <ul class="sidebar-menu">
                        <li>
                            <a class="sidebar-header" href="/dashboard">
                                <i data-feather="home"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        <li>
                            <a class="sidebar-header" href="javascript:void(0)">
                                <i data-feather="box"></i>
                                <span>POS</span>
                                <i class="fa fa-angle-right pull-right"></i>
                            </a>

                            <ul class="sidebar-submenu">
                                <li>
                         

                                   
                                       <li><a href="/pos"><i class="fa fa-circle"></i>NEW Bill</a></li>
                                        <li><a href="order-list"><i class="fa fa-circle"></i>Order-list</a></li>
                                    
                                </li>

                                
                            </ul>
                        </li>
                        <li>
                            <a class="sidebar-header" href="javascript:void(0)">
                                <i data-feather="user"></i>
                                <span>Members</span>
                                <i class="fa fa-angle-right pull-right"></i>
                            </a>
                        
                         
                            <ul class="sidebar-submenu">
                                <li>
                                    <a href="/members_activate">
                                        <i class="fa fa-circle"></i>
                                        <span>Activate Member</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="/incentive_fix">
                                        <i class="fa fa-circle"></i>
                                        <span>Fix Incentive %</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="/members_list">
                                        <i class="fa fa-circle"></i>
                                        <span>Member List</span>
                                    </a>
                                </li>
                                <!--<li>-->
                                <!--    <a href="/members_deposit_list">-->
                                <!--        <i class="fa fa-circle"></i>-->
                                <!--        <span>Member Deposit List</span>-->
                                <!--    </a>-->
                                <!--</li>-->
                                <li>
                                    <a href="/members_income_list">
                                        <i class="fa fa-circle"></i>
                                        <span>Member Income List</span>
                                    </a>
                                </li>
                                <!--<li>-->
                                <!--    <a href="/members_create">-->
                                <!--        <i class="fa fa-circle"></i>-->
                                <!--        <span>Create Member</span>-->
                                <!--    </a>-->
                                <!--</li>-->

                                <!--<li>-->
                                <!--    <a href="/members_details">-->
                                <!--        <i class="fa fa-circle"></i>-->
                                <!--        <span>Member Details</span>-->
                                <!--    </a>-->
                                <!--</li>-->
                                <!--<li>-->
                                <!--    <a href="/members_edit">-->
                                <!--        <i class="fa fa-circle"></i>-->
                                <!--        <span>Member Edit</span>-->
                                <!--    </a>-->
                                <!--</li>-->
                                

                                <li>
                                    <a href="/members_rebirth_list">
                                        <i class="fa fa-circle"></i>
                                        <span>ReBirth ID List</span>
                                    </a>
                                </li>

                                <li>
                                    <a href="/members_repurchase_id_list">
                                        <i class="fa fa-circle"></i>
                                        <span>Re-Purchase ID List</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="/members_fasttrack_id_list">
                                        <i class="fa fa-circle"></i>
                                        <span>Fast Track ID List</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        
                        <li>
                            <a class="sidebar-header" href="javascript:void(0)">
                                <i data-feather="credit-card"></i>
                                <span>Withdraw</span>
                                <i class="fa fa-angle-right pull-right"></i>
                            </a>
                            <ul class="sidebar-submenu">
                                <li>
                                    <a href="/members_withdraw_list">
                                        <i class="fa fa-circle"></i>Withdraw Request
                                    </a>
                                </li>
                                <li>
                                    <a href="/members_withdraw_report">
                                        <i class="fa fa-circle"></i>Withdraw Report
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <hr>
                        <li>
                            <a class="sidebar-header" href="javascript:void(0)">
                                <i data-feather="clipboard"></i>
                                <span>Products</span>
                                <i class="fa fa-angle-right pull-right"></i>
                            </a>
                            <ul class="sidebar-submenu">
                                 <li>
                                    <a href="/sliders">
                                        <i class="fa fa-circle"></i>Slides
                                    </a>
                                </li>
                                <li>
                                    <a href="/categories">
                                        <i class="fa fa-circle"></i>Add Category
                                    </a>
                                </li>
                                <li>
                                    <a href="/products/create">
                                        <i class="fa fa-circle"></i>Add Product
                                    </a>
                                </li>
                                 <li>
                                    <a href="/products">
                                        <i class="fa fa-circle"></i>Product List
                                    </a>
                                </li> 
                                
                                 <li>
                                    <a href="/products-editable/1">
                                        <i class="fa fa-circle"></i>ID Card Details
                                    </a>
                                </li> 
                                
                                 <li>
                                    <a href="/products-editable/2">
                                        <i class="fa fa-circle"></i>Starter Kits Details
                                    </a>
                                </li> 
                                <li>
                                    <a href="/product_stock">
                                        <i class="fa fa-circle"></i>Product Inventry
                                    </a>
                                </li>
                                   <li>
                                    <a href="/options/5">
                                        <i class="fa fa-circle"></i>Discount Fix
                                    </a>
                                </li>
                            </ul>
                        </li>
                        
                          <li>
                            <a class="sidebar-header" href="javascript:void(0)">
                                <i data-feather="tag"></i>
                                <span>Offers</span>
                                <i class="fa fa-angle-right pull-right"></i>
                            </a>
                            <ul class="sidebar-submenu">
                                <li>
                                    <a href="/products-editable/3">
                                        <i class="fa fa-circle"></i>Flash Sale
                                    </a>
                                </li>
                                <li>
                                    <a href="/products-editable/4">
                                        <i class="fa fa-circle"></i>Cut-Off Offer
                                    </a>
                                </li>
                                   <li>
                                    <a href="/cutoff_dates?mode=cutoff">
                                        <i class="fa fa-circle"></i>Cut-Off Products - Dates
                                    </a>
                                </li>
                            </ul>
                        </li>
                   
                        <hr>
                        <!--<li>-->
                        <!--    <a class="sidebar-header" href="javascript:void(0)">-->
                        <!--        <i data-feather="archive"></i>-->
                        <!--        <span>Orders</span>-->
                        <!--        <i class="fa fa-angle-right pull-right"></i>-->
                        <!--    </a>-->
                        <!--    <ul class="sidebar-submenu">-->
                        <!--         <li>-->
                        <!--            <a href="/members_kit_list">-->
                        <!--                <i class="fa fa-circle"></i>-->
                        <!--                <span>Starter Kit Order List</span>-->
                        <!--            </a>-->
                        <!--        </li>-->
                        <!--        <li>-->
                        <!--            <a href="/members_card_list">-->
                        <!--                <i class="fa fa-circle"></i>-->
                        <!--                <span>ID Card Order List</span>-->
                        <!--            </a>-->
                        <!--        </li> -->
                        <!--        <li>-->
                        <!--            <a href="/orders?status=pending">-->
                        <!--                <i class="fa fa-circle"></i>-->
                        <!--                <span>Order List</span>-->
                        <!--            </a>-->
                        <!--        </li>-->
                        <!--         <li>-->
                        <!--            <a href="order-tracking.html">-->
                        <!--                <i class="fa fa-circle"></i>-->
                        <!--                <span>Order Tracking</span>-->
                        <!--            </a>-->
                        <!--        </li> -->
                        <!--        <li>-->
                        <!--            <a href="/members_returns_list">-->
                        <!--                <i class="fa fa-circle"></i>-->
                        <!--                <span>Order Returns</span>-->
                        <!--            </a>-->
                        <!--        </li>-->
                        <!--    </ul>-->
                        <!--</li>-->
                        <li>
                            <a class="sidebar-header" href="/orders?status=pending">
                                <i data-feather="archive"></i>
                                <span>Orders</span>
                            </a>
                        </li>
                        <li>
                            <a class="sidebar-header" href="/sales_day">
                                <i data-feather="dollar-sign"></i>
                                <span>Sales Report</span>
                            </a>
                        </li>
                        <hr>
                        
                        <!--<li>-->
                        <!--    <a class="sidebar-header" href="javascript:void(0)">-->
                        <!--        <i data-feather="dollar-sign"></i>-->
                        <!--        <span>Sales</span>-->
                        <!--        <i class="fa fa-angle-right pull-right"></i>-->
                        <!--    </a>-->
                        <!--    <ul class="sidebar-submenu">-->
                        <!--        <li>-->
                        <!--            <a href="/sales_product">-->
                        <!--                <i class="fa fa-circle"></i>Product Wise Sales-->
                        <!--            </a>-->
                        <!--        </li>-->
                        <!--        <li>-->
                        <!--            <a href="/sales_day">-->
                        <!--                <i class="fa fa-circle"></i>Day Wise Sales-->
                        <!--            </a>-->
                        <!--        </li>-->
                        <!--    </ul>-->
                        <!--</li>-->
                        <!--<li>-->
                        <!--    <a class="sidebar-header" href="javascript:void(0)">-->
                        <!--        <i data-feather="list"></i>-->
                        <!--        <span>Invoices</span>-->
                        <!--        <i class="fa fa-angle-right pull-right"></i>-->
                        <!--    </a>-->
                        <!--    <ul class="sidebar-submenu">-->
                        <!--        <li>-->
                        <!--            <a href="order.html">-->
                        <!--                <i class="fa fa-circle"></i>Invoice List-->
                        <!--            </a>-->
                        <!--        </li>-->
                        <!--        <li>-->
                        <!--            <a href="transactions.html">-->
                        <!--                <i class="fa fa-circle"></i>Create Invoice-->
                        <!--            </a>-->
                        <!--        </li>-->
                        <!--        <li>-->
                        <!--            <a href="transactions.html">-->
                        <!--                <i class="fa fa-circle"></i>Edit Invoice-->
                        <!--            </a>-->
                        <!--        </li>-->
                        <!--    </ul>-->
                        <!--</li>-->

                           <li>
                            <a class="sidebar-header" href="/cutoff">
                                <i data-feather="calendar"></i>
                                <span>Income - Cut-Off</span>
                            </a>
                        </li>
                        <li>
                            <a class="sidebar-header" href="javascript:void(0)">
                                <i data-feather="share-2"></i>
                                <span>Geanology</span>
                                <i class="fa fa-angle-right pull-right"></i>
                            </a>
                            <ul class="sidebar-submenu">
                                <!--<li>-->
                                <!--    <a href="/team_tree">-->
                                <!--        <i class="fa fa-circle"></i>Own Team Tree-->
                                <!--    </a>-->
                                <!--</li>-->
                                <li>
                                    <a href="/team_per_tree">
                                        <i class="fa fa-circle"></i>Team Performance Tree
                                    </a>
                                </li>
                                <li>
                                    <a href="/global_tree">
                                        <i class="fa fa-circle"></i>Global Tree
                                    </a>
                                </li>
                                <li>
                                    <a href="/fast_track_tree">
                                        <i class="fa fa-circle"></i>Fast Track Tree
                                    </a>
                                </li>
                                <li>
                                    <a href="/achievement_tree">
                                        <i class="fa fa-circle"></i>Achievement Tree
                                    </a>
                                </li>
                                
                                <!--<li>-->
                                <!--    <a href="/repurchase_tree">-->
                                <!--        <i class="fa fa-circle"></i>RePurchase Tree-->
                                <!--    </a>-->
                                <!--</li>-->
                                
                            </ul>
                        </li>
                        
                        <li>
                            <a class="sidebar-header" href="javascript:void(0)">
                                <i data-feather="bar-chart-2"></i>
                                <span>Income Report</span>
                                <i class="fa fa-angle-right pull-right"></i>
                            </a>
                            <ul class="sidebar-submenu">
                                <li>
                                    <a href="/incentive">
                                        <i class="fa fa-circle"></i>Sales Incentive
                                    </a>
                                </li>
                                <li>
                                    <a href="/reports?type=IGNITE">
                                        <i class="fa fa-circle"></i>Ignite Bonus
                                    </a>
                                </li>
                                <li>
                                    <a href="/reports?type=RE-IGNITE">
                                        <i class="fa fa-circle"></i>Re-Ignite Bonus
                                    </a>
                                </li>
                                <li>
                                    <a href="/reports?type=TEAM-PERFORMANCE">
                                        <i class="fa fa-circle"></i>Team Performance Bonus
                                    </a>
                                </li>
                                <li>
                                    <a href="/reports?type=GLOBAL_INCOME">
                                        <i class="fa fa-circle"></i>Global Bonus
                                    </a>
                                </li>
                                <li>
                                    <a href="/reports?type=fast_track_income">
                                        <i class="fa fa-circle"></i>Fast Track Bonus
                                    </a>
                                </li>
                                <li>
                                    <a href="/reports?type=achievement_level_income">
                                        <i class="fa fa-circle"></i>Achievement Bonus
                                    </a>
                                </li>
                              
                                    <li>
                                    <a href="/reports?type=repurchase_level_income">
                                        <i class="fa fa-circle"></i>Repurchase Bonus
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <hr>
                        <!--  <li>-->
                        <!--    <a class="sidebar-header" href="javascript:void(0)">-->
                        <!--        <i data-feather="bar-chart-2"></i>-->
                        <!--        <span>Income Report</span>-->
                        <!--        <i class="fa fa-angle-right pull-right"></i>-->
                        <!--    </a>-->
                        <!--    <ul class="sidebar-submenu">-->
                        <!--        <li>-->
                        <!--            <a href="/ignite_list">-->
                        <!--                <i class="fa fa-circle"></i>Ignite Bonus-->
                        <!--            </a>-->
                        <!--        </li>-->
                        <!--        <li>-->
                        <!--            <a href="/reignite_list">-->
                        <!--                <i class="fa fa-circle"></i>Re-Ignite Bonus-->
                        <!--            </a>-->
                        <!--        </li>-->
                        <!--        <li>-->
                        <!--            <a href="/team_performance_list">-->
                        <!--                <i class="fa fa-circle"></i>Team Performance Bonus-->
                        <!--            </a>-->
                        <!--        </li>-->
                        <!--        <li>-->
                        <!--            <a href="/global_list">-->
                        <!--                <i class="fa fa-circle"></i>Global Bonus-->
                        <!--            </a>-->
                        <!--        </li>-->
                        <!--        <li>-->
                        <!--            <a href="/fasttrack_list">-->
                        <!--                <i class="fa fa-circle"></i>Fast Track Bonus-->
                        <!--            </a>-->
                        <!--        </li>-->
                        <!--        <li>-->
                        <!--            <a href="/achievement_list">-->
                        <!--                <i class="fa fa-circle"></i>Achievement Bonus-->
                        <!--            </a>-->
                        <!--        </li>-->
                        <!--        <li>-->
                        <!--            <a href="/repurchase_list">-->
                        <!--                <i class="fa fa-circle"></i>Repurchase Bonus-->
                        <!--            </a>-->
                        <!--        </li>-->
                        <!--    </ul>-->
                        <!--</li>-->
                        
                        
                        
    
                        <!--<li>-->
                        <!--    <a class="sidebar-header" href="/members_award_list">-->
                        <!--        <i data-feather="award"></i>-->
                        <!--        <span>Award List</span>-->
                        <!--    </a>-->
                        <!--</li>-->
                        <!--<li>-->
                        <!--    <a class="sidebar-header" href="/members_reward_list">-->
                        <!--        <i data-feather="flag"></i>-->
                        <!--        <span>Reward List</span>-->
                        <!--    </a>-->
                        <!--</li>-->
                        

                        <!--<li>
                            <a class="sidebar-header" href="javascript:void(0)">
                                <i data-feather="align-left"></i>
                                <span>Menus</span>
                                <i class="fa fa-angle-right pull-right"></i>
                            </a>
                            <ul class="sidebar-submenu">
                                <li>
                                    <a href="menu-list.html">
                                        <i class="fa fa-circle"></i>Menu Lists
                                    </a>
                                </li>
                                <li>
                                    <a href="create-menu.html">
                                        <i class="fa fa-circle"></i>Create Menu
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li>
                            <a class="sidebar-header" href="javascript:void(0)">
                                <i data-feather="user-plus"></i>
                                <span>Users</span>
                                <i class="fa fa-angle-right pull-right"></i>
                            </a>
                            <ul class="sidebar-submenu">
                                <li>
                                    <a href="user-list.html">
                                        <i class="fa fa-circle"></i>User List
                                    </a>
                                </li>
                                <li>
                                    <a href="create-user.html">
                                        <i class="fa fa-circle"></i>Create User
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li>
                            <a class="sidebar-header" href="javascript:void(0)">
                                <i data-feather="users"></i>
                                <span>Vendors</span>
                                <i class="fa fa-angle-right pull-right"></i>
                            </a>
                            <ul class="sidebar-submenu">
                                <li>
                                    <a href="list-vendor.html">
                                        <i class="fa fa-circle"></i>Vendor List
                                    </a>
                                </li>
                                <li>
                                    <a href="create-vendors.html">
                                        <i class="fa fa-circle"></i>Create Vendor
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li>
                            <a class="sidebar-header" href="javascript:void(0)">
                                <i data-feather="chrome"></i>
                                <span>Localization</span>
                                <i class="fa fa-angle-right pull-right"></i>
                            </a>
                            <ul class="sidebar-submenu">
                                <li>
                                    <a href="translations.html"><i class="fa fa-circle"></i>Translations
                                    </a>
                                </li>
                                <li>
                                    <a href="currency-rates.html"><i class="fa fa-circle"></i>Currency Rates
                                    </a>
                                </li>
                                <li>
                                    <a href="taxes.html"><i class="fa fa-circle"></i>Taxes </a>
                                </li>
                            </ul>
                        </li>-->

                        <li>
                            <a class="sidebar-header" href="/support"><i
                                    data-feather="phone"></i><span>Support Ticket</span>
                            </a>
                        </li>

                        <!--<li>
                            <a class="sidebar-header" href="reports.html"><i
                                    data-feather="bar-chart"></i><span>Reports</span>
                            </a>
                        </li>

                        <li>
                            <a class="sidebar-header" href="javascript:void(0)"><i
                                    data-feather="settings"></i><span>Settings</span><i
                                    class="fa fa-angle-right pull-right"></i></a>
                            <ul class="sidebar-submenu">
                                <li>
                                    <a href="profile.html"><i class="fa fa-circle"></i>Profile
                                    </a>
                                </li>
                            </ul>
                        </li>-->

                        

                        <li>
                            <a class="sidebar-header" href="/password">
                                <i data-feather="key"></i>
                                <span>Change Password</span>
                            </a>
                        </li>

                        <li>
                            <a class="sidebar-header" href="/logout">
                                <i data-feather="log-out"></i>
                                <span>Logout</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Page Sidebar Ends-->
            @yield('content')

            <!-- footer start-->
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6 footer-copyright text-start">
                            <p class="mb-0">
                                Copyright 2024 © Uniq Connect All rights reserved.
                            </p>
                        </div>
                        <div class="col-md-6 pull-right text-end">
                            <p class="mb-0">
                                Hand Crafted By<i data-feather="heart" style="color: #ff0000"></i> <a href="https://metrosoft.in">MetroSoft</a>
                            </p>
                        </div>
                    </div>
                </div>
            </footer>
            <!-- footer end-->
        </div>
    </div>

    <div class="bottom-space"></div>


    <!--<script src="{{asset('assets/js/jquery-3.3.1.min.js')}}"></script>-->
    <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/js/icons/feather-icon/feather.min.js')}}"></script>
    <script src="{{asset('assets/js/icons/feather-icon/feather-icon.js')}}"></script>
    <script src="{{asset('assets/js/sidebar-menu.js')}}"></script>
    <script src="{{asset('assets/js/chart/chartist/chartist.js')}}"></script>
    <script src="{{asset('assets/js/chart/chartjs/chart.min.js')}}"></script>
    <script src="{{asset('assets/js/lazysizes.min.js')}}"></script>
    <script src="{{asset('assets/js/prism/prism.min.js')}}"></script>
    <script src="{{asset('assets/js/clipboard/clipboard.min.js')}}"></script>
    <script src="{{asset('assets/js/custom-card/custom-card.js')}}"></script>
    <script src="{{asset('assets/js/counter/jquery.waypoints.min.js')}}"></script>
    <script src="{{asset('assets/js/counter/jquery.counterup.min.js')}}"></script>
    <script src="{{asset('assets/js/counter/counter-custom.js')}}"></script>
    <script src="{{asset('assets/js/chart/peity-chart/peity.jquery.js')}}"></script>
    <script src="{{asset('https://cdn.jsdelivr.net/npm/apexcharts')}}"></script>
    <script src="{{asset('assets/js/chart/sparkline/sparkline.js')}}"></script>
    <script src="{{asset('assets/js/admin-customizer.js')}}"></script>
    <script src="{{asset('assets/js/dashboard/default.js')}}"></script>
    <script src="{{asset('assets/js/chat-menu.js')}}"></script>
    <script src="{{asset('assets/js/height-equal.js')}}"></script>
    <script src="{{asset('assets/js/lazysizes.min.js')}}"></script>
    <script src="{{asset('assets/js/admin-script.js')}}"></script>
    <!--<script src="{{asset('assets/js/datatables/jquery.dataTables.min.js')}}"></script>-->
    <script src="{{asset('assets/js/datatables/custom-basic.js')}}"></script>
    
   <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
  <script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script>
  <script src="https://cdn.datatables.net/buttons/3.2.2/js/dataTables.buttons.js"></script>
  <script src="https://cdn.datatables.net/buttons/3.2.2/js/buttons.dataTables.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/3.2.2/js/buttons.html5.min.js"></script>

  <script>
    $(document).ready(function() {
      $('#select2').select2({
        allowClear: true
      });
    });
    
    
    new DataTable('#basic-1', {
    layout: {
        topStart: {
             buttons: [
                 { extend: 'copy', className: 'btn btn-success text-white' },
        { extend: 'pdf', className: 'btn btn-success text-white' },
        { extend: 'excel', className: 'btn btn-success text-white' }
    ]
        
        }
    }
});

  </script>
    
</body>

</html>