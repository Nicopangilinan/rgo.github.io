<?php
    session_start();
	require 'config.php';

	$grand_total = 0;
	$allItems = '';
	$items = [];

	$sql = "SELECT CONCAT(product_name, '(',qty,')') AS ItemQty, total_price FROM cart";
	$stmt = $conn->prepare($sql);
	$stmt->execute();
	$result = $stmt->get_result();
	while ($row = $result->fetch_assoc()) {
	  $grand_total += $row['total_price'];
	  $items[] = $row['ItemQty'];
	}
	$allItems = implode(', ', $items);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="author" content="Sahil Kumar">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Checkout</title>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css' />
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css' />
</head>
<style>
/* Buttons */
    .btn {
      border-color: #FF0000;
      background-color: #FF0000; /* Red button background */
      color: #ffffff; /* White button text color */
    }
    .btn:hover {
      border-color:rgb(129, 3, 3);
      background-color:rgb(129, 3, 3); /* Red button background */
      
    }
    .btn:after {
        border-color:rgb(129, 3, 3);
      background-color:rgb(129, 3, 3); 
    }
    /* Card deck styles */
  </style>
<body>
  <!-- Navbar start -->
  <nav class="navbar navbar-expand-md bg-light navbar-light"style="margin-bottom: 40px; ">
    <a class="navbar-brand" href="index.php"><img src="image/logo.png" style="max-height:50px; margin-right: -15px; margin-top: -25px;"></img>&nbsp;&nbsp;Balmes Online Booking</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link " href="shop.php"></i>Products</a>
        </li>

        <li class="nav-item">
          <a class="nav-link active" href="checkout.php">Checkout</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#" id="logout-link">Exit Shop</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="cart.php"><i class="fas fa-shopping-cart"></i> <span id="cart-item" class="badge badge-danger"></span></a>
        </li>
      </ul>
    </div>
  </nav>

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-6 px-4 pb-4" id="order">
        <h4 class="text-center p-2">Complete your order!</h4>
        <div class="jumbotron p-3 mb-2 text-center">
          <h6 class="lead"><b>Product(s) : </b><?= $allItems; ?></h6>
          <h6 class="lead"><b>Delivery Charge : </b>Free</h6>
          <h5><b>Total Amount Payable : </b> Php <?= number_format($grand_total,2) ?></h5>
        </div>
        <form action="action.php" method="post" id="placeOrder" enctype="multipart/form-data">
          <input type="hidden" name="products" value="<?= $allItems; ?>">
          <input type="hidden" name="grand_total" value="<?= $grand_total; ?>">
          <div class="form-group">
            <input type="text" name="name" class="form-control" placeholder="Enter Name" required>
          </div>
          <div class="form-group">
            <input type="email" name="email" class="form-control" placeholder="Enter E-Mail" required>
          </div>
          <div class="form-group">
            <input type="tel" name="phone" class="form-control" placeholder="Enter Phone" required>
          </div>
          <div class="form-group">
            <textarea name="address" class="form-control" rows="3" cols="10" placeholder="Enter Delivery Address Here..."></textarea>
          </div>
          <h6 class="text-center lead">Select Payment Mode</h6>
          <div class="form-group">
              <select name="pmode" class="form-control" id="paymentMode">
                  <option value="" selected disabled>-Select Payment Mode-</option>
                  <option value="cod">Cash On Delivery</option>
                  <option value="netbanking">Gcash Payment</option>
              </select>
          </div>
          <div class="form-group" id="referenceNumberGroup" style="display: none;">
              <label for="reference_number"class ="text-danger"><h4 style="font-weight:bolder; text-align: center;">Send Here: 09123512312</h4></label>
              <input type="text" name="reference_number" class="form-control" placeholder="Enter Reference Number">
          </div>
          <div class="form-group" id="imageReceiptGroup" style="display: none;">
              <label for="imageReceipt">Upload Image Receipt:</label>
              <input type="file" name="image" class="form-control-file">
          </div>
          <div class="form-group">
            <input type="submit" name="action" value="order" class="btn btn-danger btn-block">
          </div>
        </form>
      </div>
    </div>
  </div>
  <script>
    // Get the payment mode select element
    const paymentModeSelect = document.getElementById("paymentMode");
    
    // Get the reference number and image receipt input groups
    const referenceNumberGroup = document.getElementById("referenceNumberGroup");
    const imageReceiptGroup = document.getElementById("imageReceiptGroup");
    
    // Add an event listener to the payment mode select element
    paymentModeSelect.addEventListener("change", function() {
        const selectedPaymentMode = paymentModeSelect.value;
        
        // Show/hide the input groups based on the selected payment mode
        if (selectedPaymentMode === "netbanking") {
            referenceNumberGroup.style.display = "block";
            imageReceiptGroup.style.display = "block";
        } else {
            referenceNumberGroup.style.display = "none";
            imageReceiptGroup.style.display = "none";
        }
    });
</script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>
  <script>
  document.getElementById('logout-link').addEventListener('click', function (e) {
    e.preventDefault();
    if (confirm('Are you sure you want to logout?')) {
      window.location.href = 'logout.php'; // Redirect to logout script
    }
  });
</script>
  <script type="text/javascript">
  $(document).ready(function() {

    // Sending Form data to the server
    $("#placeOrder").submit(function(e) {
      e.preventDefault();
      
      var formData = new FormData(this); // Create a FormData object with the form data
      
      formData.append('action', 'order'); // Append the action parameter
      
      $.ajax({
        url: 'action.php',
        method: 'post',
        data: formData, // Use the FormData object
        contentType: false, // Important: Don't set content type
        processData: false, // Important: Don't process data
        success: function(response) {
          $("#order").html(response);
        }
      });
    });

    // Load total no.of items added in the cart and display in the navbar
    load_cart_item_number();

    function load_cart_item_number() {
      $.ajax({
        url: 'action.php',
        method: 'get',
        data: {
          cartItem: "cart_item"
        },
        success: function(response) {
          $("#cart-item").html(response);
        }
      });
    }
  });
  </script>
</body>

</html>