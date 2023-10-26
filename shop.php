<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catering</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css" />
  <link rel="stylesheet" href="shop.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

</head>
<body>
<nav class="navbar" style="padding:2px;">
        <div class="logo">
            <img src="assets/img/rgow.png" alt="R-go Logo" class="nav-image">
        </div>
        <div class="line-divider">|</div>
        <div class="search-bar">
            <input type="text" placeholder="Search...">
        </div>
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
    </div>
    <div class="icon menu-btn">
        <i class="fas fa-bars"></i>
    </div>
</nav>
<div class="breadcrumb">
    <a href="homepage.php">Home</a>
    <span>&gt;</span>
    Food Menu
</div>
<div class="conts">
<form role="search" class="search-form" id="search-form" action="#" method="post">
  
  <section class="search-terms">
    <label for="search-term" class="search-term-label screen-reader-text">Search Terms</label>
    <div>
      <span class="search-term-button-wrap">
        <input type="submit" value="Search" class="search-button">
      </span>
    </div>
  </section>

  <section class="search-filters" id="search-filters">
    
    <h3 class="search-filters-title" id="search-filters-title">Search Filters</h3>
    
    <div class="size-filters filter-group">
    
      <div>
        <input type="checkbox" id="filter-all">
        <label for="filter-size-small">ALL</label>
      </div>
      
      <div>
        <input type="checkbox" id="filter-lunch" checked>
        <label for="filter-size-medium">Lunch/Dinner</label>
      </div>
      
      <div>
        <input type="checkbox" id="filter-snacks">
        <label for="filter-size-large">Snacks</label>
      </div>

      <div>
        <input type="checkbox" id="filter-beverages">
        <label for="filter-size-large">Beverages</label>
      </div>

      <div>
        <input type="checkbox" id="filter-addons">
        <label for="filter-size-large">Add-ons</label>
      </div>
    </div>
  <!--SLIDER-->
  <div class="d-flex">
  <div class="wrapper">
    <header>
      <h2>Price Range</h2>
      <p>Use the slider or enter min and max price</p>
    </header>
    <div class="price-input">
      <div class="field">
        <span>Min</span>
        <input type="number" class="input-min" value="50" min="50" max="400">
      </div>
      <div class="separator">-</div>
      <div class="field">
        <span>Max</span>
        <input type="number" class="input-max" value="400" min="50" max="400">
      </div>
    </div>
    <div class="slider">
      <div class="progress"></div>
    </div>
    <div class="range-input">
      <input type="range" class="range-min" min="50" max="400" value="50" step="1">
      <input type="range" class="range-max" min="50" max="400" value="400" step="1">
    </div>
  </div>
</div>

    
    <small class="filter-explanation">Choosing filters automatically refines and refreshes search.</small>
    
  </section>
  </form>
  
  
<section class="search-results">
<div class="row mt-2 pb-3">
        <?php
  			include 'config.php';
        $stmt = $conn->prepare('SELECT * FROM product');
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()):
            // Check if stock is greater than 0 before allowing the item to be added to the cart
            $isOutOfStock = $row['stocks'] <= 0;
  		?>
    <div class="col-sm-6 col-md-4 col-lg-3 mb-2" >
        <div class="result">
            <div class="card p-2 border-secondary mb-2">
                <img src="<?= $row['product_image'] ?>" class="card-img-top" height="250">
                <div class="card-body p-1">
                
                <h4 class="card-title  text-dark"  ><?= $row['product_name'] ?></h4>
                <h5 class="card-text  text-danger">Php <?= number_format($row['product_price'],2) ?></h5>

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
</section>
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
var Search = {
  
  searchForm: $("#search-form"),
  searchTerms: $("#search-terms"),
  searchFilters: $("#search-filters"),
  searchFiltersTitle: $("#search-filters-title"),
  offset: $("#search-filters-title").offset(),
  win: $(window),
  
  init: function() {
    Search.bindUIEvents();
  },
  
  bindUIEvents: function() {
    
    Search.searchFiltersTitle
      .on(
        "click",
        Search.toggleSearchFilters
      );
    
    Search.win
      .on(
        "scroll",
        Search.filterHeaderPosition
       );
    
    Search.searchForm
      .on(
         "submit",
        Search.searchSubmit
       );
    
  },
  
  toggleSearchFilters: function() {
    console.log("Toggle function called");
    Search.searchForm.toggleClass("filters-open");
},
  
  filterHeaderPosition: function() {
    
     var scrollTop = Search.win.scrollTop();
           
     if (scrollTop > Search.offset.top) {
       Search.searchFilters.addClass("pinned");
       Search.searchTerms.css("margin-bottom", Search.searchFilters.outerHeight());
     } else {
       Search.searchFilters.removeClass("pinned"); 
       Search.searchTerms.css("margin-bottom", "10px");
     };
    
  },
  
  searchSubmit: function() {
    // process new search
    return false; 
  }
  
};

Search.init();
</script>
<script>
  const body = document.querySelector("body");
    const navbar = document.querySelector(".navbar");
    const menuBtn = document.querySelector(".menu-btn");
    const cancelBtn = document.querySelector(".cancel-btn");
    menuBtn.onclick = ()=>{
      navbar.classList.add("show");
      menuBtn.classList.add("hide");
      body.classList.add("disabled");
    }
    cancelBtn.onclick = ()=>{
      body.classList.remove("disabled");
      navbar.classList.remove("show");
      menuBtn.classList.remove("hide");
    }
    window.onscroll = ()=>{
      this.scrollY > 20 ? navbar.classList.add("sticky") : navbar.classList.remove("sticky");
    }
</script>

  <script>
    //slider
    const rangeInput = document.querySelectorAll(".range-input input"),
  priceInput = document.querySelectorAll(".price-input input"),
  range = document.querySelector(".slider .progress");
let priceGap = 100;

priceInput.forEach((input) => {
  input.addEventListener("input", (e) => {
    let minPrice = parseInt(priceInput[0].value),
      maxPrice = parseInt(priceInput[1].value);

    if (maxPrice - minPrice >= priceGap && maxPrice <= rangeInput[1].max) {
      if (e.target.className === "input-min") {
        rangeInput[0].value = minPrice;
        range.style.left = ((minPrice - 50) / (rangeInput[0].max - 50)) * 100 + "%";
      } else {
        rangeInput[1].value = maxPrice;
        range.style.right = 100 - ((maxPrice - 50) / (rangeInput[1].max - 50)) * 100 + "%";
      }
    }
  });
});

rangeInput.forEach((input) => {
  input.addEventListener("input", (e) => {
    let minVal = parseInt(rangeInput[0].value),
      maxVal = parseInt(rangeInput[1].value);

    if (maxVal - minVal < priceGap) {
      if (e.target.className === "range-min") {
        rangeInput[0].value = maxVal - priceGap;
      } else {
        rangeInput[1].value = minVal + priceGap;
      }
    } else {
      priceInput[0].value = minVal;
      priceInput[1].value = maxVal;
      range.style.left = ((minVal - 50) / (rangeInput[0].max - 50)) * 100 + "%";
      range.style.right = 100 - ((maxVal - 50) / (rangeInput[1].max - 50)) * 100 + "%";
    }
  });
});


</script>
</div>
</body>
</html>