<?php
session_start();
require 'config.php';

$grand_total = 0;
$allItems = '';
$items = [];

$sql = "SELECT CONCAT(product_name, '(', qty, ')') AS ItemQty, total_price FROM cart";
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css">
    <link rel="stylesheet" href="shop.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <style>
      body {
            background-image: url('assets/img/CEAFA.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            opacity: 2px;
        }
        /* Buttons */
        .btn {
            border-color: #FF0000;
            background-color: #FF0000; /* Red button background */
            color: #ffffff; /* White button text color */
        }
        .btn:hover {
            border-color: rgb(129, 3, 3);
            background-color: rgb(129, 3, 3); /* Red button background */
        }
        .btn:after {
            border-color: rgb(129, 3, 3);
            background-color: rgb(129, 3, 3);
        }
        /* Card deck styles */
        
    </style>
</head>

<body>
    <!-- Navbar start -->
    <nav class="navbar">
    <div class="logo">
        <div class="back-btn">
            <i class="fas fa-arrow-left"></i> <!-- Add your back button icon here -->
        </div>
        <img src="assets/img/rgow.png" alt="R-go Logo" class="nav-image">
    </div>
    <div class="line-divider">|</div>
    <div class="info-text">Cater Basic Needs Information</div>

    <ul class="menu-list">
        <div class="icon cancel-btn">
            <i class="fas fa-times"></i>
        </div>
        <li><a href="cart.php"><i class="fas fa-shopping-cart"></i><span id="cart-item" class="badge badge-danger"></span></a></li>
        <li class="divider"></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fas fa-user"></i></a>
          <ul class="dropdown-menu">
          <li><a href="#">My Orders</a></li>
       <li><a href="#">Logout</a></li>
 </ul>
</li>
    </div>
</li>
    </ul>
    <div class="icon menu-btn">
        <i class="fas fa-bars"></i>
    </div>
</nav>


<div class="container4">
  <form>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="inputOrder">Order Number:</label>
        <input type="text" class="form-control" id="inputOrder" placeholder="Order No.">
      </div>
      <div class="form-group col-md-6">
        <label for="inputDate">Date Requested:</label>
        <input type="date" class="form-control" id="inputDate" placeholder="Date">
      </div>
    </div>
    <div class="form-group">
      <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Office/Department/Organization:</label>
      <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref">
        <option selected>Choose...</option>
        <option value="1">CAFAD</option>
        <option value="2">CIT</option>
        <option value="3">COE</option>
        <option value="4">CICS</option>
      </select>
    </div>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="inputPerson">Responsible Person:</label>
        <input type="text" class="form-control" id="inputPerson" placeholder="Person">
      </div>
      <div class="form-group col-md-6">
        <label for="inputEvent">Name of Event:</label>
        <input type="text" class="form-control" id="inputEvent" placeholder="Event">
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="inputEdate">Date of Event:</label>
        <input type="Date" class="form-control" id="inputEdate" placeholder="Edate">
      </div>
      <div class="form-group col-md-6">
        <label for="inputPlace">Place of Event:</label>
        <input type="text" class="form-control" id="inputPlace" placeholder="Event Place">
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="inputPax">Number of Pax:</label>
        <input type="text" class="form-control" id="inputPax" placeholder="Pax No.">
      </div>
    </div>
    <div class="form-row">
      <label for="deliveryTable" class="col-md-12">Delivery Information:</label>
      <table class="table table-bordered col-md-12" id="deliveryTable">
        <thead>
          <tr>
            <th>Delivery Type</th>
            <th>Delivery Time</th>
            <th>Allotted Budget</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>
              <select class="custom-select" name="deliveryType[]">
                <option value="Breakfast">Breakfast</option>
                <option value="Lunch">Lunch</option>
                <option value="PMSnack">PM Snack</option>
              </select>
            </td>
            <td>
              <input type="text" class="form-control" name="deliveryTime[]" placeholder="Time">
            </td>
            <td>
              <input type="text" class="form-control" name="allottedBudget[]" placeholder="Budget">
            </td>
          </tr>
        </tbody>
      </table>
      <button type="button" class="btn btn-primary" id="addRow">Add Row</button>
    </div>
    <br>
    <fieldset class="form-group">
      <div class="row">
        <legend class="col-form-label col-sm-2 pt-0">Type</legend>
        <div class="col-sm-10">
          <div class="form-check">
            <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1" checked>
            <label class="form-check-label" for="gridRadios1">
              Delivery Only
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="option2">
            <label class="form-check-label" for="gridRadios2">
              With Service
            </label>
          </div>
        </div>
      </div>
    </fieldset>
    <div class="form-row">
      <label for="participantsTable" class="col-md-12">Participants Information:</label>
      <div class="form-group col-md-6">
        <label for="inputName">Name:</label>
        <input type="text" class="form-control" id="inputName" placeholder="Name">
      </div>
      <div class="form-group col-md-6">
        <label for="inputPosition">Position/Designation:</label>
        <input type="text" class="form-control" id="inputPosition" placeholder="Position">
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="inputName">Allergies:</label>
        <input type="text" class="form-control" id="inputName" placeholder="Allergies if any">
      </div>
      <div class="form-group col-md-6">
        <label for="inputPosition">Special Instruction:</label>
        <input type="text" class="form-control" id="inputPosition" placeholder="Instructions">
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="inputName">Preffered Packaging:</label>
        <input type="text" class="form-control" id="inputName" placeholder="Preffered Packaging">
      </div>
      <label for="participantsTable" class="col-md-12" style="color:red;">Reminder: Rice 1 cup per serving</label>
      </div>
      <div class="form-group">
      <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Office/Department/Organization:</label>
      <input type="text" class="form-control" id="inputPosition"style="height:200px;">
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>
</body>
</div>

<script>
  // JavaScript to add rows dynamically with a limit of 3
  const maxRows = 3;
  const addRowButton = document.getElementById("addRow");
  const tableBody = document.querySelector("#deliveryTable tbody");

  addRowButton.addEventListener("click", function () {
    const numRows = tableBody.rows.length;
    if (numRows < maxRows) {
      const newRow = tableBody.insertRow();
      const cell1 = newRow.insertCell(0);
      const cell2 = newRow.insertCell(1);
      const cell3 = newRow.insertCell(2);

      cell1.innerHTML = `
        <select class="custom-select" name="deliveryType[]">
          <option value="Breakfast">Breakfast</option>
          <option value="Lunch">Lunch</option>
          <option value="PMSnack">PM Snack</option>
        </select>
      `;

      cell2.innerHTML = '<input type="text" class="form-control" name="deliveryTime[]" placeholder="Time">';
      cell3.innerHTML = '<input type="text" class="form-control" name="allottedBudget[]" placeholder="Budget">';

      // Hide the "Add Row" button if the limit is reached
      if (numRows + 1 === maxRows) {
        addRowButton.style.display = "none";
      }
    }
  });
</script>
    <script type="text/javascript">
        $(document).ready(function () {

            // Sending Form data to the server
            $("#placeOrder").submit(function (e) {
                e.preventDefault();

                var formData = new FormData(this); // Create a FormData object with the form data

                formData.append('action', 'order'); // Append the action parameter

                $.ajax({
                    url: 'action.php',
                    method: 'post',
                    data: formData, // Use the FormData object
                    contentType: false, // Important: Don't set content type
                    processData: false, // Important: Don't process data
                    success: function (response) {
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
                    success: function (response) {
                        $("#cart-item").html(response);
                    }
                });
            }
        });
    </script>
</body>

</html>