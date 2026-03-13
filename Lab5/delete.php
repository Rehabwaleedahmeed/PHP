<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}
require "db.php";
$id = $_GET['id'] ?? null;
if ($id) {
    $service = new Service();
    $service->deleteEmployee($id);
}
header("Location: index.php");
exit;