<?php
include 'config.php';
$sql = "SELECT * FROM users";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Users List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background-color: #eef2f3;
        }
        .container {
            width: 800px;
            margin: auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 6px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        a {
            margin-right: 10px;
            text-decoration: none;
            color: #0066cc;
        }
        a:hover {
            text-decoration: underline;
        }
        .add-btn {
            display: inline-block;
            margin-bottom: 20px;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }
        .add-btn:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>All Users</h2>
    <a href="register.php" class="add-btn">Add New User</a>

    <table>
    <tr>
        <th>ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Username</th>
        <th>Profile Pic</th>
        <th>Actions</th>
    </tr>
    <?php   
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $profile_pic = isset($row['profile_pic']) && $row['profile_pic'] != '' ? $row['profile_pic'] : 'no-image.png';
            ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= htmlspecialchars($row['fname']) ?></td>
                <td><?= htmlspecialchars($row['lname']) ?></td>
                <td><?= htmlspecialchars($row['username']) ?></td>
                <td><img src="<?= $profile_pic ?>" alt="Profile Picture" width="50" style="max-height:50px;"></td>
                <td>
                    <a href="view.php?id=<?= $row['id'] ?>">View</a> |
                    <a href="delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </tr>
            <?php
        }
    } else {
        echo "<tr><td colspan='6'>No users found</td></tr>";
    }
    ?>
    </table>
</div>
</body>
</html>

<?php
$conn->close();
?>