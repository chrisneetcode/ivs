<?php
session_start();
require_once '../conn.php';

$db = new DBConnection();
$conn = $db->conn;

// Get and sanitize form inputs
$item_id = trim($_POST['item_id'] ?? '');
$quantity_received = trim($_POST['quantity_received'] ?? '');
$price = trim($_POST['price'] ?? '');
$supplier_id = trim($_POST['supplier_id'] ?? '');
$date_received = trim($_POST['date_received'] ?? '');
$fund_cluster = trim($_POST['fund_cluster'] ?? '');
$remarks = trim($_POST['remarks'] ?? '');
$received_by = trim($_POST['received_by'] ?? '');

// Basic validation
if (empty($item_id) || empty($quantity_received) || empty($price) || empty($supplier_id) || empty($date_received) || empty($fund_cluster)) {
    $_SESSION['error'] = "Please fill in all required fields.";
    header("Location: ../../index.php?page=stock-in-entry");
    exit();
}

// Start transaction
$conn->begin_transaction();

try {
    // Insert into tbl_stock_entry with quantity_received
    $stmt = $conn->prepare("INSERT INTO tbl_stock_entry 
        (item_id, quantity_received, price, supplier_id, date_received, fund_cluster, remarks, received_by)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("iidissss", $item_id, $quantity_received, $price, $supplier_id, $date_received, $fund_cluster, $remarks, $received_by);
    $stmt->execute();
    $stmt->close();

    // Update tbl_item initial_quantity = initial_quantity + quantity_received
    $update = $conn->prepare("UPDATE tbl_item SET initial_quantity = initial_quantity + ? WHERE item_id = ?");
    $update->bind_param("ii", $quantity_received, $item_id);
    $update->execute();
    $update->close();

    $conn->commit();
    $_SESSION['success'] = "Stock entry added and item quantity updated successfully.";
} catch (Exception $e) {
    $conn->rollback();
    $_SESSION['error'] = "Transaction failed: " . $e->getMessage();
}

$conn->close();
header("Location: ../../index.php?page=stock-in-entry");
exit();
