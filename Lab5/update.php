<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

require "db.php";

$id = $_GET['id'] ?? $_POST['id'] ?? null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fname = $_POST['f_name'] ?? '';
    $lname = $_POST['l_name'] ?? '';
    $email = $_POST['email'] ?? '';
    $address = $_POST['address'] ?? '';

    $service = new Service();
    $service->updateEmployee($id, $fname, $lname, $email, $address);

    header("Location: index.php");
    exit;
} else {
    $service = new Service();
    $employee = $service->getEmployeeById($id);
    include "edit.php";
}