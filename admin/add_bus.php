<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}

include '../includes/db.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collecting data from the form
    $bus_name = trim($_POST['bus_name']);
    $route = trim($_POST['route']);
    $schedule = trim($_POST['schedule']);
    $available_date = $_POST['available_date'];
    $fare = $_POST['fare'];
    $capacity = $_POST['capacity'];

    // Validate inputs
    if (empty($bus_name) || empty($route) || empty($schedule) || empty($available_date)) {
        $error = "Please fill in all required fields.";
    } else {
        // Prepare the query to insert the new bus
        $stmt = $conn->prepare("INSERT INTO buses (bus_name, route, schedule, available_date, fare, capacity) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param('ssssdi', $bus_name, $route, $schedule, $available_date, $fare, $capacity);

        if ($stmt->execute()) {
            $success = "Bus added successfully!";
            // Redirect to manage buses page after success
            header("Location: manage_buses.php");
            exit;  // Ensure no further code is executed after the redirect
        } else {
            $error = "An error occurred. Please try again.";
        }

        $stmt->close();
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add New Bus</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <style>
        /* Add button styling */
        .btn.primary-btn {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            font-size: 16px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .btn.primary-btn:hover {
            background-color: #45a049;
        }

        /* Form and Input Styling */
        .form-group label {
            font-weight: bold;
        }

        .form-group input {
            padding: 10px;
            width: 100%;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        /* Add space between footer and button */
        .container {
            margin-bottom: 50px; /* Adjust this value to control the space */
        }
    </style>
</head>
<body>
<?php include '../includes/header.php'; ?>

<div class="container">
    <h1>Add New Bus</h1>

    <?php if ($error): ?>
        <p class="error-msg" style="color: red;"><?= htmlspecialchars($error) ?></p>
    <?php elseif ($success): ?>
        <p class="success-msg" style="color: green;"><?= htmlspecialchars($success) ?></p>
    <?php endif; ?>

    <form action="add_bus.php" method="post" class="form">
        <div class="form-group">
            <label for="bus_name">Bus Name</label>
            <input type="text" id="bus_name" name="bus_name" placeholder="Enter bus name" required>
        </div>
        <div class="form-group">
            <label for="route">Route</label>
            <input type="text" id="route" name="route" placeholder="Enter route" required>
        </div>
        <div class="form-group">
            <label for="schedule">Schedule</label>
            <input type="text" id="schedule" name="schedule" placeholder="Enter schedule" required>
        </div>
        <div class="form-group">
            <label for="available_date">Available Date</label>
            <input type="date" id="available_date" name="available_date" required>
        </div>
        <div class="form-group">
            <label for="fare">Fare</label>
            <input type="number" step="0.01" id="fare" name="fare" placeholder="Enter fare" required>
        </div>
        <div class="form-group">
            <label for="capacity">Capacity</label>
            <input type="number" id="capacity" name="capacity" placeholder="Enter capacity" required>
        </div>
        <button type="submit" class="btn primary-btn">Add Bus</button>
    </form>
</div>

<?php include '../includes/footer.php'; ?>
</body>
</html>
