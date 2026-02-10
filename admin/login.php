<?php
session_start();
include('../config/db.php');

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    $result = mysqli_query($conn, "SELECT * FROM admin_users WHERE username='$username'");
    if ($user = mysqli_fetch_assoc($result)) {
        if (password_verify($password, $user['password'])) {
            $_SESSION['admin_logged_in'] = true;
            header("Location: dashboard.php");
            exit();
        }
    }
    $error = "Access Denied: Credentials do not match our records.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Being Myanmar | Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            font-family: 'Inter', sans-serif;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
            overflow: hidden;
            width: 100%;
            max-width: 420px;
            border-top: 5px solid #2e3192; /* Brand Blue */
        }
        .brand-section {
            padding: 30px 20px 10px;
            text-align: center;
        }
        .brand-logo {
            max-width: 180px;
            margin-bottom: 10px;
        }
        .form-container {
            padding: 30px 40px 40px;
        }
        .form-label {
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 600;
            color: #6c757d;
        }
        .form-control {
            border: 1px solid #e1e5eb;
            padding: 12px;
            border-radius: 6px;
            transition: all 0.3s;
        }
        .form-control:focus {
            box-shadow: none;
            border-color: #f7941d; /* Brand Gold/Orange */
        }
        .btn-login {
            background-color: #2e3192; /* Brand Blue */
            border: none;
            color: white;
            padding: 12px;
            font-weight: 600;
            border-radius: 6px;
            margin-top: 10px;
            transition: 0.3s;
        }
        .btn-login:hover {
            background-color: #1e2063;
            transform: translateY(-1px);
        }
        .error-box {
            background-color: #fff5f5;
            color: #c53030;
            padding: 12px;
            border-radius: 6px;
            font-size: 0.85rem;
            margin-bottom: 20px;
            border-left: 4px solid #f56565;
        }
        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            font-size: 0.85rem;
            color: #adb5bd;
            text-decoration: none;
        }
        .back-link:hover { color: #2e3192; }
    </style>
</head>
<body>

    <div class="login-card">
        <div class="brand-section">
            <h3 style="color: #2e3192; font-weight: 800; margin-bottom: 0;">BEING</h3>
            <p style="color: #f7941d; font-weight: 600; letter-spacing: 2px; font-size: 0.9rem; margin: 0;">MYANMAR</p>
            <hr style="width: 50px; margin: 20px auto; border-top: 2px solid #eee;">
            <p class="text-muted small">ADMINISTRATION PORTAL</p>
        </div>

        <div class="form-container">
            <?php if(isset($error)): ?>
                <div class="error-box">
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>

            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" placeholder="admin_user" required autofocus>
                </div>
                <div class="mb-4">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                </div>
                <button name="login" class="btn btn-login w-100">SIGN IN</button>
            </form>

            <a href="../index.php" class="back-link">← Return to Homepage</a>
        </div>
    </div>

</body>
</html>