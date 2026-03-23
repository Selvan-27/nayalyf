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
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            margin-bottom: 15px;
            overflow: hidden;
        }

        .accordion-header {
            background: linear-gradient(135deg, #e9f2ff, #bfc8ffff);
            padding: 15px 20px;
            font-weight: 600;
            color: #222;
            cursor: pointer;
            position: relative;
            transition: 0.3s;
        }

        .accordion-header:hover {
            background: linear-gradient(135deg, #dce9ff, #2df0a3);
        }

        .accordion-header::after {
            content: '+';
            position: absolute;
            right: 20px;
            font-size: 20px;
            transition: transform 0.3s;
        }

        .accordion-header.active::after {
            transform: rotate(45deg);
        }

        .accordion-content {
            display: none;
            padding: 15px 20px;
            border-top: 1px solid #eee;
            background: #fff;
        }

        .accordion-content.show {
            display: block;
            animation: fadeIn 0.4s ease;
        }

        @keyframes fadeIn {
            from {opacity: 0; transform: translateY(-10px);}
            to {opacity: 1; transform: translateY(0);}
        }

        .table-container {
            max-height: 100%;
            overflow-y: auto;
            white-space: nowrap;
            border-radius: 8px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }

        th {
            padding: 10px;
            border-bottom: 1px solid #eee;
            text-align: center;
            white-space: nowrap;
        }

        td {
            padding: 10px;
            border-bottom: 1px solid #eee;
            text-align: center;
            white-space: nowrap;
        }

        .progress-bar {
            width: 100%;
            height: 8px;
            background: #e0e0e0;
            border-radius: 4px;
            margin: 10px 0;
        }

        .progress {
            height: 8px;
            background: linear-gradient(90deg, #4b66ff, #2df0a3);
            border-radius: 4px;
            transition: width 0.5s ease;
        }

        .btn-group {
            display: flex;
            gap: 10px;
            margin-top: 10px;
        }

        .btn {
            flex: 1;
            padding: 8px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
            transition: 0.3s;
        }

        .btn-primary {
            background: #4b66ff;
            color: white;
        }

        .btn-secondary {
            background: #ddd;
            color: #333;
        }

        .btn-primary:hover {
            background: #3449cc;
        }

        .btn-secondary:hover {
            background: #ccc;
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
                <h3>Uniq ToDo Challenges</h3>
            </div>
        </div>
    </header>
    <!-- header end -->
<br>
    
    <!-- languages section starts -->
    <section class="custom-container">
        <div class="accordion">
            <div class="accordion-header">Task # 1: <span class="link-success">Completed</span></div>
            <div class="accordion-content">
                <div class="title">
                    <h5 class="theme-color fw-bold">Visit 3 New Members (1st set)</h5>
                    <h5 class="see-all link-danger fw-bold">Delay: 0 Days</h5>
                </div>
                <div class="title">
                    <h5 class="theme-color">Start Date: [date]</h5>
                    <h5 class="see-all link-danger">End Date: [3_days]</h5>
                </div>
                <div class="card">
                    <div class="table-container table-scroll">
                        <table class="table text-center">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Mobile</th>
                                    <th>Date</th>
                                    <th>Remarks</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>C1</td>
                                    <td>John</td>
                                    <td>8110011112</td>
                                    <td>2025-10-12</td>
                                    <td>Follow Up</td>
                                </tr>
                                <tr>
                                    <td>C2</td>
                                    <td>Mary</td>
                                    <td>8110011112</td>
                                    <td>2025-10-13</td>
                                    <td>Purchased</td>
                                </tr>
                                <tr>
                                    <td>C3</td>
                                    <td>Mary</td>
                                    <td>8110011112</td>
                                    <td>2025-10-13</td>
                                    <td>Joined</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                
            </div>
        </div>

        <div class="accordion">
            <div class="accordion-header">Task # 2: <span class="link-primary">On-Going</span></div>
            <div class="accordion-content">
                <div class="title">
                    <h5 class="theme-color fw-bold">Visit 3 New Members (2nd set)</h5>
                    <h5 class="see-all link-danger fw-bold">Delay: 0 Days</h5>
                </div>
                <div class="title">
                    <h5 class="theme-color">Start Date: [date]</h5>
                    <h5 class="see-all link-danger">End Date: [3_days]</h5>
                </div>
                <div class="card">
                    <div class="table-container table-scroll">
                        <table class="table text-center">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Mobile</th>
                                    <th>Date</th>
                                    <th>Remarks</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>C4</td>
                                    <td>Sathees Kirubakaran</td>
                                    <td>8110011112</td>
                                    <td>2025-10-12</td>
                                    <td>Follow Up</td>
                                </tr>
                                <tr>
                                    <td>C5</td>
                                    <td>Santhana Mary</td>
                                    <td>8110011112</td>
                                    <td>2025-10-13</td>
                                    <td>Follow Up</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div><br>
                <p>Task Progress:</p>
                <div class="progress-bar"><div class="progress" style="width:66%"></div></div>
            </div>
        </div>


        <div class="accordion">
            <div class="accordion-header">Task # 3: <span class="link-danger">Pending</span></div>
            <div class="accordion-content">
                <div class="title">
                    <h5 class="theme-color fw-bold">Visit 3 New Members (3rd set)</h5>
                    
                </div>
                
                <!-- <div class="card">
                    <div class="table-container table-scroll">
                        <table class="table text-center">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Mobile</th>
                                    <th>Date</th>
                                    <th>Remarks</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Sathees Kirubakaran</td>
                                    <td>8110011112</td>
                                    <td>2025-10-12</td>
                                    <td>Visited</td>
                                </tr>
                                <tr>
                                    <td>Santhana Mary</td>
                                    <td>8110011112</td>
                                    <td>2025-10-13</td>
                                    <td>Pending</td>
                                </tr>
                                <tr>
                                    <td>Mary</td>
                                    <td>8110011112</td>
                                    <td>2025-10-13</td>
                                    <td>Pending</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div><br> -->
                <!-- <p>Task Progress:</p>
                <div class="progress-bar"><div class="progress" style="width:0%"></div></div> -->
                <!-- <div class="btn-group">
                    <button class="btn btn-primary">Mark Done</button>
                    <button class="btn btn-secondary">View Details</button>
                </div> -->
                
            </div>
        </div>

        <div class="accordion">
            <div class="accordion-header">Task # 4: <span class="link-danger">Pending</span></div>
            <div class="accordion-content">
                <div class="title">
                    <h5 class="theme-color fw-bold">Visit 3 New Members (4th set)</h5>
                </div>
            </div>
        </div>

        <div class="accordion">
            <div class="accordion-header">Task # 5: <span class="link-danger">Pending</span></div>
            <div class="accordion-content">
                <div class="title">
                    <h5 class="theme-color fw-bold">Visit 3 New Members (5th set)</h5>
                </div>
            </div>
        </div>

        <div class="accordion">
            <div class="accordion-header">Task # 6: <span class="link-danger">Pending</span></div>
            <div class="accordion-content">
                <div class="title">
                    <h5 class="theme-color fw-bold">Re-Visit 6 Members (1st & 2nd set)</h5>
                </div>
            </div>
        </div>

        <div class="accordion">
            <div class="accordion-header">Task # 7: <span class="link-danger">Pending</span></div>
            <div class="accordion-content">
                <div class="title">
                    <h5 class="theme-color fw-bold">Re-Visit 9 Members (3rd, 4th & 5th set)</h5>
                </div>
            </div>
        </div>

        <div class="accordion">
            <div class="accordion-header">Task # 8: <span class="link-danger">Pending</span></div>
            <div class="accordion-content">
                <div class="title">
                    <h5 class="theme-color fw-bold">Visit 3 New Members (6th set)</h5>
                </div>
            </div>
        </div>

        <div class="accordion">
            <div class="accordion-header">Task # 9: <span class="link-danger">Pending</span></div>
            <div class="accordion-content">
                <div class="title">
                    <h5 class="theme-color fw-bold">Visit 3 New Members (7th set)</h5>
                </div>
            </div>
        </div>

        <div class="accordion">
            <div class="accordion-header">Task # 10: <span class="link-danger">Pending</span></div>
            <div class="accordion-content">
                <div class="title">
                    <h5 class="theme-color fw-bold">Visit 3 New Members (8th set)</h5>
                </div>
            </div>
        </div>

        <div class="accordion">
            <div class="accordion-header">Task # 11: <span class="link-danger">Pending</span></div>
            <div class="accordion-content">
                <div class="title">
                    <h5 class="theme-color fw-bold">Visit 3 New Members (9th set)</h5>
                </div>
            </div>
        </div>

        <div class="accordion">
            <div class="accordion-header">Task # 12: <span class="link-danger">Pending</span></div>
            <div class="accordion-content">
                <div class="title">
                    <h5 class="theme-color fw-bold">Visit 3 New Members (10th set)</h5>
                </div>
            </div>
        </div>

        <div class="accordion">
            <div class="accordion-header">Task # 13: <span class="link-danger">Pending</span></div>
            <div class="accordion-content">
                <div class="title">
                    <h5 class="theme-color fw-bold">Re-Visit 6 Members (6th & 7th set)</h5>
                </div>
            </div>
        </div>

        <div class="accordion">
            <div class="accordion-header">Task # 14: <span class="link-danger">Pending</span></div>
            <div class="accordion-content">
                <div class="title">
                    <h5 class="theme-color fw-bold">Re-Visit 9 Members (8th, 9th & 10th set)</h5>
                </div>
            </div>
        </div>

        <div class="accordion">
            <div class="accordion-header">Task # 15: <span class="link-danger">Pending</span></div>
            <div class="accordion-content">
                <div class="title">
                    <h5 class="theme-color fw-bold">Add 30 New Contacts</h5>
                </div>
            </div>
        </div>

        <div class="accordion">
            <div class="accordion-header">Task # 16: <span class="link-danger">Pending</span></div>
            <div class="accordion-content">
                <div class="title">
                    <h5 class="theme-color fw-bold">Visit 3 New Members (11th set)</h5>
                </div>
            </div>
        </div>

        <div class="accordion">
            <div class="accordion-header">Task # 17: <span class="link-danger">Pending</span></div>
            <div class="accordion-content">
                <div class="title">
                    <h5 class="theme-color fw-bold">Visit 3 New Members (12th set)</h5>
                </div>
            </div>
        </div>


        <div class="accordion">
            <div class="accordion-header">Task # 18: <span class="link-danger">Pending</span></div>
            <div class="accordion-content">
                <div class="title">
                    <h5 class="theme-color fw-bold">Visit 3 New Members (13th set)</h5>
                </div>
            </div>
        </div>

        <div class="accordion">
            <div class="accordion-header">Task # 19: <span class="link-danger">Pending</span></div>
            <div class="accordion-content">
                <div class="title">
                    <h5 class="theme-color fw-bold">Visit 3 New Members (14th set)</h5>
                </div>
            </div>
        </div>

        <div class="accordion">
            <div class="accordion-header">Task # 20: <span class="link-danger">Pending</span></div>
            <div class="accordion-content">
                <div class="title">
                    <h5 class="theme-color fw-bold">Visit 3 New Members (15th set)</h5>
                </div>
            </div>
        </div>

        <div class="accordion">
            <div class="accordion-header">Task # 21: <span class="link-danger">Pending</span></div>
            <div class="accordion-content">
                <div class="title">
                    <h5 class="theme-color fw-bold">Re-Visit 6 Members (11th & 12th set)</h5>
                </div>
            </div>
        </div>

        <div class="accordion">
            <div class="accordion-header">Task # 22: <span class="link-danger">Pending</span></div>
            <div class="accordion-content">
                <div class="title">
                    <h5 class="theme-color fw-bold">Re-Visit 9 Members (13th, 14th & 15th set)</h5>
                </div>
            </div>
        </div>

        <div class="accordion">
            <div class="accordion-header">Task # 23: <span class="link-danger">Pending</span></div>
            <div class="accordion-content">
                <div class="title">
                    <h5 class="theme-color fw-bold">Visit 3 New Members (16th set)</h5>
                </div>
            </div>
        </div>

        <div class="accordion">
            <div class="accordion-header">Task # 24: <span class="link-danger">Pending</span></div>
            <div class="accordion-content">
                <div class="title">
                    <h5 class="theme-color fw-bold">Visit 3 New Members (17th set)</h5>
                </div>
            </div>
        </div>

        <div class="accordion">
            <div class="accordion-header">Task # 25: <span class="link-danger">Pending</span></div>
            <div class="accordion-content">
                <div class="title">
                    <h5 class="theme-color fw-bold">Visit 3 New Members (18th set)</h5>
                </div>
            </div>
        </div>

        <div class="accordion">
            <div class="accordion-header">Task # 26: <span class="link-danger">Pending</span></div>
            <div class="accordion-content">
                <div class="title">
                    <h5 class="theme-color fw-bold">Visit 3 New Members (19th set)</h5>
                </div>
            </div>
        </div>

        <div class="accordion">
            <div class="accordion-header">Task # 27: <span class="link-danger">Pending</span></div>
            <div class="accordion-content">
                <div class="title">
                    <h5 class="theme-color fw-bold">Visit 3 New Members (20th set)</h5>
                </div>
            </div>
        </div>

        <div class="accordion">
            <div class="accordion-header">Task # 28: <span class="link-danger">Pending</span></div>
            <div class="accordion-content">
                <div class="title">
                    <h5 class="theme-color fw-bold">Re-Visit 6 Members (16th & 17th set)</h5>
                </div>
            </div>
        </div>

        <div class="accordion">
            <div class="accordion-header">Task # 29: <span class="link-danger">Pending</span></div>
            <div class="accordion-content">
                <div class="title">
                    <h5 class="theme-color fw-bold">Re-Visit 9 Members (18th, 19th & 20th set)</h5>
                </div>
            </div>
        </div>

        <div class="accordion">
            <div class="accordion-header">Task # 30: <span class="link-danger">Pending</span></div>
            <div class="accordion-content">
                <div class="title">
                    <h5 class="theme-color fw-bold">Update Your Core Contact List.</h5>
                </div>
            </div>
        </div>

        

        

    </section>

    <!-- languages section end -->
        <div class="panel-space"></div>
    

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
        const accordions = document.querySelectorAll('.accordion-header');
        accordions.forEach(header => {
            header.addEventListener('click', () => {
                header.classList.toggle('active');
                const content = header.nextElementSibling;
                if (content.classList.contains('show')) {
                    content.classList.remove('show');
                } else {
                    document.querySelectorAll('.accordion-content').forEach(c => c.classList.remove('show'));
                    document.querySelectorAll('.accordion-header').forEach(h => h.classList.remove('active'));
                    content.classList.add('show');
                    header.classList.add('active');
                }
            });
        });
    </script>


    

</body>

</html>