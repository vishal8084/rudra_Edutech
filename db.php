<?php



$dbHost = "localhost";
$dbName = "rudra_edutech";
$dbUser = "root";
$dbPass = "";


/* =========================================================
   CONNECT TO DATABASE
========================================================= */

$conn = new mysqli(
    $dbHost,
    $dbUser,
    $dbPass,
    $dbName
);


/* =========================================================
   CHECK DATABASE CONNECTION
========================================================= */

if ($conn->connect_error) {
    die(
        "Database connection failed: " .
        htmlspecialchars($conn->connect_error)
    );
}


/* =========================================================
   UTF-8 SUPPORT
========================================================= */

$conn->set_charset("utf8mb4");

?>