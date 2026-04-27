<?php
/**
 * logout.php - User Logout
 * 
 * Clears the session and redirects the user back to the login page.
 */

session_start();
session_unset(); // Remove all session variables
session_destroy(); // Destroy the session

header("Location: index.php");
exit();
?>
