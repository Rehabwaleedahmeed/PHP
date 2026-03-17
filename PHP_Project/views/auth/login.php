
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Premium Cafeteria</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="/css/modern.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, var(--bg-white) 0%, var(--bg-light) 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-container {
            width: 100%;
            max-width: 450px;
            padding: 1.5rem;
        }

        .login-card {
            background: var(--bg-white);
            border: 2px solid var(--primary-color);
            border-radius: 20px;
            padding: 3rem 2rem;
            box-shadow: 0 20px 60px rgba(33, 40, 66, 0.15);
        }

        .login-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .login-header h1 {
            font-size: 2.2rem;
            font-weight: 800;
            color: var(--primary-dark);
            margin-bottom: 0.5rem;
        }

        .login-header p {
            color: var(--text-dark);
            font-size: 0.95rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            color: var(--primary-dark);
            font-weight: 600;
            margin-bottom: 0.7rem;
            font-size: 0.95rem;
        }

        .form-control {
            background: var(--bg-light) !important;
            border: 2px solid var(--primary-color) !important;
            color: var(--text-dark) !important;
            border-radius: 12px !important;
            padding: 12px 16px !important;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        .form-control::placeholder {
            color: var(--text-muted) !important;
        }

        .form-control:focus {
            background: var(--bg-white) !important;
            border-color: var(--primary-dark) !important;
            box-shadow: 0 0 0 3px rgba(33, 40, 66, 0.1);
            color: var(--text-dark) !important;
        }

        .btn-login {
            background: var(--primary-dark);
            color: white;
            border: none;
            border-radius: 12px;
            padding: 12px 24px;
            font-weight: 700;
            font-size: 1rem;
            width: 100%;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 1rem;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 35px rgba(33, 40, 66, 0.3);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .divider {
            text-align: center;
            margin: 2rem 0;
            color: var(--text-muted);
            font-size: 0.9rem;
            position: relative;
        }

        .divider::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            width: 100%;
            height: 1px;
            background: rgba(212, 165, 116, 0.2);
            z-index: 0;
        }

        .divider span {
            background: rgba(255, 255, 255, 0.05);
            padding: 0 10px;
            position: relative;
            z-index: 1;
        }

        .login-footer {
            text-align: center;
            margin-top: 2rem;
            color: rgba(255, 255, 255, 0.7);
        }

        .login-footer a {
            color: #d4a574;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .login-footer a:hover {
            color: #fff;
        }

        .alert {
            background: rgba(255, 255, 255, 0.1) !important;
            border: 1px solid rgba(212, 165, 116, 0.2) !important;
            color: #fff !important;
            border-radius: 12px !important;
            margin-bottom: 1.5rem;
        }

        .alert-danger {
            background: rgba(220, 53, 69, 0.1) !important;
            border-color: rgba(220, 53, 69, 0.3) !important;
        }

        .alert-success {
            background: rgba(40, 167, 69, 0.1) !important;
            border-color: rgba(40, 167, 69, 0.3) !important;
        }

        .btn-close {
            filter: brightness(0) invert(1) !important;
        }

        .input-icon {
            position: relative;
        }

        .input-icon i {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #d4a574;
            pointer-events: none;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <h1>☕</h1>
                <h2>Welcome Back</h2>
                <p>Sign in to your Premium Cafeteria account</p>
            </div>

            <?php if (isset($_GET['error'])): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle"></i> <?php echo htmlspecialchars($_GET['error']); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <?php if (isset($_GET['success'])): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle"></i> <?php echo htmlspecialchars($_GET['success']); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <form action="/login" method="POST">
                <div class="form-group">
                    <label for="email" class="form-label">📧 Email Address</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="your@email.com" required>
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">🔒 Password</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="••••••••" required>
                </div>

                <button type="submit" class="btn-login">
                    <i class="fas fa-sign-in-alt"></i> Login
                </button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>