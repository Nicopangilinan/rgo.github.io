<!DOCTYPE html>
<!-- Created By CodingNepal - www.codingnepalweb.com -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RGO</title>
    <link rel="stylesheet" href="style2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</head>

<body>
<nav class="navbar">
        <div class="content">
            <ul class="menu-list">
                <div class="icon cancel-btn">
                    <i class="fas fa-times"></i>
                </div>
                <li><a href="homepage.php">Home</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Menu</a></li>
                <li><a href="#">Contact</a></li>
                <li><a href="shop.php">Online Catering</a></li>
                <li><a href="#">More</a></li>
                <li><a href="cart.php"><i class="fas fa-shopping-bag"></i> <span id="cart-item" class="badge badge-danger"></span></a></li>
                <a style= "color: white">GCH, Alangilan, Batangas City</a>
                <li><a href="#"><i class="fas fa-user"></i></a></li>
            </ul>
            <div class="icon menu-btn">
                <i class="fas fa-bars"></i>
            </div>
        </div>
    </nav>
  <div class="banner">
  <img src="assets/img/bsu.png" alt="left image" class="bsu_logo">
  <img src="assets/img/rgo4.png" alt="right image" class="rgo_logo">
  <img src="assets/img/rgo2.png" alt="homepage image" class="home_logo">
  </div>
  <div class="about">
    <div class="content">
      <div class="title" style = "text-align: center" >ONLINE CATERING SERVICE MANAGAMENT SYSTEM <br>
                          FOR RESOURCE GENERATION OFFICE (RGO) AT <br>
                          BASTATEU-ALANGILAN</div>
    </div>
  </div>

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

</body>
</html>
