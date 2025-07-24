<?php
// Connect to database
$conn = new mysqli("localhost", "root", "", "clinic_db");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch medicines
$sql = "SELECT * FROM medicines ORDER BY id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Medicines</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            padding: 40px;
            color: #333;
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #2c3e50;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
        }

        th, td {
            padding: 12px 15px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #3498db;
            color: white;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        a {
            text-decoration: none;
            color: #3498db;
            font-weight: bold;
        }

        a:hover {
            color: #21618c;
        }

        p {
            text-align: center;
            font-size: 18px;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<h2>Medicine Inventory</h2>

<?php if ($result->num_rows > 0): ?>
<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Quantity</th>
        <th>Price (₹)</th>
        <th>Created At</th>
        <th>Actions</th>
    </tr>
    <?php while($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?= htmlspecialchars($row["id"]) ?></td>
        <td><?= htmlspecialchars($row["name"]) ?></td>
        <td><?= htmlspecialchars($row["quantity"]) ?></td>
        <td><?= htmlspecialchars($row["price"]) ?></td>
        <td><?= htmlspecialchars($row["created_at"]) ?></td>
        <td>
            <a href="edit_medicine.php?id=<?= $row["id"] ?>">Edit</a> |
            <a href="delete_medicine.php?id=<?= $row["id"] ?>" onclick="return confirm('Are you sure you want to delete this medicine?');">Delete</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

<?php else: ?>
    <p>No medicines found.</p>
<?php endif; ?>

</body>
</html>
