<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include '../includes/db.php';

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $city = $_POST['city'];
    $age = $_POST['age'];

    $stmt = $conn->prepare("INSERT INTO users (name, email, password, city, age) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param('ssssi', $name, $email, $password, $city, $age);

    if ($stmt->execute()) {
        header("Location: login.php?registered=true");
        exit;
    } else {
        $error = "An error occurred. Please try again.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7f9;
            margin: 0;
            padding: 0;
        }

        .register-container {
            max-width: 450px;
            margin: 100px auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        }

        .register-container h1 {
            font-size: 28px;
            color: #2c3e50;
            margin-bottom: 20px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group input {
            width: 100%;
            padding: 12px;
            font-size: 14px;
            border: 1px solid #ddd;
            border-radius: 8px;
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
            font-size: 16px;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            background-color: #1abc9c; /* Teal color for Register button */
            margin-top: 10px;
        }

        .btn:hover {
            background-color: #16a085;
        }

        .btn-secondary {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            background-color: #3498db; /* Blue color for Login button */
            margin-top: 10px;
            text-decoration: none;
            text-align: center;
            display: block;
        }

        .btn-secondary:hover {
            background-color: #2980b9;
        }

        .error {
            color: #e74c3c;
            font-size: 14px;
            margin-bottom: 15px;
            text-align: center;
        }

        /* Responsive Design */
        @media (max-width: 480px) {
            .register-container {
                padding: 20px;
                max-width: 300px;
            }

            .register-container h1 {
                font-size: 24px;
            }

            .btn, .btn-secondary {
                font-size: 14px;
                padding: 10px;
            }
        }
    </style>
</head>
<body>
<div class="register-container">
    <h1>User Registration</h1>
    <?php if (isset($error)): ?>
        <p class="error"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <form action="register.php" method="post">
        <div class="form-group">
            <input type="text" name="name" placeholder="Full Name" required>
        </div>
        <div class="form-group">
            <input type="email" name="email" placeholder="Email" required>
        </div>
        <div class="form-group">
            <input type="password" name="password" placeholder="Password" required>
        </div>
        <div class="form-group">
            <input type="text" name="city" placeholder="City" required>
        </div>
        <div class="form-group">
            <input type="number" name="age" placeholder="Age" required>
        </div>
        <button type="submit" class="btn">Register</button>
    </form>
    <a href="login.php" class="btn-secondary">Login</a>
</div>
</body>
</html>
