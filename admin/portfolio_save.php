<?php
include("../config/db.php");

if (isset($_POST['add'])) {
    $title = $_POST['title'];
    $technologies = $_POST['technologies'];
    $description = $_POST['description'];
    $link = $_POST['link'];
    $github_link = $_POST['github_link'];
    
    $image = "";
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $target_dir = "../uploads/";
        if (!is_dir($target_dir)) mkdir($target_dir, 0777, true);
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
        $image = "uploads/" . basename($_FILES["image"]["name"]);
    }

    // Default category since it's not in the form yet
    $category = "Web Development";

    $sql = "INSERT INTO projects (title, category, technologies, description, link, github_link, image) VALUES (?, ?, ?, ?, ?, ?, ?)";
    
    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "sssssss", $title, $category, $technologies, $description, $link, $github_link, $image);
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_close($stmt);
            header("Location: portfolio.php?success=added");
            exit();
        } else {
            echo "Error: " . mysqli_stmt_error($stmt);
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "Error preparing statement: " . mysqli_error($conn);
    }
}

header("Location: portfolio.php");
?>
