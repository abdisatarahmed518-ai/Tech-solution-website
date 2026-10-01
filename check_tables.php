<?php
include("config/db.php");

$tables_res = mysqli_query($conn, "SHOW TABLES");
echo "Table Counts:\n";
while ($row = mysqli_fetch_array($tables_res)) {
    $table = $row[0];
    $count_res = mysqli_query($conn, "SELECT COUNT(*) FROM $table");
    $count = mysqli_fetch_array($count_res)[0];
    echo "- $table: $count rows\n";
}
?>
