<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../../../public/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../../../public/fontawesome/css/all.css" />
    <link rel="stylesheet" href="../../../public/fontawesome/css/fontawesome.min.css" />
    <title>Offer Management</title>
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
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0 fw-bold">
                            <i class="fas fa-tag me-2 text-primary"></i>Create New Offer
                        </h5>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Offer Name</label>
                                    <input type="text" class="form-control" placeholder="Enter offer name">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Category</label>
                                    <select class="form-select">
                                        <option selected disabled>Select category</option>
                                        <option>Traditional Bengali Cuisine</option>
                                        <option>Street Food</option>
                                        <option>Biriyani and Kacchi Specialist</option>
                                        <option>Drinks</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Discount Percentage</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" placeholder="0-100" min="0" max="100">
                                        <span class="input-group-text">%</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Reason</label>
                                    <input type="text" class="form-control" placeholder="Enter reason for offer">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Start Date</label>
                                    <input type="date" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">End Date</label>
                                    <input type="date" class="form-control">
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save me-1"></i> Save Offer
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
        
                <div class="card shadow-sm">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0 fw-bold">
                            <i class="fas fa-list me-2 text-primary"></i>Current Offers
                        </h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="ps-4">Offer ID</th>
                                        <th>Name</th>
                                        <th>Category</th>
                                        <th>Discount</th>
                                        <th>Period</th>
                                        <th>Status</th>
                                        <th class="text-end pe-4">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="ps-4 fw-bold">#OFF-1001</td>
                                        <td>Eid</td>
                                        <td>Biriyani and Kacchi Specialist</td>
                                        <td class="fw-bold text-success">30%</td>
                                        <td>15 Jun - 30 Jun 2023</td>
                                        <td>
                                            <span class="badge bg-success bg-opacity-10 text-success">
                                                <i class="fas fa-check-circle me-1"></i> Active
                                            </span>
                                        </td>
                                        <td class="text-end pe-4">
                                            <div class="btn-group btn-group-sm">
                                                <button class="btn btn-outline-primary" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="btn btn-outline-danger" title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="ps-4 fw-bold">#OFF-1002</td>
                                        <td>Tech Festival</td>
                                        <td>Drinks</td>
                                        <td class="fw-bold text-success">20%</td>
                                        <td>1 Jul - 15 Jul 2023</td>
                                        <td>
                                            <span class="badge bg-warning bg-opacity-10 text-warning">
                                                <i class="fas fa-clock me-1"></i> Upcoming
                                            </span>
                                        </td>
                                        <td class="text-end pe-4">
                                            <div class="btn-group btn-group-sm">
                                                <button class="btn btn-outline-primary" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="btn btn-outline-danger" title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="ps-4 fw-bold">#OFF-1003</td>
                                        <td>Food Fiesta</td>
                                        <td>Street Food</td>
                                        <td class="fw-bold text-success">15%</td>
                                        <td>1 Jun - 10 Jun 2023</td>
                                        <td>
                                            <span class="badge bg-danger bg-opacity-10 text-danger">
                                                <i class="fas fa-times-circle me-1"></i> Expired
                                            </span>
                                        </td>
                                        <td class="text-end pe-4">
                                            <div class="btn-group btn-group-sm">
                                                <button class="btn btn-outline-primary" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="btn btn-outline-danger" title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                  
                </div>
            </div>
        </main>
        

    </div>

</body>
<script src="../../../public/js/bootstrap.bundle.min.js"></script>

</html>