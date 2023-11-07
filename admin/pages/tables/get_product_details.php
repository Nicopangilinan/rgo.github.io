
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

// Retrieve orders for the logged-in user
session_start();
$user_id = $_SESSION['user_id'];

if (empty($user_id)) {
    // Handle the case where user_id is empty
    echo "User ID is empty. Check your login process.";
} else {
    if ($_GET['action'] == 'fetchOrderData') {
        $rowId = $_GET['rowId']; // Retrieve rowId from GET parameters
        $sql = "SELECT * FROM product WHERE id = '$rowId'"; // Use rowId in your SQL query
        $result = $conn->query($sql);

        if ($result) {
            $orderData = $result->fetch_assoc();
            // Output the order data as JSON
            header('Content-Type: application/json');
            echo json_encode($orderData);
        } else {
            // Handle the case where the query fails
            echo "Error fetching order data: " . $conn->error;
        }
    }
}
?>
