<?php
$conn = mysqli_connect("localhost", "root", "", "portfolio_db");

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}
?>
