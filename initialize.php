<?php
// Developer data (for fallback or debug use)
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

// App root path (for internal PHP includes)
if (!defined('base_app')) define('base_app', str_replace('\\', '/', __DIR__) . '/');

// Static base URL (reliable for all pages/assets)
if (!function_exists('base_url')) {
    function base_url($path = '') {
        return '/ivs/' . ltrim($path, '/');
    }
}

// Database config
if (!defined('DB_SERVER'))   define('DB_SERVER', 'localhost');
if (!defined('DB_USERNAME')) define('DB_USERNAME', 'root');
if (!defined('DB_PASSWORD')) define('DB_PASSWORD', '');
if (!defined('DB_NAME'))     define('DB_NAME', 'ims_db');
