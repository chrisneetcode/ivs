<?php
session_start();
require_once '../conn.php';

$db = new DBConnection();
$conn = $db->conn;

// Get submitted data
$division_id = trim($_POST['division_id'] ?? '');
$name = trim($_POST['division_name'] ?? '');
$designation = trim($_POST['designation'] ?? '');
$division_chief = trim($_POST['division_chief'] ?? '');
$position = trim($_POST['position'] ?? '');

// Basic validation
if (empty($division_id) || empty($name) || empty($designation) || empty($division_chief) || empty($position)) {
    $_SESSION['error'] = "All fields are required.";
    header("Location: ../../index.php?page=managedivision");
    exit;
}

$stmt = $conn->prepare("UPDATE tbl_division SET division_name=?, designation=?, division_chief=?, position=? WHERE division_id=?");
$stmt->bind_param("ssiss", $name, $designation, $division_id, $division_chief, $position);

if ($stmt->execute()) {
    $_SESSION['success'] = "Division Information has been Updated Successfully.";
} else {
    $_SESSION['error'] = "Failed to update division. Please check inputs or try again.";
}


$stmt->close();
$conn->close();

header("Location: ../../index.php?page=managedivision");
exit;
