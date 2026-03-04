<?php
include 'config.php';

$id = isset($_GET["id"]) ? intval($_GET["id"]) : 0;

$sql = "SELECT * FROM users WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    die("User not found!");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>User Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background-color: #eef2f3;
        }
        .container {
            width: 500px;
            margin: auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 6px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        ul {
            list-style: none;
            padding: 0;
        }
        li {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }
        li strong {
            color: #333;
        }
        a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }
        a:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>User Details</h2>

    <ul>
        <li><strong>First Name:</strong> <?= htmlspecialchars($row['fname']) ?></li>
        <li><strong>Last Name:</strong> <?= htmlspecialchars($row['lname']) ?></li>
        <li><strong>Address:</strong> <?= htmlspecialchars($row['address']) ?></li>
        <li><strong>Country:</strong> <?= htmlspecialchars($row['country']) ?></li>
        <li><strong>Gender:</strong> <?= htmlspecialchars($row['gender']) ?></li>
        <li><strong>Skills:</strong> <?= htmlspecialchars($row['skills']) ?></li>
        <li><strong>Username:</strong> <?= htmlspecialchars($row['username']) ?></li>
        <li><strong>Password:</strong> <?= htmlspecialchars($row['password']) ?></li>
        <li><strong>Department:</strong> <?= htmlspecialchars($row['department']) ?></li>
    </ul>

    <a href="list.php">Back to List</a>
</div>
</body>
</html>

<?php
$conn->close();
?>