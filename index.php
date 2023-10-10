<?php
session_start();
$databaseHost = 'localhost';
$databaseUsername = 'root';
$databasePassword = '';
$dbname = "rgo_db";

// Create a connection
$conn = new mysqli($databaseHost, $databaseUsername, $databasePassword, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Validate and sanitize user inputs (you can add more validation)
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $password = filter_var($password, FILTER_SANITIZE_STRING);

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM admin WHERE username = ? AND password = ?");
    if ($stmt) {
        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if (!$result) {
            die("Query failed: " . $conn->error);
        }

        if ($result->num_rows == 1) {
            // Successful login, retrieve the user ID
            $row = $result->fetch_assoc();
            $userID = $row["user_id"];

            // Set the user ID in a session variable
            $_SESSION['user_id'] = $userID;
            // Successful login, redirect to a dashboard page
            header("Location: homepage.php");
            exit();
        } else {
            echo "Invalid email or password.";
        }
    } else {
        die("Prepare failed: " . $conn->error);
    }
}

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
                        <label for="" class="login__label">Email</label>
                        <input type="email" placeholder="Enter your email address" required class="login__input" name="email" id="email">
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

                <a href="#" class="login__forgot">Forgot Password?</a>
            </div>
        </form>
    </div>
</div>

<!--=============== MAIN JS ===============-->
<script src="assets/js/main.js"></script>
</body>
</html>
