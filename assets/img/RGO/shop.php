<?php
        session_start();
 
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Shopping Cart System</title>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css' />
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css' />
  <link rel='stylesheet' href='shop.css' />
</head>

<body>
<nav class="navbar">
        <div class="content">
            <ul class="menu-list">
                <div class="icon cancel-btn">
                    <i class="fas fa-times"></i>
                </div>
                <li><a href="#">Home</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Menu</a></li>
                <li><a href="#">Contact</a></li>
                <li><a href="#">Online Catering</a></li>
                <li><a href="#">More</a></li>
                <li><a href="#"><i class="fas fa-shopping-bag"></i> <span id="cart-item" class="badge badge-danger"></span></a></li>
                <a style= "color: white">GCH, Alangilan, Batangas City</a>
                <li><a href="#"><i class="fas fa-user"></i></a></li>
            </ul>
            <div class="icon menu-btn">
                <i class="fas fa-bars"></i>
            </div>
        </div>
    </nav>
  <!-- Navbar end -->
  <div class="filter-container">
  <div class="filter">
          <h2>
              <button class="button button--icon button--white filter-collapse">
              <i class="fas fa-search"></i>
              </button>
              SEARCH FILTER
          </h2>
          <div class="filter-container2">
              <div class="filter-item">
                  <label for="category">By Category:</label>
                  <select id="category">
                      <option value="supplier">Supplier</option>
                  </select>
              </div>
          </div>

          <div class="filter-item">
            <label>Meal Type:</label>
            <label for="breakfast"><input type="radio" id="breakfast" name="meal-type" value="breakfast">Breakfast</label>

            <label for="snacks"><input type="radio" id="snacks" name="meal-type" value="snacks">Snacks</label>

            <label for="lunch"><input type="radio" id="lunch" name="meal-type" value="lunch">Lunch</label>

            <label for="dinner"><input type="radio" id="dinner" name="meal-type" value="dinner">Dinner</label>
          </div>
          <label for="min-price">Price Range:</label>
              <div class="price-range">
              <input type="number" id="min-price" placeholder="Min" min="0" style="width: 100px ">
              <input type="number" id="max-price" placeholder="Max" min="0" style="width: 100px">
          </div>
  </div>
</div>
  <!-- Displaying Products Start -->
  <div class="container">
    <div id="message"></div>
    <div class="row mt-2 pb-3">
      <?php
  			include 'config.php';
        include 'config.php';
        $stmt = $conn->prepare('SELECT * FROM product');
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()):
            // Check if stock is greater than 0 before allowing the item to be added to the cart
            $isOutOfStock = $row['stocks'] <= 0;
  		?>
      <div class="col-sm-6 col-md-4 col-lg-3 mb-2" >
        <div class="card-deck" >
          <div class="card p-2 border-secondary mb-2">
            <img src="<?= $row['product_image'] ?>" class="card-img-top" height="250">
            <div class="card-body p-1">
            
              <h4 class="card-title  text-dark"  ><?= $row['product_name'] ?></h4>
              <h5 class="card-text  text-danger">Php <?= number_format($row['product_price'],2) ?></h5>
              <h6 class="card-sub  text-dark">Available: <?= $row['stocks'] ?>pcs</h6>

            </div>
            <div class="card-footer p-1">
              <form action="" class="form-submit">
                <div class="row p-2">
                  <div class="col-md-6 py-1 pl-4 text-dark">
                    <b>Quantity : </b>
                  </div>
                  <div class="col-md-6">
                    <input type="number" class="form-control pqty" value="<?= $row['product_qty'] ?>">
                  </div>
                </div>
                <input type="hidden" class="pid" value="<?= $row['id'] ?>">
                <input type="hidden" class="pname" value="<?= $row['product_name'] ?>">
                <input type="hidden" class="pprice" value="<?= $row['product_price'] ?>">
                <input type="hidden" class="pimage" value="<?= $row['product_image'] ?>">
                <input type="hidden" class="pcode" value="<?= $row['product_code'] ?>">
                <?php if (!$isOutOfStock): ?>
                   <!-- Only allow adding to cart if the item is not out of stock -->
                   <button class="btn btn-info btn-block addItemBtn"><i
                      class="fas fa-cart-plus"></i>&nbsp;&nbsp;Add to cart</button>
                    <?php else: ?>
                      <div class="text-danger">Out of Stock</div>
                   <?php endif; ?>
              </form>
            </div>
          </div>
        </div>
      </div>
      <?php endwhile; ?>
    </div>
  </div>
  <!-- Displaying Products End -->

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

    // Send product details in the server
    $(".addItemBtn").click(function(e) {
      e.preventDefault();
      var $form = $(this).closest(".form-submit");
      var pid = $form.find(".pid").val();
      var pname = $form.find(".pname").val();
      var pprice = $form.find(".pprice").val();
      var pimage = $form.find(".pimage").val();
      var pcode = $form.find(".pcode").val();

      var pqty = $form.find(".pqty").val();

      $.ajax({
        url: 'action.php',
        method: 'post',
        data: {
          pid: pid,
          pname: pname,
          pprice: pprice,
          pqty: pqty,
          pimage: pimage,
          pcode: pcode
        },
        success: function(response) {
          $("#message").html(response);
          window.scrollTo(0, 0);
          load_cart_item_number();
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

<script>
  function toggleFilter() {
    var filter = document.querySelector('.filter');
    filter.classList.toggle('collapsed');
  }

  // Attach a click event to your button
  var filterButton = document.querySelector('.filter-collapse');
  filterButton.addEventListener('click', toggleFilter);
</script>

</body>