<?php
/**
 * Migration & Seeder for Being Myanmar Portal
 * This script creates the database, tables, and a default admin user.
 */

// Lightsail/Server Database Configuration
$host = "localhost";
$user = "root";
$pass = "rsKTNy5h04G";
$dbname = "if0_41124887_XXX";

$conn = mysqli_connect($host, $user, $pass);

if (!$conn) {
    die("<div style='color:red;'>Connection failed: " . mysqli_connect_error() . "</div>");
}

$sql_db = "CREATE DATABASE IF NOT EXISTS $dbname CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci";
if (mysqli_query($conn, $sql_db)) {
    echo "✔ Database '$dbname' is ready.<br>";
} else {
    die("Error creating database: " . mysqli_error($conn));
}

mysqli_select_db($conn, $dbname);

$sql_applicants = "CREATE TABLE IF NOT EXISTS applicants (
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
) ENGINE=InnoDB";

if (mysqli_query($conn, $sql_applicants)) {
    echo "✔ Table 'applicants' created successfully.<br>";
}

$sql_admin = "CREATE TABLE IF NOT EXISTS admin_users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB";

if (mysqli_query($conn, $sql_admin)) {
    echo "✔ Table 'admin_users' created successfully.<br>";
    
    $username = 'admin';
    $password = 'admin123';
    
    $checkAdmin = mysqli_query($conn, "SELECT * FROM admin_users WHERE username='$username'");
    
    if (mysqli_num_rows($checkAdmin) == 0) {
        $hashed_pass = password_hash($password, PASSWORD_DEFAULT);
        $insert_admin = "INSERT INTO admin_users (username, password) VALUES ('$username', '$hashed_pass')";
        
        if (mysqli_query($conn, $insert_admin)) {
            echo "✔ <strong>Admin Account Seeded:</strong><br>";
            echo "--- Username: <span style='color:blue;'>$username</span><br>";
            echo "--- Password: <span style='color:blue;'>$password</span> (hashed in DB)<br>";
        }
    } else {
        echo "ℹ Admin account already exists. Skipping seeder.<br>";
    }
}

mysqli_close($conn);
echo "<br><div style='padding:10px; background:#d4edda; color:#155724; border:1px solid #c3e6cb;'><strong>Migration Completed Successfully!</strong></div>";
?>