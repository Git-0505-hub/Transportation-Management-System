<?php
// session_start();
$pageTitle = $pageTitle ?? "Bus Reservation System";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($pageTitle); ?></title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
<header class="main-header">
    <div class="container">
        <h1>Bus Reservation System</h1>
        <nav>
            <ul>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <!-- User Navigation -->
                    <li><a href="../user/index.php">Home</a></li>
                    <li><a href="../user/search_buses.php">Search Buses</a></li>
                    <li><a href="../user/view_trip_history.php">Trip History</a></li>
                    <li><a href="../auth/logout.php" class="btn logout">Logout</a></li>
                <?php elseif (isset($_SESSION['admin_id'])): ?>
                    <!-- Admin Navigation -->
                    <li><a href="../admin/index.php">Dashboard</a></li>
                    <li><a href="../admin/manage_buses.php">Manage Buses</a></li>
                    <li><a href="../admin/manage_users.php">Manage Users</a></li>
                    <li><a href="../auth/logout.php" class="btn logout">Logout</a></li>
                <?php else: ?>
                    <!-- Guest Navigation -->
                    <li><a href="../auth/login.php">User Login</a></li>
                    <li><a href="../admin/login.php">Admin Login</a></li>
                    <li><a href="../auth/register.php">Register</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</header>
<div class="container">
