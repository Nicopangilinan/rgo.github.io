<?php
	require 'config.php';

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

	// Checkout and save customer info in the orders table
	if (isset($_POST['action']) && $_POST['action'] == 'order') {
		session_start();
	
		if (!$conn) {
			die("Database connection failed: " . mysqli_connect_error());
		}
	
		$name = $_POST['name'];
		$email = $_POST['email'];
		$phone = $_POST['phone'];
		$products = $_POST['products'];
		$grand_total = $_POST['grand_total'];
		$address = $_POST['address'];
		$pmode = $_POST['pmode'];
		$reference_number = $_POST['reference_number'];
		$receipt_image = '';
	
		// Set the location to 'IN PREPARATION'
		$location = 'IN PREPARATION';
	
		// Set the status to 'PENDING'
		$status = 'PENDING';
	
		// Check if Gcash Payment is selected
		if ($pmode === 'netbanking') {
			if ($_FILES['image']['error'] === 0) {
				$upload_dir = 'D:/XAMPP/htdocs/Boat Builders-main/image/receipt_image/';
				$image_name = $_FILES['image']['name'];
				$image_path = $upload_dir . $image_name;
	
				// Move the uploaded image to the server
				if (move_uploaded_file($_FILES['image']['tmp_name'], $image_path)) {
					$receipt_image = 'image/receipt_image/' . $image_name; // Set the image name in the database
				} else {
					echo "Error moving uploaded image.";
					exit();
				}
			}
	
			$reference = $reference_number; // Set the reference value in the database
		}
	
		// Get the user_id from the session
		$user_id = $_SESSION['user_id'];
		$data = '';
	
		// Prepare and execute the SQL INSERT statement
		$stmt = $conn->prepare('INSERT INTO orders (user_id, name, email, phone, address, pmode, products, amount_paid, status, location, reference, receipt_image) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
		$stmt->bind_param('ssssssssssss', $user_id, $name, $email, $phone, $address, $pmode, $products, $grand_total, $status, $location, $reference_number, $receipt_image);
	
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