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
$date_added       = date('Y-m-d'); 

// Basic validation
if (
    empty($item_name) || empty($description) || empty($unit) ||
    empty($fund_cluster) || $initial_quantity < 0 || $critical_level < 0 || empty($date_added)
) {
    $_SESSION['error'] = "All fields are required.";
    header("Location: ../index.php?page=manageitems");
    exit;
}

$stmt = $conn->prepare("
    INSERT INTO tbl_item 
    (item_name, description, unit, fund_cluster, initial_quantity, critical_level, date_added)
    VALUES (?, ?, ?, ?, ?, ?, ?)
");

$stmt->bind_param(
    "ssssiis",  // 4 strings, 2 integers, 1 string
    $item_name,
    $description,
    $unit,
    $fund_cluster,
    $initial_quantity,
    $critical_level,
    $date_added
);

if ($stmt->execute()) {
    $_SESSION['success'] = "Item added successfully.";
} else {
    $_SESSION['error'] = "Failed to add item. It might already exist or there's a DB error.";
}

$stmt->close();
$conn->close();

header("Location: ../index.php?page=manageitems");
exit;
