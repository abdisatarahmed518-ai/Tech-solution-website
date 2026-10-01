<?php
session_start();
include("auth.php");
include("../config/db.php");

// Handle Delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM services WHERE id = ?";
    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $id);
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
    <title>Edit Services</title>
    <link rel="stylesheet" href="admin.css">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
</head>
<body>

<?php include("sidebar.php"); ?>

<div class="admin-container">
    <h2 class="heading">Manage <span>Services</span></h2>

    <!-- Add Service Form -->
    <form action="services_save.php" method="POST" style="margin-bottom: 2rem;">
        <h3 style="color: var(--main-color); margin-bottom: 1rem;">Add New Service</h3>
        <div class="form-group">
            <input type="text" name="icon" placeholder="Icon Class (e.g. bx bx-code-alt)" required>
        </div>
        <div class="form-group">
            <input type="text" name="title" placeholder="Service Title" required>
        </div>
        <div class="form-group">
            <textarea name="description" placeholder="Description" required></textarea>
        </div>
        <button type="submit" name="add">Add Service</button>
    </form>

    <!-- List Services -->
    <h3 style="margin-bottom: 1rem;">Existing Services</h3>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Icon</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result = mysqli_query($conn, "SELECT * FROM services");
                while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><i class="<?= $row['icon']; ?>" style="font-size: 1.5rem; color: var(--main-color);"></i></td>
                    <td><?= $row['title']; ?></td>
                    <td><?= substr($row['description'], 0, 50); ?>...</td>
                    <td class="action-buttons">
                        <a href="edit_service.php?id=<?= $row['id']; ?>" class="btn-action btn-edit"><i class='bx bx-edit'></i> <span>Edit</span></a>
                        <a href="services.php?delete=<?= $row['id']; ?>" class="btn-action btn-delete" onclick="return confirm('Did you want to delete this service? Are you sure?')"><i class='bx bx-trash'></i> <span>Delete</span></a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
