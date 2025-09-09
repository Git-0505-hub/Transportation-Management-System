<?php
session_start();
include '../includes/db.php';

// Get email and password from POST request
$email = trim($_POST['email']);
$password = trim($_POST['password']);

// Prepare statement to validate admin credentials
$stmt = $conn->prepare("SELECT admin_id, password FROM admins WHERE email = ?");
$stmt->bind_param('s', $email);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($admin_id, $hashed_password);

// Check if admin exists and the password matches
if ($stmt->num_rows > 0 && $stmt->fetch() && password_verify($password, $hashed_password)) {
    $_SESSION['admin_id'] = $admin_id; // Set session for admin login
    echo json_encode(['success' => true, 'redirect' => '../admin/index.php']);
} else {
    // Return error message if credentials are invalid
    echo json_encode(['success' => false, 'message' => 'Invalid admin email or password.']);
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
