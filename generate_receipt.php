<?php
session_start();

// Check if the user is logged in and the user_id is set in the session
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    // Handle the case where the user is not logged in or user_id is not set in the session
    echo "User not logged in or user_id not set.";
    exit;  // Exit the script to prevent further execution
}
require 'vendor/autoload.php'; // Load the PhpSpreadsheet library

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

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

// Retrieve the order ID from the URL parameter
$id = isset($_GET['order_id']) ? intval($_GET['order_id']) : 0;
$_SESSION['user_id'] = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

if ($id > 0) {
    // Retrieve the data for the specific order using 'id' as the identifier
    $sql = "SELECT * FROM orders WHERE user_id = '$user_id' AND id = '$id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Load the Excel template
        $templatePath = 'assets/Delivery-Receipt.xlsx';
        $spreadsheet = IOFactory::load($templatePath);

        $worksheet = $spreadsheet->getActiveSheet();

        // Replace the template placeholders with the data
        $data = array(
            'DateRequested' => $row['DateRequested'],
            'Org' => $row['Org'],
            'PlaceofEvent' => $row['PlaceofEvent'], // Adjust the column name as needed
            'ResponsiblePerson' => $row['ResponsiblePerson'],
            'products' => $row['products'],  // Replace with your actual product names
            'grand_total' => $row['grand_total'],  // Replace with your actual grand total
        );

        $worksheet->setCellValue('D8', $data['DateRequested']);
        $worksheet->setCellValue('D9', $data['Org']);
        $worksheet->setCellValue('D10', $data['PlaceofEvent']);
        $worksheet->setCellValue('F42', $data['ResponsiblePerson']);
        $worksheet->setCellValue('C14', $data['products']);
        $worksheet->setCellValue('I38', $data['grand_total']);

        // Save the filled-up Excel file
        $outputPath = 'filled_delivery_receipt.xlsx';
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save($outputPath);

        // Offer the filled Excel file for download
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($outputPath) . '"');
        readfile($outputPath);

        // Clean up by deleting the temporary filled-up file
        unlink($outputPath);
    } else {
        echo "Order not found.";
    }
} else {
    echo "Invalid order ID.";
}
?>
