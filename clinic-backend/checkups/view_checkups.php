<?php
include '../includes/db_connect.php';

$result = mysqli_query($conn, "SELECT * FROM checkups ORDER BY date DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Checkups</title>
    <style>
        table { width: 90%; margin: auto; border-collapse: collapse; }
        th, td { padding: 10px; border: 1px solid #ccc; text-align: left; }
        th { background-color: #f2f2f2; }
        a.button {
            padding: 6px 12px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }
        a.button:hover { background-color: #0056b3; }
    </style>
</head>
<body>

<h2 style="text-align:center;">All Checkups</h2>
<table>
    <tr>
        <th>ID</th>
        <th>Patient ID</th>
        <th>Symptoms</th>
        <th>History</th>
        <th>Date</th>
        <th>Actions</th>
    </tr>

    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['patient_id'] ?></td>
            <td><?= htmlspecialchars($row['symptoms']) ?></td>
            <td><?= htmlspecialchars($row['history']) ?></td>
            <td><?= $row['date'] ?></td>
           <td>
    <a href="edit_checkup.php?id=<?= $row['id'] ?>" class="button">Edit</a>
    <a href="delete_checkup.php?id=<?= $row['id'] ?>" class="button" onclick="return confirm('Delete this checkup?');">Delete</a>
    <a href="prescriptions.php?checkup_id=<?= $row['id'] ?>" class="button" style="background-color:#28a745;">Prescriptions</a>
    <a href="billing.php?checkup_id=<?= $row['id'] ?>" class="button" style="background-color:#ffc107; color:black;">Billing</a>
</td>

        </tr>
    <?php } ?>
</table>

</body>
</html>
