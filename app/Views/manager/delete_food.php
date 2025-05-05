<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include __DIR__ . '/../../../config/database.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $stmt = $conn->prepare("DELETE FROM food WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: food.php?msg=Item+Deleted");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    echo "Invalid ID!";
}
?>
