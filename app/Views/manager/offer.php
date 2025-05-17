<?php include 'header.php'; ?>

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

    <?php include 'footer.php'; ?>