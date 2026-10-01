<?php
session_start();
include("auth.php");
include("../config/db.php");

// Handle Deletes
if (isset($_GET['delete_exp'])) {
    $id = $_GET['delete_exp'];
    $sql = "DELETE FROM experience WHERE id = ?";
    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
    header("Location: resume.php"); exit();
}
if (isset($_GET['delete_edu'])) {
    $id = $_GET['delete_edu'];
    $sql = "DELETE FROM education WHERE id = ?";
    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
    header("Location: resume.php"); exit();
}
if (isset($_GET['delete_skill'])) {
    $id = $_GET['delete_skill'];
    $sql = "DELETE FROM skills WHERE id = ?";
    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
    header("Location: resume.php"); exit();
}
if (isset($_GET['delete_about'])) {
    $id = $_GET['delete_about'];
    $sql = "DELETE FROM about_me WHERE id = ?";
    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
    header("Location: resume.php"); exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Resume</title>
    <link rel="stylesheet" href="admin.css">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
</head>
<body>

<?php include("sidebar.php"); ?>

<div class="admin-container">
    <h2 class="heading">Manage <span>Resume</span></h2>

    <div class="dashboard-grid">
        <!-- Experience -->
        <div style="flex: 1;">
            <form action="resume_save.php" method="POST">
                <h3 style="color: var(--main-color); margin-bottom: 1rem;">Add Experience</h3>
                <input type="text" name="year" placeholder="Year (e.g. 2026 - Present)" required style="margin-bottom: 0.5rem;">
                <input type="text" name="role" placeholder="Role (e.g. Senior Developer)" required style="margin-bottom: 0.5rem;">
                <input type="text" name="company" placeholder="Company" required style="margin-bottom: 0.5rem;">
                <textarea name="description" placeholder="Description" required style="margin-bottom: 0.5rem;"></textarea>
                <button type="submit" name="add_exp">Add</button>
            </form>
            <div style="margin-top: 1rem;">
                <?php 
                $res = mysqli_query($conn, "SELECT * FROM experience ORDER BY id DESC");
                while($row = mysqli_fetch_assoc($res)): ?>
                    <div style="background: var(--card-bg); padding: 1rem; border-radius: 8px; margin-bottom: 10px; border-left: 3px solid var(--main-color);">
                        <h4><?= $row['role']; ?> <small style="color: #888;">at <?= $row['company']; ?></small></h4>
                        <small><?= $row['year']; ?></small>
                        <div class="action-buttons" style="justify-content: flex-end; margin-top: 10px;">
                            <a href="edit_resume.php?type=exp&id=<?= $row['id']; ?>" class="btn-action btn-edit"><i class='bx bx-edit'></i></a>
                            <a href="resume.php?delete_exp=<?= $row['id']; ?>" class="btn-action btn-delete" onclick="return confirm('Did you want to delete this experience? Are you sure?')"><i class='bx bx-trash'></i></a>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>

        <!-- Education -->
        <div style="flex: 1;">
            <form action="resume_save.php" method="POST">
                <h3 style="color: var(--main-color); margin-bottom: 1rem;">Add Education</h3>
                <input type="text" name="year" placeholder="Year" required style="margin-bottom: 0.5rem;">
                <input type="text" name="degree" placeholder="Degree" required style="margin-bottom: 0.5rem;">
                <input type="text" name="institution" placeholder="Institution" required style="margin-bottom: 0.5rem;">
                <textarea name="description" placeholder="Description" required style="margin-bottom: 0.5rem;"></textarea>
                <button type="submit" name="add_edu">Add</button>
            </form>
            <div style="margin-top: 1rem;">
                <?php 
                $res = mysqli_query($conn, "SELECT * FROM education ORDER BY id DESC");
                while($row = mysqli_fetch_assoc($res)): ?>
                    <div style="background: var(--card-bg); padding: 1rem; border-radius: 8px; margin-bottom: 10px; border-left: 3px solid var(--main-color);">
                        <h4><?= $row['degree']; ?></h4>
                        <small><?= $row['institution']; ?></small>
                        <div class="action-buttons" style="justify-content: flex-end; margin-top: 10px;">
                            <a href="edit_resume.php?type=edu&id=<?= $row['id']; ?>" class="btn-action btn-edit"><i class='bx bx-edit'></i></a>
                            <a href="resume.php?delete_edu=<?= $row['id']; ?>" class="btn-action btn-delete" onclick="return confirm('Did you want to delete this education? Are you sure?')"><i class='bx bx-trash'></i></a>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
    
    <!-- Skills & About Me Grid -->
    <div class="dashboard-grid" style="margin-top: 2rem;">
        <!-- Skills -->
        <div style="flex: 1;">
            <form action="resume_save.php" method="POST">
                <h3 style="color: var(--main-color); margin-bottom: 1rem;">Add Skill</h3>
                <div style="display: flex; gap: 10px;">
                    <input type="text" name="icon" placeholder="Icon Class (bx bxl-html5)" required>
                    <input type="text" name="name" placeholder="Skill Name" required>
                    <button type="submit" name="add_skill">Add</button>
                </div>
            </form>
            <div style="display: flex; flex-wrap: wrap; gap: 10px; margin-top: 1rem;">
                <?php 
                $res = mysqli_query($conn, "SELECT * FROM skills ORDER BY id DESC");
                while($row = mysqli_fetch_assoc($res)): ?>
                    <div style="background: var(--card-bg); padding: 0.5rem 1rem; border-radius: 20px; display: flex; align-items: center; gap: 5px;">
                        <i class="<?= $row['icon']; ?>"></i> <?= $row['name']; ?>
                        <div style="margin-left: auto;">
                            <a href="edit_resume.php?type=skill&id=<?= $row['id']; ?>" style="color: #ffa502; margin-right: 5px;"><i class='bx bx-edit'></i></a>
                            <a href="resume.php?delete_skill=<?= $row['id']; ?>" style="color: #ff4757;" onclick="return confirm('Did you want to delete this skill? Are you sure?')"><i class='bx bx-x'></i></a>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>

        <!-- About Me -->
        <div style="flex: 1;">
            <form action="resume_save.php" method="POST">
                <h3 style="color: var(--main-color); margin-bottom: 1rem;">Add About Me Detail</h3>
                <div style="display: flex; gap: 10px;">
                    <input type="text" name="label" placeholder="Label" required>
                    <input type="text" name="value" placeholder="Value" required>
                    <button type="submit" name="add_about">Add</button>
                </div>
            </form>
            <div style="display: flex; flex-direction: column; gap: 10px; margin-top: 1rem;">
                <?php 
                $res = mysqli_query($conn, "SELECT * FROM about_me ORDER BY id ASC");
                while($row = mysqli_fetch_assoc($res)): ?>
                    <div style="background: var(--card-bg); padding: 0.8rem 1rem; border-radius: 8px; display: flex; align-items: center; gap: 10px; border-left: 3px solid var(--main-color);">
                        <strong style="color: var(--main-color); min-width: 100px;"><?= $row['label']; ?>:</strong> 
                        <span><?= $row['value']; ?></span>
                        <div style="margin-left: auto; display: flex; gap: 10px;">
                            <a href="edit_resume.php?type=about&id=<?= $row['id']; ?>" style="color: #ffa502;"><i class='bx bx-edit'></i></a>
                            <a href="resume.php?delete_about=<?= $row['id']; ?>" style="color: #ff4757;" onclick="return confirm('Did you want to delete this about detail? Are you sure?')"><i class='bx bx-x'></i></a>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
</div>

</body>
</html>
