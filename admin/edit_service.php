<?php
session_start();
include("auth.php");
include("../config/db.php");

if (!isset($_GET['id'])) {
    header("Location: services.php");
    exit();
}

$id = $_GET['id'];
$sql = "SELECT * FROM services WHERE id = ?";
if ($stmt = mysqli_prepare($conn, $sql)) {
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);
}

if (isset($_POST['update'])) {
    $icon = $_POST['icon'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    
    $sql = "UPDATE services SET icon=?, title=?, description=? WHERE id=?";
    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "sssi", $icon, $title, $description, $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
    header("Location: services.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Service</title>
    <link rel="stylesheet" href="admin.css">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
</head>
<body>

<?php include("sidebar.php"); ?>

<div class="admin-container">
    <h2 class="heading">Edit <span>Service</span></h2>
    
    <form action="" method="POST">
        <div class="form-group">
            <label>Icon Class</label>
            <input type="text" name="icon" value="<?= htmlspecialchars($row['icon']); ?>" required>
        </div>
        <div class="form-group">
            <label>Title</label>
            <input type="text" name="title" value="<?= htmlspecialchars($row['title']); ?>" required>
        </div>
        <div class="form-group">
            <label>Description</label>
            <textarea name="description" rows="5" required><?= htmlspecialchars($row['description']); ?></textarea>
        </div>
        <button type="submit" name="update">Update Service</button>
        <a href="services.php" style="margin-left: 10px; color: #aaa;">Cancel</a>
    </form>
</div>

</body>
</html>
