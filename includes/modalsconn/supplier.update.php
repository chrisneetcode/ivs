<?php
session_start();
require_once '../conn.php';

$db = new DBConnection();
$conn = $db->conn;

// Get and sanitize inputs
$supplier_id     = trim($_POST['supplier_id'] ?? '');
$supplier_name   = trim($_POST['supplier_name'] ?? '');
$contact_person  = trim($_POST['contact_person'] ?? '');
$mobile_number   = trim($_POST['mobile_number'] ?? '');
$tin             = trim($_POST['tin'] ?? '');

// Basic validation
if (empty($supplier_id) || empty($supplier_name) || empty($contact_person) || empty($mobile_number) || empty($tin)) {
    $_SESSION['error'] = "All fields are required.";
    header("Location: ../index.php?page=managesupplier");
    exit;
}

// Update the supplier data
$stmt = $conn->prepare("UPDATE tbl_supplier SET supplier_name = ?, contact_person = ?, mobile_number = ?, tin = ? WHERE supplier_id = ?");
$stmt->bind_param("ssssi", $supplier_name, $contact_person, $mobile_number, $tin, $supplier_id);

if ($stmt->execute()) {
    $_SESSION['success'] = "Supplier updated successfully.";
} else {
    $_SESSION['error'] = "Failed to update supplier. Please try again.";
}

$stmt->close();
$conn->close();

header("Location: ../index.php?page=managesupplier");
exit;
