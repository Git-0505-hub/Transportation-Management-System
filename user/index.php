<?php
session_start();
include '../includes/db.php';
include '../includes/functions.php';

redirectIfNotLoggedIn();
$pageTitle = "User Dashboard";
include '../includes/header.php';

// Retrieve user's name from session or database
$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT name FROM users WHERE user_id = ?");
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$user_name = $user['name'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?></title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f6f9; /* Light grayish background */
            color: #2c3e50; /* Darker text for contrast */
            display: flex;
            flex-direction: column;
            height: 100vh;
        }

        .dashboard-container {
            width: 80%;
            max-width: 1100px;
            margin: 40px auto;
            padding: 30px;
            background-color: #ffffff; /* White background for content */
            border-radius: 12px;
            box-shadow: 0 6px 30px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h2 {
            font-size: 36px;
            color: #2ecc71; /* Fresh green */
            margin-bottom: 20px;
        }

        p {
            font-size: 18px;
            color: #7f8c8d; /* Soft gray text */
            line-height: 1.6;
            margin-bottom: 40px;
        }

        .action-buttons {
            display: flex;
            justify-content: center;
            gap: 25px;
            margin-top: 30px;
        }

        .btn {
            padding: 16px 28px;
            font-size: 18px;
            color: #fff;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s;
        }

        .primary-btn {
            background-color: #2c3e50; /* Dark, elegant color */
        }

        .primary-btn:hover {
            background-color: #34495e; /* Slightly lighter dark color */
            transform: scale(1.05);
        }

        .secondary-btn {
            background-color: #27ae60; /* A soft green tint */
        }

        .secondary-btn:hover {
            background-color: #2ecc71; /* Slightly brighter green */
            transform: scale(1.05);
        }

        .tertiary-btn {
            background-color: #e74c3c; /* Bright red for bus booking */
        }

        .tertiary-btn:hover {
            background-color: #c0392b; /* Slightly darker red */
            transform: scale(1.05);
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .dashboard-container {
                width: 90%;
                padding: 20px;
            }

            h2 {
                font-size: 30px;
            }

            p {
                font-size: 16px;
            }

            .action-buttons {
                flex-direction: column;
                gap: 15px;
            }
        }

        /* Footer styling */
        footer {
            margin-top: auto;
            background-color: #34495e; /* Dark footer */
            color: #ecf0f1; /* Light text for footer */
            padding: 20px;
            text-align: center;
            font-size: 16px;
        }

    </style>
</head>
<body>

<div class="dashboard-container">
    <h2>Welcome, <?= htmlspecialchars($user_name) ?>!</h2>
    <p>Explore bus schedules, manage your trips, and enjoy seamless travel planning.</p>

    <div class="action-buttons">
        <a href="search_buses.php" class="btn primary-btn">Search Buses</a>
        <a href="view_trip_history.php" class="btn secondary-btn">Manage Trips</a>
        <a href="book_bus.php" class="btn tertiary-btn">Book a Bus</a>
    </div>
</div>

<?php include '../includes/footer.php'; ?>

</body>
</html>
