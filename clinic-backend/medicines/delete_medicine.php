<?php
// Connect to database
$conn = new mysqli("localhost", "root", "", "clinic_db");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get medicine ID from URL
$id = $_GET['id'] ?? null;

if (!$id) {
    die("❌ No medicine ID provided.");
}

// Delete medicine
$sql = "DELETE FROM medicines WHERE id = $id";

if ($conn->query($sql) === TRUE) {
    // Redirect back to view page
    header("Location: view_medicines.php");
    exit;
} else {
    echo "❌ Error deleting record: " . $conn->error;
}
?>
