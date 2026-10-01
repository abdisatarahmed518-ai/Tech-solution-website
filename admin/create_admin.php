<?php
include("../config/db.php");

// Ensure the users table exists in case it was deleted
$createTable = "CREATE TABLE IF NOT EXISTS users (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(30) NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(50),
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";
mysqli_query($conn, $createTable);

$username = "yahye";
$password = password_hash("yahye123", PASSWORD_DEFAULT);

// Check if user already exists to avoid duplicates
$check = mysqli_query($conn, "SELECT id FROM users WHERE username = '$username'");
if (mysqli_num_rows($check) == 0) {
    $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
    if (mysqli_query($conn, $sql)) {
        echo "Admin 'yahye' created successfully. You can now login at login.php";
    } else {
        echo "Error creating admin: " . mysqli_error($conn);
    }
} else {
    // Update the existing user's password
    $update_sql = "UPDATE users SET password = '$password' WHERE username = '$username'";
    if (mysqli_query($conn, $update_sql)) {
        echo "User 'yahye' already exists. Password updated to hashed version.";
    } else {
        echo "Error updating password: " . mysqli_error($conn);
    }
}
?>
