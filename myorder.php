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


<div class="limiter">
<div class="container-table100">
<div class="wrap-table100">
<div class="table100">
<table>
<thead>
<tr class="table100-head">
<th class="column1">Date</th>
<th class="column2">Order ID</th>
<th class="column3">Name</th>
<th class="column4">Price</th>
<th class="column5">Quantity</th>
<th class="column6">Total</th>
</tr>
</thead>
<tbody>
<tr>
<td class="column1">2017-09-29 01:22</td>
<td class="column2">200398</td>
<td class="column3">iPhone X 64Gb Grey</td>
<td class="column4">$999.00</td>
<td class="column5">1</td>
<td class="column6">$999.00</td>
</tr>
<tr>
<td class="column1">2017-09-28 05:57</td>
<td class="column2">200397</td>
<td class="column3">Samsung S8 Black</td>
<td class="column4">$756.00</td>
<td class="column5">1</td>
<td class="column6">$756.00</td>
</tr>
<tr>
<td class="column1">2017-09-26 05:57</td>
<td class="column2">200396</td>
<td class="column3">Game Console Controller</td>
<td class="column4">$22.00</td>
<td class="column5">2</td>
<td class="column6">$44.00</td>
</tr>
<tr>
<td class="column1">2017-09-25 23:06</td>
<td class="column2">200392</td>
<td class="column3">USB 3.0 Cable</td>
<td class="column4">$10.00</td>
<td class="column5">3</td>
<td class="column6">$30.00</td>
</tr>
<tr>
<td class="column1">2017-09-24 05:57</td>
<td class="column2">200391</td>
<td class="column3">Smartwatch 4.0 LTE Wifi</td>
<td class="column4">$199.00</td>
<td class="column5">6</td>
<td class="column6">$1494.00</td>
</tr>
<tr>
<td class="column1">2017-09-23 05:57</td>
<td class="column2">200390</td>
<td class="column3">Camera C430W 4k</td>
<td class="column4">$699.00</td>
<td class="column5">1</td>
<td class="column6">$699.00</td>
</tr>
<tr>
<td class="column1">2017-09-22 05:57</td>
<td class="column2">200389</td>
<td class="column3">Macbook Pro Retina 2017</td>
<td class="column4">$2199.00</td>
<td class="column5">1</td>
<td class="column6">$2199.00</td>
</tr>
<tr>
<td class="column1">2017-09-21 05:57</td>
<td class="column2">200388</td>
<td class="column3">Game Console Controller</td>
<td class="column4">$999.00</td>
<td class="column5">1</td>
<td class="column6">$999.00</td>
</tr>
<tr>
<td class="column1">2017-09-19 05:57</td>
<td class="column2">200387</td>
<td class="column3">iPhone X 64Gb Grey</td>
<td class="column4">$999.00</td>
<td class="column5">1</td>
<td class="column6">$999.00</td>
</tr>
<tr>
<td class="column1">2017-09-18 05:57</td>
<td class="column2">200386</td>
<td class="column3">iPhone X 64Gb Grey</td>
<td class="column4">$999.00</td>
<td class="column5">1</td>
<td class="column6">$999.00</td>
</tr>
</tbody>
</table>
</div>
</div>
</div>
</div>

<script src="vendor/jquery/jquery-3.2.1.min.js"></script>

<script src="vendor/bootstrap/js/popper.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>

<script src="vendor/select2/select2.min.js"></script>

<script src="js/main.js"></script>

<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'UA-23581568-13');
	</script>
<script defer src="https://static.cloudflareinsights.com/beacon.min.js/v8b253dfea2ab4077af8c6f58422dfbfd1689876627854" integrity="sha512-bjgnUKX4azu3dLTVtie9u6TKqgx29RBwfj3QXYt5EKfWM/9hPSAI/4qcV5NACjwAo8UtTeWefx6Zq5PHcMm7Tg==" data-cf-beacon='{"rayId":"816a35a4d8aa6017","token":"cd0b4b3a733644fc843ef0b185f98241","version":"2023.8.0","si":100}' crossorigin="anonymous"></script>
</body>
</html>

