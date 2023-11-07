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
    // Check if the username and password match a record in the database
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST["email"];
        $password = $_POST["password"];
    
        // You should perform proper validation and sanitization here
    
        $sql = "SELECT user_id FROM users WHERE username = '$username' AND password = '$password'";
        $result = $conn->query($sql);
        
        if ($result->num_rows == 1) {
        // Successful login, redirect to a dashboard page
        $row = $result->fetch_assoc();
        // Successful login, redirect to a dashboard page
        session_start();
        $_SESSION['user_id'] = $row['user_id'];
        // Use JavaScript to display an alert and then redirect
        echo '<script>window.location.href = "homepage.php";';
        echo 'alert("Login successful. Click OK to proceed to home page.");</script>';
        exit();
    } else {
        $sql = "SELECT user_id FROM admin WHERE username = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // Successful login, redirect to a dashboard page
        session_start();
        $row = $result->fetch_assoc();
        $_SESSION['user_id'] = $row['user_id'];

        // Use JavaScript to display an alert and then redirect
        echo '<script>alert("Admin Login successful. Click OK to proceed to the home page.");
              window.location.href = "admin/admin.php";</script>';
        exit();
    } else {
        echo '<script>alert("Invalid email or password.");</script>';
    }
}
}

// Close the database connection
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/styles.css">

    <title>RGO</title>
</head>
<body>
<div class="container">
    <img src="assets/img/Alangilan-CIT.jpg" alt="login image" class="login__img">
    <div class="login__content" style="display: flex; justify-content: center; align-items: center;">
        <form action="index.php" class="login__form" method="POST">
            <div style="display: flex; justify-content: center; align-items: center;">
                <img src="assets/img/rgo1.png" alt="Logo" style="width: 150px; height: 150px; scale: 150%;">
            </div>
            <div>
                <div class="login__inputs">
                    <div>
                        <label for="" class="login__label">Username</label>
                        <input type="text" placeholder="Enter your email address" required class="login__input" name="email" id="email">
                    </div>

                    <div>
                        <label for="" class="login__label">Password</label>

                        <div class="login__box">
                            <input type="password" placeholder="Enter your password" required class="login__input" name="password" id="password">
                            <i class="ri-eye-off-line login__eye" id="input-icon"></i>
                        </div>
                    </div>
                </div>

                <div class="login__check">
                    <input type="checkbox" class="login__check-input">
                    <label for="" class="login__check-label">Remember me</label>
                </div>
            </div>

            <div>
                <div class="login__buttons">
                    <button type="submit" class="login__button">Log In</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!--=============== MAIN JS ===============-->
<script src="assets/js/main.js"></script>
</body>
</html>
