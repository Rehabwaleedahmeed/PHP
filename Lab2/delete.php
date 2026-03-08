<?php
$id = $_GET["id"];
$data = file("data.txt");

if(isset($data[$id]))
    {
    unset($data[$id]);
    file_put_contents("data.txt", implode("", $data));
    }

header("Location: list.php");
?>