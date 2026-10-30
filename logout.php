<?php


if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


session_unset();
session_destroy();

// Logout message 
session_start();
$_SESSION['welcome_msg'] = "You have been logged out successfully.";

header("Location: index.php?logout_status=success");
exit();
?>