<?php
$id = $_GET["id"];
$data = file("data.txt");

if(isset($data[$id])){
    $row = explode(",", trim($data[$id]));
}
?>

<h2>User Details</h2>

<ul>
    <li>First Name: <?= $row[0] ?></li>
    <li>Last Name: <?= $row[1] ?></li>
    <li>Address: <?= $row[2] ?></li>
    <li>Country: <?= $row[3] ?></li>
    <li>Gender: <?= $row[4] ?></li>
    <li>Username: <?= $row[6] ?></li>
    <li>Password: <?= $row[7] ?></li>
    <li>Department: <?= $row[8] ?></li>
</ul>

<a href="list.php">Back</a>