<?php
session_start();
require_once '../conn.php';

$db = new DBConnection();
$conn = $db->conn;

// Sanitize inputs
$item_name        = trim($_POST['item_name'] ?? '');
$description      = trim($_POST['description'] ?? '');
$unit             = trim($_POST['unit'] ?? '');
$fund_cluster     = trim($_POST['fund_cluster'] ?? '');
$initial_quantity = intval($_POST['initial_quantity'] ?? 0);
$critical_level   = intval($_POST['critical_level'] ?? 0);
$status           = trim($_POST['status'] ?? '');
$date_added       = date('Y-m-d'); // Current date

// Basic validation
if (
    empty($item_name) || empty($description) || empty($unit) ||
    empty($fund_cluster) || $initial_quantity < 0 ||
    $critical_level < 0 || empty($status)
) {
    $_SESSION['item_error'] = "All fields are required.";
    header("Location: ../index.php?page=manageitems");
    exit;
}

// Insert into database
$stmt = $conn->prepare("
    INSERT INTO tbl_item 
    (item_name, description, unit, fund_cluster, initial_quantity, critical_level, date_added, status)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?)
");
$stmt->bind_param(
    "ssssiiss",
    $item_name,
    $description,
    $unit,
    $fund_cluster,
    $initial_quantity,
    $critical_level,
    $date_added,
    $status
);

if ($stmt->execute()) {
    $_SESSION['item_success'] = "Item added successfully.";
} else {
    $_SESSION['item_error'] = "Failed to add item. It might already exist or there's a DB error.";
}

$stmt->close();
$conn->close();

header("Location: ../index.php?page=manageitems");
exit;
