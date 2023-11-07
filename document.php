<?php
// Your database connection code here
$databaseHost = 'localhost';
$databaseUsername = 'root';
$databasePassword = '';
$dbname = 'rgo_db';

// Create a connection
$conn = new mysqli($databaseHost, $databaseUsername, $databasePassword, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle file uploads and database insertion
$order_id = $_POST['row_id'];

$fileFields = ['doc1' => 'purchase_request', 'doc2' => 'oras_pre', 'doc3' => 'project_activity', 'doc4' => 'budget_proposal', 'doc5' => 'delivery_receipt'];

// Define the target directory for file storage
$targetDirectory = 'assets/doc/';

$success = true; // Track success of all file uploads

foreach ($fileFields as $dbField => $formField) {
    if (isset($_FILES[$formField]) && $_FILES[$formField]['error'] === UPLOAD_ERR_OK) {
        $filename = $_FILES[$formField]['name'];
        $fileData = file_get_contents($_FILES[$formField]['tmp_name']);

        // Move the file to the target directory
        $targetPath = $targetDirectory . $filename;
        move_uploaded_file($_FILES[$formField]['tmp_name'], $targetPath);

        $query = "INSERT INTO documents ($dbField, order_id) VALUES (?, ?)";
        $stmt = $conn->prepare($query);

        // Use 'sb' for BLOB data type and string
        $stmt->bind_param("si", $fileData, $order_id);

        if ($stmt->execute()) {
            // File uploaded and inserted into the database
            echo "File '$formField' uploaded and inserted into the database.<br>";
        } else {
            echo "Error: " . $stmt->error . "<br>";
            $success = false; // Mark upload as unsuccessful
        }

        $stmt->close();
    }
}

// Close the database connection
$conn->close();

if ($success) {
    // All files uploaded successfully
    echo "<script>alert('All files submitted successfully. Thank you for your cooperation!');</script>";
    echo "<script>window.location.href = 'myorder.php';</script>";
}
?>
