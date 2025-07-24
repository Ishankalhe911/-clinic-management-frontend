<!DOCTYPE html>
<html>
<head>
    <title>Generate Medicine Bill</title>
    <style>
        body { background-color: #121212; color: white; font-family: Arial; padding: 20px; }
        h2 { color: #00ffcc; }
        form { background-color: #1e1e1e; padding: 20px; border-radius: 10px; width: 350px; }
        input { width: 100%; padding: 8px; margin-top: 10px; background: #2e2e2e; color: white; border: none; border-radius: 5px; }
        input[type="submit"] { background-color: #00ffcc; color: black; font-weight: bold; cursor: pointer; margin-top: 15px; }
    </style>
</head>
<body>
    <h2>Generate Medicine Bill</h2>
    <form method="POST">
        <label>Patient ID:</label>
        <input type="text" name="patient_id" required>

        <label>Total Medicine Cost:</label>
        <input type="number" name="cost" required>

        <input type="submit" name="generate" value="Generate Bill">
    </form>

    <?php
    if (isset($_POST['generate'])) {
        $pid = $_POST['patient_id'];
        $cost = $_POST['cost'];
        echo "<h3 style='color:#00ffcc;'>Medicine Bill for Patient ID $pid: ₹$cost</h3>";
    }
    ?>
</body>
</html>
