<?php include 'db.php'; ?>

<?php
$id = $_GET['id'];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $name = $_POST['name'];
  $quantity = $_POST['quantity'];
  $price = $_POST['price'];

  $conn->query("UPDATE products SET name='$name', quantity=$quantity, price=$price WHERE id=$id");
  header("Location: index.php");
}

$product = $conn->query("SELECT * FROM products WHERE id=$id")->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit Product</title>
  <!-- Link Orbitron Font and CSS -->
  <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500&display=swap" rel="stylesheet">
 <style>
    /* style.css - Gaming UI Theme with Light Blue Background */

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

  <h2>Edit Product</h2>

  <div class="container">
    <form method="post">
      <label for="name">Product Name:</label>
      <input type="text" id="name" name="name" value="<?= $product['name'] ?>" required>

      <label for="quantity">Quantity:</label>
      <input type="number" id="quantity" name="quantity" value="<?= $product['quantity'] ?>" required>

      <label for="price">Price (₹):</label>
      <input type="number" id="price" name="price" value="<?= $product['price'] ?>" step="0.01" required>

      <button type="submit">Update Product</button>
    </form>

    <div style="text-align: center; margin-top: 20px;">
      <a href="index.php">← Back to Inventory</a>
    </div>
  </div>

</body>
</html>
