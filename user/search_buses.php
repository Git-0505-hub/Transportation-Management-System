<?php
session_start();
include '../includes/db.php';
include '../includes/functions.php';

redirectIfNotLoggedIn();
$pageTitle = "Search Buses";
include '../includes/header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $from = $_POST['from'];
    $to = $_POST['to'];
    $date = $_POST['date'];

    // Debugging: Ensure the form data is being passed correctly
    // echo "From: $from, To: $to, Date: $date"; 

    // Prepare SQL query
    $stmt = $conn->prepare("SELECT * FROM buses WHERE route LIKE ? AND available_date = ?");
    $routePattern = "%$from-$to%";  // Make sure this matches your bus route format in the DB
    $stmt->bind_param('ss', $routePattern, $date);
    
    // Check if query executes correctly
    if ($stmt->execute()) {
        $result = $stmt->get_result();
    } else {
        echo "Error executing query: " . $stmt->error;
    }
}
?>

<h2>Search Buses</h2>
<form action="search_buses.php" method="post">
    <input type="text" name="from" placeholder="From" required>
    <input type="text" name="to" placeholder="To" required>
    <input type="date" name="date" required>
    <button type="submit" class="btn">Search</button>
</form>

<?php if (isset($result) && $result->num_rows > 0): ?>
    <h3>Available Buses</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Bus Name</th>
                <th>Route</th>
                <th>Schedule</th>
                <th>Date</th>
                <th>Fare</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['bus_name']; ?></td>
                    <td><?php echo $row['route']; ?></td>
                    <td><?php echo $row['schedule']; ?></td>
                    <td><?php echo $row['available_date']; ?></td>
                    <td><?php echo $row['fare']; ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>No buses found for the given search criteria.</p>
<?php endif; ?>

<?php include '../includes/footer.php'; ?>
