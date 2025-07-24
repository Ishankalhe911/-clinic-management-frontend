<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
  <title>Inventory List</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h2>Product Inventory</h2>
<style>/* style.css - Gaming Style with Black Header Text */

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
  color: #000; /* Changed to black */
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
  width: 400px;
  margin: 30px auto;
  padding: 20px;
  background: #0b0f1a;
  border: 2px solid #0ff;
  border-radius: 12px;
  box-shadow: 0 0 20px #0ff;
}

form h2 {
  color: #000; /* Black header text */
  text-align: center;
  text-shadow: none;
}

input[type="text"],
input[type="number"] {
  width: 100%;
  padding: 12px;
  margin: 10px 0 20px 0;
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
  <table border="1">
    <tr>
      <th>ID</th><th>Name</th><th>Quantity</th><th>Price</th><th>Actions</th>
    </tr>
    <?php
    $result = $conn->query("SELECT * FROM products");
    while($row = $result->fetch_assoc()):
    ?>
    <tr>
      <td><?= $row['id'] ?></td>
      <td><?= $row['name'] ?></td>
      <td><?= $row['quantity'] ?></td>
      <td><?= $row['price'] ?></td>
      <td>
        <a href="edit.php?id=<?= $row['id'] ?>">Edit</a> |
        <a href="delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Delete this product?')">Delete</a>
      </td>
    </tr>
    <?php endwhile; ?>
  </table>
</body>
</html>
