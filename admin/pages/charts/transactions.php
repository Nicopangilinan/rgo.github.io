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

    $sql = "SELECT * FROM orders";

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
    <!-- End Plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="../../assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="../../assets/images/rgow2.png" />
    <style>
      /* Add CSS to color-code dropdown items */
      .dropdown-item-approval { background-color: yellow; color: black; }
      .dropdown-item-confirmed { background-color: blue; color: white; }
      .dropdown-item-delivered { background-color: orange; color: black; }
      .dropdown-item-unpaid { background-color: red; color: white; }
      .dropdown-item-completed { background-color: green; color: white; }
      .dropdown-item-canceled { background-color: gray; color: white; }

      /* Style the selected item */
      .dropdown-item.selected {
          color: black;
      }

      /* Add CSS classes for button background color */
      .btn-yellow { background-color: yellow; color: black; }
      .btn-blue { background-color: blue; color: white; }
      .btn-orange { background-color: orange; color: black; }
      .btn-red { background-color: red; color: white; }
      .btn-green { background-color: green; color: white; }
      .btn-gray { background-color: gray; color: white; }

      .table-responsive-xl {
      max-width: 100%; /* Adjust the maximum height as needed */
      overflow-y: auto;
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
            <li class="nav-item dropdown">
              <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                <i class="mdi mdi-email-outline"></i>
                <span class="count-symbol bg-success"></span>
              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">
                <h6 class="p-3 mb-0 bg-primary text-white py-4">Messages</h6>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <img src="../../assets/images/faces/face4.jpg" alt="image" class="profile-pic">
                  </div>
                  <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                    <h6 class="preview-subject ellipsis mb-1 font-weight-normal">Mark send you a message</h6>
                    <p class="text-gray mb-0"> 1 Minutes ago </p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <img src="../../assets/images/faces/face2.jpg" alt="image" class="profile-pic">
                  </div>
                  <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                    <h6 class="preview-subject ellipsis mb-1 font-weight-normal">Cregh send you a message</h6>
                    <p class="text-gray mb-0"> 15 Minutes ago </p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <img src="../../assets/images/faces/face3.jpg" alt="image" class="profile-pic">
                  </div>
                  <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                    <h6 class="preview-subject ellipsis mb-1 font-weight-normal">Profile picture updated</h6>
                    <p class="text-gray mb-0"> 18 Minutes ago </p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <h6 class="p-3 mb-0 text-center">4 new messages</h6>
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
                <i class="mdi mdi-bell-outline"></i>
                <span class="count-symbol bg-danger"></span>
              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                <h6 class="p-3 mb-0 bg-primary text-white py-4">Notifications</h6>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-success">
                      <i class="mdi mdi-calendar"></i>
                    </div>
                  </div>
                  <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                    <h6 class="preview-subject font-weight-normal mb-1">Event today</h6>
                    <p class="text-gray ellipsis mb-0"> Just a reminder that you have an event today </p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-warning">
                      <i class="mdi mdi-settings"></i>
                    </div>
                  </div>
                  <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                    <h6 class="preview-subject font-weight-normal mb-1">Settings</h6>
                    <p class="text-gray ellipsis mb-0"> Update dashboard </p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-info">
                      <i class="mdi mdi-link-variant"></i>
                    </div>
                  </div>
                  <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                    <h6 class="preview-subject font-weight-normal mb-1">Launch Admin</h6>
                    <p class="text-gray ellipsis mb-0"> New admin wow! </p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <h6 class="p-3 mb-0 text-center">See all notifications</h6>
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
              <a class="nav-link" href="../../index.php">
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
                <a href="#" class="nav-link"><i class="mdi mdi-settings menu-icon"></i>
                  <span class="menu-title">Settings</span>
                </a>
              </div>
            </li>
            <li class="nav-item sidebar-user-actions">
              <div class="sidebar-user-menu">
                <a href="#" class="nav-link"><i class="mdi mdi-speedometer menu-icon"></i>
                  <span class="menu-title">Take Tour</span></a>
              </div>
            </li>
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
              <h3 class="page-title"> Transactions </h3>
            </div>
            <div class="row">
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Order Records</h4>
                          <?php if ($result->num_rows > 0) : ?>
    <div class="table-responsive-xl">
        <table class="table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Order ID</th>
                    <th>Event Name</th>
                    <th>Office/Department/Org</th>
                    <th>Person Responsible</th>
                    <th>Status</th>
                    <th>Remarks</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) : ?>
                    <tr> 
                        <td><?= $row['DateRequested'] ?></td>
                        <td><?= $row['id'] ?></td>
                        <td><?= $row['NameofEvent'] ?></td>
                        <td><?= $row['Org'] ?></td>
                        <td><?= $row['ResponsiblePerson'] ?></td>

                        <td><?= $row['status'] ?></td>
                        <td><?= $row['Remarks'] ?></td>
                        <td  style="width: 200px;" class="column7 action-cell">
                      <button style="width: 125px; text-align: left; margin: 2px;" type="button" class="btn btn-outline-primary btn-icon-text"
                          onclick="showRowDetails(<?= $row['id'] ?>)">
                          <i class="mdi mdi-magnify btn-icon-prepend"></i> View Details
                      </button>


                        <button style="width: 125px; text-align: left; margin:2px;" type="button" class="btn btn-outline-success btn-icon-text">
                        <i class="mdi mdi-upload btn-icon-prepend"></i> Upload </button>

                        <button style="width: 125px; text-align: left; margin:2px;" type="button" class="btn btn-outline-warning btn-icon-text">
                          <a href="../../../generate_receipt.php?order_id=<?= $row['id'] ?>" style="text-decoration: none; color: inherit;">
                              <i class="mdi mdi-file-document-box btn-icon-prepend"></i> View Receipt
                          </a>
                          
                      </button>
                        <button style="width: 125px; text-align: left; margin:2px;" type="button" class="btn btn-outline-danger btn-icon-text" onclick="confirmDelete(<?= $row['id'] ?>)">
                        <i class="mdi mdi-delete btn-icon-prepend"></i> Delete </button>
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
<div id="rowDetailsModal" class="modal" style="overflow:auto;">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h2>Order Details</h2>
        <div id="rowDetailsContent">
            <!-- Content will be loaded here via JavaScript -->
        </div>
    </div>
