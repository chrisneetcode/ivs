<?php
session_start();
require_once '../conn.php';

$db = new DBConnection();
$conn = $db->conn;

// Get and sanitize inputs
$supplier_name = trim($_POST['supplier_name'] ?? '');
$contact_person = trim($_POST['contact_person'] ?? '');
$mobile_number = trim($_POST['mobile_number'] ?? '');
$tin = trim($_POST['tin'] ?? '');
$date_added = trim($_POST['date_added'] ?? '');

// Basic validation
if (empty($supplier_name) || empty($contact_person) || empty($mobile_number) || empty($tin) || empty($date_added)) {
    $_SESSION['supplier_error'] = "All fields are required.";
    header("Location: ../index.php?page=managesupplier");
    exit;
}

// Insert into database
$stmt = $conn->prepare("INSERT INTO tbl_supplier (supplier_name, contact_person, mobile_number, tin, date_added) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $supplier_name, $contact_person, $mobile_number, $tin, $date_added);

if ($stmt->execute()) {
    $_SESSION['supplier_success'] = "Supplier added successfully.";
} else {
    $_SESSION['supplier_error'] = "Failed to add supplier. Please try again.";
}

$stmt->close();
$conn->close();

header("Location: ../index.php?page=managesupplier");
exit;
