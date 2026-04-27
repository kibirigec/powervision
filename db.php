<?php
/**
 * db.php - Database Connection
 * 
 * This file handles the connection to the MySQL database.
 * We use the MySQLi extension which is beginner-friendly and built into PHP.
 */

// Database configuration with fallback for local XAMPP vs Live Server (Railway)
$host = getenv('MYSQLHOST') ?: 'localhost';
$user = getenv('MYSQLUSER') ?: 'root';
$pass = getenv('MYSQLPASSWORD') ?: '';
$db = getenv('MYSQLDATABASE') ?: 'electricity_tracker';
$port = getenv('MYSQLPORT') ?: 3306;

// Create connection using the port
$conn = new mysqli($host, $user, $pass, $db, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
