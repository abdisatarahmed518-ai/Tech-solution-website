<?php
session_start();
include("auth.php");
include("../config/db.php");

$greeting = $_POST['greeting'];
$name = $_POST['name'];
$title_1 = $_POST['title_1'];
$title_2 = $_POST['title_2'];
$title_3 = $_POST['title_3'];
$title_4 = $_POST['title_4'];
$description = $_POST['description'];
$github_link = $_POST['github_link'];
$linkedin_link = $_POST['linkedin_link'];
$whatsapp_link = $_POST['whatsapp_link'];
$youtube_link = $_POST['youtube_link'];
$logo_text = $_POST['logo_text'];

// Fetch current data
$result = mysqli_query($conn, "SELECT profile_image, cv_file, logo FROM home_content WHERE id = 1");
$current = mysqli_fetch_assoc($result);

$profile_image = $current['profile_image'];
$cv_file = $current['cv_file'];
$logo = $current['logo'];

// Handle File Uploads
if (isset($_FILES['logo']) && $_FILES['logo']['error'] == 0) {
    $target_dir = "../uploads/";
    if (!is_dir($target_dir)) mkdir($target_dir, 0777, true);
    $target_file = $target_dir . basename($_FILES["logo"]["name"]);
    move_uploaded_file($_FILES["logo"]["tmp_name"], $target_file);
    $logo = "uploads/" . basename($_FILES["logo"]["name"]);
}

if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == 0) {
    $target_dir = "../uploads/";
    if (!is_dir($target_dir)) mkdir($target_dir, 0777, true);
    $target_file = $target_dir . basename($_FILES["profile_image"]["name"]);
    move_uploaded_file($_FILES["profile_image"]["tmp_name"], $target_file);
    $profile_image = "uploads/" . basename($_FILES["profile_image"]["name"]);
}

if (isset($_FILES['cv_file']) && $_FILES['cv_file']['error'] == 0) {
    $target_dir = "../uploads/";
    if (!is_dir($target_dir)) mkdir($target_dir, 0777, true);
    $target_file = $target_dir . basename($_FILES["cv_file"]["name"]);
    move_uploaded_file($_FILES["cv_file"]["tmp_name"], $target_file);
    $cv_file = "uploads/" . basename($_FILES["cv_file"]["name"]);
}

$sql = "UPDATE home_content SET 
    greeting=?, 
    name=?, 
    title_1=?,
    title_2=?,
    title_3=?,
    title_4=?,
    description=?,
    profile_image=?,
    logo=?,
    logo_text=?,
    cv_file=?,
    github_link=?, 
    linkedin_link=?, 
    whatsapp_link=?, 
    youtube_link=?
    WHERE id=1";

if ($stmt = mysqli_prepare($conn, $sql)) {
    mysqli_stmt_bind_param($stmt, "sssssssssssssss", 
        $greeting, $name, $title_1, $title_2, $title_3, $title_4, $description, 
        $profile_image, $logo, $logo_text, $cv_file, 
        $github_link, $linkedin_link, $whatsapp_link, $youtube_link);
    
    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);
        header("Location: home.php?success=saved");
        exit();
    } else {
        echo "Error updating record: " . mysqli_stmt_error($stmt);
    }
    mysqli_stmt_close($stmt);
} else {
    echo "Error preparing statement: " . mysqli_error($conn);
}
?>
