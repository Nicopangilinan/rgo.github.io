<?php
$databaseHost = 'localhost';
$databaseUsername = 'root';
$databasePassword = '';
$dbname = "rgo_db";

$conn = new mysqli($databaseHost, $databaseUsername, $databasePassword, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "CREATE TABLE product (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_name VARCHAR(255) NOT NULL,
    product_price VARCHAR(255) NOT NULL,
    product_qty VARCHAR(255) NOT NULL,
    product_image VARCHAR(255) NOT NULL,
    product_code VARCHAR(20) NOT NULL,
)";
if ($conn->query($sql) === TRUE) {
    echo "";
} else {
    echo "Error creating table 'product': " . $conn->error;
    exit();
}

// Create the admin table
$sql = "CREATE TABLE IF NOT EXISTS admin (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "";
} else {
    echo "Error creating table 'admin': " . $conn->error;
    exit();
}

// Define the username and password you want to insert
$username = "admin";
$password = "admin";

// Check if the username already exists
$check_query = "SELECT username FROM admin WHERE username = '$username'";
$check_result = $conn->query($check_query);

if ($check_result->num_rows == 0) {
    // The username doesn't exist, so insert it
    $insert_query = "INSERT INTO admin (username, password) VALUES ('$username', '$password')";

    if ($conn->query($insert_query) === TRUE) {
        echo " ";
    } else {
        echo "Error: " . $insert_query . "<br>" . $conn->error;
    }
// Define the username and password you want to insert
$username = "user";
$password = "user";  
}

$conn->close();
?>
