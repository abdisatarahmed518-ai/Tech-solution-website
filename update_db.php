<?php
include("config/db.php");

// Helper function to check if column exists
function columnExists($conn, $table, $column) {
    $result = $conn->query("SHOW COLUMNS FROM $table LIKE '$column'");
    return $result->num_rows > 0;
}

// Add title_1
if (!columnExists($conn, 'home_content', 'title_1')) {
    $conn->query("ALTER TABLE home_content ADD COLUMN title_1 VARCHAR(50) AFTER name");
    echo "Added title_1<br>";
} else {
    echo "title_1 exists<br>";
}

// Add title_2
if (!columnExists($conn, 'home_content', 'title_2')) {
    $conn->query("ALTER TABLE home_content ADD COLUMN title_2 VARCHAR(50) AFTER title_1");
    echo "Added title_2<br>";
} else {
    echo "title_2 exists<br>";
}

// Add title_3
if (!columnExists($conn, 'home_content', 'title_3')) {
    $conn->query("ALTER TABLE home_content ADD COLUMN title_3 VARCHAR(50) AFTER title_2");
    echo "Added title_3<br>";
} else {
    echo "title_3 exists<br>";
}

// Add title_4
if (!columnExists($conn, 'home_content', 'title_4')) {
    $conn->query("ALTER TABLE home_content ADD COLUMN title_4 VARCHAR(50) AFTER title_3");
    echo "Added title_4<br>";
} else {
    echo "title_4 exists<br>";
}

// Update values if empty
$conn->query("UPDATE home_content SET 
    title_1 = IF(title_1 IS NULL OR title_1 = '', 'Coder', title_1),
    title_2 = IF(title_2 IS NULL OR title_2 = '', 'Youtuber', title_2),
    title_3 = IF(title_3 IS NULL OR title_3 = '', 'Blogger', title_3),
    title_4 = IF(title_4 IS NULL OR title_4 = '', 'Designer', title_4),
    logo = IF(logo IS NULL OR logo = '', 'logo.png', logo)
    WHERE id = 1");

// Add github_link
if (!columnExists($conn, 'home_content', 'github_link')) {
    $conn->query("ALTER TABLE home_content ADD COLUMN github_link VARCHAR(255)");
    echo "Added github_link<br>";
}

// Add logo column
if (!columnExists($conn, 'home_content', 'logo')) {
    $conn->query("ALTER TABLE home_content ADD COLUMN logo VARCHAR(255) AFTER profile_image");
    echo "Added logo column to home_content<br>";
}

// Add logo_text column
if (!columnExists($conn, 'home_content', 'logo_text')) {
    $conn->query("ALTER TABLE home_content ADD COLUMN logo_text VARCHAR(100) AFTER logo");
    echo "Added logo_text column to home_content<br>";
}

// Add linkedin_link
if (!columnExists($conn, 'home_content', 'linkedin_link')) {
    $conn->query("ALTER TABLE home_content ADD COLUMN linkedin_link VARCHAR(255)");
    echo "Added linkedin_link<br>";
}

// Add whatsapp_link
if (!columnExists($conn, 'home_content', 'whatsapp_link')) {
    $conn->query("ALTER TABLE home_content ADD COLUMN whatsapp_link VARCHAR(255)");
    echo "Added whatsapp_link<br>";
}

// Add youtube_link
if (!columnExists($conn, 'home_content', 'youtube_link')) {
    $conn->query("ALTER TABLE home_content ADD COLUMN youtube_link VARCHAR(255)");
    echo "Added youtube_link<br>";
}

// Check experience table for 'role'
if (!columnExists($conn, 'experience', 'role')) {
    $conn->query("ALTER TABLE experience ADD COLUMN role VARCHAR(50) AFTER year");
    echo "Added role to experience<br>";
}

// Check experience table for 'company'
if (!columnExists($conn, 'experience', 'company')) {
    $conn->query("ALTER TABLE experience ADD COLUMN company VARCHAR(50) AFTER role");
    echo "Added company to experience<br>";
}

// Check education table for 'degree'
if (!columnExists($conn, 'education', 'degree')) {
    $conn->query("ALTER TABLE education ADD COLUMN degree VARCHAR(50) AFTER year");
    echo "Added degree to education<br>";
}

// Check education table for 'institution'
if (!columnExists($conn, 'education', 'institution')) {
    $conn->query("ALTER TABLE education ADD COLUMN institution VARCHAR(50) AFTER degree");
    echo "Added institution to education<br>";
}

// Check skills table columns (already done above, supposedly)

// --- FIX PROJECTS TABLE ---
// 1. Add 'image' if missing
if (!columnExists($conn, 'projects', 'image')) {
    $conn->query("ALTER TABLE projects ADD COLUMN image VARCHAR(255) AFTER description");
    echo "Added image to projects<br>";
}

// 2. Add 'category' if missing
if (!columnExists($conn, 'projects', 'category')) {
    $conn->query("ALTER TABLE projects ADD COLUMN category VARCHAR(50) AFTER title");
    echo "Added category to projects<br>";
}

// 3. Handle 'tech' -> 'technologies'
if (columnExists($conn, 'projects', 'tech') && !columnExists($conn, 'projects', 'technologies')) {
    $conn->query("ALTER TABLE projects CHANGE tech technologies VARCHAR(100)");
    echo "Renamed tech to technologies<br>";
} elseif (!columnExists($conn, 'projects', 'technologies')) {
    $conn->query("ALTER TABLE projects ADD COLUMN technologies VARCHAR(100) AFTER description");
    echo "Added technologies to projects<br>";
}

// 4. Handle 'live_url' -> 'link'
if (columnExists($conn, 'projects', 'live_url') && !columnExists($conn, 'projects', 'link')) {
    $conn->query("ALTER TABLE projects CHANGE live_url link VARCHAR(255)");
    echo "Renamed live_url to link<br>";
} elseif (!columnExists($conn, 'projects', 'link')) {
    $conn->query("ALTER TABLE projects ADD COLUMN link VARCHAR(255) AFTER image");
    echo "Added link to projects<br>";
}

// 5. Handle 'github_url' -> 'github_link'
if (columnExists($conn, 'projects', 'github_url') && !columnExists($conn, 'projects', 'github_link')) {
    $conn->query("ALTER TABLE projects CHANGE github_url github_link VARCHAR(255)");
    echo "Renamed github_url to github_link<br>";
} elseif (!columnExists($conn, 'projects', 'github_link')) {
    $conn->query("ALTER TABLE projects ADD COLUMN github_link VARCHAR(255) AFTER link");
    echo "Added github_link to projects<br>";
}

echo "Database updated successfully.";
?>
