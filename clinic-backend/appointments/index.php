<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clinic Management</title>
    <style>
        /* Reset some default styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Body Styling */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f7f9fc;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        /* Container Styling */
        .container {
            background-color: #ffffff;
            padding: 30px 40px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        /* Heading */
        .container h2 {
            margin-bottom: 20px;
            color: #2c3e50;
        }

        /* Navigation List */
        ul {
            list-style-type: none;
        }

        /* List Items */
        ul li {
            margin: 15px 0;
        }

        /* Links */
        ul li a {
            text-decoration: none;
            color: #3498db;
            font-size: 18px;
            padding: 10px 20px;
            border: 2px solid #3498db;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        /* Hover Effect */
        ul li a:hover {
            background-color: #3498db;
            color: #fff;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Clinic Dashboard</h2>
        <ul>
            <li><a href="book.php">Book Appointment</a></li>
            <li><a href="Receptionist.html">Login as Receptionist</a></li>
        </ul>
    </div>
</body>

</html>