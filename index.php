<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: /ivs/user/login.php");
    exit;
}

$page = $_GET['page'] ?? 'dashboard';

// Sanitize the input to prevent directory traversal
$page = basename($page);

// Full path to the expected page
$template = __DIR__ . "/templates/{$page}.php";

// Check if it exists
if (file_exists($template)) {
    include $template;
} else {
    // fallback to custom 404 page
    include __DIR__ . "/404.php";
}
