<?php
include '../includes/db_connect.php';

if (!isset($_GET['id'])) {
    die("Invalid ID.");
}

$id = $_GET['id'];

// Step 1: Fetch current checkup data
$query = "SELECT * FROM checkups WHERE id = $id";
$result = mysqli_query($conn, $query);
$checkup = mysqli_fetch_assoc($result);

if (!$checkup) {
    die("Checkup not found.");
}

// Step 2: Handle update after form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $symptoms = $_POST['symptoms'];
    $history = $_POST['history'];
    $date = $_POST['date'];

    $report_path = $checkup['report_path']; // default to old file

    // If a new file was uploaded
    if (!empty($_FILES['report']['name'])) {
        $target_dir = "uploads/";
        $file_name = time() . "_" . basename($_FILES["report"]["name"]);
        $target_file = $target_dir . $file_name;

        if (move_uploaded_file($_FILES["report"]["tmp_name"], $target_file)) {
            $report_path = $target_file;
        }
    }

    $update_sql = "UPDATE checkups SET 
                    symptoms = '$symptoms', 
                    history = '$history', 
                    report_path = '$report_path',
                    date = '$date'
                  WHERE id = $id";

    if (mysqli_query($conn, $update_sql)) {
        echo "<script>
                alert('Checkup Updated!');
                window.location.href='view_checkups.php';
              </script>";
        exit;
    } else {
        echo "Error updating: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Checkup</title>
</head>
<body>
    <h2>Edit Checkup - ID #<?= $id ?></h2>
    <form action="" method="POST" enctype="multipart/form-data">
        <label>Symptoms:</label><br>
        <textarea name="symptoms" required><?= htmlspecialchars($checkup['symptoms']) ?></textarea><br><br>

        <label>History:</label><br>
        <textarea name="history"><?= htmlspecialchars($checkup['history']) ?></textarea><br><br>

        <label>Checkup Date:</label><br>
        <input type="datetime-local" name="date" value="<?= date('Y-m-d\TH:i', strtotime($checkup['date'])) ?>" required><br><br>

        <label>Upload Report (optional):</label><br>
        <input type="file" name="report"><br>
        <?php if ($checkup['report_path']) echo "<small>Current: {$checkup['report_path']}</small>"; ?><br><br>

        <button type="submit">Update Checkup</button>
    </form>
</body>
</html>
