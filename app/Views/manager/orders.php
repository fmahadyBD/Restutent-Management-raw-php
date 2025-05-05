<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../../../public/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../../../public/fontawesome/css/all.css" />
    <link rel="stylesheet" href="../../../public/fontawesome/css/fontawesome.min.css" />
    <title>Food Items</title>
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
            
            <div class="container py-4">
                <form action="/update-orders" method="POST">
                    <div class="card shadow-sm">
                        <div class="card-header bg-white py-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="mb-0 fw-bold">
                                    <i class="fas fa-clipboard-list me-2 text-primary"></i>Order Management
                                </h5>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-1"></i> Save All Changes
                                </button>
                            </div>
                        </div>
        
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0 align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="ps-4">Order ID</th>
                                            <th>Customer</th>
                                            <th>Items</th>
                                            <th>Total</th>
                                            <th>Status</th>
                                            <th class="text-end pe-4">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="ps-4 fw-bold">#ORD-1001</td>
                                            <td>Fahim</td>
                                            <td>3 items</td>
                                            <td>$36.97</td>
                                            <td>
                                                <select class="form-select form-select-sm">
                                                    <option value="pending" class="text-warning">
                                                        <i class="fas fa-clock me-1"></i> Pending
                                                    </option>
                                                    <option value="processing" class="text-primary">
                                                        <i class="fas fa-sync-alt me-1"></i> Processing
                                                    </option>
                                                    <option value="completed" class="text-success">
                                                        <i class="fas fa-check-circle me-1"></i> Completed
                                                    </option>
                                                    <option value="cancelled" class="text-danger">
                                                        <i class="fas fa-times-circle me-1"></i> Cancelled
                                                    </option>
                                                </select>
                                            </td>
                                            <td class="text-end pe-4">
                                                <button type="button" class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-eye"></i> View
                                                </button>
                                            </td>
                                        </tr>
                                        
         
                                    </tbody>
                                </table>
                            </div>
                        </div>
        
                       
                    </div>
                </form>
            </div>

        </main>
        

    </div>

</body>
<script src="../../../public/js/bootstrap.bundle.min.js"></script>

</html>