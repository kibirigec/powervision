<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$app_id = $_GET['id'] ?? null;
$error = "";
$success = "";

if (!$app_id) {
    header("Location: dashboard.php");
    exit();
}

// Fetch appliance details
$sql = "SELECT * FROM appliances WHERE id = ? AND user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $app_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();
$app = $result->fetch_assoc();

if (!$app) {
    header("Location: dashboard.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $watts = $_POST['watts'];

    if (!empty($name) && !empty($watts)) {
        $update_sql = "UPDATE appliances SET name = ?, watts = ? WHERE id = ? AND user_id = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("siii", $name, $watts, $app_id, $user_id);
        
        if ($update_stmt->execute()) {
            $success = "Appliance updated successfully!";
            // Update local object to reflect changes in form
            $app['name'] = $name;
            $app['watts'] = $watts;
        } else {
            $error = "Error updating appliance.";
        }
    } else {
        $error = "Please fill in all fields.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Appliance - PowerVision</title>
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
        <h2>Edit Appliance</h2>
        
        <?php if($error): ?>
            <div class="alert"><?php echo $error; ?></div>
        <?php endif; ?>

        <?php if($success): ?>
            <div class="alert" style="background-color: #e8f5e9; color: #2e7d32; border-color: #c8e6c9;"><?php echo $success; ?></div>
        <?php endif; ?>

        <form action="edit_appliance.php?id=<?php echo $app_id; ?>" method="POST">
            <div class="form-group">
                <label>Appliance Name</label>
                <input type="text" name="name" value="<?php echo htmlspecialchars($app['name'] ?? $app['NAME'] ?? ''); ?>" required>
            </div>
            <div class="form-group">
                <label>Wattage (Watts)</label>
                <input type="number" name="watts" value="<?php echo $app['watts']; ?>" required>
            </div>
            <button type="submit" class="btn">Update Appliance</button>
        </form>
        <p class="text-center mt-1"><a href="dashboard.php">Back to Dashboard</a></p>
    </div>
</body>
</html>
