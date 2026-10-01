<?php
session_start();
include("../config/db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password']; // Do not escape password before hashing check

    $sql = "SELECT id, password FROM users WHERE username = ?";
    
    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($result)) {
            if (password_verify($password, $row['password'])) {
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['username'] = $username;
                header("Location: home.php");
                exit();
            } else {
                header("Location: login.php?error=Incorrect User or password");
                exit();
            }
        } else {
            header("Location: login.php?error=Incorrect User or password");
            exit();
        }
        mysqli_stmt_close($stmt);
    } else {
        header("Location: login.php?error=Database error");
        exit();
    }
} else {
    header("Location: login.php");
    exit();
}
?>
