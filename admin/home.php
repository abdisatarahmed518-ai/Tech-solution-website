<?php
session_start();
include("auth.php");
include("../config/db.php");

$result = mysqli_query($conn, "SELECT * FROM home_content WHERE id = 1");
$home = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Home</title>
    <link rel="stylesheet" href="admin.css">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
</head>
<body>

<?php include("sidebar.php"); ?>

<div class="admin-container">
    <h2 class="heading">Edit <span>Home Section</span></h2>
    
    <form action="home_save.php" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label>Greeting</label>
            <input type="text" name="greeting" value="<?= htmlspecialchars($home['greeting']); ?>">
        </div>
        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" value="<?= htmlspecialchars($home['name']); ?>">
        </div>
        <div class="form-group">
            <label>Title 1</label>
            <input type="text" name="title_1" value="<?= htmlspecialchars($home['title_1']); ?>">
        </div>
        <div class="form-group">
            <label>Title 2</label>
            <input type="text" name="title_2" value="<?= htmlspecialchars($home['title_2']); ?>">
        </div>
        <div class="form-group">
            <label>Title 3</label>
            <input type="text" name="title_3" value="<?= htmlspecialchars($home['title_3']); ?>">
        </div>
        <div class="form-group">
            <label>Title 4</label>
            <input type="text" name="title_4" value="<?= htmlspecialchars($home['title_4']); ?>">
        </div>

        <div class="form-group">
            <label>Description</label>
            <textarea name="description" rows="5"><?= htmlspecialchars($home['description']); ?></textarea>
        </div>

        <div class="form-group">
            <label>Current Logo</label>
            <?php if (!empty($home['logo'])): ?>
                <img src="../<?= $home['logo']; ?>"width="100" style="border-radius: 10px; margin-bottom: 10px;">
            <?php endif; ?>
            <input type="file" name="logo">
        </div>

        <div class="form-group">
            <label>Logo Text</label>
            <input type="text" name="logo_text" value="<?= htmlspecialchars($home['logo_text'] ?? ''); ?>" placeholder="Enter text to display alongside logo">
        </div>
        
        <div class="form-group">
            <label>Current Profile Image</label>
            <?php if (!empty($home['profile_image'])): ?>
                <img src="../<?= $home['profile_image']; ?>" width="100" style="border-radius: 10px; margin-bottom: 10px;">
            <?php endif; ?>
            <input type="file" name="profile_image">
        </div>

        <div class="form-group">
            <label>Update CV</label>
            <input type="file" name="cv_file">
        </div>
        
        <h3 class="heading" style="margin-top: 2rem;">Social Links</h3>
        <div class="form-group">
            <label>GitHub Link</label>
            <input type="text" name="github_link" value="<?= htmlspecialchars($home['github_link'] ?? ''); ?>">
        </div>
        <div class="form-group">
            <label>LinkedIn Link</label>
            <input type="text" name="linkedin_link" value="<?= htmlspecialchars($home['linkedin_link'] ?? ''); ?>">
        </div>
        <div class="form-group">
            <label>WhatsApp Link</label>
            <input type="text" name="whatsapp_link" value="<?= htmlspecialchars($home['whatsapp_link'] ?? ''); ?>">
        </div>
        <div class="form-group">
            <label>YouTube Link</label>
            <input type="text" name="youtube_link" value="<?= htmlspecialchars($home['youtube_link'] ?? ''); ?>">
        </div>

        <button type="submit">Save Changes</button>
    </form>
</div>

</body>
</html>
