<?php
session_start();
include 'config.php';

$username = $_POST['username'];
$password = $_POST['password'];

$stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows === 1){
    $user = $result->fetch_assoc();

    if(password_verify($password, $user['password'])){
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        header("Location: home.php");
        exit;
    }
}
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit;
}
echo "Logged in as: " . $_SESSION['username'];
echo "<p style='color:red;'>Invalid Username or Password</p>";
echo "<a href='login.php'>Try Again</a>";
?>