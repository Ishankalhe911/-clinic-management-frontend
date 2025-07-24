<?php
include 'datafunction.php';

// Sanitize and validate the ID
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
    $delete = mysqli_query($conn, "DELETE FROM appointments WHERE id = $id");

    if ($delete) {
        header("Location: view.php?msg=deleted");
    } else {
        echo "Failed to delete appointment. Please try again.";
    }
} else {
    echo "Invalid appointment ID.";
}
exit;
?>
