<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Call Task Manager</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        /* 🌈 Gradient Background */
        body {
            /* background: linear-gradient(135deg, #2b2d8f, #7f56d9); */
            min-height: 100vh;
            /* color: #fff; */
            font-family: 'Inter', sans-serif;
            transition: all 0.3s ease;
        }

        /* 🧱 Card Styling */
        .card-custom {
            background: #ffffff10;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.15);
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.15);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card-custom:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 25px rgba(0,0,0,0.2);
        }

        /* 💬 Status Badges */
        .badge-active { background-color: #28a745 !important; }   /* Green */
        .badge-inactive { background-color: #6c757d !important; } /* Gray */
        .badge-onhold { background-color: #ffc107 !important; }   /* Yellow */
        .badge-overdue { background-color: #dc3545 !important; }  /* Red */
        .badge-pending { background-color: #17a2b8 !important; }  /* Teal */

        /* ✨ Buttons */
        .btn-gradient {
            background: linear-gradient(90deg, #5a60ff, #8a4dff);
            color: white;
            border: none;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .btn-gradient:hover {
            background: linear-gradient(90deg, #4d54ff, #7f3dff);
            transform: scale(1.05);
        }

        /* 🕶️ Table tweaks */
        .table th, .table td {
            vertical-align: middle;
            /* color: #fff; */
        }

        .table-striped>tbody>tr:nth-of-type(odd)>* {
            background-color: rgba(255,255,255,0.05);
        }

        a {
            text-decoration: none;
        }

        .form-control, .form-select, textarea {
            background: rgba(255,255,255,0.1);
            /* color: #fff; */
            border: 1px solid rgba(255,255,255,0.25);
        }

        .form-control:focus, .form-select:focus, textarea:focus {
            border-color: #9d7aff;
            box-shadow: 0 0 0 0.25rem rgba(157, 122, 255, 0.25);
        }
    </style>
</head>
<body>


    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ route('contacts.index') }}">Call Task Manager</a>
        <div class="navbar-nav">
            <a class="nav-link" href="{{ route('contacts.index') }}">Dashboard</a>
            <a class="nav-link" href="{{ route('scheduled.index') }}">Scheduled Calls</a>
        </div>
    </div>
</nav>

    <main class="container py-4">
        @yield('content')
    </main>

</body>
</html>
