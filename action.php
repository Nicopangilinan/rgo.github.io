<?php
	require 'config.php';
	session_start();

	// Add products into the cart table
	if (isset($_POST['pid'])) {
	  $pid = $_POST['pid'];
	  $pname = $_POST['pname'];
	  $pprice = $_POST['pprice'];
	  $pimage = $_POST['pimage'];
	  $pcode = $_POST['pcode'];
	  $pqty = $_POST['pqty'];
	  $total_price = $pprice * $pqty;

	  $stmt = $conn->prepare('SELECT product_code FROM cart WHERE product_code=?');
	  $stmt->bind_param('s',$pcode);
	  $stmt->execute();
	  $res = $stmt->get_result();
	  $r = $res->fetch_assoc();
	  $code = $r['product_code'] ?? '';

	  if (!$code) {
	    $query = $conn->prepare('INSERT INTO cart (product_name,product_price,product_image,qty,total_price,product_code) VALUES (?,?,?,?,?,?)');
	    $query->bind_param('ssssss',$pname,$pprice,$pimage,$pqty,$total_price,$pcode);
	    $query->execute();

	    echo '<div class="alert alert-success alert-dismissible mt-2">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
						  <strong>Item added to your cart!</strong>
						</div>';
	  } else {
	    echo '<div class="alert alert-danger alert-dismissible mt-2">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
						  <strong>Item already added to your cart!</strong>
						</div>';
	  }
	}

	// Get no.of items available in the cart table
	if (isset($_GET['cartItem']) && isset($_GET['cartItem']) == 'cart_item') {
	  $stmt = $conn->prepare('SELECT * FROM cart');
	  $stmt->execute();
	  $stmt->store_result();
	  $rows = $stmt->num_rows;

	  echo $rows;
	}

	// Remove single items from cart
	if (isset($_GET['remove'])) {
	  $id = $_GET['remove'];

	  $stmt = $conn->prepare('DELETE FROM cart WHERE id=?');
	  $stmt->bind_param('i',$id);
	  $stmt->execute();

	  $_SESSION['showAlert'] = 'block';
	  $_SESSION['message'] = 'Item removed from the cart!';
	  header('location:cart.php');
	}

	// Remove all items at once from cart
	if (isset($_GET['clear'])) {
	  $stmt = $conn->prepare('DELETE FROM cart');
	  $stmt->execute();
	  $_SESSION['showAlert'] = 'block';
	  $_SESSION['message'] = 'All Item removed from the cart!';
	  header('location:cart.php');
	}

	// Set total price of the product in the cart table
	if (isset($_POST['qty'])) {
	  $qty = $_POST['qty'];
	  $pid = $_POST['pid'];
	  $pprice = $_POST['pprice'];

	  $tprice = $qty * $pprice;

	  $stmt = $conn->prepare('UPDATE cart SET qty=?, total_price=? WHERE id=?');
	  $stmt->bind_param('isi',$qty,$tprice,$pid);
	  $stmt->execute();
	}


		// Check if the form was submitted
	if (isset($_POST['action']) && $_POST['action'] == 'order') {
    // Get values from the form

    $user_id = 1; // You need to set the user_id based on your authentication logic
    $OrderNumber = $_POST['inputOrder'];
    $DateRequested = $_POST['inputDate'];
    $Org = $_POST['inlineFormCustomSelectPref']; // The name attribute of the select element should match
    $ResponsiblePerson = $_POST['inputPerson'];
    $NameofEvent = $_POST['inputEvent'];
    $DateofEvent = $_POST['inputEdate'];
    $PlaceofEvent = $_POST['inputPlace'];
    $NumberofPax = $_POST['inputPax'];
	$Type = $_POST['gridRadios'];	

    // Capture values from the delivery table
    $DeliveryType1 = $_POST['deliveryType'][0];
    $DeliveryTime1 = $_POST['deliveryTime'][0];
    $AllottedBudget1 = $_POST['allottedBudget'][0];

    $DeliveryType2 = $_POST['deliveryType'][1];
    $DeliveryTime2 = $_POST['deliveryTime'][1];
    $AllottedBudget2 = $_POST['allottedBudget'][1];

    $DeliveryType3 = $_POST['deliveryType'][2];
    $DeliveryTime3 = $_POST['deliveryTime'][2];
    $AllottedBudget3 = $_POST['allottedBudget'][2];

    // Capture values from the "Participants Information" section
    $Pname = $_POST['inputName'];
    $Pposition = $_POST['inputPosition'];
    $Pallergies = $_POST['inputAllergies']; // Update to match your form field name
    $Pinstructions = $_POST['inputInstructions'];
    $Ppackaging = $_POST['inputPackaging'];

    $products = $_POST['products'];
    $amount_paid = $_POST['grand_total'];
    $status = 'PENDING'; // You can set the initial status as per your requirements
	
		// Prepare and execute the SQL INSERT statement
		$stmt = $conn->prepare('INSERT INTO orders (user_id, OrderNumber, DateRequested, Org, ResponsiblePerson, NameofEvent, DateofEvent, PlaceofEvent, NumberofPax, Type, DeliveryTime1, AllottedBudget1, DeliveryTime2, AllottedBudget2, DeliveryTime3, AllottedBudget3, Pname, Pposition, Pallergies, Pinstructions, Ppackaging, products, amount_paid,  status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
		$stmt->bind_param('sssssssssssssssssssssssss', $user_id, $OrderNumber, $DateRequested, $Org, $ResponsiblePerson, $NameofEvent, $DateofEvent, $PlaceofEvent, $NumberofPax, $Type, $DeliveryTime1, $AllottedBudget1, $DeliveryTime2, $AllottedBudget2, $DeliveryTime3, $AllottedBudget3, $Pname, $Pposition, $Pallergies, $Pinstructions, $Ppackaging, $products, $amount_paid, $status);

	
		if ($stmt->execute()) {
			// Successfully inserted into the database
			$stmt2 = $conn->prepare('DELETE FROM cart');
			if ($stmt2->execute()) {
				// Update product stock quantities
				$items = explode(',', $products);
				foreach ($items as $item) {
					$itemParts = explode('(', $item);
					$productName = trim($itemParts[0]);

					// Get the quantity ordered for this product
					preg_match('/\((\d+)\)/', $item, $matches);
					$quantityOrdered = intval($matches[1]);

					// Update the product stock quantity
					$stmt3 = $conn->prepare('UPDATE product SET stocks = stocks - ? WHERE product_name = ?');
					$stmt3->bind_param('is', $quantityOrdered, $productName);
					$stmt3->execute();
				}
				$data .= '<div class="text-center">
				<h1 class="display-4 mt-2 text-danger">Thank You!</h1>
				<h2 class="text-success">Your Order Placed Successfully!</h2>
				<h4 class="bg-danger text-light rounded p-2">Items Purchased : ' . $products . '</h4>
				<h4>Your Name : ' . $name . '</h4>
				<h4>user_id : ' . $user_id . '</h4>
				<h4>Your E-mail : ' . $email . '</h4>
				<h4>Your Phone : ' . $phone . '</h4>
				<h4>Total Amount Paid : ' . number_format($grand_total, 2) . '</h4>
				<h4>Payment Mode : ' . $pmode . '</h4>';
	
				if ($pmode === 'netbanking') {
					$data .= '<h4>Reference Number: ' . $reference_number . '</h4>';
					$data .= '<h4>Receipt Image: ' . $receipt_image . '</h4>';
				}
	
				$data .= '</div>';
	
				echo $data;
			} else {
				// Error deleting from cart
				echo "Error deleting from cart: " . $conn->error;
			}
		} else {
			// Error inserting into the orders table
			echo "Error inserting into orders: " . $conn->error;
		}
	
		// Close the database connection
		$conn->close();
	}

	?>