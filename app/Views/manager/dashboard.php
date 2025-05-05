<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../../../public/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../../../public/fontawesome/css/all.css" />
    <link rel="stylesheet" href="../../../public/fontawesome/css/fontawesome.min.css" />
    <title>Dashboard</title>
</head>

<body>
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggler"
                aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <a class="navbar-brand text-info" href="#">
                <i class="fas fa-chart-line me-2 text-success"></i>
                RS Restaurant APP &nbsp; &nbsp;
            </a>
            
            

            <div class="collapse navbar-collapse" id="navbarToggler">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Dashboard</a>
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
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown">
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
        

    </div>

</body>
<script src="../../../public/js/bootstrap.bundle.min.js"></script>

</html>