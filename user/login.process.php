<?php
session_start();
require_once '../includes/conn.php';

$db = new DBConnection();
$conn = $db->conn;

$username = trim($_POST['username'] ?? '');
$password = trim($_POST['password'] ?? '');

if (empty($username) || empty($password)) {
    $_SESSION['login_error'] = "Please enter both username and password.";
    header("Location: login.php");
    exit;
}

$stmt = $conn->prepare("SELECT id, username, password, userlevel FROM tbl_user WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['userlevel'] = $user['userlevel'];
    header("Location: ../index.php?page=dashboard");
    exit;
} else {
    $_SESSION['login_error'] = "Invalid username or password.";
    header("Location: login.php");
    exit;
}
