<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: /ivs/user/login.php");
    exit;
}

$page = $_GET['page'] ?? 'dashboard';
include "templates/{$page}.php";
