<?php
session_start();

// Redirect logged-in admins to the dashboard
if (isset($_SESSION['admin_id'])) {
    header("Location: index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include '../includes/db.php';

    $full_name = trim($_POST['full_name']); // Updated from 'name' to 'full_name'
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    // Validate passwords match
    if ($password !== $confirm_password) {
        $error = "Passwords do not match!";
    } else {
        // Check if email is already registered
        $stmt = $conn->prepare("SELECT admin_id FROM admins WHERE email = ?");
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $error = "Email is already registered!";
        } else {
            // Hash the password
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);

            // Insert new admin
            $stmt = $conn->prepare("INSERT INTO admins (full_name, email, password) VALUES (?, ?, ?)");
            $stmt->bind_param('sss', $full_name, $email, $hashed_password);

            if ($stmt->execute()) {
                $success = "Registration successful! You can now log in.";
            } else {
                $error = "An error occurred. Please try again.";
            }
        }

        $stmt->close();
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Registration</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background: #f7f9fc; /* Light blue-gray background */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .auth-container {
            width: 100%;
            max-width: 400px;
            padding: 20px;
            background: #ffffff; /* White background for the form */
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1); /* Soft shadow */
            text-align: center;
        }

        .auth-title {
            font-size: 24px;
            margin-bottom: 20px;
            color: #2c3e50; /* Dark gray for titles */
        }

        .auth-form .form-group {
            margin-bottom: 15px;
            text-align: left;
        }

        .form-group label {
            font-size: 14px;
            color: #34495e; /* Dark gray for labels */
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #dcdde1; /* Light gray border */
            border-radius: 5px;
            margin-top: 5px;
            outline: none;
            box-sizing: border-box;
        }

        .form-group input:focus {
            border-color: #3498db; /* Blue border on focus */
            box-shadow: 0 0 5px rgba(52, 152, 219, 0.3); /* Subtle blue glow */
        }

        .btn {
            display: inline-block;
            width: 100%;
            padding: 10px 15px;
            font-size: 16px;
            color: #ffffff; /* White text */
            background: #3498db; /* Blue background */
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-decoration: none;
            margin-top: 10px;
        }

        .btn:hover {
            background: #2980b9; /* Darker blue on hover */
        }

        .btn.secondary-btn {
            background: #2ecc71; /* Green background for secondary button */
        }

        .btn.secondary-btn:hover {
            background: #27ae60; /* Darker green on hover */
        }

        .error-msg {
            color: #e74c3c; /* Red for errors */
            margin-bottom: 10px;
        }

        .success-msg {
            color: #2ecc71; /* Green for success */
            margin-bottom: 10px;
        }

        .auth-switch {
            margin-top: 15px;
            font-size: 14px;
        }

        .auth-switch a {
            color: #3498db; /* Blue link */
            text-decoration: none;
        }

        .auth-switch a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="auth-container">
    <h1 class="auth-title">Admin Registration</h1>
    <?php if (isset($error)): ?>
        <p class="error-msg"><?= htmlspecialchars($error) ?></p>
    <?php elseif (isset($success)): ?>
        <p class="success-msg"><?= htmlspecialchars($success) ?></p>
    <?php endif; ?>
    <form action="register.php" method="post" class="auth-form">
        <div class="form-group">
            <label for="full_name">Full Name</label>
            <input type="text" id="full_name" name="full_name" placeholder="Enter your full name" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" required>
        </div>
        <div class="form-group">
            <label for="confirm_password">Confirm Password</label>
            <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm your password" required>
        </div>
        <button type="submit" class="btn primary-btn">Register</button>
    </form>
    <p class="auth-switch">
        Already registered? <a href="login.php" class="btn secondary-btn">Login Here</a>
    </p>
</div>
</body>
</html>
