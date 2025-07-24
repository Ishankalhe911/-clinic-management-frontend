<?php
// Connect to database
$conn = new mysqli("localhost", "root", "", "clinic_db");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the ID from the URL
$id = $_GET["id"] ?? null;
if (!$id) {
    die("❌ Medicine ID not provided.");
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input
    $name = $conn->real_escape_string($_POST["name"]);
    $quantity = (int) $_POST["quantity"];
    $price = (float) $_POST["price"];

    $update_sql = "UPDATE medicines SET 
                    name='$name', 
                    quantity='$quantity', 
                    price='$price' 
                  WHERE id=$id";

    if ($conn->query($update_sql) === TRUE) {
        echo "✅ Medicine updated successfully.";
        echo '<br><a href="view_medicines.php">← Back to List</a>';
        exit;
    } else {
        echo "❌ Update failed: " . $conn->error;
    }
}

// Load existing medicine data
$sql = "SELECT * FROM medicines WHERE id = $id";
$result = $conn->query($sql);
if ($result->num_rows != 1) {
    die("❌ Medicine not found.");
}

$medicine = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Medicine</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #d0e7ff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        form {
            background: white;
            padding: 30px 40px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            width: 350px;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 25px;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: bold;
            color: #333;
        }

        input[type="text"],
        input[type="number"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            outline: none;
            transition: 0.3s ease;
        }

        input[type="text"]:focus,
        input[type="number"]:focus,
        select:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0,123,255,0.4);
        }

        button[type="submit"] {
            width: 100%;
            background-color: #007bff;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <form method="POST">
        <h2>Edit Medicine</h2>

        <label>Name:</label>
        <input type="text" name="name" value="<?= htmlspecialchars($medicine['name']) ?>" required>

        <label>Quantity:</label>
        <input type="number" name="quantity" value="<?= htmlspecialchars($medicine['quantity']) ?>" required>

        <label>Price (₹):</label>
        <input type="number" step="0.01" name="price" value="<?= htmlspecialchars($medicine['price']) ?>" required>

        <button type="submit">Update Medicine</button>
    </form>
</body>
</html>
