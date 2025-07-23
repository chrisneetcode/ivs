<?php
session_start();
require_once '../conn.php';

$db = new DBConnection();
$conn = $db->conn;

// Get and sanitize inputs
$supplier_name = trim($_POST['supplier_name'] ?? '');
$item = trim($_POST['item'] ?? '');
$description = trim($_POST['description'] ?? '');
$unit_of_measure = trim($_POST['unit_of_measure'] ?? '');
$quantity = trim($_POST['quantity'] ?? '');
$price = trim($_POST['price'] ?? '');
$fund_cluster = trim($_POST['fund_cluster'] ?? '');
$contact_person = trim($_POST['contact_person'] ?? '');
$mobile_number = trim($_POST['mobile_number'] ?? '');
$tin = trim($_POST['tin'] ?? '');

// Validation
if (
    empty($supplier_name) || empty($item) || empty($description) || empty($unit_of_measure)||
    empty($quantity) || empty($fund_cluster) || empty($price)||
    empty($contact_person) || empty($mobile_number) || empty($tin)
) {
    $_SESSION['supplier_error'] = "All fields are required.";
    header("Location: ../index.php?page=managesupplier");
    exit;
}

// Insert
$stmt = $conn->prepare("INSERT INTO tbl_supplier (supplier_name, item, description, unit_of_measure, quantity, fund_cluster, price, contact_person, mobile_number, tin) VALUES (?, ?,?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssssssss", $supplier_name, $item, $description, $unit_of_measure,  $quantity, $fund_cluster, $price, $contact_person, $mobile_number, $tin);

if ($stmt->execute()) {
    $_SESSION['supplier_success'] = "Supplier created successfully.";
} else {
    $_SESSION['supplier_error'] = "Failed to create supplier. Please check inputs or try again.";
}

$stmt->close();
$conn->close();

header("Location: ../index.php?page=managesupplier");
exit;
