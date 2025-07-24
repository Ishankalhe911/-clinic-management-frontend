<!DOCTYPE html>
<html>
<head>
    <title>Assign Medicines</title>
    <style>
        body { background-color: #121212; color: white; font-family: Arial; padding: 20px; }
        h2 { color: #00ffcc; }
        form { background-color: #1e1e1e; padding: 20px; border-radius: 10px; width: 300px; }
        input, textarea { width: 100%; padding: 8px; margin-top: 8px; background: #2e2e2e; color: white; border: none; border-radius: 5px; }
        input[type="submit"] { background-color: #00ffcc; color: black; font-weight: bold; cursor: pointer; margin-top: 15px; }
    </style>
</head>
<body>
    <h2>Assign Medicines to Patient</h2>
    <center><form method="POST">
        <label>Patient ID:</label>
        <input type="text" name="patient_id" required>

        <label>Medicines:</label>
        <textarea name="medicines" rows="3" required></textarea>

        <input type="submit" name="assign" value="Assign">
    </form></center>

    <?php
    if (isset($_POST['assign'])) {
        $pid = $_POST['patient_id'];
        $meds = $_POST['medicines'];
        echo "<p style='color:#00ffcc;'>Medicines assigned to Patient ID <strong>$pid</strong>: $meds</p>";
    }
    ?>
</body>
</html>
