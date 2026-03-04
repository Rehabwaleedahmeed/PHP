<?php
$host = "localhost";
$username = "phpuser";
$password = "phpuser123";
$database = "lab3_db";
$conn = new mysqli($host, $username, $password);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "CREATE DATABASE IF NOT EXISTS $database";
if ($conn->query($sql) === TRUE) {
} else {
    die("Error creating database: " . $conn->error);
}
$conn->select_db($database);
$table_sql = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fname VARCHAR(50) NOT NULL,
    lname VARCHAR(50) NOT NULL,
    address VARCHAR(255) NOT NULL,
    country VARCHAR(50) NOT NULL,
    gender VARCHAR(10) NOT NULL,
    skills VARCHAR(255) NOT NULL,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    department VARCHAR(50) NOT NULL,
    profile_pic VARCHAR(255) NOT NULL
)";
if ($conn->query($table_sql) === TRUE) {
} else {
    die("Error creating table: " . $conn->error);
}
$check_column = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME='users' AND COLUMN_NAME='profile_pic' AND TABLE_SCHEMA='$database'";
$result = $conn->query($check_column);
if ($result->num_rows === 0) {
    $alter_table = "ALTER TABLE users ADD COLUMN profile_pic VARCHAR(255) DEFAULT '' NOT NULL";
    $conn->query($alter_table);
}
?>
