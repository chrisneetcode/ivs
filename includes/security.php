<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Generate CSRF token if it doesn't exist
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Optional: Block unauthenticated users
function require_login() {
    $currentScript = basename($_SERVER['SCRIPT_NAME']);
    if ($currentScript === 'login.php') {
        return; // Skip redirect to avoid looping on the login page
    }

    if (!isset($_SESSION['username'])) {
        header("Location: /ivs/user/login.php"); 
        exit();
    }
}


// Validate CSRF token on form submission
function validate_csrf() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            $_SESSION['error'] = "Invalid CSRF token.";
            header("Location: /ivs/index.php?page=dashboard"); // or wherever you want to redirect
            exit();
        }
    }
}
?>
