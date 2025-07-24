<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "clinic_db"; // must match the DB name you imported

$conn = mysqli_connect($host, $user, $pass, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
