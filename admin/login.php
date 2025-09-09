<?php
session_start();

// Redirect logged-in admins to the admin dashboard
if (isset($_SESSION['admin_id'])) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background: #f7f9fc;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .auth-container {
            width: 100%;
            max-width: 400px;
            padding: 20px;
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .auth-title {
            font-size: 24px;
            margin-bottom: 20px;
            color: #2c3e50;
        }

        .auth-form .form-group {
            margin-bottom: 15px;
            text-align: left;
        }

        .form-group label {
            font-size: 14px;
            color: #34495e;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #dcdde1;
            border-radius: 5px;
            margin-top: 5px;
            outline: none;
            box-sizing: border-box;
        }

        .form-group input:focus {
            border-color: #3498db;
            box-shadow: 0 0 5px rgba(52, 152, 219, 0.3);
        }

        .btn {
            display: inline-block;
            width: 100%;
            padding: 10px 15px;
            font-size: 16px;
            color: #ffffff;
            background: #3498db;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-decoration: none;
            margin-top: 10px;
        }

        .btn:hover {
            background: #2980b9;
        }

        .btn.secondary-btn {
            background: #2ecc71;
            margin-top: 5px;
        }

        .btn.secondary-btn:hover {
            background: #27ae60;
        }

        .error-msg {
            color: #e74c3c;
            margin-bottom: 10px;
            display: block;
        }

        .auth-switch {
            margin-top: 15px;
            font-size: 14px;
        }

        .auth-switch a {
            color: #2c3e50; /* Darker color for better visibility */
            text-decoration: none;
            font-weight: bold; /* Makes it stand out */
        }

        .auth-switch a:hover {
            text-decoration: underline;
            color: #3498db; /* Slight color change on hover */
        }

        @media screen and (max-width: 480px) {
            .auth-container {
                padding: 15px;
            }

            .auth-title {
                font-size: 20px;
            }

            .btn {
                font-size: 14px;
                padding: 8px;
            }
        }
    </style>
</head>
<body>
<div class="auth-container">
    <h1 class="auth-title">Admin Login</h1>
    <p class="error-msg" id="error-msg" style="display: none;">Invalid login details</p>
    <form id="admin-login-form" class="auth-form">
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Enter your admin email" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Enter your admin password" required>
        </div>
        <input type="hidden" name="role" value="admin">
        <button type="submit" class="btn primary-btn">Login</button>
    </form>
    <p class="auth-switch">
        Don't have an account? <a href="register.php" class="btn secondary-btn">Register Here</a>
    </p>
    <p class="auth-switch">
        <a href="../auth/login.php" class="btn secondary-btn">User Login</a>
    </p>
</div>
<script src="../assets/js/admin_login.js"></script>
</body>
</html>
