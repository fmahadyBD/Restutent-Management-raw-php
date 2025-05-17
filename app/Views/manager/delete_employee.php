<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include __DIR__ . '/../../../config/database.php';

// Check user login (adjust session check as needed)
if (!isset($_SESSION['user_id'])) {
    header('Location: ../../auth/login.php');
    exit;
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // sanitize input

    // Prepare delete statement only for admins
    $stmt = $conn->prepare("DELETE FROM users WHERE id = ? AND LOWER(role) = 'admin'");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $stmt->close();
        header('Location: employees.php?msg=deleted');
        exit;
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    header('Location: employees.php');
    exit;
}
?>
