<?php
include 'datafunction.php';
header('Content-Type: application/json');

// Allow only POST requests
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $passwords = $_POST['passwords'] ?? '';

    // Prevent SQL Injection using prepared statements
    $stmt = $conn->prepare("SELECT * FROM Receptionist WHERE username=? AND passwords=?");
    $stmt->bind_param("ss", $username, $passwords);
    $stmt->execute();
    $resultLogin = $stmt->get_result();

    // If receptionist exists
    if ($resultLogin->num_rows > 0) {
        $appointments = [];
        $result = mysqli_query($conn, "SELECT * FROM appointments");

        while ($row = mysqli_fetch_assoc($result)) {
            $appointments[] = $row;
        }

        echo json_encode([
            "status" => "success",
            "data" => $appointments
        ]);
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "Invalid username or password"
        ]);
    }
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Only POST method allowed"
    ]);
}
