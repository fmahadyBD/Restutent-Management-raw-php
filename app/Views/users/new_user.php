<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include __DIR__ . '/../../../config/database.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $fname = $_POST['fname'] ?? '';
    $lname = $_POST['lname'] ?? '';
    $email = $_POST['email'] ?? '';
    $mobile = $_POST['mobile'] ?? '';
    $address = $_POST['address'] ?? '';
    $password = $_POST['password'] ?? ''; 

    // Prepare statement
    $statement = $conn->prepare("INSERT INTO users (fname, lname, email, mobile, address, password) VALUES (?, ?, ?, ?, ?, ?)");

    if ($statement === false) {
        die('Prepare failed: ' . $conn->error);
    }

    // Bind parameters
    $statement->bind_param("ssssss", $fname, $lname, $email, $mobile, $address, $password);

    if ($statement->execute()) {
        $message = '
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> User registered successfully!
            </div>
        ';
    } else {
        $message = '
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-triangle"></i> SQL Error: ' . $statement->error . '
            </div>
        ';
    }
    $statement->close();
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
    <title>Register</title>
</head>

<body class="bg-light">
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="w-100" style="max-width: 500px;">
            <div class="p-5 rounded-3 shadow bg-white">

                <!-- Display success or error message -->
                <?php if (!empty($message)) echo $message; ?>

                <div class="text-center mb-4">
                    <h3 class="text-primary fw-bold">
                        <i class="fas fa-user-plus me-2"></i>Register
                    </h3>
                </div>

                <form action="" method="POST">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <i class="fas fa-user text-muted"></i>
                                </span>
                                <input type="text" name="fname" placeholder="First Name" id="fname" 
                                       class="form-control py-2" required>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <i class="fas fa-user text-muted"></i>
                                </span>
                                <input type="text" name="lname" placeholder="Last Name" id="lname" 
                                       class="form-control py-2" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <div class="input-group">
                            <span class="input-group-text bg-light">
                                <i class="fas fa-envelope text-muted"></i>
                            </span>
                            <input type="email" name="email" placeholder="Email Address" id="email" 
                                   class="form-control py-2" required>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <div class="input-group">
                            <span class="input-group-text bg-light">
                                <i class="fas fa-phone text-muted"></i>
                            </span>
                            <input type="tel" name="mobile" placeholder="Mobile Number" id="mobile" 
                                   class="form-control py-2" required>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <div class="input-group">
                            <span class="input-group-text bg-light">
                                <i class="fas fa-map-marker-alt text-muted"></i>
                            </span>
                            <input type="text" name="address" placeholder="Street Address" id="address" 
                                   class="form-control py-2" required>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <div class="input-group">
                            <span class="input-group-text bg-light">
                                <i class="fas fa-lock text-muted"></i>
                            </span>
                            <input type="password" name="password" placeholder="Password" id="password" 
                                   class="form-control py-2" required>
                        </div>
                    </div>
                    
                    <div class="d-grid mb-3">
                        <button type="submit" name="submit" class="btn btn-primary py-2 fw-bold">
                            <i class="fas fa-user-plus me-2"></i> Create Account
                        </button>
                    </div>

                    <div class="text-center text-muted">
                        Already have an account? <a href="#" class="text-decoration-none">Login</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

<script src="../../../public/js/bootstrap.bundle.min.js"></script>

</html>
