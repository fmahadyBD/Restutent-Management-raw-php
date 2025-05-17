<?php include 'header.php'; ?>

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

    <?php include 'footer.php'; ?>