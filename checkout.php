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
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Complete Form</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css" />
  <link rel="stylesheet" href="shop.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  
    <style>
      body {
            background-image: url('assets/img/CEAFA-3D.jpg');
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
          <li><a href="myorder.php">My Orders</a></li>
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
<div class="breadcrumb">
    <a href="homepage.php">Home</a>
    <span>&gt;</span>
    <a href="shop.php">Food Menu</a>
    <span>&gt;</span>
    <a href="cart.php">Food Cart</a>
    <span>&gt;</span>
    Cater Basic Needs Information
</div>


<div class="container4">
  <div class="jumbotron p-3 mb-2 ">
  <div id="order">
        <h4 class="text-center p-2">Complete your order!</h4>
        <div class="jumbotron p-3 mb-2 text-center">
          <h6 class="lead"><b>Product(s) : </b><?= $allItems; ?></h6>
          <h5><b>Total Amount Payable : </b> Php <?= number_format($grand_total,2) ?></h5>
        </div>
    <form action="action2.php" method="post" id="placeOrder" enctype="multipart/form-data">
         <input type="hidden" name="products" value="<?= $allItems; ?>">
          <input type="hidden" name="grand_total" value="<?= $grand_total; ?>">
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="inputDate">Date Requested:</label>
              <input type="date" class="form-control" name="inputDate" id="inputDate" placeholder="Date">
            </div>
          </div>
          <div class="form-group">
            <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Office/Department/Organization:</label>
            <select class="custom-select my-1 mr-sm-2" name="inlineFormCustomSelectPref" id="inlineFormCustomSelectPref">
              <option selected>Choose...</option>
              <?php
              // Your database connection code
              $databaseHost = 'localhost';
              $databaseUsername = 'root';
              $databasePassword = '';
              $dbname = "rgo_db";

              $conn = new mysqli($databaseHost, $databaseUsername, $databasePassword, $dbname);

              // Check the connection
              if ($conn->connect_error) {
                  die("Connection failed: " . $conn->connect_error);
              }

              // Define the column names
              $columnNames = ["Campus", "CoE", "CAFAD", "CIT", "CICS"];

              // Output column names as option values
              foreach ($columnNames as $columnName) {
                  echo "<option value='$columnName'>$columnName</option>";
              }

              // Get the data and populate options
              $query = "SELECT * FROM org";
              $result = $conn->query($query);

              while ($row = $result->fetch_assoc()) {
                  foreach ($columnNames as $columnName) {
                      $value = $row[$columnName];
                      if (!empty($value)) {
                          echo "<option value='$value'>$value</option>";
                      }
                  }
              }

              // Close the database connection
              $conn->close();
              ?>
            </select>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="inputPerson">Responsible Person:</label>
              <input type="text" class="form-control" id="inputPerson"  name="inputPerson"placeholder="Person">
            </div>
            <div class="form-group col-md-6">
              <label for="inputEvent">Name of Event:</label>
              <input type="text" class="form-control" id="inputEvent" name="inputEvent" placeholder="Event">
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="inputEdate">Date of Event:</label>
              <input type="Date" class="form-control" id="inputEdate" name="inputEdate" placeholder="Edate">
            </div>
            <div class="form-group col-md-6">
              <label for="inputPlace">Place of Event:</label>
              <input type="text" class="form-control" id="inputPlace" name="inputPlace"placeholder="Event Place">
            </div>
          </div>
          <div class="form-row">
    <div class="form-group col-md-6">
        <label for="inputPax">Number of Pax:</label>
        <input type="text" class="form-control" id="inputPax" name="inputPax" placeholder="Pax No.">
    </div>
    <div class="form-group col-md-6">
        <label for="selecttype">Select Type:</label>
        <select class="custom-select" name="selecttype" id="selecttype">
            <option selected>Choose...</option>
            <option value="With Service">With Service</option>
            <option value="Delivery Only">Delivery Only</option>
        </select>
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
                    <input type="time" class="form-control" name="deliveryTime[]" placeholder="Time">
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

   <!--Participant's Information !-->
   <div class="container">
  <div class="row">
    <div class="col-md-12">
      <label for="participantsTable">Participants Information:</label>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label for="inputName">Name:</label>
        <input type="text" class="form-control" id="inputName" name="inputName" placeholder="Name">
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label for="inputPosition">Position/Designation:</label>
        <input type="text" class="form-control" id="inputPosition" name="inputPosition" placeholder="Position">
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label for="inputAllergies">Allergies:</label>
        <input type="text" class="form-control" id="inputAllergies" name="inputAllergies" placeholder="Allergies if any type 'N\A' if none">
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label for="inputInstructions">Special Instruction:</label>
        <input type="text" class="form-control" id="inputInstructions" name="inputInstructions" placeholder="Instructions type 'N\A' if none">
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label for="inputPackaging">Preferred Packaging:</label>
        <input type="text" class="form-control" id="inputPackaging" name="inputPackaging" placeholder="Preferred Packaging">
      </div>
    </div>
  </div>
</div>
<label for="participantsTable" class="col-md-12" style="color:red;">Reminder: Rice 1 cup per serving</label>

        <div class="form-check">
            <button type="submit" name="action" value="order" class="btn btn-primary" style="width: 100%;">Submit</button>
        </div>
    </form>
</div>


<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
<script>
// JavaScript to add rows dynamically with a limit of 3
const maxRows = 3;
const addRowButton = document.getElementById("addRow");
const tableBody = document.querySelector("#deliveryTable tbody");
let index = 1; // Initialize the index variable

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

    cell2.innerHTML = `<input type="time" class="form-control" name="deliveryTime[${index}]" placeholder="Time">`;
    cell3.innerHTML = `<input type="text" class="form-control" name="allottedBudget[${index}]" placeholder="Budget">`;

    // Increment the index for the next row
    index++;

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
                    url: 'action2.php',
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
                    url: 'action2.php',
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