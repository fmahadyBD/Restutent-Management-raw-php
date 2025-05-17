<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../auth/login.php");
    exit;
}
?>

<?php include 'header.php'; ?>

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
                                    <h3>1,240</h3>
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
                                    <h3>75</h3>
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
                                    <h3>38</h3>
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
                                    <h3>$12,500</h3>
                                </div>
                                <i class="fas fa-dollar-sign fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        
<?php include 'footer.php'; ?>