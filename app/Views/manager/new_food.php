<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../auth/login.php");
    exit;
}
include __DIR__ . '/../../../config/database.php';

$message = '';

if (isset($_POST['submit'])) {
    $name = $_POST['name'] ?? '';
    $category = $_POST['category'] ?? '';
    $price = $_POST['price'] ?? '';
    $status = $_POST['status'] ?? '';

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $imageName = $_FILES['image']['name'];
        $uniqueName = uniqid() . '_' . basename($imageName);
        $target = __DIR__ . "/../../../storage/" . $uniqueName;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
            $stmt = $conn->prepare("INSERT INTO food (name, category, price,
status, image) VALUES (?, ?, ?, ?, ?)"); $stmt->bind_param("sssss", $name,
$category, $price, $status, $uniqueName); if ($stmt->execute()) { $message = '
<div class="alert alert-success">
  <i class="fas fa-check-circle"></i> Food added successfully!
</div>
'; } else { $message = '
<div class="alert alert-danger">
  <i class="fas fa-exclamation-triangle"></i> SQL Error: ' . $stmt->error . '
</div>
'; } $stmt->close(); } else { $message = '
<div class="alert alert-danger">
  <i class="fas fa-times-circle"></i> Error uploading the file.
</div>
'; } } else { $errorCode = $_FILES['image']['error'] ?? 'No file uploaded';
$message = '
<div class="alert alert-danger">
  <i class="fas fa-times-circle"></i> Image upload failed! Error code: ' .
  $errorCode . '
</div>
'; } } ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../../../public/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../../../public/fontawesome/css/all.css" />
    <link
      rel="stylesheet"
      href="../../../public/fontawesome/css/fontawesome.min.css"
    />
    <title>Food Items</title>
  </head>

  <body>
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container-fluid">
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarToggler"
          aria-controls="navbarToggler"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>

        <a class="navbar-brand text-info" href="#">
          <i class="fas fa-chart-line me-2 text-success"></i>
          RS Restaurant APP &nbsp; &nbsp;
        </a>

        <div class="collapse navbar-collapse" id="navbarToggler">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#"
                >Dashboard</a
              >
            </li>

            <li class="nav-item">
              <a href="" class="nav-link"> Home </a>
            </li>

            <li class="nav-item">
              <a href="" class="nav-link"> About </a>
            </li>
            <li class="nav-item">
              <a href="" class="nav-link"> Contact </a>
            </li>
          </ul>

          <form>
            <div class="input-group">
              <input type="search" class="form-control" placeholder="Search" />
              <button class="btn btn-outline-light" type="submit">
                <i class="fas fa-search"></i>
              </button>
            </div>
          </form>

          <ul class="navbar-nav ms-3">
            <li class="nav-item dropdown">
              <a
                class="nav-link dropdown-toggle"
                href="#"
                id="navbarDropdown"
                role="button"
                data-bs-toggle="dropdown"
              >
                <i class="fas fa-user-circle fa-lg"></i>
              </a>
              <ul class="dropdown-menu dropdown-menu-end">
                <li>
                  <a href="#" class="dropdown-item">
                    <i class="fas fa-user me-2"></i>
                    Profile
                  </a>
                </li>
                <li>
                  <a href="#" class="dropdown-item">
                    <i class="fas fa-cog me-2"></i>
                    Settings
                  </a>
                </li>
                <li>
                  <hr class="dropdown-divoder" />
                </li>

                <li>
                  <a href="../users/login.php" class="dropdown-item">
                    <i class="fas fa-sign-out-alt me-2"></i>
                    Logout
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="d-flex">
    <aside class="bg-dark text-light p-3" style="width: 250px; min-height: 100vh;">
            <h4 class="mb-4"><i class="fas fa-tools me-2"></i>Admin Panel</h4>
            <ul class="nav flex-column">
                <li class="nav-item mb-2">
                    <a href="./dashboard.php" class="nav-link text-light">
                        <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a href="./employees.php" class="nav-link text-light">
                        <i class="fas fa-user-tie me-2"></i>Employees
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a href="./foods.php" class="nav-link text-light">
                        <i class="fas fa-hamburger me-2"></i>Food Items
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a href="./orders.php" class="nav-link text-light">
                        <i class="fas fa-receipt me-2"></i>Orders
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a href="./users.php" class="nav-link text-light">
                        <i class="fas fa-users me-2"></i>Users
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a href="./offer.php" class="nav-link text-light">
                        <i class="fas fa-handshake me-2"></i>Offers
                    </a>
                </li>
                
            </ul>
        </aside>
      <main class="flex-grow-1 p-4">
        <div class="container py-5">
          <div class="card p-4 shadow">
          <div class="card-header bg-white py-3">
               <!-- Message -->
              
                       
                        <?php echo $message; ?>
                        
              <h2 class="mb-4 text-info"><i class="fas fa-utensils"></i> Add Food</h2>
            </div>

            <div class="card-body p-0">


            
                <form method="post" enctype="multipart/form-data" class="mt-3">
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Category</label>
                        <input type="text" name="category" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Price</label>
                        <input type="text" name="price" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select" required>
                            <option value="Available">Available</option>
                            <option value="Unavailable">Unavailable</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Image</label>
                        <input type="file" name="image" class="form-control" required>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Add Food
                    </button>
                </form>
            </div>

            </div>


        </div>
      </main>
    </div>
  </body>
  <script src="../../../public/js/bootstrap.bundle.min.js"></script>
</html>
