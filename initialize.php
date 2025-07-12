<?php
$dev_data = [
    'id' => '-1',
    'firstname' => 'Developer',
    'lastname' => '',
    'username' => 'dev_oretnom',
    'password' => '5da283a2d990e8d8512cf967df5bc0d0',
    'last_login' => '',
    'date_updated' => '',
    'date_added' => ''
];
if (!defined('dev_data')) define('dev_data', $dev_data);

// Application root path (used for internal includes)
if (!defined('base_app')) define('base_app', str_replace('\\', '/', __DIR__) . '/');

// Base URL generator (dynamic path based on current location)
if (!function_exists('base_url')) {
    function base_url($path = '') {
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https://" : "http://";
        $host = $_SERVER['HTTP_HOST'];
        $dir = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
        return $protocol . $host . $dir . '/' . ltrim($path, '/');
    }
}

// Database configuration
if (!defined('DB_SERVER')) define('DB_SERVER', 'localhost');
if (!defined('DB_USERNAME')) define('DB_USERNAME', 'root');
if (!defined('DB_PASSWORD')) define('DB_PASSWORD', '');
if (!defined('DB_NAME')) define('DB_NAME', 'ims_db');
