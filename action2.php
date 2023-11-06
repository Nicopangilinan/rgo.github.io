<?php
require 'config.php';
session_start();

// Check if the form was submitted
if (isset($_POST['action']) && $_POST['action'] == 'order') {
    // Get values from the form
    $user_id = $_SESSION['user_id']; // You need to set the user_id based on your authentication logic
    $DateRequested = $_POST['inputDate'];
    $Org = $_POST['inlineFormCustomSelectPref']; // Make sure the name matches in your HTML form
    $ResponsiblePerson = $_POST['inputPerson'];
    $NameofEvent = $_POST['inputEvent'];
    $DateofEvent = $_POST['inputEdate'];
    $PlaceofEvent = $_POST['inputPlace'];
    $NumberofPax = $_POST['inputPax'];
    $Type = $_POST['selecttype'];	

    // Capture values from the "Participants Information" section
    $Pname = $_POST['inputName'];
    $Pposition = $_POST['inputPosition'];
    $Pallergies = $_POST['inputAllergies']; // Update to match your form field name
    $Pinstructions = $_POST['inputInstructions'];
    $Ppackaging = $_POST['inputPackaging'];
    $products = $_POST['products'];
    $grand_total = $_POST['grand_total'];

    $deliveryTypes = $_POST['deliveryType'];
    $deliveryTimes = $_POST['deliveryTime'];
    $allottedBudgets = $_POST['allottedBudget'];

    $statusRemarks = array(
        'Approval In Progress' => 'Incomplete documents',
    );
    
    // Set the initial status as per your requirements
    $status = 'Approval In Progress';

    // Check if the status is in the array of status-remark pairs
      if (array_key_exists($status, $statusRemarks)) {
             $remark = $statusRemarks[$status];
        } else {
    // Default remark if the status is not found in the array
    $remark = '';
}

    // Prepare and execute the SQL INSERT statement
    $stmt = $conn->prepare('INSERT INTO orders (user_id, DateRequested, Org, ResponsiblePerson, NameofEvent, DateofEvent, PlaceofEvent, NumberofPax, Type, Pname, Pposition, Pallergies, Pinstructions, Ppackaging, products, grand_total, DeliveryType1, DeliveryTime1, AllottedBudget1, DeliveryType2, DeliveryTime2, AllottedBudget2, DeliveryType3, DeliveryTime3, AllottedBudget3, status, Remarks) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');

    if ($stmt) {  // Check if prepare was successful
        $stmt->bind_param('sssssssssssssssssssssssssss', $user_id, $DateRequested, $Org, $ResponsiblePerson, $NameofEvent, $DateofEvent, $PlaceofEvent, $NumberofPax, $Type, $Pname, $Pposition, $Pallergies, $Pinstructions, $Ppackaging, $products, $grand_total, $deliveryTypes[0], $deliveryTimes[0], $allottedBudgets[0], $deliveryTypes[1], $deliveryTimes[1], $allottedBudgets[1], $deliveryTypes[2], $deliveryTimes[2], $allottedBudgets[2], $status, $remark);

    if ($stmt->execute()) {
        // Successfully inserted into the database
        $stmt2 = $conn->prepare('DELETE FROM cart');
        if ($stmt2->execute()) {
            echo "Form Successfuly Submitted!<br>";
            echo "TRANSACTION PENDING<br>";
            echo "Please submit the approved and signed requirements at least a week before the event date.<br>";
            echo '<a href="myorder.php">Go to My Orders</a>';
        } else {
            // Error deleting from the cart table
            echo "Error: " . $stmt2->error;
        }
    } else {
        // Error inserting into the orders table
        echo "Error: " . $stmt->error;
    }
} else {
    // Error in preparing the statement
    echo "Error: " . $conn->error;
}


    // Close the database connection
    $conn->close();
}
?>
