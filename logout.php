<?php
session_start();
session_destroy(); // End the user's session
header('Location: index.php'); // Redirect to your login page or any other appropriate page after logout
exit();
?>