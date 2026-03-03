<!DOCTYPE html>
<html>
<head>
    <title>Registration Form</title>
   
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background-color: #eef2f3;
        }

        .container {
            width: 400px;
            margin: auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 6px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        label {
            display: block;
            margin-top: 10px;
            font-weight: bold;
        }

        input, textarea, select {
            display: block;
            margin-top: 5px;
            margin-bottom: 10px;
            width: 100%;
            padding: 5px;
            box-sizing: border-box;
        }

        .checkbox-group, .radio-group {
            margin-top: 5px;
        }

        button {
            margin-top: 10px;
            padding: 5px 15px;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Registration Form</h2>
    <form method="POST" action="save.php">

        <label>First Name:</label>
        <input type="text" name="fname" required minlength="2" pattern="[A-Za-z]+" title="at least 2 characters"/>

        <label>Last Name:</label>
        <input type="text" name="lname" required minlength="2" pattern="[A-Za-z]+" title="at least 2 characters">

        <label>Address:</label>
        <textarea name="address" required minlength="5" placeholder="Enter your address"></textarea>


        <label>Department:</label>
        <input type="text" name="department" value="OpenSource" readonly>
     
        <label>Gender:</label>
        <div class="radio-group">
            <input type="radio" name="gender" value="Male" required> Male
            <input type="radio" name="gender" value="Female"> Female
        </div>

        <label>Username:</label>
        <input type="text" name="username" required minlength="4" pattern="[A-Za-z0-9_]+" title="At least 4 characters">

        <label>Password:</label>
        <input type="password" name="password" required minlength="6" title="Password must be at least 6 characters">

        

        <button type="submit">Submit</button>

    </form>
</div>
</body>
</html>