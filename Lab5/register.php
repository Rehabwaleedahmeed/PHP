<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
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
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="form-container">
                    <h2 class="form-title">User Registration Form</h2>
                    <?php if (isset($_GET['error'])): ?>
                        <div class="alert alert-danger" role="alert">
                            <?= htmlspecialchars($_GET['error']) ?>
                        </div>
                    <?php endif; ?>

                    <form method="POST" action="store.php" enctype="multipart/form-data">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="fname" class="form-label">First Name:</label>
                                <input type="text" class="form-control" id="fname" name="fname" required minlength="2" pattern="[A-Za-z]+" title="at least 2 characters">
                            </div>
                            <div class="col-md-6">
                                <label for="lname" class="form-label">Last Name:</label>
                                <input type="text" class="form-control" id="lname" name="lname" required minlength="2" pattern="[A-Za-z]+" title="at least 2 characters">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">Address:</label>
                            <textarea class="form-control" id="address" name="address" required minlength="5" placeholder="Enter your address" rows="3"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="country" class="form-label">Country:</label>
                            <select class="form-select" id="country" name="country" required>
                                <option value="" disabled selected>Select Country</option>
                                <option value="Egypt">Egypt</option>
                                <option value="USA">USA</option>
                                <option value="UK">UK</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Gender:</label>
                            <div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender" id="male" value="Male" required>
                                    <label class="form-check-label" for="male">Male</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender" id="female" value="Female">
                                    <label class="form-check-label" for="female">Female</label>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Skills (select at least one):</label>
                            <div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="skills[]" id="php" value="PHP" required>
                                    <label class="form-check-label" for="php">PHP</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="skills[]" id="mysql" value="MySQL">
                                    <label class="form-check-label" for="mysql">MySQL</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="skills[]" id="js" value="JS">
                                    <label class="form-check-label" for="js">JavaScript</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="skills[]" id="html" value="HTML">
                                    <label class="form-check-label" for="html">HTML</label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="username" class="form-label">Username:</label>
                                <input type="text" class="form-control" id="username" name="username" required minlength="4" pattern="[A-Za-z0-9_]+" title="At least 4 characters">
                            </div>
                            <div class="col-md-6">
                                <label for="password" class="form-label">Password:</label>
                                <input type="password" class="form-control" id="password" name="password" required minlength="6" title="Password must be at least 6 characters">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="department" class="form-label">Department:</label>
                                <input type="text" class="form-control" id="department" name="department" value="OpenSource" readonly>
                            </div>
                            <div class="col-md-6">
                                <label for="profile_pic" class="form-label">Profile Picture:</label>
                                <input type="file" class="form-control" id="profile_pic" name="profile_pic" accept=".jpg,.jpeg,.png" required>
                            </div>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="reset" class="btn btn-secondary">Reset</button>
                            <a href="login.php" class="btn btn-outline-dark">Back to Login</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>