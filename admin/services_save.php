<?php
include("../config/db.php");

if (isset($_POST['add'])) {
    $icon = $_POST['icon'];
    $title = $_POST['title'];
    $description = $_POST['description'];

    $sql = "INSERT INTO services (icon, title, description) VALUES (?, ?, ?)";
    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "sss", $icon, $title, $description);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
}

header("Location: services.php");
?>
