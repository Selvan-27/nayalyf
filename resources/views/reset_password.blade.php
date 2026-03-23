<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Dleohr is a clean and modern human resource management admin dashboard template which is based on HTML 5, Bootstrap 5. Try Demo and Buy Now!">
	<meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern, accounts, invoice, html5, responsive, CRM, Projects">
    <title>Reset Password</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="google-site-verification" content="KQqjqpiE2S9PXDwXR1Qd4PJFuVj4OuIHEz3L1rzWTtA" />	
    <!-- Favicon -->


    <!-- Apple Icon -->
    <link rel="apple-touch-icon" href="images/apple-icon.png">

    <!-- Theme Config Js -->
    <script src="js/theme-script.js" type="cee027f135ed6da1c28aec05-text/javascript"></script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- Fontawesome CSS -->
	<link rel="stylesheet" href="css/fontawesome.min.css">
	<link rel="stylesheet" href="css/all.min.css">

    <!-- Tabler Icon CSS -->
    <link rel="stylesheet" href="css/tabler-icons.min.css">

    <!-- Simplebar CSS -->
    <link rel="stylesheet" href="css/simplebar.min.css">

    <!-- ChartC3 CSS -->
    <link rel="stylesheet" href="css/c3.min.css">

    <!-- Select2 CSS -->
    <link rel="stylesheet" href="css/select2.min.css">

    <!-- Main CSS -->
    <link rel="stylesheet" href="css/style.css" id="app-style">
    <style>
        body {
            background: linear-gradient(to right, #e3f2fd, #f8f9fa);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
        }

        .password-reset-container {
            max-width: 420px;
            margin: 60px auto;
            padding: 30px;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.1);
            position: relative;
        }

        .logo-container {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo-container img {
            max-width: 120px;
        }

        .reset-form-header {
            text-align: center;
            margin-bottom: 25px;
        }

        .reset-form-header h2 {
            margin: 0;
            font-size: 22px;
            color: #333;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            font-weight: 600;
            display: block;
            margin-bottom: 6px;
            color: #444;
        }

        .form-group input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 1rem;
        }

        .submit-btn {
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            border: none;
            border-radius: 6px;
            color: white;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        .submit-btn:hover {
            background-color: #0056b3;
        }

        .alert {
            padding: 10px;
            border-radius: 5px;
            font-size: 0.95rem;
            margin-bottom: 15px;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
        }

        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
        }

        .password-requirements {
            font-size: 0.8rem;
            color: #777;
            margin-top: 4px;
        }
    </style>
</head>
<body>
    <div class="password-reset-container">
        {{-- Logo --}}
        <div class="logo-container">
            	<img src="https://uniqconnectwc.com/assets/images/logo/logo2.png" class="img-fluid" width="100" alt="Logo">
        </div>

        <div class="reset-form-header">
            <h2>Reset Your Password</h2>
        </div>

        {{-- Session Messages --}}
        @if (session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        {{-- Form --}}
        <form  method="POST" action="/updatePassword">
            @csrf
            <input type="hidden" name="user_id" value="{{ $user_id }}">

            <div class="form-group">
                <label for="new-password">New Password</label>
                <input type="password" id="new-password" name="new_password" required
                      >
                <!--<p class="password-requirements">At least one number, one uppercase and lowercase letter, and 8+ characters.</p>-->
            </div>

            <div class="form-group">
                <label for="new-password-confirmation">Confirm New Password</label>
                <input type="password" id="new-password-confirmation" name="new_password_confirmation" required>
            </div>

            <button type="submit" class="submit-btn">Reset Password</button>
        </form>
    </div>

    {{-- Match Password Script --}}
    <!--<script>-->
    <!--    const resetForm = document.getElementById('passwordResetForm');-->
    <!--    const password = document.getElementById('new-password');-->
    <!--    const confirm = document.getElementById('new-password-confirmation');-->

    <!--    resetForm.addEventListener('submit', function(e) {-->
    <!--        if (password.value !== confirm.value) {-->
    <!--            confirm.setCustomValidity('Passwords do not match.');-->
    <!--            e.preventDefault();-->
    <!--        } else {-->
    <!--            confirm.setCustomValidity('');-->
    <!--        }-->
    <!--    });-->

    <!--    confirm.addEventListener('input', () => confirm.setCustomValidity(''));-->
    <!--</script>-->
</body>
</html>