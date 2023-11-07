<?php
// Database connection details
$databaseHost = 'localhost';
$databaseUsername = 'root';
$databasePassword = '';
$dbname = 'rgo_db';

// Create a connection to the database
$conn = new mysqli($databaseHost, $databaseUsername, $databasePassword, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get data from the POST request
if (isset($_POST['orderId']) && isset($_POST['newStatus'])) {
    $orderId = $_POST['orderId'];
    $newStatus = $_POST['newStatus'];

    // Prepare an SQL statement to update the status
    $sql = "UPDATE orders SET Status = ? WHERE id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('si', $newStatus, $orderId);

    if ($stmt->execute()) {
        echo 'success'; // Status update was successful
    } else {
        echo 'error'; // Status update failed
    }

    $stmt->close();
} else {
    echo 'error'; // Invalid input
}

// Close the database connection
$conn->close();
?>
