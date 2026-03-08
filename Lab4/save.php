<?php
include 'config.php';
$errors = [];
$data = [
    'fname' => $_POST['fname'] ?? '',
    'lname' => $_POST['lname'] ?? '',
    'address' => $_POST['address'] ?? '',
    'country' => $_POST['country'] ?? '',
    'gender' => $_POST['gender'] ?? '',
    'skills' => $_POST['skills'] ?? [],
    'username' => $_POST['username'] ?? '',
    'password' => $_POST['password'] ?? '',
    'department' => $_POST['department'] ?? 'OpenSource'
];
if (!isset($_FILES['profile_pic']) || $_FILES['profile_pic']['error'] !== 0) {
    $errors[] = "Profile picture is required.";
} else {
    $allowed_types = ['image/jpeg', 'image/png'];
    $max_size = 2 * 1024 * 1024; // 2 MB

    $file_type = $_FILES['profile_pic']['type'];
    $file_size = $_FILES['profile_pic']['size'];
    $file_tmp = $_FILES['profile_pic']['tmp_name'];

    if (!in_array($file_type, $allowed_types)) {
        $errors[] = "Only JPG and PNG images are allowed.";
    }

    if ($file_size > $max_size) {
        $errors[] = "File size must not exceed 2MB.";
    }
}

if (!empty($errors)) {
    foreach ($errors as $err) {
        echo "<p style='color:red;'>$err</p>";
    }
    echo "<p><a href='register.php'>Go back</a></p>";
    exit;
}

$ext = pathinfo($_FILES['profile_pic']['name'], PATHINFO_EXTENSION);
$target_dir = "uploads/";
if (!is_dir($target_dir)) mkdir($target_dir, 0777, true); 
$filename = uniqid() . "." . $ext;
$target_file = $target_dir . $filename;

if (!move_uploaded_file($file_tmp, $target_file)) {
    die("Failed to upload profile picture.");
}

$skills_str = implode(",", $data['skills']);
$password_hashed = password_hash($data['password'], PASSWORD_DEFAULT);

$stmt = $conn->prepare("INSERT INTO users (fname, lname, address, country, gender, skills, username, password, department, profile_pic) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param(
    "ssssssssss",
    $data['fname'],
    $data['lname'],
    $data['address'],
    $data['country'],
    $data['gender'],
    $skills_str,
    $data['username'],
    $password_hashed,
    $data['department'],
    $target_file
);

try {
    if ($stmt->execute()) {
        header("Location: list.php");
        exit;
    } else {
        $error_msg = $stmt->error;
        if (strpos($error_msg, 'Duplicate entry') !== false) {
            $error_msg = "Username already exists. Please choose a different username.";
        }
        echo "<p style='color:red;'>Error: " . $error_msg . "</p>";
        echo "<p><a href='register.php'>Go back and try again</a></p>";
    }
} catch (mysqli_sql_exception $e) {
    $error_msg = $e->getMessage();
    if (strpos($error_msg, 'Duplicate entry') !== false) {
        $error_msg = "Username already exists. Please choose a different username.";
    }
    echo "<p style='color:red;'>Error: " . $error_msg . "</p>";
    echo "<p><a href='register.php'>Go back and try again</a></p>";
}

$stmt->close();
$conn->close();
?>

