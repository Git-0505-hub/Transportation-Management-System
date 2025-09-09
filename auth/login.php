<?php
session_start();

// Redirect logged-in users to their dashboard
if (isset($_SESSION['user_id'])) {
    header("Location: ../user/index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include '../includes/db.php';

    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Check user credentials
    $stmt = $conn->prepare("SELECT user_id, password FROM users WHERE email = ?");
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($user_id, $hashed_password);

    if ($stmt->num_rows > 0 && $stmt->fetch() && password_verify($password, $hashed_password)) {
        $_SESSION['user_id'] = $user_id;
        header("Location: ../user/index.php");
        exit;
    } else {
        $error = "Invalid email or password.";
    }

    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            color: #2c3e50;
            margin: 0;
            padding: 0;
        }

        .auth-container {
            max-width: 500px;
            margin: 120px auto;
            background-color: #fff;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .auth-title {
            font-size: 28px;
            color: #2c3e50;
            margin-bottom: 20px;
            font-weight: bold;
            width: 100%;
            text-align: center;
        }

        .error-msg {
            color: #e74c3c;
            font-size: 14px;
            margin-bottom: 15px;
        }

        .form-group {
            margin-bottom: 15px;
            width: 100%;
            text-align: left;
        }

        .form-group label {
            font-size: 14px;
            color: #2c3e50;
            margin-bottom: 5px;
            display: block;
        }

        .form-group input {
            width: 100%;
            padding: 12px;
            font-size: 14px;
            border: 1px solid #ddd;
            border-radius: 8px;
            margin-top: 5px;
            background-color: #f5f6fa;
            box-sizing: border-box;
        }

        .form-group input:focus {
            border-color: #3498db;
            outline: none;
            background-color: #fff;
        }

        .btn {
            width: 100%;
            padding: 12px;
            font-size: 14px;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-top: 10px;
        }

        .primary-btn {
            background-color: #3498db;
        }

        .primary-btn:hover {
            background-color: #2980b9;
        }

        .secondary-btn {
            background-color: #2ecc71;
        }

        .secondary-btn:hover {
            background-color: #27ae60;
        }

        .auth-buttons {
            margin-top: 20px;
            display: flex;
            flex-direction: column;
            gap: 10px;
            width: 100%;
        }

        .auth-buttons a {
            text-decoration: none;
            display: block;
            text-align: center;
            padding: 12px;
            font-size: 14px;
            color: white;
            border-radius: 8px;
            transition: background-color 0.3s ease;
        }

        .register-btn {
            background-color: #8e44ad;
        }

        .register-btn:hover {
            background-color: #732d91;
        }

        .admin-btn {
            background-color: #e67e22;
        }

        .admin-btn:hover {
            background-color: #d35400;
        }

        /* Responsive design */
        @media (max-width: 480px) {
            .auth-container {
                padding: 20px;
                max-width: 300px;
            }

            .auth-title {
                font-size: 24px;
            }

            .form-group input {
                font-size: 14px;
            }

            .btn {
                font-size: 14px;
                padding: 12px;
            }
        }
    </style>
</head>
<body>
<div class="auth-container">
    <div class="auth-title">User Login</div>
    <?php if (isset($error)): ?>
        <p class="error-msg"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <form action="login.php" method="post" class="auth-form">
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" required>
        </div>
        <button type="submit" class="btn primary-btn">Login</button>
    </form>
    <div class="auth-buttons">
        <a href="register.php" class="register-btn">Register</a>
        <a href="../admin/login.php" class="admin-btn">Admin Login</a>
    </div>
</div>
</body>
</html>
