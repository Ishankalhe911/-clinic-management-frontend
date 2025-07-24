<?php
include '../includes/db_connect.php';

// Collect form data

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    die("Access Denied");
}

$patient_id = $_POST['patient_id'];
$symptoms = $_POST['symptoms'];
$history = $_POST['history'];
$date = $_POST['checkup_date'];


// File upload
$report_path = "";
if (!empty($_FILES['report']['name'])) {
    $target_dir = "uploads/";
    $file_name = time() . "_" . basename($_FILES["report"]["name"]);
    $target_file = $target_dir . $file_name;

    if (move_uploaded_file($_FILES["report"]["tmp_name"], $target_file)) {
        $report_path = $target_file;
    } else {
        echo "Error uploading file.";
        exit;
    }
}

// Insert into database
$sql = "INSERT INTO checkups (patient_id, symptoms, history, report_path, date) 
        VALUES ('$patient_id', '$symptoms', '$history', '$report_path', '$date')";

if (mysqli_query($conn, $sql)) {
    echo "<script>
            alert('Checkup Saved!');
            window.location.href='checkup_form.php';
          </script>";
} else {
    echo "Error: " . mysqli_error($conn);
}
?>
