<?php
/**
 * db.php - Database Connection
 * 
 * This file handles the connection to the MySQL database.
 * We use the MySQLi extension which is beginner-friendly and built into PHP.
 */

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Helper function to safely get environment variables across different server configs
function get_env_var($key, $default = '') {
    $val = getenv($key);
    if ($val !== false && $val !== '') return $val;
    if (isset($_ENV[$key]) && $_ENV[$key] !== '') return $_ENV[$key];
    if (isset($_SERVER[$key]) && $_SERVER[$key] !== '') return $_SERVER[$key];
    return $default;
}

// Database configuration with fallback for local XAMPP vs Live Server (Railway)
$host = get_env_var('MYSQLHOST', 'localhost');
$user = get_env_var('MYSQLUSER', 'root');
$pass = get_env_var('MYSQLPASSWORD', '');

// Automatically detect if we are on Railway (where default DB is 'railway') or local XAMPP
$db = get_env_var('MYSQLDATABASE');
if (!$db) {
    $db = get_env_var('MYSQLHOST') ? 'railway' : 'electricity_tracker';
}

$port = get_env_var('MYSQLPORT') ? (int)get_env_var('MYSQLPORT') : 3306;

try {
    // Create connection using the port
    $conn = new mysqli($host, $user, $pass, $db, $port);

    // Check connection
    if ($conn->connect_error) {
        die("<h2>Database Connection Failed!</h2><p>Error: " . $conn->connect_error . "</p>");
    }
} catch (Exception $e) {
    die("<h2>Database Connection Failed!</h2>
         <p>It looks like the app cannot connect to the MySQL database.</p>
         <p><b>Error Details:</b> " . $e->getMessage() . "</p>
         <p><i>If you are on Railway, make sure you went to your PHP App -> Variables tab and added the Reference variables for MYSQLHOST, MYSQLUSER, MYSQLPASSWORD, MYSQLDATABASE, and MYSQLPORT.</i></p>");
}
?>
