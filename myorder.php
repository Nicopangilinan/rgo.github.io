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

    $sql = "SELECT * FROM orders WHERE user_id = '$user_id'";

    $result = $conn->query($sql);

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>My Orders</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css" />
  <link rel="stylesheet" href="shop.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
  <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
  <link rel="stylesheet" type="text/css" href="vendor/perfect-scrollbar/perfect-scrollbar.css">
  <link rel="stylesheet" type="text/css" href="assets/css/util.css">
  <link rel="stylesheet" type="text/css" href="assets/css/main.css">
  <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
  <link rel="stylesheet" href="admin/assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="admin/assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="admin/assets/vendors/css/vendor.bundle.base.css">


<meta name="robots" content="noindex, follow">

<style>
    body {
        background: url("CEAFA-3D.jpg") no-repeat;
          height: 100vh;
          background-size: cover;
          background-position: center;
          background-attachment: fixed;
          align-items: center;
}
    .column7 {
      width: 150px; /* Adjust the width as needed */
}
    
    .action-cell .action-button {
  margin-bottom: 10px; /* Adjust the spacing as needed */
}
.dropdown {
    position: relative;
    display: inline-block;
  }

  .dropdown-toggle {
    text-decoration: none;
    color: #333;
    padding: 10px;
    display: block;
    cursor: pointer;
  }

  .dropdown-menu {
    display: none;
    position: absolute;
    width: 150px;
    background-color: #ffffff;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    list-style: none;
    padding: 0;
    margin: 0;
  }

  .dropdown-menu li {
    padding: 10px;
  }

  .dropdown-menu a {
    color: #000; /* Set text color to black */
    text-decoration: none;
    display: block;
  }

  .dropdown:hover .dropdown-menu {
    display: block;
  }
        body {
          background: url("CEAFA-3D.jpg") no-repeat;
          height: 100vh;
          background-size: cover;
          background-position: center;
          background-attachment: fixed;
          align-items: center;
}
.table-responsive-xl {
      max-width: 100%; /* Adjust the maximum height as needed */
      overflow-y: auto;}
      /* Styles for the modals */
      .modal2 {
          display: none; /* Hidden by default */
          position: fixed;
          top: 0;
          left: 0;
          width: 100%;
          height: 100%;
          background-color: rgba(0, 0, 0, 0.7); /* Semi-transparent background overlay */
          z-index: 99;
      }

      .modal-content2 {
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

</style>

<script nonce="68fe1ece-0441-478a-a67f-ba0bdae9ea39">
  (function (w, d) {
    !function (a, b, c, d) {
      a[c] = a[c] || {};
      a[c].executed = [];
      a.zaraz = {
        deferred: [],
        listeners: []
      };
      a.zaraz.q = [];
      a.zaraz._f = function (e) {
        return async function () {
          var f = Array.prototype.slice.call(arguments);
          a.zaraz.q.push({
            m: e,
            a: f
          });
        };
      };
      for (const g of ["track", "set", "debug"]) a.zaraz[g] = a.zaraz._f(g);
      a.zaraz.init = () => {
        var h = b.getElementsByTagName(d)[0],
          i = b.createElement(d),
          j = b.getElementsByTagName("title")[0];
        j && (a[c].t = b.getElementsByTagName("title")[0].text);
        a[c].x = Math.random();
        a[c].w = a.screen.width;
        a[c].h = a.screen.height;
        a[c].j = a.innerHeight;
        a[c].e = a.innerWidth;
        a[c].l = a.location.href;
        a[c].r = b.referrer;
        a[c].k = a.screen.colorDepth;
        a[c].n = b.characterSet;
        a[c].o = (new Date).getTimezoneOffset();
        if (a.dataLayer)
          for (const n of Object.entries(Object.entries(dataLayer).reduce(((o, p) => ({
            ...o[1],
            ...p[1]
          }), {})))
          ) zaraz.set(n[0], n[1], {
            scope: "page"
          });
        a[c].q = [];
        for (; a.zaraz.q.length;) {
          const q = a.zaraz.q.shift();
          a[c].q.push(q);
        }
        i.defer = !0;
        for (const r of [localStorage, sessionStorage])
          Object.keys(r || {}).filter((t => t.startsWith("_zaraz_"))).forEach((s => {
            try {
              a[c]["z_" + s.slice(7)] = JSON.parse(r.getItem(s));
            } catch {
              a[c]["z_" + s.slice(7)] = r.getItem(s);
            }
          }));
        i.referrerPolicy = "origin";
        i.src = "/cdn-cgi/zaraz/s.js?z=" + btoa(encodeURIComponent(JSON.stringify(a[c])));
        h.parentNode.insertBefore(i, h);
      };
      ["complete", "interactive"].includes(b.readyState) ? zaraz.init() : a.addEventListener("DOMContentLoaded", zaraz.init);
    }(w, d, "zarazData", "script");
  })(window, document);
</script>
</head>
<body>
<nav class="navbar">
    <div class="logo">
        <div class="back-btn" >
            <a class="fas fa-arrow-left" href="homepage.php" ></a> 
        </div>
        <img src="assets/img/rgow.png" alt="R-go Logo" class="nav-image">
    </div>
    <div class="line-divider">|</div>
    <div class="info-text">My Orders!</div>

    <ul class="menu-list">
        <div class="icon cancel-btn">
            <i class="fas fa-times"></i>
        </div>
        <li><a href="cart.php"><i class="fas fa-shopping-cart"></i><span id="cart-item" class="badge badge-danger"></span></a></li>
        <li class="divider"></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fas fa-user"></i></a>
          <ul class="dropdown-menu">
       <li><a href="#" id="logout-link">Logout</a></li>
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
    <a href="checkout.php">Cater Basic Needs Information</a>
    <span>&gt;</span>
    My Orders
</div>

<style>
    .table100 {
      width: 100%;
    }
    .table100 th{
      color: white;
    }
    
    .table100 th, .table100 td {
      padding: 5px;
      text-align: left;
    }

    .table100 th.column6, .table100 td.column6 {
      position: relative;
    }

    .button-container {
      display: flex;
      justify-content: space-between;
    }

    .action-button {
      cursor: pointer;
      margin-right: 5px;
    }
  </style>
</head>
<body>
  <div class="limiter">
    <div class="container-table100">
      <div class="wrap-table100">
        <div class="table100">
        <?php if ($result->num_rows > 0) : ?>
    <div class="table-container">
        <table class="content-table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Order ID</th>
                    <th>Event Name</th>
                    <th style="width: 15%;">Office/Department/Org</th>
                    <th>Person Responsible</th>
                    <th>Status</th>
                    <th>Remarks</th>
                    <th style="width: 15%;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) : ?>
                    <tr> 
                        <td><?= $row['DateRequested'] ?></td>
                        <td><?= $row['id'] ?></td>
                        <td><?= $row['NameofEvent'] ?></td>
                        <td style="width: 15%;"><?= $row['Org'] ?></td>
                        <td><?= $row['ResponsiblePerson'] ?></td>

                        <td><?= $row['status'] ?></td>
                        <td><?= $row['Remarks'] ?></td>
                        <td style="width: 15%;" class="column7 action-cell">
                      <button style="width: 150px; text-align: left; margin: 2px;" type="button" class="btn btn-outline-primary btn-icon-text"
                          onclick="showRowDetails(<?= $row['id'] ?>)">
                          <i class="mdi mdi-magnify btn-icon-prepend"></i> View Details
                      </button>


                        <button style="width: 150px; text-align: left; margin:2px;" type="button" class="btn btn-outline-success btn-icon-text" onclick="showRowFiles(<?= $row['id'] ?>)">
                        <i class="mdi mdi-upload btn-icon-prepend"></i> Upload </button>

                        <button style="width: 150px; text-align: left; margin:2px;" type="button" class="btn btn-outline-warning btn-icon-text">
                          <a href="generate_receipt.php?order_id=<?= $row['id'] ?>" style="text-decoration: none; color: inherit;">
                              <i class="mdi mdi-file-document-box btn-icon-prepend"></i> View Receipt
                          </a>
                          
                      </button>
                        <button style="width: 150px; text-align: left; margin:2px;" type="button" class="btn btn-outline-danger btn-icon-text" onclick="confirmDelete(<?= $row['id'] ?>)">
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
                  <!-- DOCUMENT MODAL -->
            <div id="rowFilesModal" class="modal2">
                <div class="modal-content2">
                <span class="close" onclick="closeModal2()">&times;</span>
                    <a>Select Files To upload (PDF files only)</a>
                    <div class="table-responsive-xl">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Transactions (Receivable)</th>
                                    <th>Filename (PDF only)</th>
                                    <th>View/Download</th>
                                    <th>Upload</th>
                                    <th>Delete</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr id="purchaseRequestRow">
                                    <td>1</td>
                                    <td>Purchase Request</td>
                                    <td><input type="file" id="purchaseRequestFile" accept=".pdf"></td>
                                    <td><button onclick="viewFile('purchaseRequestFile')">View</button></td>
                                    <td><button onclick="uploadFile('purchaseRequestFile')">Upload</button></td>
                                    <td><button onclick="deleteFile('purchaseRequestFile')">Delete</button></td>
                                    <td><button onclick="changeStatus('purchaseRequestFile')">Change Status</button></td>
                                </tr>
                                <tr id="purchaseRequestRow">
                                    <td>1</td>
                                    <td>Purchase Request</td>
                                    <td><input type="file" id="purchaseRequestFile" accept=".pdf"></td>
                                    <td><button onclick="viewFile('purchaseRequestFile')">View</button></td>
                                    <td><button onclick="uploadFile('purchaseRequestFile')">Upload</button></td>
                                    <td><button onclick="deleteFile('purchaseRequestFile')">Delete</button></td>
                                    <td><button onclick="changeStatus('purchaseRequestFile')">Change Status</button></td>
                                </tr>
                                <tr id="purchaseRequestRow">
                                    <td>1</td>
                                    <td>Purchase Request</td>
                                    <td><input type="file" id="purchaseRequestFile" accept=".pdf"></td>
                                    <td><button onclick="viewFile('purchaseRequestFile')">View</button></td>
                                    <td><button onclick="uploadFile('purchaseRequestFile')">Upload</button></td>
                                    <td><button onclick="deleteFile('purchaseRequestFile')">Delete</button></td>
                                    <td><button onclick="changeStatus('purchaseRequestFile')">Change Status</button></td>
                                </tr>
                                <tr id="purchaseRequestRow">
                                    <td>1</td>
                                    <td>Purchase Request</td>
                                    <td><input type="file" id="purchaseRequestFile" accept=".pdf"></td>
                                    <td><button onclick="viewFile('purchaseRequestFile')">View</button></td>
                                    <td><button onclick="uploadFile('purchaseRequestFile')">Upload</button></td>
                                    <td><button onclick="deleteFile('purchaseRequestFile')">Delete</button></td>
                                    <td><button onclick="changeStatus('purchaseRequestFile')">Change Status</button></td>
                                </tr>
                                <tr id="purchaseRequestRow">
                                    <td>1</td>
                                    <td>Purchase Request</td>
                                    <td><input type="file" id="purchaseRequestFile" accept=".pdf"></td>
                                    <td><button onclick="viewFile('purchaseRequestFile')">View</button></td>
                                    <td><button onclick="uploadFile('purchaseRequestFile')">Upload</button></td>
                                    <td><button onclick="deleteFile('purchaseRequestFile')">Delete</button></td>
                                    <td><button onclick="changeStatus('purchaseRequestFile')">Change Status</button></td>
                                </tr>
                                <tr id="purchaseRequestRow">
                                    <td>1</td>
                                    <td>Purchase Request</td>
                                    <td><input type="file" id="purchaseRequestFile" accept=".pdf"></td>
                                    <td><button onclick="viewFile('purchaseRequestFile')">View</button></td>
                                    <td><button onclick="uploadFile('purchaseRequestFile')">Upload</button></td>
                                    <td><button onclick="deleteFile('purchaseRequestFile')">Delete</button></td>
                                    <td><button onclick="changeStatus('purchaseRequestFile')">Change Status</button></td>
                                </tr>
                                
                                <!-- Repeat the structure for other rows -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
      </div>
    </div>
  </div>

<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<script src="vendor/bootstrap/js/popper.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="vendor/select2/select2.min.js"></script>
<script src="js/main.js"></script>
<script src="admin/assets/js/off-canvas.js"></script>
<script src="admin/assets/js/hoverable-collapse.js"></script>
<script src="admin/assets/js/misc.js"></script>
<script src="admin/assets/vendors/js/vendor.bundle.base.js"></script>
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
<script>
function showRowDetails(rowId) {
    // Make an AJAX request to fetch data from the database
    $.ajax({
        url: 'api.php?action=fetchOrderData', // Replace with the actual URL to your PHP script
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
    const modal = document.getElementById("rowDetailsModal", "rowFilesModal");
    modal.style.display = "block";
}
    // Function to close the modal
    function closeModal() {
        const modal = document.getElementById("rowDetailsModal", "rowFilesModal");
        modal.style.display = "none";
    }
</script>
<script>
  function showRowFiles(rowId) {
      // Show the modal
      const modal = document.getElementById("rowFilesModal");
    modal.style.display = "block";
}
    // Function to close the modal
    function closeModal2() {
        const modal = document.getElementById("rowFilesModal");
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
<script defer src="https://static.cloudflareinsights.com/beacon.min.js/v8b253dfea2ab4077af8c6f58422dfbfd1689876627854" integrity="sha512-bjgnUKX4azu3dLTVtie9u6TKqgx29RBwfj3QXYt5EKfWM/9hPSAI/4qcV5NACjwAo8UtTeWefx6Zq5PHcMm7Tg==" data-cf-beacon='{"rayId":"816a35a4d8aa6017","token":"cd0b4b3a733644fc843ef0b185f98241","version":"2023.8.0","si":100}' crossorigin="anonymous"></script>
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
</script>
</body>
</html>

