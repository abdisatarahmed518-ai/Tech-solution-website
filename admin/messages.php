<?php
session_start();
include("auth.php");
include("../config/db.php");

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM messages WHERE id=$id");
    header("Location: messages.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages</title>
    <link rel="stylesheet" href="admin.css">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
</head>
<body>

<?php include("sidebar.php"); ?>

<div class="admin-container">
    <h2 class="heading">Contact <span>Messages</span></h2>

    <div class="dashboard-grid" style="grid-template-columns: 1fr;">
    <?php 
    $res = mysqli_query($conn, "SELECT * FROM messages ORDER BY id DESC");
    if (mysqli_num_rows($res) == 0) echo "<p>No messages found.</p>";
    while($row = mysqli_fetch_assoc($res)): ?>
        <div class="message-card">
            <div class="message-header">
                <h4><?= $row['name']; ?> <small>&lt;<?= $row['email']; ?>&gt;</small></h4>
                <small class="date"><?= $row['created_at']; ?></small>
            </div>
            <div class="message-meta">
                <span><i class='bx bxs-phone'></i> <?= $row['phone']; ?></span>
                <span><i class='bx bxs-user'></i> <?= ucfirst($row['gender']); ?></span>
            </div>
            <p class="subject">Subject: <?= $row['subject']; ?></p>
            <p class="message-body"><?= nl2br($row['message']); ?></p>
            <div class="action-buttons" style="justify-content: flex-end;">
                <a href="messages.php?delete=<?= $row['id']; ?>" class="btn-action btn-delete" onclick="return confirm('Delete this message?')"><i class='bx bx-trash'></i> <span>Delete</span></a>
            </div>
        </div>
    <?php endwhile; ?>
    </div>
</div>

</body>
</html>
