<?php
session_start();
include("auth.php");
include("../config/db.php");

if (!isset($_GET['id'])) {
    header("Location: portfolio.php");
    exit();
}

$id = $_GET['id'];
$sql = "SELECT * FROM projects WHERE id = ?";
if ($stmt = mysqli_prepare($conn, $sql)) {
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);
}

if (!$row) {
    header("Location: portfolio.php");
    exit();
}

if (isset($_POST['update'])) {
    $title = $_POST['title'];
    $technologies = $_POST['technologies'];
    $description = $_POST['description'];
    $link = $_POST['link'];
    $github_link = $_POST['github_link'];
    
    // Check if new image is uploaded
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $target_dir = "../uploads/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
        $image = "uploads/" . basename($_FILES["image"]["name"]);
        
        // Update with image
        $sql = "UPDATE projects SET title=?, technologies=?, description=?, link=?, github_link=?, image=? WHERE id=?";
        if ($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, "ssssssi", $title, $technologies, $description, $link, $github_link, $image, $id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
    } else {
        // Update without image
        $sql = "UPDATE projects SET title=?, technologies=?, description=?, link=?, github_link=? WHERE id=?";
        if ($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, "sssssi", $title, $technologies, $description, $link, $github_link, $id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
    }
    
    header("Location: portfolio.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Project</title>
    <link rel="stylesheet" href="admin.css">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
</head>
<body>

<?php include("sidebar.php"); ?>

<div class="admin-container">
    <h2 class="heading">Edit <span>Project</span></h2>
    
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label>Title</label>
            <input type="text" name="title" value="<?= htmlspecialchars($row['title']); ?>" required>
        </div>
        <div class="form-group">
            <label>Technologies</label>
            <input type="text" name="technologies" value="<?= htmlspecialchars($row['technologies']); ?>" required>
        </div>
        <div class="form-group">
            <label>Description</label>
            <textarea name="description" rows="5" required><?= htmlspecialchars($row['description']); ?></textarea>
        </div>
        <div class="form-group" style="display: flex; gap: 10px;">
            <div style="flex:1">
                <label>Live Link</label>
                <input type="text" name="link" value="<?= htmlspecialchars($row['link']); ?>">
            </div>
            <div style="flex:1">
                <label>GitHub Link</label>
                <input type="text" name="github_link" value="<?= htmlspecialchars($row['github_link']); ?>">
            </div>
        </div>
        
        <div class="form-group">
            <label>Current Image</label><br>
            <img src="../<?= $row['image']; ?>" width="150" style="border-radius: 8px; margin-bottom: 10px;">
            <br>
            <label>Replace Image (Optional)</label>
            <input type="file" name="image" style="color: white;">
        </div>

        <button type="submit" name="update">Update Project</button>
        <a href="portfolio.php" style="margin-left: 10px; color: #aaa;">Cancel</a>
    </form>
</div>

</body>
</html>
