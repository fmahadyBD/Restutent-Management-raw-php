<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../auth/login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Management System</title>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Browse our delicious menu at FoodZone - the best place for quality food and dining experience">
    <link rel="stylesheet" href="../../../public/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../../../public/fontawesome/css/all.css" />
    <link rel="stylesheet" href="../../../public/fontawesome/css/fontawesome.min.css" />
    <title>Menu | RS Restaurant APP</title>
</head>
<body class="bg-light">

<!-- Navigation Bar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="/">
            <i class="fas fa-utensils me-2"></i>
            <span class="fw-bold">FoodZone</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mainNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="./index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="./index.php">Menu</a>
                </li>
                <li class="nav-item ms-lg-3 my-2 my-lg-0">
                    <a class="btn btn-outline-light" href="../users/logout.php">
                        <i class="fas fa-sign-in-alt me-1"></i> Logout
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<?php
if (isset($_GET['success']) && $_GET['success'] === 'ordered') {
    echo '<div class="alert alert-success alert-dismissible fade show">
            <i class="fas fa-check-circle me-2"></i> Item added to your order!
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
          </div>';
}
if (isset($_GET['error'])) {
    $errorMessage = match ($_GET['error']) {
        'invalid_request' => 'Invalid request',
        'order_failed' => 'Failed to process order',
        default => 'An error occurred'
    };
    echo '<div class="alert alert-danger alert-dismissible fade show">
            <i class="fas fa-exclamation-circle me-2"></i> ' . $errorMessage . '
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
          </div>';
}
?>

<!-- Main Content -->
<main class="container my-5">
    <div class="text-center mb-5">
        <h1 class="display-4 fw-bold text-dark mb-3">
            <i class="fas fa-utensils text-primary me-2"></i>Our Menu
        </h1>
        <p class="lead text-muted">Discover our selection of delicious dishes made with the finest ingredients</p>
    </div>

    <div class="row g-4" id="menuItems">
        <?php
        include __DIR__ . '/../../../config/database.php';

        try {
            $stmt = $conn->prepare("SELECT * FROM food WHERE status = 'Available' ORDER BY category, name");
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result && $result->num_rows > 0):
                while ($row = $result->fetch_assoc()):
        ?>
            <div class="col-lg-4 col-md-6 menu-item" data-category="<?= htmlspecialchars($row['category']) ?>">
                <div class="card h-100 border-0 shadow-sm overflow-hidden">
                    <div class="position-relative">
                        <?php if ($row['image']): ?>
                            <img src="../../../storage/<?= htmlspecialchars($row['image']) ?>"
                                 class="card-img-top object-fit-cover"
                                 alt="<?= htmlspecialchars($row['name']) ?>"
                                 style="height: 200px; width: 100%;">
                        <?php else: ?>
                            <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                                <div class="text-center p-3">
                                    <i class="fas fa-image fa-3x text-muted mb-2"></i>
                                    <p class="text-muted mb-0">Image coming soon</p>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="position-absolute top-0 end-0 bg-primary text-white px-2 py-1 small">
                            <?= htmlspecialchars($row['category']) ?>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <h3 class="h5 card-title mb-0"><?= htmlspecialchars($row['name']) ?></h3>
                            <span class="badge bg-success rounded-pill">$<?= htmlspecialchars($row['price']) ?></span>
                        </div>
                        <?php if (!empty($row['description'])): ?>
                            <p class="card-text text-muted small"><?= htmlspecialchars($row['description']) ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="card-footer bg-white border-0">
                        <form method="post" action="process_order.php">
                            <input type="hidden" name="food_id" value="<?= $row['id'] ?>">
                            <input type="hidden" name="food_name" value="<?= htmlspecialchars($row['name']) ?>">
                            <input type="hidden" name="food_price" value="<?= $row['price'] ?>">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-info-circle me-1"></i> Order
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        <?php
                endwhile;
            else:
        ?>
            <div class="col-12">
                <div class="alert alert-info text-center py-4">
                    <i class="fas fa-info-circle fa-2x mb-3"></i>
                    <h3 class="h4">Our menu is currently being updated</h3>
                    <p class="mb-0">Please check back soon or contact us for special requests</p>
                </div>
            </div>
        <?php
            endif;
        } catch (Exception $e) {
            echo '<div class="col-12"><div class="alert alert-danger">We\'re experiencing technical difficulties. Please try again later.</div></div>';
        }
        ?>
    </div>
</main>

<!-- Footer -->
<footer class="bg-dark text-white py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 mb-4 mb-lg-0">
                <h3 class="h5 mb-3"><i class="fas fa-utensils me-2"></i>FoodZone</h3>
                <p class="small text-muted">Quality ingredients, exceptional flavors, unforgettable experiences.</p>
            </div>
            <div class="col-lg-4 mb-4 mb-lg-0">
                <h4 class="h6 mb-3">Quick Links</h4>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="/" class="text-muted small">Home</a></li>
                </ul>
            </div>
            <div class="col-lg-4">
                <h4 class="h6 mb-3">Contact Us</h4>
                <ul class="list-unstyled text-muted small">
                    <li class="mb-2"><i class="fas fa-map-marker-alt me-2"></i> 123 Food St, City</li>
                    <li class="mb-2"><i class="fas fa-phone me-2"></i> 01722003285</li>
                    <li class="mb-2"><i class="fas fa-envelope me-2"></i> fahim@example.com</li>
                </ul>
            </div>
        </div>
        <hr class="my-4 bg-secondary">
        <div class="row">
            <div class="col-md-6 text-center text-md-start">
                <p class="small text-muted mb-0">&copy; <?= date('Y') ?> RS Restaurant APP. All rights reserved.</p>
            </div>
            <div class="col-md-6 text-center text-md-end">
                <a href="#" class="text-muted small me-3"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="text-muted small me-3"><i class="fab fa-instagram"></i></a>
                <a href="#" class="text-muted small me-3"><i class="fab fa-twitter"></i></a>
            </div>
        </div>
    </div>
</footer>

<!-- Scripts -->
<script src="../../../public/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('menuSearch');
        const categoryFilter = document.getElementById('categoryFilter');
        const menuItems = document.querySelectorAll('.menu-item');

        function filterMenu() {
            const searchTerm = searchInput?.value.toLowerCase() ?? '';
            const selectedCategory = categoryFilter?.value ?? '';

            menuItems.forEach(item => {
                const itemName = item.querySelector('.card-title').textContent.toLowerCase();
                const itemCategory = item.dataset.category;

                const matchesSearch = itemName.includes(searchTerm);
                const matchesCategory = selectedCategory === '' || itemCategory === selectedCategory;

                item.style.display = (matchesSearch && matchesCategory) ? 'block' : 'none';
            });
        }

        searchInput?.addEventListener('input', filterMenu);
        categoryFilter?.addEventListener('change', filterMenu);
    });
</script>

</body>
</html>
<?php
