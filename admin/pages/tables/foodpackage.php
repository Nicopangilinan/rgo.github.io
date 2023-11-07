<?php
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

// Retrieve orders for the logged-in user
session_start();
$user_id = $_SESSION['user_id'];

if (empty($user_id)) {
    // Handle the case where user_id is empty
    echo "User ID is empty. Check your login process.";
} else {

    $sql = "SELECT * FROM product";

    $result = $conn->query($sql);

}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>RGO Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="../../assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../../assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="../../assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="../../assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="../../assets/images/rgow2.png" />
    <style>
      .table-responsive-xl {
      max-width: 100%; /* Adjust the maximum height as needed */
      overflow-y: auto;}
      /* Styles for the modals */
      .modal {
          display: none; /* Hidden by default */
          position: fixed;
          top: 0;
          left: 0;
          width: 100%;
          height: 100%;
          background-color: rgba(0, 0, 0, 0.7); /* Semi-transparent background overlay */
      }

      .modal-content {
          background-color: #fff;
          border-radius: 5px;
          box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
          position: relative;
          margin: 10% auto; /* Centered vertically and horizontally */
          padding: 20px;
          width: 70%;
      }

      /* Close button style */
      .close {
          color: #555;
          float: right;
          font-size: 28px;
          font-weight: bold;
          cursor: pointer;
      }

      .close:hover {
          color: #000;
      }

      /* Form style */
      .form-group {
          margin: 10px 0;
      }

      /* Button style */
      #but {
          background-color: #007BFF;
          color: #fff;
          border: none;
          border-radius: 3px;
          padding: 10px 20px;
          cursor: pointer;
      }

      #but:hover {
          background-color: #0056b3;
      }

    </style>
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_navbar.html -->
      <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
          <a class="navbar-brand brand-logo"  href="../../index.html"><img src="../../assets/images/rgow.png" alt="logo" /></a>
          <a class="navbar-brand brand-logo-mini" href="../../index.html"><img src="../../assets/images/rgow2.png" alt="logo" /></a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-stretch">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
          </button>
          <div class="search-field d-none d-xl-block">
            <form class="d-flex align-items-center h-100" action="#">
              
            </form>
          </div>
          <ul class="navbar-nav navbar-nav-right">
            
            <li class="nav-item nav-profile dropdown">
              <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                <div class="nav-profile-img">
                  <img src="../../assets/images/faces/face28.png" alt="image">
                </div>
                <div class="nav-profile-text">
                  <p class="mb-1 text-black">RGO Admin</p>
                </div>
              </a>
              <div class="dropdown-menu navbar-dropdown dropdown-menu-right p-0 border-0 font-size-sm" aria-labelledby="profileDropdown" data-x-placement="bottom-end">
                <div class="p-3 text-center bg-primary">
                  <img class="img-avatar img-avatar48 img-avatar-thumb" src="../../assets/images/faces/face28.png" alt="">
                </div>
                <div class="p-2">
                  <h5 class="dropdown-header text-uppercase pl-2 text-dark">User Options</h5>
                  <a class="dropdown-item py-1 d-flex align-items-center justify-content-between" href="#">
                    <span>Inbox</span>
                    <span class="p-0">
                      <span class="badge badge-primary">3</span>
                      <i class="mdi mdi-email-open-outline ml-1"></i>
                    </span>
                  </a>
                  <a class="dropdown-item py-1 d-flex align-items-center justify-content-between" href="#">
                    <span>Profile</span>
                    <span class="p-0">
                      <span class="badge badge-success">1</span>
                      <i class="mdi mdi-account-outline ml-1"></i>
                    </span>
                  </a>
                  <a class="dropdown-item py-1 d-flex align-items-center justify-content-between" href="javascript:void(0)">
                    <span>Settings</span>
                    <i class="mdi mdi-settings"></i>
                  </a>
                  <div role="separator" class="dropdown-divider"></div>
                  <h5 class="dropdown-header text-uppercase  pl-2 text-dark mt-2">Actions</h5>
                  <a class="dropdown-item py-1 d-flex align-items-center justify-content-between" href="#">
                    <span>Lock Account</span>
                    <i class="mdi mdi-lock ml-1"></i>
                  </a>
                  <a class="dropdown-item py-1 d-flex align-items-center justify-content-between" href="#">
                    <span>Log Out</span>
                    <i class="mdi mdi-logout ml-1"></i>
                  </a>
                </div>
              </div>
            </li>
            
          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
          </button>
        </div>
      </nav>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item nav-category">Admin Dashboard</li>
            <li class="nav-item">
              <a class="nav-link" href="../../admin.php">
                <span class="icon-bg"><i class="mdi mdi-cube menu-icon"></i></span>
                <span class="menu-title">Dashboard</span>
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="../../pages/charts/transactions.php">
                <span class="icon-bg"><i class="mdi mdi-bulletin-board menu-icon"></i></span>
                <span class="menu-title">Transactions</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../../pages/tables/foodpackage.php">
                <span class="icon-bg"><i class="mdi mdi-food menu-icon"></i></span>
                <span class="menu-title">Food Packages</span>
              </a>
              <li class="nav-item sidebar-user-actions">
                <div class="user-details">
                  <div class="d-flex justify-content-between align-items-center">
                    <div>
                      <div class="d-flex align-items-center">
                        
                      </div>
                    </div>
                    
                  </div>
                </div>
              </li>
            </li>
            <li class="nav-item nav-category">Settings</li>
           
            <li class="nav-item sidebar-user-actions">
              <div class="sidebar-user-menu">
                <a href="#" class="nav-link"><i class="mdi mdi-logout menu-icon"></i>
                  <span class="menu-title">Log Out</span></a>
              </div>
            </li>
          </ul>
        </nav>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title"> Food Packages Tables </h3>
            </div>
            <div class="row">
            <?php if ($result->num_rows > 0) : ?>
                          <div class="table-responsive-xl">
                              <table class="table">
                                  <thead>
                                      <tr>
                                          <th>Id</th>
                                          <th>Product</th>
                                          <th>Price</th>
                                          <th>Image</th>
                                          <th>Product Code</th>
                                          <th>Type</th>
                                          <th>Actions</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <?php while ($row = $result->fetch_assoc()) : ?>
                                          <tr> 
                                              <td><?= $row['id'] ?></td>
                                              <td><?= $row['product_name'] ?></td>
                                              <td><?= $row['product_price'] ?></td>
                                              <td>
                                                  <img style="width: 180px; height:180px;"src="/rgo.github.io/<?= $row['product_image'] ?>" alt="<?= $row['product_name'] ?>">
                                              </td>

                                              <td><?= $row['product_code'] ?></td>

                                              <td><?= $row['product_type'] ?></td>
                                              <td  style="width: 200px;" class="column7 action-cell">
                                            <button style="width: 125px; text-align: left; margin: 2px;" type="button" class="btn btn-outline-primary btn-icon-text"
                                                onclick="showRowDetails(<?= $row['id'] ?>)">
                                                <i class="mdi mdi-magnify btn-icon-prepend"></i> View Details
                                            </button>


                                            <button style="width: 125px; text-align: left; margin:2px;" type="button" class="btn btn-outline-success btn-icon-text" onclick="openEditModal(<?= $row['id'] ?>, '<?= $row['product_name'] ?>', <?= $row['product_price'] ?>)">
                                                <i class="mdi mdi-upload btn-icon-prepend"></i> Edit
                                            </button>
                                      </td>
                                          </tr>
                                      <?php endwhile; ?>
                                  </tbody>
                              </table>
                          <?php else : ?>
                              <p>No orders found.</p>
                          <?php endif; ?>
                        </div>
              
            <!-- Modal for displaying row details -->
          <div id="rowDetailsModal" class="modal">
              <div class="modal-content">
                  <span class="close" onclick="closeModal()">&times;</span>
                  <h2>Product Details</h2>
                  <div id="rowDetailsContent">
                      <!-- Content will be loaded here via JavaScript -->
                  </div>
              </div>
          </div>

          <!-- Modal for editing product details -->
          <div id="editProductModal" class="modal">
              <div class="modal-content">
                  <span class="close" onclick="closeEditModal()">&times;</span>
                  <h2>Edit Product Details</h2>
                  <form id="editProductForm" action="edit_product.php" method="post">
                      <input type="hidden" id="editProductId" name="product_id">
                      <div class="form-group">
                          <label for="editProductName">Product Name:</label>
                          <input type="text" id="editProductName" name="product_name" class="form-control">
                      </div>
                      <div class="form-group">
                          <label for="editProductPrice">Price:</label>
                          <input type="number" id="editProductPrice" name="product_price" class="form-control">
                      </div>
                      <button type="submit" id="but"class="btn btn-primary">Save Changes</button>
                  </form>
              </div>
          </div>


              
              
            </div>
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:../../partials/_footer.html -->
          <footer class="footer">
            <div class="footer-inner-wraper">
              <div class="d-sm-flex justify-content-center justify-content-sm-between">
                <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © Resource Generation Office | Batangas State University - Alangilan 2023</span>
                </div>
              </div>
            </div>
          </footer>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <script>
          // JavaScript code to update the button text and color when an item is selected
          var buttons = document.querySelectorAll('.dropdown-toggle');
        
          buttons.forEach(function(button) {
            button.addEventListener('click', function () {
              var dropdownId = this.getAttribute('id');
              var dropdownMenu = document.querySelector('[aria-labelledby="' + dropdownId + '"]');
              var prevColorClass = button.classList[2]; // Get the previous color class
        
              dropdownMenu.querySelectorAll('.dropdown-item').forEach(function (item) {
                item.addEventListener('click', function () {
                  var selectedText = this.textContent;
                  var itemColorClass = this.classList[1]; // Get the color class
                  button.textContent = selectedText;
        
                  // Remove the previous color class from the button
                  if (prevColorClass) {
                    button.classList.remove(prevColorClass);
                  }
        
                  button.classList.add(itemColorClass); // Add the new color class
                  this.classList.add('selected'); // Style the selected item
                  prevColorClass = itemColorClass; // Update the previous color class
                });
              });
            });
          });
        </script>
        
        <!-- container-scroller -->
        <!-- plugins:js -->
        <script src="../../assets/vendors/js/vendor.bundle.base.js"></script>
        <!-- endinject -->
        <!-- Plugin js for this page -->
        <script src="../../assets/vendors/chart.js/Chart.min.js"></script>
        <!-- End plugin js for this page -->
        <!-- inject:js -->
        <script src="../../assets/js/off-canvas.js"></script>
        <script src="../../assets/js/hoverable-collapse.js"></script>
        <script src="../../assets/js/misc.js"></script>
        <!-- endinject -->
        <!-- Custom js for this page -->
        <script src="../../assets/js/chart.js"></script>
        <!-- End custom js for this page -->
        <script>
    function showRowDetails(rowId) {
        // Make an AJAX request to fetch data from the database
        $.ajax({
            url: 'get_product_details.php?action=fetchOrderData', // Replace with the actual URL to your PHP script
            method: 'GET',
            data: { rowId: rowId }, // Pass any necessary data to identify the specific row

            success: function (data) {
                // Assuming 'data' contains the fetched database row

                // Populate the modal with the fetched data
                document.getElementById("rowDetailsContent").innerHTML = `
               
        <p><strong>ID:</strong> ${data.id}</p>
        <p><strong>Product:</strong> ${data.product_name}</p>
        <p><strong>Price:</strong> ${data.product_price}</p>
        <p><strong>Product Code:</strong> ${data.product_code}</p>
        <p><strong>Type:</strong> ${data.product_type}</p>`;
            },
            error: function (error) {
                console.log("Error fetching data from the database: " + error);
            }
        });

        // Show the modal
        const modal = document.getElementById("rowDetailsModal");
        modal.style.display = "block";
    }
        // Function to close the modal
        function closeModal() {
            const modal = document.getElementById("rowDetailsModal");
            modal.style.display = "none";
        }
    </script>
    <script>
    // JavaScript function to trigger the confirmation dialog
    function confirmDelete(orderId) {
        if (confirm("Are you sure you want to delete this order?")) {
            // If the user confirms, submit the form to delete the row
            var form = document.createElement('form');
            form.method = 'post';
            form.action = '../../../delete.php';
            
            var input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'order_id';
            input.value = orderId;
            
            form.appendChild(input);
            document.body.appendChild(form);
            
            form.submit();
        }
    }
    </script>

    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-23581568-13');
      </script>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('logout-link').addEventListener('click', function(e) {
          e.preventDefault();
          if (confirm('Are you sure you want to logout?')) {
            window.location.href = '../../../logout.php'; // Redirect to logout script
          }
        });
      });
    </script>
    <script>
      function openEditModal(productId, productName, productPrice) {
          const modal = document.getElementById("editProductModal");
          const productIdField = document.getElementById("editProductId");
          const productNameField = document.getElementById("editProductName");
          const productPriceField = document.getElementById("editProductPrice");

          productIdField.value = productId;
          productNameField.value = productName;
          productPriceField.value = productPrice;

          modal.style.display = "block";
      }

      function closeEditModal() {
          const modal = document.getElementById("editProductModal");
          modal.style.display = "none";
      }

    </script>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="../../assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="../../assets/js/off-canvas.js"></script>
    <script src="../../assets/js/hoverable-collapse.js"></script>
    <script src="../../assets/js/misc.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <!-- End custom js for this page -->
  </body>
</html>