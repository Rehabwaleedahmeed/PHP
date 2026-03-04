<?php
include 'config.php';
$sql = "SELECT * FROM users";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f5f5f5;
            padding-top: 20px;
        }
        .container-wrapper {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .page-title {
            color: #333;
            margin-bottom: 30px;
            font-weight: bold;
        }
        .table-wrapper {
            margin-top: 20px;
        }
        .profile-img {
            max-height: 50px;
            border-radius: 4px;
        }
        .btn-sm {
            margin: 2px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <span class="navbar-brand">User Management</span>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="home.php">Home</a>
                <a class="nav-link" href="logout.php">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="container-wrapper">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="page-title mb-0">All Users</h2>
                <a href="register.php" class="btn btn-success">Add New User</a>
            </div>

            <div class="table-wrapper">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Username</th>
                            <th>Profile Picture</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php   
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                $profile_pic = isset($row['profile_pic']) && $row['profile_pic'] != '' && file_exists($row['profile_pic']) ? $row['profile_pic'] : 'https://via.placeholder.com/50';
                                ?>
                                <tr>
                                    <td><?= $row['id'] ?></td>
                                    <td><?= htmlspecialchars($row['fname']) ?></td>
                                    <td><?= htmlspecialchars($row['lname']) ?></td>
                                    <td><?= htmlspecialchars($row['username']) ?></td>
                                    <td><img src="<?= $profile_pic ?>" alt="Profile Picture" class="profile-img"></td>
                                    <td>
                                        <a href="view.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-primary">View</a>
                                        <a href="delete.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                                    </td>
                                </tr>
                                <?php
                            }
                        } else {
                            echo "<tr><td colspan='6' class='text-center text-muted'>No users found</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>