<?php
session_start();
include '../includes/db.php';
include '../includes/functions.php';

redirectIfNotLoggedIn();
$pageTitle = "Trip History";
include '../includes/header.php';

$user_id = $_SESSION['user_id'];

// Fetch trip history, sorted by date (most recent first)
$stmt = $conn->prepare("SELECT * FROM trip_history WHERE user_id = ? ORDER BY trip_date DESC");
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f7f9fc; /* Light background */
            color: #34495e; /* Dark text */
        }

        h2 {
            text-align: center;
            color: #2c3e50; /* Dark header */
            margin-bottom: 20px;
        }

        .table-container {
            display: flex;
            justify-content: center;
        }

        .table {
            width: 80%;
            border-collapse: collapse;
            background-color: #ffffff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        .table th, .table td {
            padding: 12px 16px;
            text-align: left;
        }

        .table th {
            background-color: #2ecc71; /* Pleasant green */
            color: #ffffff;
        }

        .table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .table tr:hover {
            background-color: #dff9fb; /* Light blue highlight */
        }

        .no-history {
            text-align: center;
            color: #7f8c8d; /* Subtle gray */
            font-size: 18px;
        }
    </style>
</head>
<body>

<h2>Your Trip History</h2>
<div class="table-container">
    <?php if ($result->num_rows > 0): ?>
        <table class="table">
            <thead>
                <tr>
                    <th>Trip ID</th>
                    <th>Bus Name</th>
                    <th>Route</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['trip_id']) ?></td>
                        <td><?= htmlspecialchars($row['bus_name']) ?></td>
                        <td><?= htmlspecialchars($row['route']) ?></td>
                        <td><?= htmlspecialchars($row['trip_date']) ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="no-history">No trip history found. Start planning your first trip!</p>
    <?php endif; ?>
</div>

<?php include '../includes/footer.php'; ?>

</body>
</html>
