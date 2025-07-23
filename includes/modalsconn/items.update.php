<?php
session_start();
require_once '../conn.php';

$db = new DBConnection();
$conn = $db->conn;

$item_id = trim($_POST['item_id'] ?? '');
$item_name = trim($_POST['item_name'] ?? '');
$description = trim($_POST['description'] ?? '');
$unit = trim($_POST['unit'] ?? ''); 
$fund_cluster = trim($_POST['fund_cluster'] ?? '');
$initial_quantity = $_POST['initial_quantity'] ?? '';
$critical_level = $_POST['critical_level'] ?? '';

// Basic validation
if (
    empty($item_id) || empty($item_name) || empty($description) ||
    empty($unit) || empty($fund_cluster)
) {
    $_SESSION['error'] = "All fields are required.";
    header("Location: ../../index.php?page=manageitems");
    exit;
}

// Validate numeric values
if (!is_numeric($initial_quantity) || !is_numeric($critical_level)) {
    $_SESSION['error'] = "Quantity and Reorder Point must be numeric.";
    header("Location: ../../index.php?page=manageitems");
    exit;
}

// Cast to integers
$initial_quantity = intval($initial_quantity);
$critical_level = intval($critical_level);

// Prepare and execute update query
$stmt = $conn->prepare("UPDATE tbl_item SET item_name=?, description=?, unit=?, fund_cluster=?, initial_quantity=?, critical_level=? WHERE item_id=?");
$stmt->bind_param("ssssiii", $item_name, $description, $unit, $fund_cluster, $initial_quantity, $critical_level, $item_id);

if ($stmt->execute()) {
    $_SESSION['success'] = "Item updated successfully.";
} else {
    $_SESSION['error'] = "Failed to update item: " . $stmt->error;
}

$stmt->close();
$conn->close();

header("Location: ../../index.php?page=manageitems");
exit;
