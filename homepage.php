<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RGO</title>
    <link rel="stylesheet" href="style2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="script.js"></script>
    
</head>

<body>
<nav class="navbar">
        <div class="content">
            <ul class="menu-list">
                <div class="icon cancel-btn">
                    <i class="fas fa-times"></i>
                </div>
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
    <button class="btn1" onclick="gotologin()">Catering Services</button> 
    <script>
      function gotologin() {
        window.location.href = "shop.php";
      }
    </script>
  </div>
  <div>

</div>
  <div class="about">
    <div class="content">
      <div class="title" style = "text-align: center" >ONLINE CATERING SERVICE MANAGAMENT SYSTEM <br>
                          FOR RESOURCE GENERATION OFFICE (RGO) AT <br>
                          BASTATEU-ALANGILAN</div>
    </div>
  </div>

  <div class="footer">
        <div class="footer-content">
            <div class="left-content">
                <h3>BATANGAS STATE UNIVERSITY</h3>
                <p>A premier national university that develops <br> leaders in the global knowledge economy</p><br>
                <h3>CONTACT US</h3>
                <p>Landline: 980-0385/980-0387/980-0394 loc 1221 / 1130</p>
                <p>Email Address: rgo.main@g.batastate-u.edu.ph,<br> resourcegenerationoffice@gmail.com</p>
                <p>Facebook Page: Batangas State University Resource Generation Office</p><br>
                <p>Copyright © 2023</p>
            </div>
            <div class="right-content">
                <img src="assets/img/rgo4.png" alt="Your Logo" class="logo">
                <div class="social-icons">
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                    <a href="#"><i class="fab fa-google"></i></a>
                    <a href="#"><i class="fab fa-linkedin"></i></a>
                </div>
            </div>
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
