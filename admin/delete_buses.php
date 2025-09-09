<?php
// admin/delete_buses.php

include '../includes/db.php'; // Include database connection

// Check if bus_id is provided
if (isset($_GET['bus_id'])) {
    $bus_id = intval($_GET['bus_id']);

    // Prepare delete query
    $stmt = $conn->prepare("DELETE FROM buses WHERE bus_id = ?");
    $stmt->bind_param('i', $bus_id);

    if ($stmt->execute()) {
        // Redirect with success message
        header("Location: manage_buses.php?success=Bus deleted successfully");
        exit;
    } else {
        // Redirect with error message
        header("Location: manage_buses.php?error=Failed to delete bus");
        exit;
    }
} else {
    // Redirect if no bus_id is provided
    header("Location: manage_buses.php?error=Invalid bus ID");
    exit;
}
?>
