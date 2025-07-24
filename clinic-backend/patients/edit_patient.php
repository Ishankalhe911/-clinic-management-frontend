<?php
$host = "localhost";
$user = "root";
$password = "";
$db = "clinic";

$conn = new mysqli($host, $user, $password, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $conn->query("SELECT * FROM patients WHERE id = $id");
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Patient not found.";
        exit();
    }
} else {
    echo "No ID provided.";
    exit();
}

if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $contact = $_POST['contact'];

    $updateQuery = "UPDATE patients SET name='$name', age='$age', gender='$gender', contact='$contact' WHERE id=$id";
    if ($conn->query($updateQuery) === TRUE) {
        header("Location: view_patients.php");
        exit();
    } else {
        echo "Error updating: " . $conn->error;
    }
}
?>
    
<!DOCTYPE html>
<html>
<head>
    <title>Edit Patient</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #d0e7ff; /* Light blue */
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

        input[type="submit"] {
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

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<form method="POST">
    <h2>Edit Patient</h2>
    <label>Name:</label>
    <input type="text" name="name" value="<?= $row['name'] ?>" required>

    <label>Age:</label>
    <input type="number" name="age" value="<?= $row['age'] ?>" required>

    <label>Gender:</label>
    <select name="gender" required>
        <option value="Male" <?= $row['gender'] == 'Male' ? 'selected' : '' ?>>Male</option>
        <option value="Female" <?= $row['gender'] == 'Female' ? 'selected' : '' ?>>Female</option>
    </select>

    <label>Contact:</label>
    <input type="text" name="contact" value="<?= $row['contact'] ?>" required>

    <input type="submit" name="update" value="Update Patient">
</form>

</body>
</html>

