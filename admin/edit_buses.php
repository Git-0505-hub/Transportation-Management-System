<?php
// admin/edit_buses.php

include '../includes/db.php'; // Include database connection

// Check if bus_id is provided
if (isset($_GET['bus_id'])) {
    $bus_id = intval($_GET['bus_id']);

    // Fetch bus details
    $stmt = $conn->prepare("SELECT * FROM buses WHERE bus_id = ?");
    $stmt->bind_param('i', $bus_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $bus = $result->fetch_assoc();
    } else {
        // Redirect if bus not found
        header("Location: manage_buses.php?error=Bus not found");
        exit;
    }
} else {
    header("Location: manage_buses.php?error=Invalid bus ID");
    exit;
}

// Update bus details
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $bus_name = trim($_POST['bus_name']);
    $route = trim($_POST['route']);
    $schedule = trim($_POST['schedule']);
    $available_date = trim($_POST['available_date']);
    $fare = floatval($_POST['fare']);
    $capacity = intval($_POST['capacity']);

    $stmt = $conn->prepare("UPDATE buses SET bus_name = ?, route = ?, schedule = ?, available_date = ?, fare = ?, capacity = ? WHERE bus_id = ?");
    $stmt->bind_param('ssssiii', $bus_name, $route, $schedule, $available_date, $fare, $capacity, $bus_id);

    if ($stmt->execute()) {
        header("Location: manage_buses.php?success=Bus updated successfully");
        exit;
    } else {
        $error = "Failed to update bus";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Bus</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
<div class="container">
    <h1>Edit Bus</h1>
    <?php if (isset($error)): ?>
        <p style="color: red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <form action="edit_buses.php?bus_id=<?= $bus_id ?>" method="post">
        <label for="bus_name">Bus Name</label>
        <input type="text" id="bus_name" name="bus_name" value="<?= htmlspecialchars($bus['bus_name']) ?>" required>

        <label for="route">Route</label>
        <input type="text" id="route" name="route" value="<?= htmlspecialchars($bus['route']) ?>" required>

        <label for="schedule">Schedule</label>
        <input type="text" id="schedule" name="schedule" value="<?= htmlspecialchars($bus['schedule']) ?>" required>

        <label for="available_date">Available Date</label>
        <input type="date" id="available_date" name="available_date" value="<?= htmlspecialchars($bus['available_date']) ?>" required>

        <label for="fare">Fare</label>
        <input type="number" step="0.01" id="fare" name="fare" value="<?= htmlspecialchars($bus['fare']) ?>" required>

        <label for="capacity">Capacity</label>
        <input type="number" id="capacity" name="capacity" value="<?= htmlspecialchars($bus['capacity']) ?>" required>

        <button type="submit">Update Bus</button>
    </form>
</div>
</body>
</html>
