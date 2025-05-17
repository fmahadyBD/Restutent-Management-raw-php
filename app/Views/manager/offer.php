<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../auth/login.php");
    exit;
}
include __DIR__ . '/../../../config/database.php'; // DB connection
// include 'header.php'; // include header

$errors = [];

// Handle form submission for creating an offer
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $category = trim($_POST['category'] ?? '');
    $discount = (int)($_POST['discount'] ?? 0);
    $start = $_POST['start'] ?? '';
    $end = $_POST['end'] ?? '';

    // Validation
    if ($name === '') $errors[] = "Offer Name is required";
    if ($category === '') $errors[] = "Category is required";
    if ($discount < 0 || $discount > 100) $errors[] = "Discount must be between 0 and 100";
    if ($start === '') $errors[] = "Start Date is required";
    if ($end === '') $errors[] = "End Date is required";
    if ($start !== '' && $end !== '' && $start > $end) $errors[] = "Start Date cannot be after End Date";

    $today = date('Y-m-d');
    if (empty($errors)) {
        if ($today >= $start && $today <= $end) {
            $status = 'active';
        } elseif ($today < $start) {
            $status = 'upcoming';
        } else {
            $status = 'expired';
        }

        $stmt = $conn->prepare("INSERT INTO offer (name, category, discount, start, end, status) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssisss", $name, $category, $discount, $start, $end, $status);
        $stmt->execute();
        $stmt->close();

        // Redirect to avoid resubmission
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }
}

// Handle deletion via GET param ?delete_id=ID
if (isset($_GET['delete_id'])) {
    $delete_id = (int)$_GET['delete_id'];
    if ($delete_id > 0) {
        $stmt = $conn->prepare("DELETE FROM offer WHERE id = ?");
        $stmt->bind_param("i", $delete_id);
        $stmt->execute();
        $stmt->close();

        // Redirect to avoid repeat delete on refresh
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }
}

// Fetch offers ordered by start date descending
$result = $conn->query("SELECT * FROM offer ORDER BY start DESC");

// Function to display status badges with icons and colors
function statusBadge($status) {
    switch ($status) {
        case 'active':
            return '<span class="badge bg-success bg-opacity-10 text-success"><i class="fas fa-check-circle me-1"></i> Active</span>';
        case 'upcoming':
            return '<span class="badge bg-warning bg-opacity-10 text-warning"><i class="fas fa-clock me-1"></i> Upcoming</span>';
        case 'expired':
            return '<span class="badge bg-danger bg-opacity-10 text-danger"><i class="fas fa-times-circle me-1"></i> Expired</span>';
        default:
            return '<span class="badge bg-secondary">Unknown</span>';
    }
}
?>

<?php include 'header.php'; ?>
<main class="flex-grow-1 p-4">
    <div class="container py-4">

        <!-- Create Offer Card -->
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0 fw-bold">
                    <i class="fas fa-tag me-2 text-primary"></i>Create New Offer
                </h5>
            </div>
            <div class="card-body">
                <?php if (!empty($errors)): ?>
                    <div class="alert alert-danger">
                        <ul>
                            <?php foreach ($errors as $err): ?>
                                <li><?= htmlspecialchars($err) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
                <form method="POST" novalidate>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label" for="offerName">Offer Name</label>
                            <input id="offerName" name="name" type="text" class="form-control" placeholder="Enter offer name" value="<?= htmlspecialchars($_POST['name'] ?? '') ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="offerCategory">Category</label>
                            <select id="offerCategory" name="category" class="form-select" required>
                                <option value="" disabled <?= !isset($_POST['category']) ? 'selected' : '' ?>>Select category</option>
                                <?php
                                $categories = ['Traditional Bengali Cuisine', 'Street Food', 'Biriyani and Kacchi Specialist', 'Drinks'];
                                foreach ($categories as $cat): ?>
                                    <option value="<?= htmlspecialchars($cat) ?>" <?= (isset($_POST['category']) && $_POST['category'] === $cat) ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($cat) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="discount">Discount Percentage</label>
                            <div class="input-group">
                                <input id="discount" name="discount" type="number" min="0" max="100" class="form-control" placeholder="0-100" value="<?= htmlspecialchars($_POST['discount'] ?? '') ?>">
                                <span class="input-group-text">%</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="startDate">Start Date</label>
                            <input id="startDate" name="start" type="date" class="form-control" value="<?= htmlspecialchars($_POST['start'] ?? '') ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="endDate">End Date</label>
                            <input id="endDate" name="end" type="date" class="form-control" value="<?= htmlspecialchars($_POST['end'] ?? '') ?>">
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

        <!-- Offers List Card -->
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
                            <?php if ($result && $result->num_rows > 0): ?>
                                <?php while ($row = $result->fetch_assoc()): ?>
                                    <tr>
                                        <td class="ps-4 fw-bold">#OFF-<?= htmlspecialchars($row['id'] + 1000) ?></td>
                                        <td><?= htmlspecialchars($row['name']) ?></td>
                                        <td><?= htmlspecialchars($row['category']) ?></td>
                                        <td class="fw-bold text-success"><?= htmlspecialchars($row['discount']) ?>%</td>
                                        <td><?= date('d M', strtotime($row['start'])) ?> - <?= date('d M Y', strtotime($row['end'])) ?></td>
                                        <td><?= statusBadge($row['status']) ?></td>
                                        <td class="text-end pe-4">
                                            <div class="btn-group btn-group-sm">
                                                <!-- Disabled Edit button -->
                                                <button class="btn btn-outline-primary" title="Edit" disabled>
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <!-- Delete button triggers modal -->
                                                <button class="btn btn-outline-danger" title="Delete"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#deleteModal"
                                                    data-id="<?= htmlspecialchars($row['id']) ?>">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr><td colspan="7" class="text-center py-4">No offers found.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</main>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this offer?
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
  var button = event.relatedTarget;
  var id = button.getAttribute('data-id');

  var confirmBtn = document.getElementById('confirmDeleteBtn');
  confirmBtn.href = '?delete_id=' + id;
});
</script>

<?php
$conn->close();
include 'footer.php';
?>
