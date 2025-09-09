<?php
if (!isset($_GET['token'])) {
    header("Location: ../index.php");
    exit;
}

include '../includes/db.php';
$token = $_GET['token'];

$stmt = $conn->prepare("UPDATE users SET verified = 1 WHERE verification_token = ?");
$stmt->bind_param('s', $token);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo "<h1>Email verified successfully! You can now <a href='login.php'>login</a>.</h1>";
} else {
    echo "<h1>Invalid or expired token.</h1>";
}
?>
