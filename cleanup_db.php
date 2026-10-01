<?php
include("config/db.php");

$tables_to_drop = [
    'admin',
    'about_me',
    'contact_info',
    'home_titles',
    'project_images',
    'site_settings',
    'social_links'
];

foreach ($tables_to_drop as $table) {
    if (mysqli_query($conn, "DROP TABLE IF EXISTS $table")) {
        echo "Dropped table: $table\n";
    } else {
        echo "Error dropping table $table: " . mysqli_error($conn) . "\n";
    }
}
?>
