<?php
session_start();
include '../includes/db.php';

// Get the role from POST (admin or user)
$role = $_POST['role']; // 'user' or 'admin'
$email = $_POST['email'];
$password = $_POST['password'];

if ($role === 'user') {
    // Process user login
    $stmt = $conn->prepare("SELECT user_id, password FROM users WHERE email = ?");
    $stmt->bind_param('s', $email);
} elseif ($role === 'admin') {
    // Process admin login
    $stmt = $conn->prepare("SELECT admin_id, password FROM admins WHERE email = ?");
    $stmt->bind_param('s', $email);
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid role specified']);
    exit;
}

$stmt->execute();
$stmt->store_result();
$stmt->bind_result($id, $hashed_password);

if ($stmt->num_rows > 0 && $stmt->fetch() && password_verify($password, $hashed_password)) {
    if ($role === 'user') {
        $_SESSION['user_id'] = $id;
    } elseif ($role === 'admin') {
        $_SESSION['admin_id'] = $id;
    }
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid credentials']);
}

$stmt->close();
$conn->close();
?>
