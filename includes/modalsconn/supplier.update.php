<?php
session_start();
require_once '../conn.php';

$db = new DBConnection();
$conn = $db->conn;

$supplier_id = $_POST['supplier_id'] ?? null;
$supplier_name = ($_POST['supplier_name'] ?? '');
$item = ($_POST['item'] ?? '');
$description = ($_POST['description'] ?? '');
$unit_of_measure = ($_POST['unit_of_measure'] ?? '');
$quantity = ($_POST['quantity'] ?? '');
$price = ($_POST['price'] ?? '');
$fund_cluster = ($_POST['fund_cluster'] ?? '');
$contact_person = ($_POST['contact_person'] ?? '');
$mobile_number = ($_POST['mobile_number'] ?? '');
$tin = ($_POST['tin'] ?? '');

if (
    empty($supplier_id) || empty($supplier_name) || empty($item) || empty($description) || empty($unit_of_measure) ||
    empty($quantity) || empty($price) || empty($fund_cluster) ||
    empty($contact_person) || empty($mobile_number) || empty($tin)
) {
    $_SESSION['supplier_error'] = "All fields are required.";
    header("Location: ../index.php?page=managesupplier");
    exit;
}

$stmt = $conn->prepare("UPDATE tbl_supplier SET supplier_name=?, item=?, description=?, unit_of_measure=?, quantity=?, fund_cluster=?, price=?, contact_person=?, mobile_number=?, tin=? WHERE id=?");
$stmt->bind_param("ssssssssssi", $supplier_name, $item, $description, $unit_of_measure, $quantity, $fund_cluster, $price, $contact_person, $mobile_number, $tin, $supplier_id);

if ($stmt->execute()) {
    $_SESSION['supplier_success'] = "Supplier updated successfully.";
} else {
    $_SESSION['supplier_error'] = "Failed to update supplier. Please check inputs or try again.";
}

$stmt->close();
$conn->close();

header("Location: ../index.php?page=managesupplier");
exit;
