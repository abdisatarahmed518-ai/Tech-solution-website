<?php
include("config/db.php");

echo "<h2>Table: social_links</h2>";
$check = mysqli_query($conn, "SHOW TABLES LIKE 'social_links'");
if (mysqli_num_rows($check) > 0) {
    // Show columns
    echo "<h3>Columns:</h3>";
    $cols = mysqli_query($conn, "SHOW COLUMNS FROM social_links");
    while ($row = mysqli_fetch_assoc($cols)) {
        echo $row['Field'] . " (" . $row['Type'] . ")<br>";
    }

    // Show content
    echo "<h3>Content:</h3>";
    $res = mysqli_query($conn, "SELECT * FROM social_links");
    if (mysqli_num_rows($res) > 0) {
        while ($row = mysqli_fetch_assoc($res)) {
            print_r($row);
            echo "<br>";
        }
    } else {
        echo "Table is empty.<br>";
    }
} else {
    echo "Table 'social_links' does not exist.<br>";
}

echo "<h2>Table: home_content (Current Social Links)</h2>";
$res_home = mysqli_query($conn, "SELECT github_link, linkedin_link, whatsapp_link, youtube_link FROM home_content WHERE id=1");
if ($row = mysqli_fetch_assoc($res_home)) {
    echo "Github: " . $row['github_link'] . "<br>";
    echo "LinkedIn: " . $row['linkedin_link'] . "<br>";
    echo "WhatsApp: " . $row['whatsapp_link'] . "<br>";
    echo "YouTube: " . $row['youtube_link'] . "<br>";
}
?>
