<?php
$host = "localhost";
$user = "root";
$pass = "root";
$dbname = "BeingMyanmar@2026";

$conn = mysqli_connect($host, $user, $pass, $dbname);

if (!$conn) {
    $conn = mysqli_connect($host, $user, $pass, $dbname);
    
    if(!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
}
?>