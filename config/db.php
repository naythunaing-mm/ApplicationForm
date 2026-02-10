<?php
$host = "localhost";
$user = "root";
$pass = "rsKTNy5h04G";
$dbname = "if0_41124887_XXX";

$port = 8888;

$conn = mysqli_connect($host, $user, $pass, $dbname);

if (!$conn) {
    $conn = mysqli_connect($host, $user, $pass, $dbname);
    
    if(!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
}
?>