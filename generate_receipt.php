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
        $templatePath = 'assets/Delivery-Receipt2.xlsx';
        $spreadsheet = IOFactory::load($templatePath);

        $worksheet = $spreadsheet->getActiveSheet();

        // Replace the template placeholders with the data
        $data = array(
            'id' => $row['id'],
            'DateRequested' => $row['DateRequested'],
            'Org' => $row['Org'],
            'PlaceofEvent' => $row['PlaceofEvent'], // Adjust the column name as needed
            'ResponsiblePerson' => $row['ResponsiblePerson'],
            'grand_total' => $row['grand_total'],  // Replace with your actual grand total
            'NameofEvent' => $row['NameofEvent'],  // Replace with your actual grand total
            'products' => $row['products'],  // Replace with your actual grand total
            
            
        );
        // Assuming $data['products'] contains a string like 'Lunch 6(4), Lunch 15(1), Snack 7(1)'
        $products = explode(', ', $data['products']); // Split the string into an array

        // Starting row for the products
        $row = 13;

        foreach ($products as $product) {
            // Assuming $product is in the format 'Lunch 6(4)'
            $parts = explode('(', $product); // Split by '('

            if (count($parts) === 2) {
        $name = trim($parts[0]); // Get the product name
        $quantity = trim(str_replace(')', '', $parts[1])); // Get the quantity
        $cell = 'C' . $row; // Construct the cell address

        $worksheet->setCellValue($cell, $name); // Set product name in the cell
        $cell = 'A' . $row; // Update the cell address for quantity
        $worksheet->setCellValue($cell, $quantity); // Set quantity in the cell

        $row++; // Move to the next row
    }
}
        $text = 'RGO-DRCS-2023-'; // Replace 'Your Text Here' with the desired text
        $id = $data['id']; // Assuming $data['id'] contains the id value
         // Concatenate the text and id
        $value = $text . ' ' . $id;
        // Set the value in the cell
        $worksheet->setCellValue('I6', $value);
        $worksheet->setCellValue('D8', $data['DateRequested']);
        $worksheet->setCellValue('D9', $data['Org']);
        $worksheet->setCellValue('D10', $data['PlaceofEvent']);
        $worksheet->setCellValue('F43', $data['ResponsiblePerson']);
        $worksheet->setCellValue('I38', $data['grand_total']);
        $worksheet->setCellValue('D11', $data['NameofEvent']);


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