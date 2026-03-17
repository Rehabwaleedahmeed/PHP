<?php
include 'config.php';

$id = isset($_GET["id"]) ? intval($_GET["id"]) : 0;

$sql = "SELECT * FROM users WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    die("User not found!");
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f5f5f5;
            padding-top: 20px;
        }
        .detail-container {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .detail-title {
            color: #333;
            margin-bottom: 30px;
            font-weight: bold;
        }
        .detail-item {
            padding: 15px;
            border-bottom: 1px solid #eee;
        }
        .detail-item:last-child {
            border-bottom: none;
        }
        .detail-label {
            font-weight: bold;
            color: #555;
        }
        .detail-value {
            color: #333;
            margin-top: 5px;
        }
        .profile-pic-container {
            text-align: center;
            margin-top: 20px;
            margin-bottom: 20px;
        }
        .profile-pic {
            max-width: 200px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <span class="navbar-brand">User Details</span>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="list.php">Back to List</a>
                <a class="nav-link" href="logout.php">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="detail-container">
                    <h2 class="detail-title"><?= htmlspecialchars($row['fname']) ?> <?= htmlspecialchars($row['lname']) ?></h2>
                    
                    <div class="profile-pic-container">
                        <?php if (!empty($row['profile_pic']) && file_exists($row['profile_pic'])): ?>
                            <img src="<?= htmlspecialchars($row['profile_pic']) ?>" alt="Profile" class="profile-pic">
                        <?php else: ?>
                            <img src="https://via.placeholder.com/200" alt="No Profile Picture" class="profile-pic">
                        <?php endif; ?>
                    </div>

                    <div class="detail-item">
                        <div class="detail-label">Username:</div>
                        <div class="detail-value"><?= htmlspecialchars($row['username']) ?></div>
                    </div>

                    <div class="detail-item">
                        <div class="detail-label">Address:</div>
                        <div class="detail-value"><?= htmlspecialchars($row['address']) ?></div>
                    </div>

                    <div class="detail-item">
                        <div class="detail-label">Country:</div>
                        <div class="detail-value"><?= htmlspecialchars($row['country']) ?></div>
                    </div>

                    <div class="detail-item">
                        <div class="detail-label">Gender:</div>
                        <div class="detail-value"><?= htmlspecialchars($row['gender']) ?></div>
                    </div>

                    <div class="detail-item">
                        <div class="detail-label">Skills:</div>
                        <div class="detail-value"><?= htmlspecialchars($row['skills']) ?></div>
                    </div>

                    <div class="detail-item">
                        <div class="detail-label">Department:</div>
                        <div class="detail-value"><?= htmlspecialchars($row['department']) ?></div>
                    </div>

                    <div class="mt-4">
                        <a href="list.php" class="btn btn-primary">Back to List</a>
                        <a href="delete.php?id=<?= $row['id'] ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?')">Delete User</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>