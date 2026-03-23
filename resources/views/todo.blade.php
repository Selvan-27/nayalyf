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
    <style>
/* Tile Grid Layout */
.tile-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
    padding: 0 20px;
}

/* Individual Tile */
.tile {
    background: #f7f9fc;
    border: 1px solid #e2e8f0;
    border-radius: 16px;
    padding: 25px 10px;
    text-align: center;
    box-shadow: 0 4px 10px rgba(0,0,0,0.05);
    transition: all 0.3s ease;
    text-decoration: none;
    color: #000;
    opacity: 0;
    transform: translateY(30px);
    animation: flyIn 0.8s ease forwards;
}

/* Tile hover / click effect */
.tile:hover {
    background: #2777FC;
    color: #fff;
    transform: translateY(-5px);
    box-shadow: 0 6px 16px rgba(39, 119, 252, 0.4);
}

/* Disabled tile */
.tile.disabled {
    opacity: 0.5;
    pointer-events: none;
}

/* Tile icon */
.tile img {
    width: 100px;
    height: 100px;
    margin-bottom: 10px;
}

/* Flying animation for tiles */
@keyframes flyIn {
    from { opacity: 0; transform: translateY(30px); }
    to { opacity: 1; transform: translateY(0); }
}

/* Responsive view */
@media (max-width: 600px) {
    .tile-grid {
        grid-template-columns: 1fr 1fr;
        gap: 15px;
    }
    .tile {
        padding: 20px 5px;
    }
}
</style>

<style>
/* Default tile styling */
.tile {
    background: #f7f9fc;
    border: 1px solid #e2e8f0;
    border-radius: 16px;
    padding: 25px 10px;
    text-align: center;
    box-shadow: 0 4px 10px rgba(0,0,0,0.05);
    transition: all 0.3s ease;
    text-decoration: none;
    color: #000;
}

/* Tile hover effects */
.tile:hover {
    background: #2777FC;
    color: #fff;
    transform: translateY(-5px);
    box-shadow: 0 6px 16px rgba(39, 119, 252, 0.4);
}

/* Bounce animation on hover or click */
.bounce-icon {
    width: 40px;
    height: 40px;
    transition: transform 0.2s ease;
}

.tile:hover .bounce-icon,
.tile:active .bounce-icon {
    animation: bounce 0.6s ease;
}

/* Keyframes for single bounce */
@keyframes bounce {
    0%, 100% {
        transform: translateY(0);
    }
    30% {
        transform: translateY(-15px);
    }
    60% {
        transform: translateY(5px);
    }
}
</style>






</head>

<body>
    <!-- loader start-->
    <div class="loader-wrapper" id="loader">
        <span class="loader"></span>
    </div>
    <!-- loader end -->

    <!-- header starts -->
    <header class="main-header">
        <div class="custom-container">
            <div class="header-panel">
                <a onclick="history.back();">
                    <img class="img-fluid icon-btn back-arrow" src="assets/images/svg/back-arrow.svg" alt="back-arrow">
                </a>
                <h3>Uniq ToDo </h3>
            </div>
        </div>
    </header>
    <!-- header end -->
<br>
    
    <!-- languages section starts -->
    <section class="section-b-space">
        <div class="custom-container tile-grid">
            <a href="/ToDoVideos" class="tile">
                <img src="assets/images/todo/1.png" alt="Video Training"  class="bounce-icon">
                <h5>Video Training</h5>
            </a>
            <a href="/ToDoVideos" class="tile">
                <img src="assets/images/todo/5.png" alt="Video Training"  class="bounce-icon">
                <h5>Video Library</h5>
            </a>
            <a href="/Contact_List" class="tile">
                <img src="assets/images/todo/2.png" alt="Contact List"  class="bounce-icon">
                <h5>Contact List</h5>
            </a>
            <a href="/ToDo_Tasks" class="tile">
                <img src="assets/images/todo/3.png" alt="ToDo Task"  class="bounce-icon">
                <h5>ToDo Task</h5>
            </a>
            <a href="/ToDo_Tracking" class="tile">
                <img src="assets/images/todo/4.png" alt="Team Tracking"  class="bounce-icon">
                <h5>Team Tracking</h5>
            </a>
            <a href="/ToDo_Tools" class="tile">
                <img src="assets/images/todo/6.png" alt="Team Tracking"  class="bounce-icon">
                <h5>Tools Download</h5>
            </a>
            
        </div>
    </section>

    <!-- languages section end -->

    

    <!-- panel-space start -->
    <!-- <div class="panel-space"></div> -->
    <!-- panel-space end -->
    <ul class="bottom-menu">
        <li><a href="/Home"><i class="iconsax text-content" data-icon="home-2"></i><h6>Home</h6></a></li>
        <li><a href="/Dashboard"><i class="iconsax text-content" data-icon="grid-apps"></i><h6>Account</h6></a></li>
        <li><a href="/UC_Wallet"><i class="iconsax text-content" data-icon="wallet-1"></i><h6>Wallet</h6></a></li>
        <li><a href="/Orders"><i class="iconsax text-content" data-icon="shop"></i><h6>Orders</h6></a></li>
        <li><a href="/Profile"><i class="iconsax text-content" data-icon="user-2"></i><h6>Profile</h6></a></li>
        <li><a href="/ToDo" class="active"><i class="iconsax text-content" data-icon="calendar-add"></i><h6>Todo</h6></a></li>
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
                <a href="login.html" class="pages">
                    <i class="iconsax sidebar-icon" data-icon="logout-2"> </i>
                    <h3>Logout</h3>
                </a>
            </div>
        </div>
    </div>
    <!-- bootstrap js -->
    <script src="assets/js/bootstrap.bundle.min.js"></script>

    <!-- iconsax icon -->
    <script src="assets/js/iconsax-icon.js"></script>

    <!-- homescreen popup icon -->
    <script src="assets/js/homescreen-popup.js"></script>

    <!-- template-setting js -->
    <script src="assets/js/template-setting.js"></script>

    <!-- script js -->
    <script src="assets/js/script.js"></script>

    


    

</body>

</html>