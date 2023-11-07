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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];

    // Perform database update using an SQL UPDATE statement
    $updateSql = "UPDATE product SET product_name = ?, product_price = ? WHERE id = ?";
    $stmt = $conn->prepare($updateSql);
    $stmt->bind_param("sdi", $product_name, $product_price, $product_id);

    if ($stmt->execute()) {
        // Database update successful
        $stmt->close();
        $conn->close();

        // Redirect back to the product list page or show a success message
        header('Location: foodpackage.php'); // Redirect to the product list page
        exit();
    } else {
        // Handle the case where the database update fails
        $stmt->close();
        $conn->close();
        die("Error updating product: " . $conn->error);
    }
}
?>
