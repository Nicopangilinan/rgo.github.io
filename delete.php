<?php
require 'config.php';

if (isset($_POST['order_id'])) {
    // Get the order ID from the form submission
    $order_id = $_POST['order_id'];

    // Prepare and execute the SQL DELETE statement
    $stmt = $conn->prepare('DELETE FROM orders WHERE id = ?');
    $stmt->bind_param('i', $order_id);

    if ($stmt->execute()) {
        // Deletion successful
        header('Location: myorder.php'); // Redirect to the previous page after successful deletion
    } else {
        // Error deleting the order
        echo "Error: " . $stmt->error;
    }
} else {
    // Invalid request
    echo "Invalid request.";
}

// Close the database connection
$conn->close();
?>
