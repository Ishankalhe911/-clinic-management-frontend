<?php
// Show PHP errors
ini_set('display_errors', 1);
error_reporting(E_ALL);

// DB connection
include '../includes/db_connect.php';

if (!isset($_GET['checkup_id'])) {
    die("Missing checkup ID.");
}

$checkup_id = $_GET['checkup_id'];

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $total = $_POST['total_amount'];
    $status = $_POST['payment_status'];

    // Check if billing already exists for this checkup
    $existing = mysqli_query($conn, "SELECT id FROM billing WHERE checkup_id = $checkup_id");

    if (mysqli_num_rows($existing) > 0) {
        // Update existing billing
        $sql = "UPDATE billing SET total_amount = '$total', payment_status = '$status' WHERE checkup_id = $checkup_id";
    } else {
        // Insert new billing
        $sql = "INSERT INTO billing (checkup_id, total_amount, payment_status)
                VALUES ('$checkup_id', '$total', '$status')";
    }

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Billing saved.'); window.location.href='billing.php?checkup_id=$checkup_id';</script>";
        exit;
    } else {
        echo "Error saving billing: " . mysqli_error($conn);
    }
}

// Load existing billing data (if any)
$billing = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM billing WHERE checkup_id = $checkup_id"));
?>

<!DOCTYPE html>
<html>
<head>
    <title>Billing</title>
</head>
<body>
    <h2>Billing for Checkup ID #<?= $checkup_id ?></h2>

    <form method="POST">
        <label>Total Amount:</label><br>
        <input type="number" step="0.01" name="total_amount" value="<?= $billing['total_amount'] ?? '' ?>" required><br><br>

        <label>Payment Status:</label><br>
        <select name="payment_status" required>
            <option value="Pending" <?= ($billing['payment_status'] ?? '') === 'Pending' ? 'selected' : '' ?>>Pending</option>
            <option value="Paid" <?= ($billing['payment_status'] ?? '') === 'Paid' ? 'selected' : '' ?>>Paid</option>
        </select><br><br>

        <button type="submit">Save Billing</button>
    </form>
</body>
</html>
