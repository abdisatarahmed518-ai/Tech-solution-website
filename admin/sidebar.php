<!-- Mobile Header -->
<div class="mobile-header">
    <div class="logo">Admin Panel</div>
    <div id="admin-toggle"><i class='bx bx-menu'></i></div>
</div>

<div class="sidebar">
    <h3>Admin Panel</h3>
    <a href="dashboard.php" class="<?= basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'active' : '' ?>">
        <i class='bx bxs-dashboard'></i> <span>Dashboard</span>
    </a>
    <a href="home.php" class="<?= basename($_SERVER['PHP_SELF']) == 'home.php' ? 'active' : '' ?>">
        <i class='bx bx-home'></i> <span>Home Edit</span>
    </a>
    <a href="services.php" class="<?= basename($_SERVER['PHP_SELF']) == 'services.php' ? 'active' : '' ?>">
        <i class='bx bx-cog'></i> <span>Services</span>
    </a>
    <a href="resume.php" class="<?= basename($_SERVER['PHP_SELF']) == 'resume.php' ? 'active' : '' ?>">
        <i class='bx bx-file'></i> <span>Resume</span>
    </a>
    <a href="portfolio.php" class="<?= basename($_SERVER['PHP_SELF']) == 'portfolio.php' ? 'active' : '' ?>">
        <i class='bx bx-briefcase'></i> <span>Portfolio</span>
    </a>
    <a href="messages.php" class="<?= basename($_SERVER['PHP_SELF']) == 'messages.php' ? 'active' : '' ?>">
        <i class='bx bx-envelope'></i> <span>Messages</span>
    </a>
    
    <div class="sidebar-footer">
        <a href="../index.php" target="_blank">
            <i class='bx bx-globe'></i> <span>View Website</span>
        </a>
        <a href="logout.php" class="logout-btn">
            <i class='bx bx-log-out'></i> <span>Logout</span>
        </a>
    </div>
</div>

<script src="admin.js"></script>
