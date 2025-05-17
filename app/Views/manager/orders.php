<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../auth/login.php");
    exit;
}
include __DIR__ . '/../../../config/database.php'; // Your DB connection

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

include 'header.php';

$errors = [];
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Expect order_status as associative array: order_status[order_id] = new_status
    $order_statuses = $_POST['order_status'] ?? [];

    $stmt = $conn->prepare("UPDATE orders SET status = ? WHERE id = ?");
    foreach ($order_statuses as $order_id => $status) {
        $status = trim($status);
        $order_id = (int)$order_id;
        // Validate status
        if (!in_array($status, ['pending', 'processing', 'completed', 'cancelled'])) {
            $errors[] = "Invalid status for order #$order_id";
            continue;
        }
        $stmt->bind_param("si", $status, $order_id);
        $stmt->execute();
    }
    $stmt->close();

    if (empty($errors)) {
        $success = "Order statuses updated successfully.";
    }
}

// Fetch orders from DB with correct columns
$result = $conn->query("SELECT id, customer, items, total, status FROM orders ORDER BY id DESC");

function statusOptions($currentStatus, $orderId) {
    $statuses = [
        'pending' => ['class' => 'text-warning', 'icon' => 'fas fa-clock', 'label' => 'Pending'],
        'processing' => ['class' => 'text-primary', 'icon' => 'fas fa-sync-alt', 'label' => 'Processing'],
        'completed' => ['class' => 'text-success', 'icon' => 'fas fa-check-circle', 'label' => 'Completed'],
        'cancelled' => ['class' => 'text-danger', 'icon' => 'fas fa-times-circle', 'label' => 'Cancelled'],
    ];

    $html = '<select name="order_status[' . $orderId . ']" class="form-select form-select-sm">';
    foreach ($statuses as $status => $data) {
        $selected = ($status === $currentStatus) ? 'selected' : '';
        $html .= '<option value="' . $status . '" class="' . $data['class'] . '" ' . $selected . '>';
        $html .= '<i class="' . $data['icon'] . ' me-1"></i> ' . $data['label'];
        $html .= '</option>';
    }
    $html .= '</select>';
    return $html;
}
?>

<main class="flex-grow-1 p-4">
    <div class="container py-4">

        <?php if ($success): ?>
            <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
        <?php endif; ?>

        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php foreach ($errors as $err): ?>
                        <li><?= htmlspecialchars($err) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="" method="POST">
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
                                <?php if ($result && $result->num_rows > 0): ?>
                                    <?php while ($row = $result->fetch_assoc()): ?>
                                        <tr>
                                            <td class="ps-4 fw-bold">#ORD-<?= htmlspecialchars($row['id']) ?></td>
                                            <td><?= htmlspecialchars($row['customer']) ?></td>
                                            <td><?= (int)$row['items'] ?> item<?= ((int)$row['items'] !== 1 ? 's' : '') ?></td>
                                            <td>$<?= number_format((float)$row['total'], 2) ?></td>
                                            <td>
                                                <?= statusOptions($row['status'], $row['id']) ?>
                                            </td>
                                            <td class="text-end pe-4">
                                                <button type="button" class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-eye"></i> View
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <tr><td colspan="6" class="text-center py-4">No orders found.</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </form>
    </div>
</main>

<?php
$conn->close();
include 'footer.php';
?>