</div>
                  </div>
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
        url: '../../api.php?action=fetchOrderData', // Replace with the actual URL to your PHP script
        method: 'GET',
        data: { rowId: rowId }, // Pass any necessary data to identify the specific row

        success: function (data) {
            // Assuming 'data' contains the fetched database row

            // Populate the modal with the fetched data
            document.getElementById("rowDetailsContent").innerHTML = `
            <h2>Event Details</h2>
    <p><strong>Date Requested:</strong> ${data.DateRequested}</p>
    <p><strong>Event Name:</strong> ${data.NameofEvent}</p>
    <p><strong>Office/Department/Org:</strong> ${data.Org}</p>
    <p><strong>Person Responsible:</strong> ${data.ResponsiblePerson}</p>
    <p><strong>Status:</strong> ${data.status}</p>
    <p><strong>Event Date:</strong> ${data.DateofEvent}</p>
    <p><strong>Event Place:</strong> ${data.PlaceofEvent}</p>
    <p><strong>Number of Pax:</strong> ${data.NumberofPax}</p>
    <p><strong>Service Type:</strong> ${data.Type}</p>

    <h3>Delivery Information</h3>
    <p><strong>Delivery Type:</strong> ${data.DeliveryType1}</p>
    <p><strong>Delivery Time:</strong> ${data.DeliveryTime1}</p>
    <p><strong>Allotted Budget:</strong> ${data.AllottedBudget1}</p>
    
    <h3>Additional Delivery</h3>
    <p><strong>Delivery Type:</strong> ${data.DeliveryType2}</p>
    <p><strong>Delivery Time:</strong> ${data.DeliveryTime2}</p>
    <p><strong>Allotted Budget:</strong> ${data.AllottedBudget2}</p>

    <!-- Include data for Delivery Type 3, if needed -->

    <h3>Participants' Information</h3>
    <p><strong>Participant's Name:</strong> ${data.Pname}</p>
    <p><strong>Participant's Position:</strong> ${data.Pposition}</p>
    <p><strong>Participant's Allergies:</strong> ${data.Pallergies}</p>
    <p><strong>Special Instructions:</strong> ${data.Pinstructions}</p>
    <p><strong>Preferred Packaging:</strong> ${data.Ppackaging}</p>

    <h3>Food Information</h3>
    <p><strong>Packages Ordered:</strong> ${data.products}</p>
    <p><strong>Total Expenses:</strong> ${data.grand_total}</p>
            `;
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
        form.action = 'delete.php';
        
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
    // JavaScript functions to handle button clicks
    function handleMagnifyingGlassClick() {
      // Handle Magnifying Glass button click
      // Add your code here
    }

    function handleUploadClick() {
      // Handle Upload button click
      // Add your code here
    }

    function handleXClick() {
    // Handle X button click
    const isConfirmed = confirm('Are you sure you want to delete record?');

    if (isConfirmed) {
      // The user confirmed the deletion, you can perform the deletion action here.
      // Add your code for deleting the item.
      // For example, you can use AJAX to send a request to the server to delete the item.
    } else {
      // The user canceled the deletion.
      // You can add code here to handle the cancellation.
    }
    }
  </script>
  <script>
  document.getElementById('logout-link').addEventListener('click', function (e) {
    e.preventDefault();
    if (confirm('Are you sure you want to logout?')) {
      window.location.href = 'logout.php'; // Redirect to logout script
    }
  });
  </body>
</html>