<?php
session_start();
require "db.php";
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $username = $_POST['username'] ?? '';

    $pass = $_POST['pass'] ?? '';

    $service = new Service();

    $user = $service->authenticate($username, $pass);

    if ($user) {
        $_SESSION['user'] = $user['f_name'];
        $_SESSION['user_id'] = $user['id'];
        header("Location: index.php");
        exit;
    }
    else {
        $error = "Invalid username or password";
        include "login.php";
    }
}