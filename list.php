<?php
$data = file("data.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
?>
<!DOCTYPE html>
<html>
<head>
    <title>All Users</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #eef2f3;
            padding: 30px;
        }
        .container {
            max-width: 750px;
            margin: auto;
            background-color: #fff;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 0 12px rgba(0,0,0,0.1);
        }
        h2 {
            margin-bottom: 15px;
            color: #333;
        }
        .top-link {
            display: inline-block;
            margin-bottom: 15px;
            padding: 8px 14px;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }
        th {
            color: #fff;
            padding: 10px 14px;
            text-align: left;
        }
        td {
            padding: 9px 14px;
            border-bottom: 1px solid #ddd;
        }
        tr:nth-child(even) {
            background-color: #f5f8fc;
        }
        tr:hover {
            background-color: #e8f0fb;
        }
        a.btn {
            text-decoration: none;
            font-weight: bold;
        }
        a.btn:hover {
            text-decoration: underline;
        }
        a.btn.del {
            color: #e74c3c;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>All Users</h2>
    <a class="top-link" href="register.php">+ Register New User</a>
    <table>
    <tr>
        <th>#</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Username</th>
        <th>Actions</th>
    </tr>
    <?php if(empty($data)): ?>
    <tr><td colspan="5" style="text-align:center;">No users registered yet.</td></tr>
    <?php else: ?>
    <?php foreach($data as $index => $line):
        $row = explode("|", trim($line));
    ?>
    <tr>
        <td><?= $index + 1 ?></td>
        <td><?= $row[0] ?></td>
        <td><?= $row[1] ?></td>
        <td><?= $row[5] ?></td>
        <td>
            <a class="btn" href="view.php?id=<?= $index ?>">View</a> |
            <a class="btn del" href="delete.php?id=<?= $index ?>" onclick="return confirm('Delete this user?')">Delete</a>
        </td>
    </tr>
    <?php endforeach; ?>
    <?php endif; ?>
    </table>
</div>
</body>
</html>