<?php
include '../includes/db.php';

$name = $_POST['name'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
$city = $_POST['city'];
$age = $_POST['age'];
$verification_token = bin2hex(random_bytes(16));

$stmt = $conn->prepare("INSERT INTO users (name, email, password, city, age, verification_token) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param('ssssis', $name, $email, $password, $city, $age, $verification_token);

if ($stmt->execute()) {
    $verification_link = "http://localhost/auth/verify_email.php?token=$verification_token";
    // Simulate sending email for simplicity
    echo "<h1>Registration successful. Verify your email using this <a href='$verification_link'>link</a>.</h1>";
} else {
    echo "<h1>Registration failed. Please try again.</h1>";
}
?>
