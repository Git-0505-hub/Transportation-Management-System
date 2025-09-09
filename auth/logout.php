<?php
// logout.php: Destroys the session and shows a logout confirmation page
session_start();

// Unset all session variables
$_SESSION = [];

// Destroy the session
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout Successful</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #f0f4f8; /* Soft blue-gray background */
            color: #34495e; /* Dark gray text */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .logout-container {
            text-align: center;
            background-color: #ffffff; /* White background for the card */
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 90%;
        }

        h1 {
            font-size: 28px;
            color: #27ae60; /* Pleasant green */
            margin-bottom: 20px;
        }

        p {
            font-size: 16px;
            color: #7f8c8d; /* Soft gray for text */
            margin-bottom: 30px;
            line-height: 1.5;
        }

        .btn {
            display: inline-block;
            padding: 12px 24px;
            font-size: 16px;
            color: #ffffff; /* White text */
            background-color: #2c3e50; /* Dark, neutral button */
            text-decoration: none;
            border-radius: 8px;
            transition: background-color 0.3s ease, transform 0.2s;
        }

        .btn:hover {
            background-color: #34495e; /* Slightly lighter */
            transform: scale(1.05);
        }

        /* Footer link for added polish */
        footer {
            margin-top: 20px;
            font-size: 14px;
            color: #95a5a6; /* Subtle gray */
        }

        footer a {
            color: #27ae60; /* Matching pleasant green */
            text-decoration: none;
        }

        footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="logout-container">
        <h1>Logged Out Successfully</h1>
        <p>You have been securely logged out of your account. Click the button below to log in again.</p>
        <a href="login.php" class="btn">Go to Login</a>
        <footer>
            <p>Need help? <a href="contact.php">Contact Support</a></p>
        </footer>
    </div>
</body>
</html>
