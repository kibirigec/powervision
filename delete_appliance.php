<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

if (isset($_GET['id'])) {
    $app_id = $_GET['id'];
    $user_id = $_SESSION['user_id'];

    // Ensure the appliance belongs to the user
    $sql = "DELETE FROM appliances WHERE id = ? AND user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $app_id, $user_id);
    
    if ($stmt->execute()) {
        header("Location: dashboard.php?msg=Appliance deleted");
    } else {
        header("Location: dashboard.php?err=Could not delete appliance");
    }
} else {
    header("Location: dashboard.php");
}
exit();
?>
