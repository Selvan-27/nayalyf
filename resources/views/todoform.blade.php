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
    <style>
        @keyframes gradientShift {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }

        .card {
            background: linear-gradient(135deg, #f9f9ff, #94fcbcff, #ffe8aaff);
            background-size: 200% 200%;
            animation: gradientShift 6s ease infinite;
            border-radius: 12px;
            padding: 15px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            transition: all 0.1s ease;
            cursor: pointer;
            position: relative;
        }

        .card:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 14px rgba(0,0,0,0.12);
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
                <h3>Uniq Visit Form </h3>
            </div>
        </div>
    </header>
    <!-- header end -->

    
    <!-- form section starts -->
    <section class="section-b-space">
        <div class="custom-container">
            <form class="theme-form profile-form">
                <div class="card p-10">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label class="form-label" for="birthdate">Last Visited On:</label>
                            <h4 class="theme-color">[date]</h4><br>
                            <h6>Delayed By: 0 Days</h6>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label class="form-label title-color">Type</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" name="flexRadio" type="radio" id="radio1" checked>
                            <label class="form-check-label title-color" for="radio1">
                                Core
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" name="flexRadio" type="radio" id="radio2">
                            <label class="form-check-label title-color" for="radio2">
                                Non-Core
                            </label>
                        </div>
                    </div>

                </div>   
                </div><hr>
                <div class="form-group mt-0">
                    <label class="form-label" for="inputname">Name</label>
                    <input type="text" class="form-control wo-icon" id="inputname" value="Smitha Williams"
                        placeholder="Enter name">
                </div>

                <div class="form-group">
                    <label class="form-label" for="inputMobile">Mobile Number</label>
                    <input type="Number" class="form-control wo-icon" id="inputMobile" value="9652345678"
                        placeholder="Enter Number">
                </div>
                <div class="form-group">
                    <label class="form-label" for="inputWhatsApp">WhatsApp Number</label>
                    <input type="Number" class="form-control wo-icon" id="inputWhatsApp" value="9652345678"
                        placeholder="Enter Number">
                </div>

                <div class="form-group">
                    <label class="form-label" for="inputemail">Email</label>
                    <input type="email" class="form-control wo-icon" id="inputemail" value="smitha01@example.com"
                        placeholder="Enter username">
                </div>

                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label class="form-label title-color">Gender</label>
                        </div>

                        <div class="d-flex align-items-center gap-2">
                            <div class="form-check">
                                <input class="form-check-input ms-auto" type="radio" name="flexRadioDefault"
                                    id="flexRadioDefault3">
                                <label class="form-check-label" for="flexRadioDefault3">Male</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input ms-auto" type="radio" name="flexRadioDefault"
                                    id="flexRadioDefault4" checked>
                                <label class="form-check-label" for="flexRadioDefault4">Female</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <label class="form-label" for="birthdate">Birth Date</label>
                            <input type="date" class="form-control wo-icon" id="birthdate" value="">
                        </div>
                    </div>
                </div>

                <!-- Occupation -->
                <div class="form-group">
                    <label class="form-label" for="occupation">Occupation</label>
                    <select class="form-select form-control wo-icon" id="occupation">
                        <option value="">Select Occupation</option>
                        <option value="business">Business</option>
                        <option value="government job">Government Job</option>
                        <option value="private job">Private Job</option>
                        <option value="house wife">House Wife</option>
                        <option value="student">Student</option>
                        <option value="others">Others</option>
                    </select>
                    <input type="text" class="form-control mt-2 d-none" id="otherOccupation"
                        placeholder="Please specify your occupation">
                </div>

                <!-- Interested -->
                <div class="form-group">
                    <label class="form-label" for="interested">Interested In</label>
                    <select class="form-select form-control" id="interested">
                        <option value="">Select Interest</option>
                        <option value="product">Product</option>
                        <option value="business">Business</option>
                        <option value="both">Both</option>
                    </select>

                    <div id="productDropdownContainer" class="mt-2 d-none">
                        <select class="form-select form-control mb-2">
                            <option value="">Select Product</option>
                            <option value="product1">Product 1</option>
                            <option value="product2">Product 2</option>
                            <option value="product3">Product 3</option>
                        </select>

                        <a href="#" id="addProduct" class="theme-color fw-medium small-text">+ Add Product</a>
                    </div>
                </div>

                <!-- Next Visit Date -->
                <div class="form-group">
                    <label class="form-label" for="nextVisit">Next Visit Date</label>
                    <input type="date" class="form-control wo-icon" id="nextVisit">
                </div><br><hr>
            </form>
        </div>
        <div class="fixed-btn-grp">
            <div class="custom-container">
                <a href="#" class="btn btn-mid theme-btn w-100">Update Visit Details</a>
            </div>
        </div>
    </section>

    <section class="custom-container">                
        <div class="custom-container">
            <a href="#" class="btn btn-mid btn-info w-100">Send Referral Link To Mr/Ms. [contact_name]</a>
        </div>
        <div class="row">
            <div class="col-12"></div><br>
            <div class="col-6">
                <div class="custom-container">
                    <a href="#" class="btn btn-mid btn-success w-100">Joined</a>
                </div>
            </div>
            <div class="col-6">
                <div class="custom-container">
                    <a href="#" class="btn btn-mid btn-primary w-100">Purchased</a>
                </div>
            </div>
        </div><br>
        <hr>
    </section>


    <section>                
        <div class="custom-container">
            <h3><u>Follow Up Details:</u></h3><br>
            <div class="table table-responsive">
                <table id="recent-orders" class="table text-center">
                    <thead>
                        <tr>
                            <th class="border-top-0">#</th>
                            <th class="border-top-0">Visit Date</th>
                            <th class="border-top-0">Follow Up</th>
                            <th class="border-top-0">Interest</th>
                            <th class="border-top-0">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-truncate">1</td>
                            <td class="text-truncate">[date_time]</td>
                            <td class="text-truncate">[date_time]</td>
                            <td class="text-truncate">Business</td>
                            <td class="text-truncate"><a class="link-danger">FollowUp</a></td>
                        </tr>
                        <tr>
                            <td class="text-truncate">2</td>
                            <td class="text-truncate">[date_time]</td>
                            <td class="text-truncate">[date_time]</td>
                            <td class="text-truncate">Product</td>
                            <td class="text-truncate"><a class="link-info">Referred</a></td>
                        </tr>
                        <tr>
                            <td class="text-truncate">3</td>
                            <td class="text-truncate">[date_time]</td>
                            <td class="text-truncate">[date_time]</td>
                            <td class="text-truncate">Product</td>
                            <td class="text-truncate"><a class="link-success">Joined</a></td>
                        </tr>
                        <tr>
                            <td class="text-truncate">4</td>
                            <td class="text-truncate">[date_time]</td>
                            <td class="text-truncate">[date_time]</td>
                            <td class="text-truncate">Product</td>
                            <td class="text-truncate"><a class="link-primary">Purchased</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <div class="panel-space"></div><br>


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

    <script>
        // Handle Occupation dropdown
        const occupationSelect = document.getElementById('occupation');
        const otherOccupationInput = document.getElementById('otherOccupation');
        occupationSelect.addEventListener('change', function () {
            if (this.value === 'others') {
                otherOccupationInput.classList.remove('d-none');
            } else {
                otherOccupationInput.classList.add('d-none');
                otherOccupationInput.value = '';
            }
        });
    </script>

    <script>
        //handle interested dropdown
        const interestedSelect = document.getElementById('interested');
        const productContainer = document.getElementById('productDropdownContainer');
        const addProductBtn = document.getElementById('addProduct');

        // Show/hide product section based on interest
        interestedSelect.addEventListener('change', function () {
            if (this.value === 'product' || this.value === 'both') {
                productContainer.classList.remove('d-none');
            } else {
                productContainer.classList.add('d-none');
                // Remove any extra product dropdowns
                const selects = productContainer.querySelectorAll('select');
                selects.forEach((select, index) => {
                    if (index > 0) select.remove();
                });
            }
        });

        // Add product dropdowns with a limit of 3
        addProductBtn.addEventListener('click', function (e) {
            e.preventDefault();

            const currentSelects = productContainer.querySelectorAll('select').length;
            if (currentSelects >= 3) {
                alert('You can add up to 3 products only.');
                return;
            }

            const newSelect = document.createElement('select');
            newSelect.className = 'form-select form-control mb-2';
            newSelect.innerHTML = `
                <option value="">Select Product</option>
                <option value="product1">Product 1</option>
                <option value="product2">Product 2</option>
                <option value="product3">Product 3</option>
            `;
            productContainer.insertBefore(newSelect, addProductBtn);
        });
    </script>
</body>
</html>