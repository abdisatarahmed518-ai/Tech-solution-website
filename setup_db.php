<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "portfolio_db";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database if not exists
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) === TRUE) {
    echo "Database created or already exists\n";
} else {
    echo "Error creating database: " . $conn->error . "\n";
}

// Select database
$conn->select_db($dbname);

// 1. Users Table
$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(30) NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(50),
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";
if ($conn->query($sql) === TRUE) echo "Table 'users' created successfully\n";
else echo "Error creating table 'users': " . $conn->error . "\n";

// Insert default user if not exists (admin/admin123)
$result = $conn->query("SELECT * FROM users WHERE username='admin'");
if ($result->num_rows == 0) {
    $pass = password_hash("admin123", PASSWORD_DEFAULT);
    $conn->query("INSERT INTO users (username, password, email) VALUES ('admin', '$pass', 'admin@example.com')");
    echo "Default admin user created\n";
}

// 2. Home Content Table
$sql = "CREATE TABLE IF NOT EXISTS home_content (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    greeting VARCHAR(50),
    name VARCHAR(50),
    title_1 VARCHAR(50),
    title_2 VARCHAR(50),
    title_3 VARCHAR(50),
    title_4 VARCHAR(50),
    description TEXT,
    profile_image VARCHAR(255),
    cv_file VARCHAR(255),
    github_link VARCHAR(255),
    linkedin_link VARCHAR(255),
    whatsapp_link VARCHAR(255),
    youtube_link VARCHAR(255)
)";
if ($conn->query($sql) === TRUE) echo "Table 'home_content' created successfully\n";
else echo "Error creating table 'home_content': " . $conn->error . "\n";

// Insert default home content
$result = $conn->query("SELECT * FROM home_content WHERE id=1");
if ($result->num_rows == 0) {
    $conn->query("INSERT INTO home_content (id, greeting, name, title_1, title_2, title_3, title_4, description) VALUES (1, 'Hello, It\'s Me', 'Abdisatar', 'Coder', 'Youtuber', 'Blogger', 'Designer', 'Your body sleeps, but your mind keeps thinking because...')");
    echo "Default home content inserted\n";
}

// 3. Services Table
$sql = "CREATE TABLE IF NOT EXISTS services (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    icon VARCHAR(50),
    title VARCHAR(50),
    description TEXT
)";
if ($conn->query($sql) === TRUE) echo "Table 'services' created successfully\n";
else echo "Error creating table 'services': " . $conn->error . "\n";

// 4. Experience Table
$sql = "CREATE TABLE IF NOT EXISTS experience (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    year VARCHAR(50),
    role VARCHAR(50),
    company VARCHAR(50),
    description TEXT
)";
if ($conn->query($sql) === TRUE) echo "Table 'experience' created successfully\n";
else echo "Error creating table 'experience': " . $conn->error . "\n";

// 5. Education Table
$sql = "CREATE TABLE IF NOT EXISTS education (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    year VARCHAR(50),
    degree VARCHAR(50),
    institution VARCHAR(50),
    description TEXT
)";
if ($conn->query($sql) === TRUE) echo "Table 'education' created successfully\n";
else echo "Error creating table 'education': " . $conn->error . "\n";

// 6. Skills Table
$sql = "CREATE TABLE IF NOT EXISTS skills (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    icon VARCHAR(50),
    name VARCHAR(50)
)";
if ($conn->query($sql) === TRUE) echo "Table 'skills' created successfully\n";
else echo "Error creating table 'skills': " . $conn->error . "\n";

// 7. Projects Table
$sql = "CREATE TABLE IF NOT EXISTS projects (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(50),
    category VARCHAR(50),
    description TEXT,
    technologies VARCHAR(100),
    image VARCHAR(255),
    link VARCHAR(255),
    github_link VARCHAR(255)
)";
if ($conn->query($sql) === TRUE) echo "Table 'projects' created successfully\n";
else echo "Error creating table 'projects': " . $conn->error . "\n";

// 8. Contact Info Table (for Admin to update)
$sql = "CREATE TABLE IF NOT EXISTS contact_info (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    phone VARCHAR(50),
    email VARCHAR(50),
    address VARCHAR(100),
    map_embed_code TEXT
)";
if ($conn->query($sql) === TRUE) echo "Table 'contact_info' created successfully\n";
else echo "Error creating table 'contact_info': " . $conn->error . "\n";

// 9. Messages Table (Received from Contact Form)
$sql = "CREATE TABLE IF NOT EXISTS messages (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50),
    email VARCHAR(50),
    phone VARCHAR(20),
    gender VARCHAR(10),
    subject VARCHAR(100),
    message TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
if ($conn->query($sql) === TRUE) echo "Table 'messages' created successfully\n";
else echo "Error creating table 'messages': " . $conn->error . "\n";


$conn->close();
?>
