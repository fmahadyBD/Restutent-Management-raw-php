<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);
require __DIR__ . '/../../../config/database.php';
session_start();

// 1) Auth check...
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../auth/login.php");
    exit();
}

// 2) POST check...
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['food_id'])) {
    header("Location: index.php?error=invalid_request");
    exit();
}

// 3) Sanitize & validate
$foodId    = (int) $_POST['food_id'];
$foodName  = htmlspecialchars(trim($_POST['food_name'] ?? ''), ENT_QUOTES, 'UTF-8');
$foodPrice = (float) ($_POST['food_price'] ?? 0);

// DEBUG: Print PHP variables to browser console
echo "<script>
    console.log('food_id:', " . json_encode($foodId) . ");
    console.log('food_name:', " . json_encode($foodName) . ");
    console.log('food_price:', " . json_encode($foodPrice) . ");
    console.log('user_id:', " . json_encode($_SESSION['user_id']) . ");
</script>";

// 4) Validate inputs and redirect if invalid
if ($foodId <= 0 || empty($foodName) || $foodPrice <= 0) {
    header("Location: index.php?error=invalid_data");
    exit();
}

// 5) Check availability
$checkStmt = $conn->prepare("SELECT id FROM food WHERE id = ? AND status = 'Available'");
if (!$checkStmt) {
    error_log("Check prepare failed: " . $conn->error);
    header("Location: index.php?error=db_check_prepare");
    exit();
}
$checkStmt->bind_param("i", $foodId);
if (!$checkStmt->execute()) {
    error_log("Check execute failed: " . $checkStmt->error);
    header("Location: index.php?error=db_check_execute");
    exit();
}
if ($checkStmt->get_result()->num_rows === 0) {
    header("Location: index.php?error=item_unavailable");
    exit();
}

// 6) Insert order
$status   = 'pending';
$customer = $_SESSION['user_id'];
$items    =  1;
$total    = $foodPrice;

$stmt = $conn->prepare("INSERT INTO orders (status, customer, items, total) VALUES (?, ?, ?, ?)");
if (!$stmt) {
    error_log("Insert prepare failed: " . $conn->error);
    header("Location: index.php?error=db_insert_prepare");
    exit();
}
$stmt->bind_param("sssd", $status, $customer, $items, $total);
if (!$stmt->execute()) {
    error_log("Insert execute failed: " . $stmt->error);
    header("Location: index.php?error=db_insert_execute");
    exit();
}

header("Location: index.php?success=ordered");
exit();
?>
