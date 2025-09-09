<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}
include '../includes/db.php';

// Fetch buses data
$query = "SELECT * FROM buses";
$result = $conn->query($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Buses</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
<?php include '../includes/header.php'; ?>

<div class="container">
    <h1>Manage Buses</h1>
    
    <!-- Link to Add a New Bus -->
    <a href="add_bus.php" class="btn primary-btn">Add New Bus</a>
    
    <!-- Bus Table -->
    <table class="table">
        <thead>
            <tr>
                <th>Bus Name</th>
                <th>Route</th>
                <th>Schedule</th>
                <th>Available Date</th>
                <th>Fare</th>
                <th>Capacity</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['bus_name']) ?></td>
                    <td><?= htmlspecialchars($row['route']) ?></td>
                    <td><?= htmlspecialchars($row['schedule']) ?></td>
                    <td><?= htmlspecialchars($row['available_date']) ?></td>
                    <td><?= htmlspecialchars($row['fare']) ?></td>
                    <td><?= htmlspecialchars($row['capacity']) ?></td>
                    <td>
                        <!-- Edit and Delete links with bus_id as parameter -->
                        <a href="edit_buses.php?bus_id=<?= $row['bus_id'] ?>" class="btn">Edit</a>
                        <a href="delete_buses.php?bus_id=<?= $row['bus_id'] ?>" class="btn delete" onclick="return confirm('Are you sure you want to delete this bus?')">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php include '../includes/footer.php'; ?>
</body>
</html>
