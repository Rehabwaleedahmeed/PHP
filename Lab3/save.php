<?php
    include 'config.php';

    $fname = $conn->real_escape_string($_POST['fname']);
    $lname = $conn->real_escape_string($_POST['lname']);
    $address = $conn->real_escape_string($_POST['address']);
    $country = $conn->real_escape_string($_POST['country']);
    $gender = $conn->real_escape_string($_POST['gender']);
    $skills = $conn->real_escape_string(implode(", ", $_POST['skills']));
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);
    $department = $conn->real_escape_string($_POST['department']);

    $sql = "INSERT INTO users (fname, lname, address, country, gender, skills, username, password, department) 
            VALUES ('$fname', '$lname', '$address', '$country', '$gender', '$skills', '$username', '$password', '$department')";

    if ($conn->query($sql) === TRUE) {
        header("Location: list.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
?>