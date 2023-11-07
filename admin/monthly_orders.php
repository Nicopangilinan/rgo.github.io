<?php
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

// SQL query to count orders for each month
$query = "SELECT DATE_FORMAT(DateRequested, '%Y-%m') AS month, COUNT(*) AS orderCount
          FROM orders
          GROUP BY month
          ORDER BY month";

$result = $conn->query($query); // Change $mysqli to $conn

if ($result) {
    $data = array();

    // Fetch data and build an array
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    // Return data as JSON
    echo json_encode($data);
} else {
    // Handle the query error
    echo json_encode(array('error' => $conn->error)); // Change $mysqli to $conn
}

// Close the database connection
$conn->close(); // Change $mysqli to $conn
?>
