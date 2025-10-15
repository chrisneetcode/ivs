<?php
// Load constants for DB
if (!defined('DB_SERVER')) {
    require_once(__DIR__ . "/../initialize.php"); // Adjust path if needed
}

// Start session once
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// === Load Modular Security (CSRF, login checks, etc.) ===
require_once(__DIR__ . "/security.php");

class DBConnection {
    private $host = DB_SERVER;
    private $username = DB_USERNAME;
    private $password = DB_PASSWORD;
    private $database = DB_NAME;

    public $conn;

    public function __construct() {
        if (!isset($this->conn)) {
            $this->conn = new mysqli($this->host, $this->username, $this->password, $this->database);

            if ($this->conn->connect_error) {
                // Log the error and show a generic message
                error_log("Database connection failed: " . $this->conn->connect_error);
                die("A database error occurred. Please try again later.");
            }
        }
    }

    public function __destruct() {
        if (isset($this->conn)) {
            $this->conn->close();
        }
    }
}
?>
