<?php
$host = "localhost";
$user = "root";
$pass = "root"; // MAMP အတွက် password ကို 'root' လို့ ပြောင်းပေးရပါမယ်
$dbname = "being_myanmar_db";

$conn = mysqli_connect($host, $user, $pass);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$dbName = "being_myanmar_db";
$sql_db = "CREATE DATABASE IF NOT EXISTS $dbName";
if (mysqli_query($conn, $sql_db)) {
    echo "Database '$dbName' ready...<br>";
}

mysqli_select_db($conn, $dbName);

$sql_table = "CREATE TABLE IF NOT EXISTS applicants (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(255) NOT NULL,
    dob DATE,
    nrc VARCHAR(100),
    address TEXT,
    gender ENUM('Male', 'Female', 'Other'),
    religion VARCHAR(100),
    race VARCHAR(100),
    phone VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    position VARCHAR(150) NOT NULL,
    expected_salary VARCHAR(100),
    education_background TEXT,
    work_experience TEXT,
    foreign_languages TEXT,
    technical_skills TEXT,
    resume_path VARCHAR(255),
    applied_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if (mysqli_query($conn, $sql_table)) {
    echo "Table 'applicants' created successfully!<br>";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}

mysqli_close($conn);
?>