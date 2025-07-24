<?php
include '../includes/db_connect.php';

// Fetch patients for dropdown
$result = mysqli_query($conn, "SELECT id, name FROM patients");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Checkup Form</title>
</head>
<body>

<h2>Checkup Form</h2>

<form action="save_checkup.php" method="POST" enctype="multipart/form-data">
    <label>Patient:</label>
    <select name="patient_id" required>
        <option value="">-- Select Patient --</option>
        <?php while($row = mysqli_fetch_assoc($result)) {
            echo "<option value='{$row['id']}'>{$row['name']}</option>";
        } ?>
    </select><br><br>
    <label>Checkup Date and Time:</label><br>
<input type="datetime-local" name="checkup_date" required><br><br>


    <label>Symptoms:</label><br>
    <textarea name="symptoms" required></textarea><br><br>

    <label>Medical History:</label><br>
    <textarea name="history" required></textarea><br><br>

    <label>Upload Report:</label>
    <input type="file" name="report"><br><br>

    <input type="submit" value="Save Checkup">
</form>

</body>
</html>
