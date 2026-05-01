<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

if (isset($_GET['id'])) {
    $log_id = $_GET['id'];
    $user_id = $_SESSION['user_id'];

    // Ensure the log belongs to an appliance owned by the user
    $sql = "DELETE l FROM usage_logs l 
            JOIN appliances a ON l.appliance_id = a.id 
            WHERE l.id = ? AND a.user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $log_id, $user_id);
    
    if ($stmt->execute()) {
        header("Location: dashboard.php?msg=Usage log deleted");
    } else {
        header("Location: dashboard.php?err=Could not delete log");
    }
} else {
    header("Location: dashboard.php");
}
exit();
?>
