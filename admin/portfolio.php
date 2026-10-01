<?php
session_start();
include("auth.php");
include("../config/db.php");

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM projects WHERE id = ?";
    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
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
    <title>Edit Portfolio</title>
    <link rel="stylesheet" href="admin.css">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
</head>
<body>

<?php include("sidebar.php"); ?>

<div class="admin-container">
    <h2 class="heading">Manage <span>Projects</span></h2>

    <form action="portfolio_save.php" method="POST" enctype="multipart/form-data">
        <h3 style="color: var(--main-color); margin-bottom: 1rem;">Add New Project</h3>
        <div class="form-group">
            <input type="text" name="title" placeholder="Project Title" required>
        </div>
        <div class="form-group">
            <input type="text" name="technologies" placeholder="Technologies (e.g. HTML, CSS)" required>
        </div>
        <div class="form-group">
            <textarea name="description" placeholder="Description" required></textarea>
        </div>
        <div class="form-row">
            <div class="form-group">
                <input type="text" name="link" placeholder="Live Link">
            </div>
            <div class="form-group">
                <input type="text" name="github_link" placeholder="GitHub Link">
            </div>
        </div>
        <div class="form-group">
            <label>Project Image</label>
            <input type="file" name="image" required style="color: white;">
        </div>
        <button type="submit" name="add">Add Project</button>
    </form>

    <h3>Existing Projects</h3>
    <div class="dashboard-grid">
        <?php 
        $res = mysqli_query($conn, "SELECT * FROM projects ORDER BY id DESC");
        while($row = mysqli_fetch_assoc($res)): ?>
            <div class="project-card">
                <img src="../<?= $row['image']; ?>" alt="Project Image">
                <h4 style="font-size: 1.2rem; margin-bottom: 0.5rem;"><?= $row['title']; ?></h4>
                <p style="color: #ccc; font-size: 0.9rem; margin-bottom: 0.5rem;"><strong>Tech:</strong> <?= $row['technologies']; ?></p>
                <p style="color: #aaa; font-size: 0.85rem; margin-bottom: 1rem;"><?= substr($row['description'], 0, 100); ?>...</p>
                <div class="action-buttons">
                    <a href="edit_portfolio.php?id=<?= $row['id']; ?>" class="btn-action btn-edit"><i class='bx bx-edit'></i> <span>Edit</span></a>
                    <a href="portfolio.php?delete=<?= $row['id']; ?>" class="btn-action btn-delete" onclick="return confirm('Did you want to delete this project? Are you sure?')"><i class='bx bx-trash'></i> <span>Delete</span></a>
                </div>
            </div>
        <?php endwhile; ?>
    </div>

</div>

</body>
</html>
