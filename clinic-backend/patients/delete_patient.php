<?php
include '../config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $conn->query("DELETE FROM patients WHERE id=$id");
}

header("Location: view_patients.php");
exit();
