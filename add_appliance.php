<?php
/**
 * add_appliance.php - Add New Appliance
 * 
 * Allows users to register their appliances and their power ratings (Watts).
 */

session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$success = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $name = $_POST['name'];
    $watts = $_POST['watts'];

    $sql = "INSERT INTO appliances (user_id, name, watts) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isi", $user_id, $name, $watts);

    if ($stmt->execute()) {
        $success = "Appliance added successfully!";
    } else {
        $error = "Failed to add appliance.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Appliance - PowerVision</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav>
        <h1>PowerVision</h1>
        <div>
            <a href="dashboard.php">Dashboard</a>
            <a href="add_appliance.php">Appliances</a>
            <a href="log_usage.php">Log Usage</a>
            <a href="profile.php">Profile</a>
            <a href="logout.php">Logout</a>
        </div>
    </nav>

    <div class="form-container">
        <h2>Add New Appliance</h2>

        <?php if($success): ?>
            <div class="alert" style="background-color: #e8f5e9; color: #2e7d32;"><?php echo $success; ?></div>
        <?php endif; ?>

        <form action="add_appliance.php" method="POST">
            <div class="form-group">
                <label>Appliance Name</label>
                <input type="text" name="name" required placeholder="e.g. Fridge, Flat Iron">
            </div>
            <div class="form-group">
                <label>Power Rating (Watts)</label>
                <input type="number" name="watts" required placeholder="e.g. 1500">
            </div>
            <button type="submit" class="btn">Save Appliance</button>
        </form>
        <p class="text-center mt-1"><a href="dashboard.php">Back to Dashboard</a></p>
    </div>
</body>
</html>
