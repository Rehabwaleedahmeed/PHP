<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $address = $_POST['address'];
    $country = $_POST['country'];
    $gender = $_POST['gender'];
    $username = $_POST['username'];
    $department = $_POST['department'];
    $skills = "";
    if(isset($_POST['skills'])){
        $skills = implode(", ", $_POST['skills']);
    }
    if($gender == "Male"){
        $title = "Mr.";
    }     else{
    $title = "Miss";
    }
    
}else{
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Review</title>
</head>
<body>
<div class="container">
    <h3>
        Thanks <?php echo $title . " " . $fname . " " . $lname; ?>
    </h3>
    <p>Please Review Your Information</p>
    <p><strong>Name:</strong> <?php echo $fname . " " . $lname; ?></p>
    <p><strong>Address:</strong> <?php echo $address; ?></p>
    <p><strong>Country:</strong> <?php echo $country; ?></p>
    <p><strong>Your Skills:</strong> <?php echo $skills; ?></p>
    <p><strong>Department:</strong> <?php echo $department; ?></p>
</div>
</body>
</html>