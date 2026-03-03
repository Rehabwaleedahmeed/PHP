<?php
    $line = implode("|", [
        $_POST['fname'],
        $_POST['lname'],
        $_POST['address'],
        $_POST['department'],
        $_POST['gender'],
        $_POST['username'],
        $_POST['password']
    ]) . "\n";
    file_put_contents("data.txt", $line, FILE_APPEND);
    header("Location: list.php");
?>