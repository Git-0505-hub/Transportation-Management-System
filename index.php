<?php
session_start();
$pageTitle = "Welcome to the Public Transportation Portal";
include 'includes/header.php';
?>

<style>
    /* Reset some basic styles */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Arial', sans-serif;
        background-color: #f4f7fb;
        color: #333;
        padding: 0;
        margin: 0;
        display: flex;
    }

    /* Sidebar Styles */
    .sidebar {
        width: 250px;
        background-color: #2c3e50;
        color: white;
        padding: 20px;
        height: 100vh;
        position: fixed;
        top: 0;
        left: 0;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        transition: all 0.3s ease;
    }

    .sidebar a {
        color: white;
        text-decoration: none;
        font-size: 18px;
        margin: 15px 0;
        padding: 10px;
        border-radius: 5px;
        display: block;
        transition: background-color 0.3s ease;
    }

    .sidebar a:hover {
        background-color: #34495e;
    }

    .sidebar .logo {
        font-size: 24px;
        font-weight: bold;
        text-align: center;
        margin-bottom: 20px;
    }

    .sidebar .logout-btn {
        position: absolute;
        bottom: 20px;
        left: 50%;
        transform: translateX(-50%);
        background-color: #e74c3c;
        color: white;
        padding: 10px 20px;
        text-align: center;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    .sidebar .logout-btn:hover {
        background-color: #c0392b;
    }

    /* Main content */
    .main-content {
        margin-left: 250px;
        padding: 20px;
        width: calc(100% - 250px);
        background-color: #f4f7fb;
        min-height: 100vh;
    }

    .landing {
        background-color: #ffffff;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        max-width: 800px;
        margin: 50px auto;
        padding: 40px;
        text-align: center;
    }

    .landing h2 {
        font-size: 32px;
        color: #2c3e50;
        margin-bottom: 20px;
        font-weight: bold;
    }

    .landing p {
        font-size: 18px;
        color: #7f8c8d;
        margin-bottom: 30px;
    }

    .btn {
        display: inline-block;
        padding: 15px 30px;
        margin: 10px;
        font-size: 16px;
        text-decoration: none;
        background-color: #3498db;
        color: white;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    .btn:hover {
        background-color: #2980b9;
    }

    .btn-alt {
        background-color: #2ecc71;
    }

    .btn-alt:hover {
        background-color: #27ae60;
    }

    .landing .btn-alt {
        background-color: #e74c3c;
    }

    .landing .btn-alt:hover {
        background-color: #c0392b;
    }

    footer {
        text-align: center;
        margin-top: 50px;
        color: #7f8c8d;
        font-size: 14px;
    }

    footer a {
        color: #3498db;
        text-decoration: none;
    }

    footer a:hover {
        text-decoration: underline;
    }
</style>

<!-- Sidebar -->
<div class="sidebar">
    <div class="logo">
        
    </div>
    <a href="index.php" class="btn">Home</a>
    <?php if (isset($_SESSION['admin_id'])): ?>
        <!-- Admin links -->
        <a href="admin_dashboard.php" class="btn">Admin Dashboard</a>
        <a href="manage_buses.php" class="btn">Manage Buses</a>
        <a href="auth/logout.php" class="logout-btn">Logout</a>
    <?php elseif (isset($_SESSION['user_id'])): ?>
        <!-- User links -->
        <a href="user_dashboard.php" class="btn">User Dashboard</a>
        <a href="auth/logout.php" class="logout-btn">Logout</a>
    <?php else: ?>
        <!-- Public links -->
        <a href="auth/login.php" class="btn">Login</a>
        <a href="auth/register.php" class="btn btn-alt">Register</a>
    <?php endif; ?>
</div>

<!-- Main Content Area -->
<div class="main-content">
    <div class="landing">
        <h2>Your Gateway to Seamless Public Transport</h2>
        <p>Explore bus schedules, manage your trips, and enjoy a hassle-free journey with us.</p>
        
        <?php if (isset($_SESSION['user_id'])): ?>
            <p>Welcome back, <?php echo htmlspecialchars($_SESSION['username']); ?>!</p>
            <a href="auth/logout.php" class="btn btn-alt">Logout</a>
        <?php else: ?>
            <a href="auth/login.php" class="btn">Login</a>
            <a href="auth/register.php" class="btn btn-alt">Register</a>
        <?php endif; ?>
    </div>

    <?php include 'includes/footer.php'; ?>
</div>
