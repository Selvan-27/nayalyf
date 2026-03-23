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
        .accordion {
            max-width: 600px;
            margin: 0 auto;
        }

        .accordion-item {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            margin-bottom: 12px;
            overflow: hidden;
        }

        .accordion-header1 {
            background: linear-gradient(135deg, #e9f2ff, #03972fff);
            padding: 15px 20px;
            font-weight: 600;
            cursor: pointer;
            position: relative;
        }

        .accordion-header2 {
            background: linear-gradient(135deg, #e9f2ff, #ffbb00ff);
            padding: 15px 20px;
            font-weight: 600;
            cursor: pointer;
            position: relative;
        }

        .accordion-header3 {
            background: linear-gradient(135deg, #e9f2ff, #5b8ef2);
            padding: 15px 20px;
            font-weight: 600;
            cursor: pointer;
            position: relative;
        }

        .accordion-header1::after {
            content: '+';
            position: absolute;
            right: 20px;
            font-size: 20px;
            transition: transform 0.3s;
        }

        .accordion-header2::after {
            content: '+';
            position: absolute;
            right: 20px;
            font-size: 20px;
            transition: transform 0.3s;
        }

        .accordion-header3::after {
            content: '+';
            position: absolute;
            right: 20px;
            font-size: 20px;
            transition: transform 0.3s;
        }

        .accordion-header1.active::after {
            transform: rotate(45deg);
        }

        .accordion-header2.active::after {
            transform: rotate(45deg);
        }

        .accordion-header3.active::after {
            transform: rotate(45deg);
        }

        .accordion-body {
            display: none;
            padding: 20px;
            background: #fafbff;
        }

        .card {
            background: linear-gradient(135deg, #f9f9ff, #f3f9ff, #fff7ff);
            background-size: 200% 400%;
            animation: gradientShift 6s ease infinite;
            border-radius: 12px;
            padding: 15px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        }

        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        td {
            padding: 10px 8px;
            border-bottom: 1px solid #eee;
        }

        .progress-bar-container {
            background: #e9ecef;
            border-radius: 6px;
            overflow: hidden;
            height: 10px;
            margin-bottom: 15px;
        }

        .progress-bar {
            height: 10px;
            width: 60%; /* adjust value dynamically */
            background: linear-gradient(90deg, #5b8ef2, #72c2ff);
            border-radius: 6px;
            transition: width 0.4s ease;
        }

        .btn-group {
            display: flex;
            gap: 10px;
        }

        .btn {
            flex: 1;
            padding: 10px 0;
            text-align: center;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 500;
            transition: all 0.3s;
        }

        .btn-primary {
            background: #4b8ef2;
            color: #fff;
        }

        .btn-secondary {
            background: #e4e7eb;
            color: #333;
        }

        .btn:hover {
            transform: translateY(-2px);
        }

        .table-responsive {
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            white-space: nowrap;
        }

        .card {
            background: #fff;
            border-radius: 12px;
            padding: 15px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
            position: relative;
            max-width: 100%;
            overflow: hidden;
        }

        /* Scroll container for table */
        .table-scroll {
            max-height: 100%; 
            overflow-y: auto;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            white-space: nowrap;
            border-radius: 8px;
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
                <h3>Uniq ToDo Tracking </h3>
            </div>
        </div>
    </header>
    <!-- header end -->
<br>
    
    <!-- languages section starts -->
    <section class="custom-container">
        <div class="accordion">

            <div class="accordion-item">
                <div class="accordion-header1">[member_name] | [member_id]<br>Active Member</div>
                <div class="accordion-body">
                    <div class="card">
                        <div class="title">
                            <h5>Active From: [active_date]</h5>
                            <h5 class="see-all theme-color">SP: 1600</h5>
                        </div>
                        <table>
                            <tr>
                                <td><strong>Training</strong></td>
                                <td class="link-success">Completed</td>
                            </tr>
                            <tr>
                                <td><strong>Contact List</strong></td>
                                <td class="link-danger">[contact_count]</td>
                            </tr>
                            <tr>
                                <td><strong>Challenge Tasks</strong></td>
                                <td>0 Out Of 30 Tasks</td>
                            </tr>
                        </table>
                        

                        <div class="row">
                            <div class="col-g">
                                <div class="title">
                                    <h5>Current Task #: 1</h5>
                                    <h5 class="see-all link-danger">Delay: 0 Days</h5>
                                </div>
                            </div>
                            <div class="col-g">
                                <div class="progress-bar-container">
                                    <div class="progress-bar" style="width: 70%;"></div>
                                </div>
                            </div>

                        </div>
                        <div class="card">
                        <table class="text-center">
                            <tr class="theme-color">
                                <td><strong>Active</strong></td>
                                <td><strong>In-Active</strong></td>
                                <td><strong>Customers</strong></td>
                            </tr>
                            <tr>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                            </tr>
                        </table>
                        </div>
                        
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <div class="accordion-header2">[member_name] | [member_id]<br>In-Active Member</div>
                <div class="accordion-body">
                    <div class="card">
                        <div class="title">
                            <h5>Signed Up On: [register_date]</h5>
                            <h5 class="see-all theme-color">SP: 1600</h5>
                        </div>
                        <table>
                            <tr>
                                <td><strong>Referrals</strong></td>
                                <td>[refer_count]</td>
                            </tr>
                            <tr>
                                <td><strong>Incentive</strong></td>
                                <td>[wallet_balance]</td>
                            </tr>
                            <tr>
                                <td><strong>Purchase Value</strong></td>
                                <td>[total_order_value]</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <div class="accordion-header3">[customer_name]<br>Product Customer</div>
                <div class="accordion-body">
                    <div class="card">
                        <div class="table-scroll">
                            <table class="table text-center">
                                <thead>
                                    <tr>
                                        <th>Delay</th>
                                        <th>Product</th>
                                        <th>Orders</th>
                                        <th>Last Order Date</th>
                                        <th>Next Order Date</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="link-primary">0 Days</td>
                                        <td>UC Antioxidant Juice</td>
                                        <td>[order_count]</td>
                                        <td>[order_date]</td>
                                        <td>[15_days]</td>
                                        
                                    </tr>
                                    <tr>
                                        <td class="link-danger">2 Days</td>
                                        <td>UC Herbal Detox Tea</td>
                                        <td>[order_count]</td>
                                        <td>[order_date]</td>
                                        <td>[15_days]</td>
                                        
                                    </tr>
                                </tbody>
                            </table>
                        </div><br>


                        <div class="d-flex gap-2">
                            <a href="#center" class="btn btn-primary w-100" data-bs-toggle="modal">Update New Order</a>
                            
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </section>

    <!-- languages section end -->
        <!-- center modal starts -->
    <div class="modal element-modal fade" id="center" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header p-2">
                    <h2 class="modal-title" id="exampleModalLabel">Update New Order</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="text" class="form-control wo-icon mb-2" id="inputordernumber" placeholder="Order Number">

                    <div id="productContainer">
                        <div class="row mb-2 product-row">
                            <div class="col-8">
                                <select class="form-select">
                                    <option value="">Select Product</option>
                                    <option value="product1">Product 1</option>
                                    <option value="product2">Product 2</option>
                                    <option value="product3">Product 3</option>
                                </select>
                            </div>
                            <div class="col-4">
                                <input type="number" class="form-control wo-icon" placeholder="Qty">
                            </div>
                        </div>
                    </div>

                    <button type="button" class="btn btn-link text-primary p-0" id="addProductBtn">
                        + Add Product
                    </button>
                </div>

                <div class="modal-footer">
                    <a href="#" class="btn theme-btn p-2">Update</a>
                </div>
            </div>
        </div>
    </div>
    <!-- center modal end -->
    

    
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
    // Function to set up smooth accordion behavior
    function setupSmoothAccordion(selector) {
        const headers = document.querySelectorAll(selector);

        headers.forEach(header => {
            const body = header.nextElementSibling;
            body.style.maxHeight = "0";
            body.style.overflow = "hidden";
            body.style.transition = "max-height 0.4s ease";

            header.addEventListener('click', () => {
                const isActive = header.classList.toggle('active');

                if (isActive) {
                    // Open accordion
                    body.style.display = "block";
                    const scrollHeight = body.scrollHeight + "px";
                    body.style.maxHeight = scrollHeight;
                } else {
                    // Close accordion
                    body.style.maxHeight = "0";
                    setTimeout(() => {
                        if (!header.classList.contains('active')) {
                            body.style.display = "none";
                        }
                    }, 400);
                }
            });
        });
    }

    // Initialize all three types of accordions
    setupSmoothAccordion('.accordion-header1');
    setupSmoothAccordion('.accordion-header2');
    setupSmoothAccordion('.accordion-header3');
</script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const addProductBtn = document.getElementById("addProductBtn");
        const productContainer = document.getElementById("productContainer");

        addProductBtn.addEventListener("click", function () {
            const productCount = productContainer.querySelectorAll(".product-row").length;

            if (productCount >= 5) {
                alert("You can add up to 5 products only.");
                return;
            }

            const newRow = document.createElement("div");
            newRow.classList.add("row", "mb-2", "product-row");

            newRow.innerHTML = `
                <div class="col-8">
                    <select class="form-select">
                        <option value="">Select Product</option>
                        <option value="product1">Product 1</option>
                        <option value="product2">Product 2</option>
                        <option value="product3">Product 3</option>
                    </select>
                </div>
                <div class="col-4">
                    <input type="number" class="form-control wo-icon" placeholder="Qty">
                </div>
            `;

            productContainer.appendChild(newRow);
        });
    });
</script>


    


    

</body>

</html>