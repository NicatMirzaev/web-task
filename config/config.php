<?php
// Database configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'php_project');

// Application configuration
define('SITE_NAME', 'PHP Project');
define('BASE_URL', 'http://localhost/php-project');

// Error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Session start
session_start();

// Time zone
date_default_timezone_set('UTC');
?> 