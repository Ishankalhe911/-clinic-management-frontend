<?php
// Connect to the database
$conn = new mysqli("localhost", "root", "", "clinic_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);
    $quantity = (int)$_POST['quantity'];
    $price = (float)$_POST['price'];

    // Basic validation
    if ($name === '' || $quantity <= 0 || $price < 0) {
        die("Invalid input data. Please check your entries.");
    }

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO products (name, quantity, price) VALUES (?, ?, ?)");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("sid", $name, $quantity, $price);

    if ($stmt->execute()) {
        // Redirect after successful insertion
        header("Location: index.php");
        exit();
    } else {
        echo "Error inserting product: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $name = $_POST['name'];
  $quantity = $_POST['quantity'];
  $price = $_POST['price'];

  $conn->query("INSERT INTO products (name, quantity, price) VALUES ('$name', $quantity, $price)");
  header("Location: index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Add Product</title>
  <!-- Link to Google Fonts for Orbitron -->
  <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500&display=swap" rel="stylesheet">
  <!-- Link to style.css -->
<style>/* style.css - Gaming UI Theme */

body {
  font-family: 'Orbitron', sans-serif;
  background-color: #d6f0ff; /* Light blue background */
  margin: 0;
  padding: 0;
  color: #fff;
}

h2 {
  text-align: center;
  margin-top: 30px;
  font-size: 32px;
  color: #000; /* Black header text */
  text-shadow: none;
}

.container {
  width: 85%;
  max-width: 1000px;
  margin: 30px auto;
  padding: 20px;
  background: #0b0f1a; /* Dark container */
  border: 2px solid #0ff;
  border-radius: 12px;
  box-shadow: 0 0 20px #0ff;
}

a {
  text-decoration: none;
  color: #0ff;
  background-color: #111;
  padding: 10px 20px;
  border-radius: 6px;
  display: inline-block;
  margin: 10px 0;
  box-shadow: 0 0 10px #0ff;
  transition: 0.3s ease;
}

a:hover {
  background-color: #0ff;
  color: #000;
  box-shadow: 0 0 20px #0ff;
}

table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 20px;
  background-color: #111;
  color: #0ff;
}

table, th, td {
  border: 1px solid #0ff;
}

th {
  background-color: #0d1117;
  padding: 12px;
  font-size: 16px;
  text-transform: uppercase;
}

td {
  text-align: center;
  padding: 10px;
  font-size: 14px;
}

form {
  width: 100%;
  max-width: 400px;
  margin: 0 auto;
  padding: 20px;
  background: #0b0f1a;
  border: 2px solid #0ff;
  border-radius: 12px;
  box-shadow: 0 0 20px #0ff;
}

form label {
  color: #0ff;
  display: block;
  margin-bottom: 6px;
  font-weight: bold;
}

input[type="text"],
input[type="number"] {
  width: 100%;
  padding: 12px;
  margin-bottom: 20px;
  border: 2px solid #0ff;
  background-color: #111;
  color: #0ff;
  border-radius: 6px;
  box-shadow: inset 0 0 5px #0ff;
}

button {
  width: 100%;
  padding: 12px;
  background-color: #0ff;
  color: #000;
  font-weight: bold;
  border: none;
  border-radius: 6px;
  cursor: pointer;
  box-shadow: 0 0 15px #0ff;
  transition: 0.3s ease;
}

button:hover {
  background-color: #00e6e6;
  box-shadow: 0 0 30px #00e6e6;
}

.action-links a {
  margin: 0 6px;
  font-size: 14px;
  padding: 6px 12px;
  background-color: #111;
  color: #0ff;
  box-shadow: 0 0 10px #0ff;
}

.action-links a:hover {
  background-color: #0ff;
  color: #000;
}
</style>
</head>
<body>

  <h2>Add New Product</h2>
  
  <div class="container">
    <form method="post">
      <label for="name">Product Name:</label><br>
      <input type="text" id="name" name="name" required><br>

      <label for="quantity">Quantity:</label><br>
      <input type="number" id="quantity" name="quantity" required><br>

      <label for="price">Price (₹):</label><br>
      <input type="number" id="price" name="price" step="0.01" required><br>

      <button type="submit">Add Product</button>
    </form>

    <div style="text-align: center; margin-top: 20px;">
      <a href="index.php">← Back to Inventory</a>
    </div>
  </div>

</body>
</html>
