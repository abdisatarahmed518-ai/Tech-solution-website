<?php
session_start();
include("auth.php");
include("../config/db.php");

if (!isset($_GET['id']) || !isset($_GET['type'])) {
    header("Location: resume.php");
    exit();
}

$id = $_GET['id'];
$type = $_GET['type'];
$table = "";
$fields = [];

// Determine table and fields based on type
if ($type == 'exp') {
    $table = "experience";
    $fields = ['year', 'role', 'company', 'description'];
} elseif ($type == 'edu') {
    $table = "education";
    $fields = ['year', 'degree', 'institution', 'description'];
} elseif ($type == 'skill') {
    $table = "skills";
    $fields = ['icon', 'name'];
} elseif ($type == 'about') {
    $table = "about_me";
    $fields = ['label', 'value'];
} else {
    // Invalid type
    header("Location: resume.php"); exit();
}

// Fetch current data
$sql = "SELECT * FROM $table WHERE id = ?";
if ($stmt = mysqli_prepare($conn, $sql)) {
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);
}

if (!$row) {
    header("Location: resume.php"); exit();
}

// Handle Update
if (isset($_POST['update'])) {
    if ($type == 'exp') {
        $year = $_POST['year'];
        $role = $_POST['role'];
        $company = $_POST['company'];
        $description = $_POST['description'];
        
        $sql = "UPDATE experience SET year=?, role=?, company=?, description=? WHERE id=?";
        if ($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, "ssssi", $year, $role, $company, $description, $id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
    } elseif ($type == 'edu') {
        $year = $_POST['year'];
        $degree = $_POST['degree'];
        $institution = $_POST['institution'];
        $description = $_POST['description'];

        $sql = "UPDATE education SET year=?, degree=?, institution=?, description=? WHERE id=?";
        if ($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, "ssssi", $year, $degree, $institution, $description, $id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
    } elseif ($type == 'skill') {
        $icon = $_POST['icon'];
        $name = $_POST['name'];

        $sql = "UPDATE skills SET icon=?, name=? WHERE id=?";
        if ($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, "ssi", $icon, $name, $id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
    } elseif ($type == 'about') {
        $label = $_POST['label'];
        $value = $_POST['value'];

        $sql = "UPDATE about_me SET label=?, value=? WHERE id=?";
        if ($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, "ssi", $label, $value, $id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
    }
    
    header("Location: resume.php?msg=updated");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Resume Item</title>
    <link rel="stylesheet" href="admin.css">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
</head>
<body>

<?php include("sidebar.php"); ?>

<div class="admin-container">
    <h2 class="heading">Edit <span><?= ucfirst(($type == 'exp') ? 'Experience' : (($type == 'edu') ? 'Education' : (($type == 'skill') ? 'Skill' : 'About Me'))); ?></span></h2>
    
    <form action="" method="POST">
        <?php if ($type == 'exp'): ?>
            <div class="form-group"><label>Year</label><input type="text" name="year" value="<?= htmlspecialchars($row['year']); ?>" required></div>
            <div class="form-group"><label>Role</label><input type="text" name="role" value="<?= htmlspecialchars($row['role']); ?>" required></div>
            <div class="form-group"><label>Company</label><input type="text" name="company" value="<?= htmlspecialchars($row['company']); ?>" required></div>
            <div class="form-group"><label>Description</label><textarea name="description" rows="5" required><?= htmlspecialchars($row['description']); ?></textarea></div>

        <?php elseif ($type == 'edu'): ?>
            <div class="form-group"><label>Year</label><input type="text" name="year" value="<?= htmlspecialchars($row['year']); ?>" required></div>
            <div class="form-group"><label>Degree</label><input type="text" name="degree" value="<?= htmlspecialchars($row['degree']); ?>" required></div>
            <div class="form-group"><label>Institution</label><input type="text" name="institution" value="<?= htmlspecialchars($row['institution']); ?>" required></div>
            <div class="form-group"><label>Description</label><textarea name="description" rows="5" required><?= htmlspecialchars($row['description']); ?></textarea></div>

        <?php elseif ($type == 'skill'): ?>
            <div class="form-group"><label>Icon Class</label><input type="text" name="icon" value="<?= htmlspecialchars($row['icon']); ?>" required></div>
            <div class="form-group"><label>Skill Name</label><input type="text" name="name" value="<?= htmlspecialchars($row['name']); ?>" required></div>
        <?php elseif ($type == 'about'): ?>
            <div class="form-group"><label>Label</label><input type="text" name="label" value="<?= htmlspecialchars($row['label']); ?>" required></div>
            <div class="form-group"><label>Value</label><input type="text" name="value" value="<?= htmlspecialchars($row['value']); ?>" required></div>
        <?php endif; ?>

        <button type="submit" name="update">Update</button>
        <a href="resume.php" style="margin-left: 10px; color: #aaa;">Cancel</a>
    </form>
</div>

</body>
</html>
