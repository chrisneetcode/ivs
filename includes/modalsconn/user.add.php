<?php
session_start();
require_once '../conn.php';

$db = new DBConnection();
$conn = $db->conn;

// Get and sanitize inputs
$username = trim($_POST['username'] ?? '');
$password = trim($_POST['password'] ?? '');
$userlevel = trim($_POST['userlevel'] ?? '');

// Basic validation
if (empty($username) || empty($password) || empty($userlevel)) {
    $_SESSION['user_error'] = "All fields are required.";
    header("Location: ../index.php?page=manageuser");
    exit;
}

// Hash the password securely
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Insert into database
$stmt = $conn->prepare("INSERT INTO tbl_user (username, password, userlevel) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $username, $hashedPassword, $userlevel);

if ($stmt->execute()) {
    $_SESSION['user_success'] = "User created successfully.";
} else {
    $_SESSION['user_error'] = "Failed to create user. Maybe username already exists.";
}

$stmt->close();
$conn->close();

header("Location: ../index.php?page=manageuser");
exit;
