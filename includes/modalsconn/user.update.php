<?php
session_start();
require_once '../conn.php';

$db = new DBConnection();
$conn = $db->conn;

// Get submitted data
$user_id = trim($_POST['user_id'] ?? '');
$username = trim($_POST['username'] ?? '');
$password = trim($_POST['password'] ?? '');
$userlevel = trim($_POST['userlevel'] ?? '');

// Basic validation
if (empty($user_id) || empty($username) || empty($userlevel)) {
    $_SESSION['user_error'] = "All fields (except password) are required.";
    header("Location: ../../index.php?page=manageuser");
    exit;
}

// Build update query
if (!empty($password)) {
    // Hash new password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("UPDATE tbl_user SET username = ?, password = ?, userlevel = ? WHERE id = ?");
    $stmt->bind_param("sssi", $username, $hashedPassword, $userlevel, $user_id);
} else {
    // Keep old password
    $stmt = $conn->prepare("UPDATE tbl_user SET username = ?, userlevel = ? WHERE id = ?");
    $stmt->bind_param("ssi", $username, $userlevel, $user_id);
}

if ($stmt->execute()) {
    $_SESSION['user_success'] = "User updated successfully.";
} else {
    $_SESSION['user_error'] = "Failed to update user. Username may already exist.";
}

$stmt->close();
$conn->close();

header("Location: ../../index.php?page=manageuser");
exit;
