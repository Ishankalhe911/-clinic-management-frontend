<?php
include '../includes/db_connect.php';

if (!isset($_GET['checkup_id'])) {
    die("Missing checkup ID");
}

$checkup_id = $_GET['checkup_id'];

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $medicine_id = $_POST['medicine_id'];
    $dosage = $_POST['dosage'];
    $duration = $_POST['duration'];

    $stmt = $conn->prepare("INSERT INTO prescriptions (checkup_id, medicine_id, dosage, duration) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iiss", $checkup_id, $medicine_id, $dosage, $duration);
    $stmt->execute();
    $stmt->close();
}

// Fetch existing prescriptions
$query = "SELECT p.id, m.name AS medicine_name, p.dosage, p.duration
          FROM prescriptions p
          JOIN medicines m ON p.medicine_id = m.id
          WHERE p.checkup_id = $checkup_id";
$prescriptions = mysqli_query($conn, $query);

// Fetch medicines for dropdown
$medicines = mysqli_query($conn, "SELECT id, name FROM medicines");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Prescriptions</title>
</head>
<body>
    <h2>Prescriptions for Checkup ID #<?= $checkup_id ?></h2>

    <form method="POST">
        <select name="medicine_id" required>
            <option value="">-- Select Medicine --</option>
            <?php while ($row = mysqli_fetch_assoc($medicines)) { ?>
                <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
            <?php } ?>
        </select>

        <input type="text" name="dosage" placeholder="Dosage (e.g., 500mg)" required>
        <input type="text" name="duration" placeholder="Duration (e.g., 5 days)" required>
        <button type="submit">Add Prescription</button>
    </form>

    <h3>Prescribed Medicines</h3>
    <table border="1" cellpadding="8">
        <tr>
            <th>ID</th>
            <th>Medicine Name</th>
            <th>Dosage</th>
            <th>Duration</th>
        </tr>

        <?php while ($row = mysqli_fetch_assoc($prescriptions)) { ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['medicine_name'] ?></td>
                <td><?= $row['dosage'] ?></td>
                <td><?= $row['duration'] ?></td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>
