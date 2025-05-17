<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../auth/login.php");
    exit;
}
// Correct include path (using absolute path)
include __DIR__ . '/../../../config/database.php';
?>

<?php include 'header.php'; ?>
        <!-- Main Content -->
        <main class="flex-grow-1 p-4">
            <div class="container py-5">
                <div class="card shadow-sm">
                    <div class="card-header bg-white py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0 fw-bold">Menu Items</h5>
                            <a href="new_food.php" class="btn btn-outline-primary">
                                <i class="fas fa-plus me-1"></i> Add Item
                            </a>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="ps-4">ID</th>
                                        <th>Item Name</th>
                                        <th>Category</th>
                                        <th>Price</th>
                                        <th>Status</th>
                                        <th>Image</th>
                                        <th class="text-end pe-4">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $result = $conn->query("SELECT * FROM food");
                                    while ($row = $result->fetch_assoc()):
                                    ?>
                                    <tr>
                                        <td><?= $row['id'] ?></td>
                                        <td><?= $row['name'] ?></td>
                                        <td><?= $row['category'] ?></td>
                                        <td><?= $row['price'] ?></td>
                                        <td><?= $row['status'] ?></td>
                                        <td>
                                            <?php if ($row['image']): ?>
                                                <img src="../../../storage/<?= $row['image'] ?>" width="100">
                                            <?php else: ?>
                                                No Image
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-end pe-4">
                                            <div class="btn-group">
                                                <button class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-success">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <!-- Delete Button -->
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

        <!-- Delete Confirmation Modal -->
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-danger text-white">
            <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            Are you sure you want to delete this item?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <a href="#" id="confirmDeleteBtn" class="btn btn-danger">Delete</a>
          </div>
        </div>
      </div>
    </div>


    <script src="../../../public/js/bootstrap.bundle.min.js"></script>

    <script>
    var deleteModal = document.getElementById('deleteModal');
    deleteModal.addEventListener('show.bs.modal', function (event) {
      var button = event.relatedTarget; // Button that triggered modal
      var id = button.getAttribute('data-id'); // Get id from data-id

      var confirmBtn = document.getElementById('confirmDeleteBtn');
      confirmBtn.href = 'delete_food.php?id=' + id; // Set delete link
    });
    </script>
</body>

</html>
