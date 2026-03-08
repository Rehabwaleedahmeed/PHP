<?php
    $data = $_POST;

    $line = implode(",", $data) . "\n";

    file_put_contents("data.txt", $line, FILE_APPEND);

    header("Location: list.php");
?>