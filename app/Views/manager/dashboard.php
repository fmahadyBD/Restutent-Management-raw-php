<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../auth/login.php");
    exit;
}

include __DIR__ . '/../../../config/database.php';
include 'header.php';

// Initialize variables
$totalCustomers = $totalEmployees = $ordersInProgress = 0;
$monthlyRevenue = 0.0;

// Fetch stats
// Total customers
$customerResult = $conn->query("SELECT COUNT(*) as count FROM users WHERE role = 'user'");
if ($customerResult && $row = $customerResult->fetch_assoc()) {
    $totalCustomers = $row['count'];
}

// Orders in progress
$ordersProgressResult = $conn->query("SELECT COUNT(*) as count FROM orders WHERE status = 'processing'");
if ($ordersProgressResult && $row = $ordersProgressResult->fetch_assoc()) {
    $ordersInProgress = $row['count'];
}

// Total employees
$employeeResult = $conn->query("SELECT COUNT(*) as count FROM users WHERE role = 'admin'");
if ($employeeResult && $row = $employeeResult->fetch_assoc()) {
    $totalEmployees = $row['count'];
}

// Monthly revenue (sum of completed order totals)
$revenueResult = $conn->query("SELECT SUM(total) as total FROM orders WHERE status = 'completed'");
if ($revenueResult && $row = $revenueResult->fetch_assoc()) {
    $monthlyRevenue = $row['total'] ?? 0;
}
?>

<main class="flex-grow-1 p-4">
    <h1 class="mb-4">Restaurant Management System</h1>

    <div class="row g-4">
        <!-- Total Customers Card -->
        <div class="col-md-6 col-xl-3">
            <div class="card text-white bg-primary shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Total Customers</h5>
                            <h3><?= htmlspecialchars($totalCustomers) ?></h3>
                        </div>
                        <i class="fas fa-users fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Orders in Progress Card -->
        <div class="col-md-6 col-xl-3">
            <div class="card text-white bg-warning shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Orders in Progress</h5>
                            <h3><?= htmlspecialchars($ordersInProgress) ?></h3>
                        </div>
                        <i class="fas fa-receipt fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Employees Card -->
        <div class="col-md-6 col-xl-3">
            <div class="card text-white bg-success shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Total Employees</h5>
                            <h3><?= htmlspecialchars($totalEmployees) ?></h3>
                        </div>
                        <i class="fas fa-user-tie fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Monthly Revenue Card -->
        <div class="col-md-6 col-xl-3">
            <div class="card text-white bg-info shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Monthly Revenue</h5>
                            <h3>$<?= number_format((float)$monthlyRevenue, 2) ?></h3>
                        </div>
                        <i class="fas fa-dollar-sign fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include 'footer.php'; ?>
