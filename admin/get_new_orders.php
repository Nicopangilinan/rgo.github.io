<?php
// Connect to your database
// Database connection details
$databaseHost = 'localhost';
$databaseUsername = 'root';
$databasePassword = '';
$dbname = "rgo_db";

// Create a connection to the database
$conn = new mysqli($databaseHost, $databaseUsername, $databasePassword, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Calculate the date 3 days ago and the current date
$dateThreeDaysAgo = date('Y-m-d', strtotime('-3 days'));
$currentDate = date('Y-m-d');

// Query the database to get the count of orders within the date range
$sql = "SELECT COUNT(*) AS count FROM orders WHERE DateRequested >= '$dateThreeDaysAgo' AND DateRequested <= '$currentDate'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $count = $row["count"];
    echo $count;
} else {
    echo "0"; // No records found
}

$conn->close();
?>