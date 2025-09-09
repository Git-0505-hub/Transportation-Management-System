<?php
session_start();

// Check if user is logged in as admin
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}

include '../includes/db.php';

// Check if user_id is set in URL
if (isset($_GET['id'])) {
    $user_id = $_GET['id'];

    // Prepare the delete query
    $stmt = $conn->prepare("DELETE FROM users WHERE user_id = ?");
    $stmt->bind_param('i', $user_id);

    if ($stmt->execute()) {
        // Success: Redirect to manage_users.php with success message
        $_SESSION['success'] = "User deleted successfully.";
        header("Location: manage_users.php");
        exit;
    } else {
        // Failure: Redirect to manage_users.php with error message
        $_SESSION['error'] = "An error occurred while deleting the user.";
        header("Location: manage_users.php");
        exit;
    }

    $stmt->close();
} else {
    // If no user_id is provided, redirect to manage_users.php
    $_SESSION['error'] = "No user ID specified.";
    header("Location: manage_users.php");
    exit;
}

$conn->close();
?>
