<?php
if (isset($_POST['register']))
try {
    $connection = new pdo("mysql:host=localhost;dbname=PHP_Project", "root", "123");
    $result = $connection->prepare("insert into users (fname, email , password ,room_no , ext ,profile_picture) values (?, ?, ? ,? ,?,?)");
    $result->execute([$_POST['fname'], $_POST['email'], $_POST['password'], $_POST['room_no'], $_POST['ext'], $_FILES['profile_picture']['name']]);
    }
catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>