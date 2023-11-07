<? session_start(); ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>RGO Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="assets/vendors/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" href="assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="assets/images/rgow2.png" />
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_navbar.html -->
      <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
          <a class="navbar-brand brand-logo"  href="../../index.html"><img src="/rgo.github.io/admin/assets/images/rgow.png" alt="logo" /></a>
          <a class="navbar-brand brand-logo-mini" href="../../index.html"><img src="/rgo.github.io/admin/assets/images/rgow2.png" alt="logo" /></a>
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
            
            <li class="nav-item nav-profile">
                <div class="nav-profile-text">
                  <p class="mb-1 text-black">RGO Admin</p>
                </div>
        </div>
      </nav>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item nav-category">Admin Dashboard</li>
            <li class="nav-item">
              <a class="nav-link" href="index.html">
                <span class="icon-bg"><i class="mdi mdi-cube menu-icon"></i></span>
                <span class="menu-title">Dashboard</span>
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="pages/charts/transactions.php">
                <span class="icon-bg"><i class="mdi mdi-bulletin-board menu-icon"></i></span>
                <span class="menu-title">Transactions</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="pages/tables/foodpackage.php">
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
            <div class="row">
              <div class="col-12">
              </div>
            </div>
            <div class="d-xl-flex justify-content-between align-items-start">
              <h2 class="text-dark font-weight-bold mb-2"> Overview dashboard </h2>
              <div class="d-sm-flex justify-content-xl-between align-items-center mb-2">
                
                
              </div>
            </div>
            <div class="row" id="bannerClose">
              <div class="col-md-12">
                <div class="d-sm-flex justify-content-between align-items-center transaparent-tab-border ">
          
                  <div class="d-md-block d-none"></div>
                </div>
                <div class="tab-content tab-transparent-content">
                  <div class="tab-pane fade show active" id="business-1" role="tabpanel" aria-labelledby="business-tab">
                    <div class="row">
                      <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 grid-margin stretch-card">
                        <div class="card">
                          <div class="card-body text-center">
                          <i class="mdi mdi-new-box icon-lg text-warning" style="font-size:80px;"></i>
                            <h5 class="mb-2 text-dark font-weight-normal">New Orders</h5>
                            <h1 class="mb-4 text-dark font-weight-bolder"><span id="newOrdersCount">--</span></h1>
                          <h3 class="mb-0 font-weight-bold mt-2 text-warning">__________________</h3>
                          </div>
                        </div>
                      </div>
                      <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 grid-margin stretch-card">
                      <div class="card">
                        <div class="card-body text-center">
                        <i class="mdi mdi-av-timer icon-lg text-primary" style="font-size:80px;"></i>
                          <h5 class="mb-2 text-dark font-weight-normal">Pending Orders</h5>
                          <h1 class="mb-4 text-dark font-weight-bolder"><span id="pendingOrdersCount">--</span></h1>
                          <h3 class="mb-0 font-weight-bold mt-2 text-primary">__________________</h3>
                        </div>
                      </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 grid-margin stretch-card">
                      <div class="card">
                        <div class="card-body text-center">
                        <i class="mdi mdi-truck-delivery icon-lg text-success" style="font-size:80px;"></i>
                          <h5 class="mb-2 text-dark font-weight-normal">Delivered Orders</h5>
                          <h1 class="mb-4 text-dark font-weight-bolder"><span id="deliveredOrdersCount">--</span></h1>
                          <h3 class="mb-0 font-weight-bold mt-2 text-success">__________________</h3>
                        </div>
                      </div>
                    </div>
                    </div>
                    <div class="row">
                      <div class="col-12 grid-margin">
                        <div class="card">
                          <div class="card-body">
                            <div class="row">
                              <div class="col-sm-12">
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                  <h4 class="card-title mb-0">Record of Orders Collected Monthly</h4>
                                  <div class="dropdown dropdown-arrow-none">
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuIconButton1">
                                    </div>
                                  </div>
                                </div>
                              </div>
                    
                              <div class="col-12 grid-margin">
                                <div class="pl-0 pl-lg-4">
                                    <div class="d-xl-flex justify-content-between align-items-center mb-2">
                                        
                                    </div>
                                    <div class="graph-custom-legend clearfix" id="device-sales-legend"></div>
                                    <canvas id="dmonth" style="width: 100%; height: 300px;"></canvas>
                                </div>
                            </div>
                            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                            <script>
                                $(function () {
                                    // Function to fetch data from the PHP script
                                    function fetchDataForLineChart() {
                                        $.ajax({
                                            url: 'monthly_orders.php', // Replace with the actual path to your PHP script
                                            method: 'GET',
                                            dataType: 'json',
                                            success: function (data) {
                                                console.log("Data received:", data); // Log the data to the console for inspection
                                                // Create or update the line chart with the fetched data
                                                createLineChart(data);
                                            },
                                            error: function (error) {
                                                console.error('Error fetching data: ' + error);
                                            }
                                        });
                                    }


                                    // Function to create or update the line chart
                                    function createLineChart(data) {    
                                        console.log(data); // Log the data to the console to check its content
                                        var lineChartCanvas = $("#dmonth").get(0).getContext("2d");
                                        var lineChart = new Chart(lineChartCanvas, {
                                            type: 'line',
                                            data: {
                                                labels: data.map(function (item) {
                                                    return item.month;
                                                }),
                                                datasets: [
                                                    {
                                                        label: 'Number of Orders',
                                                        data: data.map(function (item) {
                                                            return item.orderCount;
                                                        }),
                                                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                                                        borderColor: 'rgba(54, 162, 235, 1)',
                                                        borderWidth: 1
                                                    }
                                                ]
                                            },
                                            options: {
                                                scales: {
                                                    yAxes: [{
                                                        ticks: {
                                                            beginAtZero: true
                                                        }
                                                    }]
                                                }
                                            }
                                        });
                                    }

                                    // Call the function to fetch and display data on page load
                                    fetchDataForLineChart();
                                });
                            </script>
                    
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>                    
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          <footer class="footer">
            <div class="footer-inner-wraper">
              <div class="d-sm-flex justify-content-center justify-content-sm-between">
                <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © Resource Generation Office | Batangas State University - Alangilan 2023</span>
                             </div>
           
          </footer>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="assets/vendors/chart.js/Chart.min.js"></script>
    <script src="assets/vendors/jquery-circle-progress/js/circle-progress.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
    
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="assets/js/dashboard.js"></script>
    <script>
      $(function() {
        var doughnutPieData = {
          datasets: [{
            data: [0], // Initial count, will be updated via AJAX
            backgroundColor: [
              'rgba(255, 99, 132, 0.5)',
              'rgba(54, 162, 235, 0.5)',
              'rgba(255, 206, 86, 0.5)',
              'rgba(75, 192, 192, 0.5)',
              'rgba(153, 102, 255, 0.5)',
              'rgba(255, 159, 64, 0.5)'
            ],
            borderColor: [
              'rgba(255,99,132,1)',
              'rgba(54, 162, 235, 1)',
              'rgba(255, 206, 86, 1)',
              'rgba(75, 192, 192, 1)',
              'rgba(153, 102, 255, 1)',
              'rgba(255, 159, 64, 1)'
            ],
          }],
          labels: [
            'Pink',
            'Blue',
            'Yellow',
          ]
        };

        var doughnutPieOptions = {
          responsive: true,
          animation: {
            animateScale: true,
            animateRotate: true
          }
        };

        // Fetch the count of orders with "Approval In Progress" status from the server
        $.ajax({
          url: 'get_pending_orders.php', // Replace with the actual path to your server-side script
          success: function(data) {
            // Update the doughnutPieData with the fetched count
            doughnutPieData.datasets[0].data = [data];

            // Update the HTML element with the count
            $('#pendingOrdersCount').text(data);

            // Create the doughnut chart
            if ($("#doughnutChart").length) {
              var doughnutChartCanvas = $("#doughnutChart").get(0).getContext("2d");
              var doughnutChart = new Chart(doughnutChartCanvas, {
                type: 'doughnut',
                data: doughnutPieData,
                options: doughnutPieOptions
              });
            }
          }
        });
      });
    </script>
    <script>
      $(function() {
        var deliveredDoughnutPieData = {
          datasets: [{
            data: [0], // Initial count, will be updated via AJAX
            backgroundColor: [
              'rgba(255, 99, 132, 0.5)',
              'rgba(54, 162, 235, 0.5)',
              'rgba(255, 206, 86, 0.5)',
              'rgba(75, 192, 192, 0.5)',
              'rgba(153, 102, 255, 0.5)',
              'rgba(255, 159, 64, 0.5)'
            ],
            borderColor: [
              'rgba(255,99,132,1)',
              'rgba(54, 162, 235, 1)',
              'rgba(255, 206, 86, 1)',
              'rgba(75, 192, 192, 1)',
              'rgba(153, 102, 255, 1)',
              'rgba(255, 159, 64, 1)'
            ],
          }],
          labels: [
            'Pink',
            'Blue',
            'Yellow',
          ]
        };

        var deliveredDoughnutPieOptions = {
          responsive: true,
          animation: {
            animateScale: true,
            animateRotate: true
          }
        };

        // Fetch the count of orders with "Delivered" status from the server
        $.ajax({
          url: 'get_delivered_orders.php', // Replace with the actual path to your server-side script
          success: function(data) {
            // Update the deliveredDoughnutPieData with the fetched count
            deliveredDoughnutPieData.datasets[0].data = [data];

            // Update the HTML element with the count
            $('#deliveredOrdersCount').text(data);

            // Create the doughnut chart
            if ($("#deliveredDoughnutChart").length) {
              var deliveredDoughnutChartCanvas = $("#deliveredDoughnutChart").get(0).getContext("2d");
              var deliveredDoughnutChart = new Chart(deliveredDoughnutChartCanvas, {
                type: 'doughnut',
                data: deliveredDoughnutPieData,
                options: deliveredDoughnutPieOptions
              });
            }
          }
        });
      });

    </script>
    <script>
      $(function() {
        var doughnutPieData = {
          datasets: [{
            data: [0], // Initial count, will be updated via AJAX
            backgroundColor: [
              'rgba(255, 99, 132, 0.5)',
              'rgba(54, 162, 235, 0.5)',
              'rgba(255, 206, 86, 0.5)',
              'rgba(75, 192, 192, 0.5)',
              'rgba(153, 102, 255, 0.5)',
              'rgba(255, 159, 64, 0.5)'
            ],
            borderColor: [
              'rgba(255,99,132,1)',
              'rgba(54, 162, 235, 1)',
              'rgba(255, 206, 86, 1)',
              'rgba(75, 192, 192, 1)',
              'rgba(153, 102, 255, 1)',
              'rgba(255, 159, 64, 1)'
            ],
          }],
          labels: [
            'Pink',
            'Blue',
            'Yellow',
          ]
        };

        var doughnutPieOptions = {
          responsive: true,
          animation: {
            animateScale: true,
            animateRotate: true
          }
        };

        // Fetch the count of orders requested 3 days ago from the server
        $.ajax({
          url: 'get_new_orders.php', // Replace with the actual path to your server-side script
          success: function(data) {
            // Update the doughnutPieData with the fetched count
            doughnutPieData.datasets[0].data = [data];

            // Update the HTML element with the count
            $('#newOrdersCount').text(data);

            // Create the doughnut chart
            if ($("#doughnutChart").length) {
              var doughnutChartCanvas = $("#doughnutChart").get(0).getContext("2d");
              var doughnutChart = new Chart(doughnutChartCanvas, {
                type: 'doughnut',
                data: doughnutPieData,
                options: doughnutPieOptions
              });
            }
          }
        });
      });

    </script>
    <!-- End custom js for this page -->
  </body>
</html>