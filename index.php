<?php
// Start a session
session_start();

// Database connection details
$databaseHost = 'localhost';
$databaseUsername = 'root';
$databasePassword = '';
$dbname = 'rgo_db';

// Create a connection to the database
$conn = new mysqli($databaseHost, $databaseUsername, $databasePassword, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the username and password match a record in the database    
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // You should perform proper validation and sanitization here

    // Hash the password before comparing it with the database
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql = "SELECT user_id, password FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['user_id'];

            // Check if user_id is present in 'applicants' table
            $applicantSql = "SELECT user_id FROM applicants WHERE user_id = ?";
            $applicantStmt = $conn->prepare($applicantSql);
            $applicantStmt->bind_param("s", $_SESSION['user_id']);
            $applicantStmt->execute();
            $applicantResult = $applicantStmt->get_result();

            if ($applicantResult->num_rows == 1) {
                header("Location: homepage.php");
                exit();
            } else {
                echo '<script>alert("Invalid email or password.");</script>';
            }
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
                <form action="" class="login__form" >
                <div style="display: flex; justify-content: center; align-items: center;">
                    <img src="assets/img/rgo1.png" alt="Logo" style="width: 150px; height: 150px; scale: 150%;">
                    </div>                   
                    <div>
                        <div class="login__inputs">
                            <div>
                                <label for="" class="login__label">Email</label>
                                <input type="email" placeholder="Enter your email address" required class="login__input">
                            </div>
    
                            <div>
                                <label for="" class="login__label">Password</label>
    
                                <div class="login__box">
                                    <input type="password" placeholder="Enter your password" required class="login__input" id="input-pass">
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
                            <button class="login__button">Log In</button>
                                
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