<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Employee</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f5f5f5;
            padding-top: 20px;
        }
        .form-container {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .form-title {
            color: #333;
            margin-bottom: 30px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <span class="navbar-brand">👥 Employee Management</span>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="index.php">Back</a>
                <a class="nav-link" href="logout.php">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="form-container">
                    <h2 class="form-title">Edit Employee</h2>

                    <?php if(isset($employee) && $employee): ?>
                        <form action="update.php" method="post">
                            <input type="hidden" name="id" value="<?php echo htmlspecialchars($employee['id']); ?>">

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="f_name" class="form-label">First Name:</label>
                                    <input type="text" name="f_name" id="f_name" value="<?php echo htmlspecialchars($employee['f_name']); ?>" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="l_name" class="form-label">Last Name:</label>
                                    <input type="text" name="l_name" id="l_name" value="<?php echo htmlspecialchars($employee['l_name']); ?>" class="form-control" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email:</label>
                                    <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($employee['email']); ?>" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="username" class="form-label">Username:</label>
                                    <input type="text" name="username" id="username" value="<?php echo htmlspecialchars($employee['username'] ?? ''); ?>" class="form-control" disabled>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="address" class="form-label">Address:</label>
                                <textarea name="address" id="address" class="form-control" required rows="3"><?php echo htmlspecialchars($employee['address']); ?></textarea>
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                                <button class="btn btn-primary">Update</button>
                                <a href="index.php" class="btn btn-outline-secondary">Cancel</a>
                            </div>
                        </form>
                    <?php else: ?>
                        <div class="alert alert-danger">Employee not found</div>
                        <a href="index.php" class="btn btn-secondary">Back</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>