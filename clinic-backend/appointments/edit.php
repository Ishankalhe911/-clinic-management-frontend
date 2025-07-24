<?php
include 'datafunction.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id <= 0) {
    die("Invalid appointment ID.");
}

// Fetch appointment data
$result = mysqli_query($conn, "SELECT * FROM appointments WHERE id = $id");
if (!$result || mysqli_num_rows($result) == 0) {
    die("Appointment not found.");
}
$row = mysqli_fetch_assoc($result);

// Handle update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = mysqli_real_escape_string($conn, $_POST['patient_name']);
    $date = $_POST['date'];
    $time = $_POST['time'];
    $doctor = mysqli_real_escape_string($conn, $_POST['doctor']);

    $update = "UPDATE appointments SET 
        patient_name = '$name',
        date_a = '$date',
        time_a = '$time',
        doctor = '$doctor'
        WHERE id = $id";

    if (mysqli_query($conn, $update)) {
        header("Location: view.php");
        exit;
    } else {
        echo "Error updating appointment.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Appointment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background: linear-gradient(to right, #cfd9df, #e2ebf0);">

<div class="container mt-5">
    <div class="card shadow-lg rounded-4">
        <div class="card-header bg-info text-white text-center fs-4">Edit Appointment</div>
        <div class="card-body">
            <form method="POST">
                <div class="mb-3">
                    <label>Patient Name</label>
                    <input type="text" name="patient_name" class="form-control" value="<?= htmlspecialchars($row['patient_name']) ?>" required>
                </div>
                <div class="mb-3">
                    <label>Date</label>
                    <input type="date" name="date" class="form-control" value="<?= $row['date_a'] ?>" required>
                </div>
                <div class="mb-3">
                    <label>Time</label>
                    <input type="time" name="time" class="form-control" value="<?= $row['time_a'] ?>" required>
                </div>
                <div class="mb-3">
                    <label>Doctor</label>
                    <input type="text" name="doctor" class="form-control" value="<?= htmlspecialchars($row['doctor']) ?>" required>
                </div>
                <button type="submit" class="btn btn-primary">Update Appointment</button>
                <a href="view.php" class="btn btn-secondary">Cancel</a>
            <
                /form>
        </div>
    </div>
</div>

</body>
</html>
