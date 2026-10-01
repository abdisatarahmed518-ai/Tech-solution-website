<?php
include("../config/db.php");

if (isset($_POST['add_exp'])) {
    $year = $_POST['year'];
    $role = $_POST['role'];
    $company = $_POST['company'];
    $description = $_POST['description'];

    $sql = "INSERT INTO experience (year, role, company, description) VALUES (?, ?, ?, ?)";
    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "ssss", $year, $role, $company, $description);
        if (!mysqli_stmt_execute($stmt)) {
            echo "Error: " . mysqli_stmt_error($stmt); exit();
        }
        mysqli_stmt_close($stmt);
    }
}

if (isset($_POST['add_edu'])) {
    $year = $_POST['year'];
    $degree = $_POST['degree'];
    $institution = $_POST['institution'];
    $description = $_POST['description'];

    $sql = "INSERT INTO education (year, degree, institution, description) VALUES (?, ?, ?, ?)";
    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "ssss", $year, $degree, $institution, $description);
        if (!mysqli_stmt_execute($stmt)) {
            echo "Error: " . mysqli_stmt_error($stmt); exit();
        }
        mysqli_stmt_close($stmt);
    }
}

if (isset($_POST['add_skill'])) {
    $icon = $_POST['icon'];
    $name = $_POST['name'];

    $sql = "INSERT INTO skills (icon, name) VALUES (?, ?)";
    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "ss", $icon, $name);
        if (!mysqli_stmt_execute($stmt)) {
             echo "Error: " . mysqli_stmt_error($stmt); exit();
        }
        mysqli_stmt_close($stmt);
    }
}

if (isset($_POST['add_about'])) {
    $label = $_POST['label'];
    $value = $_POST['value'];

    $sql = "INSERT INTO about_me (label, value) VALUES (?, ?)";
    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "ss", $label, $value);
        if (!mysqli_stmt_execute($stmt)) {
             echo "Error: " . mysqli_stmt_error($stmt); exit();
        }
        mysqli_stmt_close($stmt);
    }
}

header("Location: resume.php");
?>
