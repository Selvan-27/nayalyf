<!DOCTYPE html>
<html lang="en">


<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Uniq Connect">
    <meta name="keywords" content="Uniq Connect">
    <meta name="author" content="Uniq Connect">
    <link rel="manifest" href="manifest.json">
    <link rel="icon" href="assets/images/logo/favicon.png" type="image/x-icon">
    <title>Uniq Connect</title>
    <link rel="apple-touch-icon" href="assets/images/logo/favicon.png">
    <meta name="theme-color" content="#2777FC">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="Uniq Connect">
    <meta name="msapplication-TileImage" content="assets/images/logo/favicon.png">
    <meta name="msapplication-TileColor" content="#FFFFFF">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="assets/css/br-hendrix.css">
    <link rel="stylesheet" type="text/css" id="rtl-link" href="assets/css/vendors/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/swiper-bundle.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/iconsax.css">
    <link rel="stylesheet" id="change-link" type="text/css" href="assets/css/style.css">
</head>


<body>
    <!-- loader start-->
    <div class="loader-wrapper" id="loader">
        <span class="loader"></span>
    </div>
    <!-- loader end -->

    <!-- header start -->
    <header class="main-header profile-header">
        <div class="custom-container">
            <div class="header-panel">
                <a href="#sidebar" class="sidebar-btn" data-bs-toggle="offcanvas">
                    <i class="iconsax" data-icon="text-align-left"></i>
                </a>
                <h3>Your Awards!</h3>
            </div>
        </div>
    </header>
    <!-- header end -->

    <!-- profile section starts -->
    <section class="light-theme-bg">
        <div class="profile-background">
            <div class="profile-part">
                <div class="profile-image">
                    <img id="output" class="img-fluid profile-pic"   src="{{ Auth::user()->profile_photo ? asset('profile/'.Auth::user()->profile_photo) : asset('assets/images/avatar/uc.png') }}"  alt="11">
                </div>
             <h3>{{Auth::user()->name?? ''}}</h3>
                <p>{{Auth::user()->memberid?? ''}}</p>
                <p>{{$member_rank}}</p>
            </div>
        </div><br><br>
    </section>

    <section class="pt-0">
        <div class="profile-wrapper">
            <div class="form">
                <div class="form-group row">
                    <label for="awardFilter" class="col-12">Select Award</label>
                    <div class="col-12">
                        <select class="form-control digits" id="awardFilter" onchange="filterAwards()">
                            <option value="0">All Awards</option>
                            <option value="1">BWD-Bronze Wellness Distributor</option>
                            <option value="2">SSD-Silver Star Distributor</option>
                            <option value="3">GED-Golden Elite Distributor</option>
                            <option value="4">PD-Platinum Distributor</option>
                            <option value="5">DD-Dynamic Distributor</option>
                            <option value="6">RD-Rhodium Distributor</option>
                            <option value="7">UCA-UC Ambassador</option>
                            <option value="8">DA-Diamond Ambassador</option>
                            <option value="9">EA-Elite Ambassador</option>
                            <option value="10">TA-Titan Ambassador</option>
                            <option value="11">DDD-Double Diamond Director</option>
                            <option value="12">DED-Double Elite Director</option>
                            <option value="13">DTD-Double Titan Director</option>
                            <option value="14">CD-Crown Director</option>
                        </select>
                    </div>
                </div>
            </div><br>
        
        
        <div class="table table-responsive">
            <table id="recent-orders" class="table text-center">
                <thead>
                    <tr>
                        <th class="border-top-0">S.No</th>
                        <th class="border-top-0">Achieve Date</th>
                        <th class="border-top-0">Achieve Cut-Off</th>
                        <th class="border-top-0">Rank</th>
                        
                    </tr>
                </thead>
                <tbody id="awardsTableBody">
                     @foreach($data as $index => $item)                    
                    <tr class="award-row" data-award="{{ $item->award }}">
                        <td class="text-truncate">{{ $index + 1 }}</td>
                        <td class="text-truncate">{{ $item->created_at ? \Carbon\Carbon::parse($item->created_at)->format('d/m/Y H:i A') : 'N/A' }}</td>
                        <td class="text-truncate">{{ $item->cutoff_name ?? $item->memberid }}</td>
                        <td class="text-truncate">{{ $item->award }}</td>
                    </tr>
                     @endforeach
                    <!--<tr>-->
                    <!--    <td class="text-truncate">2</td>-->
                    <!--    <td class="text-truncate">[date_time]</td>-->
                    <!--    <td class="text-truncate">2508</td>-->
                    <!--    <td class="text-truncate">Eligible 2</td>-->
                    <!--</tr>-->
                    <!--<tr>-->
                    <!--    <td class="text-truncate">3</td>-->
                    <!--    <td class="text-truncate">[date_time]</td>-->
                    <!--    <td class="text-truncate">2509</td>-->
                    <!--    <td class="text-truncate">Rank</td>-->
                    <!--</tr>-->
                    <!--<tr>-->
                    <!--    <td class="text-truncate">4</td>-->
                    <!--    <td class="text-truncate">[date_time]</td>-->
                    <!--    <td class="text-truncate">2510</td>-->
                    <!--    <td class="text-truncate">Rank</td>-->
                    <!--</tr>-->
                    <!--<tr>-->
                    <!--    <td class="text-truncate">5</td>-->
                    <!--    <td class="text-truncate">[date_time]</td>-->
                    <!--    <td class="text-truncate">2511</td>-->
                    <!--    <td class="text-truncate">Rank</td>-->
                    <!--</tr>-->
                    <!--<tr>-->
                    <!--    <td class="text-truncate">6</td>-->
                    <!--    <td class="text-truncate">[date_time]</td>-->
                    <!--    <td class="text-truncate">2512</td>-->
                    <!--    <td class="text-truncate">Rank</td>-->
                    <!--</tr>-->
                    
                    
                </tbody>
                
            </table>
        </div>

            
        </div>
    </section>
    <!-- profile section ends -->
    
    

    

   

    <!-- bottom panel start -->
    <ul class="bottom-menu">
        <li><a href="/Home"><i class="iconsax text-content" data-icon="home-2"></i><h6>Home</h6></a></li>
        <li><a href="/Dashboard"><i class="iconsax text-content" data-icon="grid-apps"></i><h6>Account</h6></a></li>
        <li><a href="/UC_Wallet"><i class="iconsax text-content" data-icon="wallet-1"></i><h6>Wallet</h6></a></li>
        <li><a href="/Orders"><i class="iconsax text-content" data-icon="shop"></i><h6>Orders</h6></a></li>
        <li><a href="/Profile" class="active"><i class="iconsax text-content" data-icon="user-2"></i><h6>Profile</h6></a></li>
        <li><a href="#"><i class="iconsax text-content" data-icon="calendar-add"></i><h6>Todo</h6></a></li>
    </ul>
    <!-- bottom panel end -->

    <!-- sidebar starts -->
    <div class="offcanvas sidebar-offcanvas offcanvas-start" tabindex="-1" id="sidebar">
        <div class="offcanvas-header sidebar-header">
            <div class="sidebar-logo">
                <img class="img-fluid logo" src="assets/images/logo/logo.png" alt="logo">
            </div>
        </div>
        <div class="offcanvas-body">
            <a href="edit-profile.html" class="profile-part">
                <img class="img-fluid profile-pic" src="assets/images/avatar/uc.png" alt="p8">
                <div>
                    <h3>[member_name]</h3>
                    <span>[member_id]</span>
                    <h5>[member_rank]</h5>
                </div>
                
            </a>
            
            <ul class="link-section switch-section">
                <!--<li class="active">
                    <a href="home.html" class="pages">
                        <i class="iconsax sidebar-icon icon" data-icon="home-2"></i>
                        <h3>Home</h3>
                    </a>
                </li>
                <li>
                    <a href="category.html" class="pages">
                        <i class="iconsax sidebar-icon icon" data-icon="grid-apps"></i>
                        <h3>Category</h3>
                    </a>
                </li>
                <li>
                    <a href="cart.html" class="pages">
                        <i class="iconsax sidebar-icon icon" data-icon="shopping-cart"></i>

                        <h3>Cart</h3>
                    </a>
                </li>

                <li>
                    <a href="wishlist.html" class="pages">
                        <i class="iconsax sidebar-icon icon" data-icon="heart"></i>
                        <h3>Wishlist</h3>
                    </a>
                </li>
                <li>
                    <a href="account.html" class="pages">
                        <i class="iconsax sidebar-icon icon" data-icon="user-2"></i>
                        <h3>Profile</h3>
                    </a>
                </li>

                <li>
                    <a href="page-listing.html" class="pages">
                        <i class="iconsax sidebar-icon icon" data-icon="book-closed"> </i>
                        <h3>Template Pages</h3>
                    </a>
                </li>

                <li>
                    <a href="elements-page.html" class="pages">
                        <i class="iconsax sidebar-icon icon" data-icon="document-text-1"> </i>
                        <h3> Template Elements</h3>
                    </a>
                </li>-->

                <!-- <li>
                    <div class="pages">
                        <i class="iconsax sidebar-icon" data-icon="repeat"> </i>
                        <h3>RTL</h3>
                    </div>
                    <div class="switch-btn">
                        <input id="dir-switch" type="checkbox">
                    </div>
                </li> -->

                <li>
                    <div class="pages">
                        <i class="iconsax sidebar-icon" data-icon="brush-3"> </i>
                        <h3>Dark</h3>
                    </div>
                    <div class="switch-btn">
                        <input id="dark-switch" type="checkbox">
                    </div>
                </li>

            </ul>

            <div class="bottom-sidebar">
                <a href="/" class="pages">
                    <i class="iconsax sidebar-icon" data-icon="logout-2"> </i>
                    <h3>Logout</h3>
                </a>
            </div>
        </div>
    </div>
    <!-- sidebar end -->

    <!-- bootstrap js -->
    <script src="assets/js/bootstrap.bundle.min.js"></script>

    <!-- iconsax icon -->
    <script src="assets/js/iconsax-icon.js"></script>

    <!-- template-setting js -->
    <script src="assets/js/template-setting.js"></script>

    <!-- image change js -->
    <script src="assets/js/image-change.js"></script>

    <!-- script js -->
    <script src="assets/js/script.js"></script>
    
    <script>
        function filterAwards() {
            const filterValue = document.getElementById('awardFilter').value;
            const rows = document.querySelectorAll('.award-row');
            
            // Award mapping for filtering
            const awardMapping = {
                '1': 'BWD-Bronze Wellness Distributor',
                '2': 'SSD-Silver Star Distributor',
                '3': 'GED-Golden Elite Distributor',
                '4': 'PD-Platinum Distributor',
                '5': 'DD-Dynamic Distributor',
                '6': 'RD-Rhodium Distributor',
                '7': 'UCA-UC Ambassador',
                '8': 'DA-Diamond Ambassador',
                '9': 'EA-Elite Ambassador',
                '10': 'TA-Titan Ambassador',
                '11': 'DDD-Double Diamond Director',
                '12': 'DED-Double Elite Director',
                '13': 'DTD-Double Titan Director',
                '14': 'CD-Crown Director'
            };
            
            rows.forEach((row, index) => {
                const awardText = row.getAttribute('data-award');
                
                if (filterValue === '0') {
                    // Show all awards
                    row.style.display = '';
                    // Update serial number
                    row.querySelector('td:first-child').textContent = index + 1;
                } else {
                    // Filter based on selected award
                    const selectedAward = awardMapping[filterValue];
                    if (awardText === selectedAward) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                }
            });
            
            // Update serial numbers for visible rows
            let visibleIndex = 1;
            rows.forEach(row => {
                if (row.style.display !== 'none') {
                    row.querySelector('td:first-child').textContent = visibleIndex;
                    visibleIndex++;
                }
            });
        }
    </script>
</body>


<!-- Mirrored from themes.pixelstrap.com/pwa/Uniq Connect/account.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 12 Mar 2025 09:41:23 GMT -->
</html>