<?php
/**
 * db.php - Database Connection
 * 
 * This file handles the connection to the MySQL database.
 * We use the MySQLi extension which is beginner-friendly and built into PHP.
 */

$host = "localhost";
$username = "root";
$password = ""; // Default XAMPP/WAMP password is empty
$dbname = "electricity_tracker";

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
