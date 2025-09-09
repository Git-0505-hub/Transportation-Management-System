<?php
session_start();
include '../includes/db.php';
include '../includes/functions.php';

// Ensure user is logged in
redirectIfNotLoggedIn();
$pageTitle = "Book a Bus";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $bus_id = $_POST['bus_id'];
    $travel_date = $_POST['travel_date'];
    $seat_count = $_POST['seat_count'];

    // Insert booking into the database
    $stmt = $conn->prepare("INSERT INTO bookings (user_id, bus_id, travel_date, seat_count) VALUES (?, ?, ?, ?)");
    $stmt->bind_param('iisi', $user_id, $bus_id, $travel_date, $seat_count);

    if ($stmt->execute()) {
        $success = "Bus booked successfully!";
    } else {
        $error = "An error occurred. Please try again.";
    }
}

// Fetch available buses for selection
$buses = $conn->query("SELECT id, bus_name, route");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?></title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f6f9;
            color: #2c3e50;
        }

        .booking-container {
            width: 80%;
            max-width: 800px;
            margin: 50px auto;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 6px 30px rgba(0, 0, 0, 0.1);
        }

        h2 {
            font-size: 28px;
            color: #2ecc71;
            margin-bottom: 20px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 16px;
            margin-bottom: 8px;
            color: #34495e;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #f5f6fa;
        }

        .form-group input:focus,
        .form-group select:focus {
            border-color: #3498db;
            outline: none;
            background-color: #fff;
        }

        .btn {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            background-color: #27ae60;
        }

        .btn:hover {
            background-color: #2ecc71;
        }

        .message {
            text-align: center;
            font-size: 16px;
            margin-top: 20px;
        }

        .message.success {
            color: #27ae60;
        }

        .message.error {
            color: #e74c3c;
        }

    </style>
</head>
<body>

<div class="booking-container">
    <h2>Book a Bus</h2>
    <?php if (isset($success)): ?>
        <p class="message success"><?= htmlspecialchars($success) ?></p>
    <?php elseif (isset($error)): ?>
        <p class="message error"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form action="book_bus.php" method="post">
        <div class="form-group">
            <label for="bus_id">Select Bus</label>
            <select name="bus_id" id="bus_id" required>
                <option value="">-- Select a Bus --</option>
                <?php while ($bus = $buses->fetch_assoc()): ?>
                    <option value="<?= $bus['id'] ?>">
                        <?= htmlspecialchars($bus['bus_name']) ?> (<?= htmlspecialchars($bus['route']) ?> - <?= htmlspecialchars($bus['departure_time']) ?>)
                    </option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="travel_date">Travel Date</label>
            <input type="date" name="travel_date" id="travel_date" required>
        </div>

        <div class="form-group">
            <label for="seat_count">Number of Seats</label>
            <input type="number" name="seat_count" id="seat_count" min="1" max="10" required>
        </div>

        <button type="submit" class="btn">Book Now</button>
    </form>
</div>

</body>
</html>
