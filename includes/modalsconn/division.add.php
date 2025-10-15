<?php
session_start();
require_once '../conn.php';

$db = new DBConnection();
$conn = $db->conn;

// Get and sanitize inputs
$division_name = trim($_POST['division_name'] ?? '');
$designation = trim($_POST['designation'] ?? '');
$division_chief = trim($_POST['division_chief'] ?? '');
$position = trim($_POST['position'] ?? '');


// Basic validation
if (empty($division_name) || empty($designation)) {
    $_SESSION['error'] = "All fields are required.";
    header("Location: ../index.php?page=managedivision");
    exit;
}

// Insert into database
$stmt = $conn->prepare("INSERT INTO tbl_division (division_name, designation, division_chief, position) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $division_name, $designation, $division_chief, $position);

if ($stmt->execute()) {
    $_SESSION['success'] = "Division created successfully.";
} else {
    $_SESSION['error'] = "Failed to Create Division. Maybe Division already exists.";
}

$stmt->close();
$conn->close();

header("Location: ../index.php?page=managedivision");
exit;
