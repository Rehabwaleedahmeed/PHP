<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

require "db.php";

$service = new Service();
$result = $service->getAllEmployees();
$employees = $result->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employees List</title>
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
            <span class="navbar-brand"> Employee</span>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="index.php">Dashboard</a>
                <a class="nav-link" href="logout.php">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="container-wrapper">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="page-title mb-0">All Employees</h2>
                <a href="create.php" class="btn btn-success">➕ Add New Employee</a>
            </div>

            <div class="table-wrapper">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($employees) > 0): ?>
                            <?php foreach($employees as $emp): ?>
                                <tr>
                                    <td><?= htmlspecialchars($emp['id']) ?></td>
                                    <td><strong><?= htmlspecialchars($emp['username'] ?? 'N/A') ?></strong></td>
                                    <td><?= htmlspecialchars($emp['f_name']) ?></td>
                                    <td><?= htmlspecialchars($emp['l_name']) ?></td>
                                    <td><?= htmlspecialchars($emp['email']) ?></td>
                                    <td><?= htmlspecialchars($emp['address']) ?></td>
                                    <td>
                                        <a href="edit.php?id=<?= $emp['id'] ?>" class="btn btn-sm btn-warning">✏️ Edit</a>
                                        <a href="delete.php?id=<?= $emp['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this employee?')">🗑️ Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="text-center text-muted">No employees found</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>