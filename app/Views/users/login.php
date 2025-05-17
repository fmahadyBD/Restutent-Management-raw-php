<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Connect to your database
include __DIR__ . '/../../../config/database.php';

$login_error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (!empty($email) && !empty($password)) {
        $stmt = $conn->prepare("SELECT id, email, password, role FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            if ($password === $row['password']) {
                // Login successful
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['user_email'] = $row['email'];
                $_SESSION['user_role'] = $row['role'];

                // Redirect based on role
                if ($row['role'] === 'admin') {
                    header("Location: ../manager/dashboard.php");
                } else {
                    header("Location: ../users/home.php");
                }
                exit;
            } else {
                $login_error = "Invalid password.";
            }
        } else {
            $login_error = "User not found.";
        }

        $stmt->close();
    } else {
        $login_error = "Please enter email and password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../../../public/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../../../public/fontawesome/css/all.css" />
    <link rel="stylesheet" href="../../../public/fontawesome/css/fontawesome.min.css" />
    <title>Login</title>
</head>

<body class="bg-light">
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="w-100" style="max-width: 400px;">
            <div class="p-4 rounded shadow bg-white">
                <h3 class="text-center mb-4 text-primary">
                    <i class="fas fa-sign-in-alt me-2"></i>Login
                </h3>
                <form action="" method="POST">
                    <?php if ($login_error): ?>
                        <div class="alert alert-danger text-center"><?= $login_error ?></div>
                    <?php endif; ?>

                    <div class="mb-3">
                        <div class="input-group">
                            <span class="input-group-text bg-light">
                                <i class="fas fa-envelope text-muted"></i>
                            </span>
                            <input type="email" class="form-control py-2" name="email" id="email" placeholder="Email address" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="input-group">
                            <span class="input-group-text bg-light">
                                <i class="fas fa-lock text-muted"></i>
                            </span>
                            <input type="password" name="password" id="password" placeholder="Password" class="form-control py-2" required>
                        </div>
                    </div>

                    <div class="d-grid mb-3">
                        <button type="submit" class="btn btn-primary py-2">
                            <i class="fas fa-sign-in-alt me-2"></i> Login
                        </button>
                    </div>

                    <div class="text-center">
                        <a href="#" class="text-decoration-none d-block mb-2">Forgot password?</a>
                        <span class="text-muted">Don't have an account?
                            <a href="./new_user.php" class="text-decoration-none text-primary">Register</a>
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="../../../public/js/bootstrap.bundle.min.js"></script>
</body>
</html>
