<?php
require_once __DIR__ . '/initialize.php';

// Optional helper to echo base_url easily
function asset($path = '') {
    echo base_url($path);
}
