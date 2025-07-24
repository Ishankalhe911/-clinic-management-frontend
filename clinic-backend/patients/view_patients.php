<?php
// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "clinic";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check DB connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle search input
$searchName = "";
if (isset($_GET['name'])) {
    $searchName = strtolower(trim($_GET['name']));
    $stmt = $conn->prepare("SELECT * FROM patients WHERE LOWER(name) = ?");
    $stmt->bind_param("s", $searchName);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $sql = "SELECT * FROM patients";
    $result = $conn->query($sql);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>All Patients</title>
    <style>
        body {
            font-family: 'Orbitron', sans-serif;
            background-color:rgb(152, 215, 241);
            color: #fff;
            padding: 40px;
        }

        h2 {
            text-align: center;
            color:rgb(0, 0, 0);
            text-shadow: 0 0 5px #00ffe1;
            margin-bottom: 30px;
        }

        .search-box {
            text-align: center;
            margin-bottom: 30px;
        }

        input[type="search"] {
            padding: 10px;
            width: 250px;
            font-size: 16px;
            border-radius: 6px;
            border: 1px solid #ccc;
        }

        button {
            padding: 10px 16px;
            font-size: 16px;
            background-color: #00ffe1;
            color: #000;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            margin-left: 10px;
        }

        button:hover {
            background-color: #ff00d4;
            color: white;
        }

        table {
            width: 90%;
            margin: auto;
            border-collapse: collapse;
            background: #1a1a1a;
            box-shadow: 0 0 15px #00ffe1;
            border-radius: 12px;
            overflow: hidden;
        }

        th, td {
            padding: 15px;
            text-align: center;
            border-bottom: 1px solid #333;
            transition: background 0.3s;
        }

        th {
            background: #222;
            color: #00ffe1;
            font-size: 18px;
            border-bottom: 2px solid #00ffe1;
        }

        td {
            color: #f0f0f0;
        }

        tr:hover {
            background:rgb(219, 169, 156);
        }

        a {
            color: #00ffe1;
            text-decoration: none;
            transition: 0.3s;
        }

        a:hover {
            color: #ff00d4;
            text-shadow: 0 0 5px #ff00d4;
        }

        .no-result {
            text-align: center;
            color: red;
            margin-top: 20px;
        }
    </style>
</head>
<body>

    <h2>Patients List</h2>

    <div class="search-box">
        <form method="GET">
            <input type="search" name="name" placeholder="Search patient name" value="<?php echo htmlspecialchars($searchName); ?>">
            <button type="submit">Search</button>
        </form>
    </div>

    <?php if ($result->num_rows > 0): ?>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Age</th>
            <th>Gender</th>
            <th>Contact</th>
            <th>Actions</th>
        </tr>

        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= htmlspecialchars($row['name']) ?></td>
                <td><?= $row['age'] ?></td>
                <td><?= $row['gender'] ?></td>
                <td><?= $row['contact'] ?></td>
                <td>
                    <a href='edit_patient.php?id=<?= $row['id'] ?>'>Edit</a> |
                    <a href='delete_patient.php?id=<?= $row['id'] ?>' onclick="return confirm('Are you sure?');">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
    <?php else: ?>
        <div class="no-result">No patient found with that name.</div>
    <?php endif; ?>

</body>
</html>
