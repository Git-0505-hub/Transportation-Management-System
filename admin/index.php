<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}
include '../includes/db.php';

// Retrieve admin name from the database
$admin_id = $_SESSION['admin_id'];
$stmt = $conn->prepare("SELECT full_name FROM admins WHERE admin_id = ?");
$stmt->bind_param('i', $admin_id);
$stmt->execute();
$result = $stmt->get_result();
$admin = $result->fetch_assoc();
$admin_name = $admin['full_name'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background: #f0f4f8; /* Soft background color */
            color: #34495e; /* Text color */
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .container {
            max-width: 1100px;
            margin: 50px auto;
            padding: 20px;
            background: #ffffff; /* White background for content */
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h1 {
            font-size: 36px;
            color: #2ecc71; /* Fresh green for headings */
            margin-bottom: 20px;
        }

        .btn {
            display: inline-block;
            margin: 20px 15px;
            padding: 14px 28px;
            font-size: 18px;
            color: #ffffff; /* White text */
            background: #3498db; /* Blue button background */
            border: none;
            border-radius: 8px;
            text-decoration: none;
            transition: background-color 0.3s ease, transform 0.2s;
        }

        .btn:hover {
            background: #2980b9; /* Darker blue on hover */
            transform: scale(1.05);
        }

        .btn.logout {
            background: #95a5a6; /* Neutral gray for logout */
            color: #ffffff;
            font-size: 16px;
            padding: 10px 20px; /* Smaller logout button */
        }

        .btn.logout:hover {
            background: #7f8c8d; /* Slightly darker gray on hover */
        }

        footer {
            margin-top: auto;
            background: #2c3e50; /* Darker footer background for better visibility */
            color: #bdc3c7; /* Light gray text for contrast */
            text-align: center;
            padding: 15px;
            font-size: 14px;
        }

        footer a {
            color: #ecf0f1; /* Footer link color */
            text-decoration: none;
        }

        footer a:hover {
            text-decoration: underline;
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .container {
                width: 90%;
                padding: 20px;
            }

            h1 {
                font-size: 28px;
            }

            .btn {
                font-size: 16px;
                padding: 12px 24px;
                margin: 10px 10px;
            }
        }
    </style>
</head>
<body>
    <?php include '../includes/header.php'; ?>

    <div class="container">
        <h1>Welcome, <?= htmlspecialchars($admin_name) ?>!</h1>
        <p>Manage your platform effectively using the options below:</p>
        <a href="manage_buses.php" class="btn">Manage Buses</a>
        <a href="manage_users.php" class="btn">Manage Users</a>
        <a href="../auth/logout.php" class="btn logout">Logout</a>
    </div>

    <?php include '../includes/footer.php'; ?>
</body>
</html>
