<!DOCTYPE html>
<html>
<head>
    <title>Login Form</title>
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

        input {
            display: block;
            margin-top: 5px;
            margin-bottom: 10px;
            width: 100%;
            padding: 5px;
            box-sizing: border-box;
        }

        button {
            margin-top: 10px;
            padding: 5px 15px;
            margin-right: 5px;
        }

        .link {
            margin-top: 15px;
            text-align: center;
        }

        .link a {
            color: #0066cc;
            text-decoration: none;
        }

        .link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Login</h2>
    <form method="POST" action="auth.php">

        <label>Username:</label>
        <input type="text" name="username" required minlength="4" pattern="[A-Za-z0-9_]+" title="At least 4 characters">

        <label>Password:</label>
        <input type="password" name="password" required minlength="6" title="Password must be at least 6 characters">

        <button type="submit">Login</button>
        <button type="reset">Reset</button>

    </form>

    <div class="link">
        <p>Don't have an account? <a href="register.php">Register here</a></p>
    </div>
</div>
</body>
</html>