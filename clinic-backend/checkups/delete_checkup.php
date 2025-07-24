<?php
include '../includes/db_connect.php';

if (!isset($_GET['id'])) {
    die("Invalid ID.");
}

$id = $_GET['id'];

// Optionally: delete uploaded report file (if exists)
$query = "SELECT report_path FROM checkups WHERE id = $id";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

if ($row && !empty($row['report_path']) && file_exists($row['report_path'])) {
    unlink($row['report_path']); // delete the file
}

// Now delete the DB record
$delete_sql = "DELETE FROM checkups WHERE id = $id";

if (mysqli_query($conn, $delete_sql)) {
    echo "<script>
            alert('Checkup Deleted!');
            window.location.href='view_checkups.php';
          </script>";
} else {
    echo "Error deleting: " . mysqli_error($conn);
}
?>
