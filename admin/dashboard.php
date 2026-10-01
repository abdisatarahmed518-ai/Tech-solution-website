<?php
session_start();
include("auth.php");
include("../config/db.php");

// Fetch counts for dashboard stats
$projects_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM projects"))['count'];
$services_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM services"))['count'];
$messages_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM messages"))['count'];
$skills_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM skills"))['count'];
$experience_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM experience"))['count'];
$education_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM education"))['count'];
$about_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM about_me"))['count'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Use admin.css -->
    <link rel="stylesheet" href="admin.css">
    <!-- Boxicons -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
</head>
<body>

<?php include("sidebar.php"); ?>

<div class="admin-container">
    <h1 class="heading">Dashboard <span>Overview</span></h1>
    
    <div class="dashboard-grid">
        <!-- Projects Card -->
        <a href="portfolio.php" class="stat-card">
            <div class="stat-info">
                <h3><?= $projects_count; ?></h3>
                <p>Total Projects</p>
            </div>
            <div class="stat-icon">
                <i class='bx bx-grid-alt'></i>
            </div>
        </a>

        <!-- Services Card -->
        <a href="services.php" class="stat-card">
            <div class="stat-info">
                <h3><?= $services_count; ?></h3>
                <p>Active Services</p>
            </div>
            <div class="stat-icon">
                <i class='bx bx-cog'></i>
            </div>
        </a>

        <!-- Messages Card -->
        <a href="messages.php" class="stat-card">
            <div class="stat-info">
                <h3><?= $messages_count; ?></h3>
                <p>New Messages</p>
            </div>
            <div class="stat-icon">
                <i class='bx bx-envelope'></i>
            </div>
        </a>

        <!-- Skills Card -->
        <a href="resume.php" class="stat-card">
            <div class="stat-info">
                <h3><?= $skills_count; ?></h3>
                <p>Total Skills</p>
            </div>
            <div class="stat-icon">
                <i class='bx bx-code-alt'></i>
            </div>
        </a>
    </div>

    <br><br>

    <div class="dashboard-grid">
        <!-- Experience Card -->
        <a href="resume.php" class="stat-card">
            <div class="stat-info">
                <h3><?= $experience_count; ?></h3>
                <p>Total Experience</p>
            </div>
            <div class="stat-icon">
                <i class='bx bx-briefcase'></i>
            </div>
        </a>

        <!-- Education Card -->
        <a href="resume.php" class="stat-card">
            <div class="stat-info">
                <h3><?= $education_count; ?></h3>
                <p>Total Education</p>
            </div>
            <div class="stat-icon">
                <i class='bx bxs-graduation'></i>
            </div>
        </a>

        <!-- About Me Card -->
        <a href="resume.php" class="stat-card">
            <div class="stat-info">
                <h3><?= $about_count; ?></h3>
                <p>About Me Details</p>
            </div>
            <div class="stat-icon">
                <i class='bx bx-user'></i>
            </div>
        </a>
    </div>

    <br><br>
    
    <h2 class="heading">Quick <span>Actions</span></h2>
    <div class="dashboard-grid">
        <a href="portfolio.php" class="stat-card" style="justify-content: center; background: var(--bg-color); border: 2px dashed var(--main-color);">
            <div class="stat-info" style="text-align: center;">
                <i class='bx bx-plus' style="font-size: 2rem; color: var(--main-color);"></i>
                <p style="color: var(--main-color);">Add New Project</p>
            </div>
        </a>
        
        <a href="messages.php" class="stat-card" style="justify-content: center; background: var(--bg-color); border: 2px dashed var(--main-color);">
            <div class="stat-info" style="text-align: center;">
                <i class='bx bx-message-detail' style="font-size: 2rem; color: var(--main-color);"></i>
                <p style="color: var(--main-color);">View Messages</p>
            </div>
        </a>
    </div>

</div>

</body>
</html>
