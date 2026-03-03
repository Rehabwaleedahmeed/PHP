<?php
$id = $_GET["id"];
$data = file("data.txt");

if (isset($data[$id])) {
    $row = explode("|", trim($data[$id]));
} else {
    header("Location: list.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>User Details</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; background-color: #eef2f3; }
        .container { width: 400px; margin: auto; padding: 20px; background-color: #fff;
            border-radius: 6px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        ul { list-style: none; padding: 0; }
        ul li { padding: 6px 0; border-bottom: 1px solid #eee; }
        ul li strong { display: inline-block; width: 110px; }
        a { display: inline-block; margin-top: 15px; color: #333; }
    </style>
</head>
<body>
<div class="container">
    <h2>User Details</h2>
    <ul>
        <li><strong>First Name:</strong> <?= $row[0] ?></li>
        <li><strong>Last Name:</strong> <?= $row[1] ?></li>
        <li><strong>Address:</strong> <?= $row[2] ?></li>
        <li><strong>Department:</strong> <?= $row[3] ?></li>
        <li><strong>Gender:</strong> <?= $row[4] ?></li>
        <li><strong>Username:</strong> <?= $row[5] ?></li>
        <li><strong>Password:</strong> <?= $row[6] ?></li>
    </ul>
    <a href="list.php">&larr; Back to List</a>
</div>
</body>
</html>