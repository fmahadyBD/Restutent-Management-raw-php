<?php
include __DIR__ . '/../../../config/database.php'; // Make sure this is included at the top
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../auth/login.php");
    exit;
}

?>
<?php include 'header.php'; ?>
        <main class="flex-grow-1 p-4">
            <div class="container py-4">
                <div class="card shadow-sm">
                    <div class="card-header bg-white py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0 fw-bold">Customer Records</h5>
                            <button class="btn btn-primary btn-sm">
                                <i class="fas fa-plus me-1"></i> Add New
                            </button>
                        </div>
                    </div>

                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="ps-4">ID</th>
                                        <th>Fname</th>
                                        <th>Lname</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Address</th>
                                        <th class="text-end pe-4">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                
                                    <?php
                                    $result = $conn->query("SELECT * FROM users WHERE LOWER(role) = 'user'");
                                    while ($row = $result->fetch_assoc()):
                                    ?>
                                        <tr>
                                            <td><?= $row['id'] ?></td>
                                            <td><?= $row['fname'] ?></td>
                                            <td><?= $row['lname'] ?></td>
                                            <td><?= $row['email'] ?></td>
                                            <td><?= $row['mobile'] ?></td>
                                            <td><?= $row['address'] ?></td>
                                            <td class="text-end pe-4">
                                                <div class="btn-group">
                                                    <button class="btn btn-sm btn-outline-primary">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-outline-success">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-outline-danger" 
                                                        data-bs-toggle="modal" 
                                                        data-bs-target="#deleteModal" 
                                                        data-id="<?= $row['id'] ?>">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    Are you sure you want to delete this user?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <a href="" id="confirmDeleteBtn" class="btn btn-danger">Delete</a>
                </div>
            </div>
        </div>
    </div>

</body>

<script src="../../../public/js/bootstrap.bundle.min.js"></script>

<script>
    var deleteModal = document.getElementById('deleteModal');
    deleteModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var id = button.getAttribute('data-id');
        var confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
        confirmDeleteBtn.href = 'delete_user.php?id=' + id;
    });
</script>
</html>
