<?php
include 'datafunction.php';
header('Content-Type: application/json');

// Only allow POST requests
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['patient_name'] ?? '';
    $date = $_POST['date'] ?? '';
    $time = $_POST['time'] ?? '';
    $doctor = $_POST['doctor'] ?? '';

    // Check for empty fields
    if ($name && $date && $time && $doctor) {
        // Use prepared statement for safety
        $stmt = $conn->prepare("INSERT INTO appointments (patient_name, date_a, time_a, doctor) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $date, $time, $doctor);

        if ($stmt->execute()) {
            echo json_encode([
                "status" => "success",
                "message" => "Appointment booked successfully"
            ]);
        } else {
            echo json_encode([
                "status" => "error",
                "message" => "Failed to book appointment"
            ]);
        }
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "All fields are required"
        ]);
    }
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Only POST method allowed"
    ]);
}
