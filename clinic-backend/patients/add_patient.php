
<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "clinic"; // Replace with your database name

$conn = new mysqli($servername, $username, $password, $database);

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $age = $_POST["age"];
    $gender = $_POST["gender"];
    $contact = $_POST["contact"];

    $sql = "INSERT INTO patients (name, age, gender, contact) VALUES ('$name', '$age', '$gender', '$contact')";

    if ($conn->query($sql) === TRUE) {
        $msg = "Patient added successfully!";
    } else {
        $msg = "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Patient</title>
    <style>
        body {
            background-color: #d0ebff;
            font-family: Arial, sans-serif;
        }

        .form-container {
            background-color: white;
            width: 400px;
            padding: 30px;
            margin: 100px auto;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.2);
        }

        .form-container h2 {
            text-align: center;
            color: #0077b6;
        }

        label {
            display: block;
            margin-top: 15px;
        }

        input[type="text"], input[type="number"], select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="submit"] {
            margin-top: 20px;
            width: 100%;
            background-color: #0077b6;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .message {
            text-align: center;
            color: green;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Add New Patient</h2>
        <?php if (!empty($msg)) echo "<p class='message'>$msg</p>"; ?>
        <form method="POST">
            <label>Name:</label>
            <input type="text" name="name" required>

            <label>Age:</label>
            <input type="number" name="age" required>

            <label>Gender:</label>
            <select name="gender" required>
                <option value="">-- Select --</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>

            <label>Contact:</label>
            <input type="text" name="contact" required>

            <input type="submit" value="Add Patient">
        </form>
    </div>
</body>
</html>
