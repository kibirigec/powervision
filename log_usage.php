<?php
/**
 * log_usage.php - Log Appliance Usage
 * 
 * Users select an appliance and enter how many hours it was used.
 */

session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$success = "";

// Fetch user's appliances for the dropdown
$sql_apps = "SELECT * FROM appliances WHERE user_id = ?";
$stmt_apps = $conn->prepare($sql_apps);
$stmt_apps->bind_param("i", $user_id);
$stmt_apps->execute();
$appliances = $stmt_apps->get_result();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $app_id = $_POST['appliance_id'];
    $hours = $_POST['hours'];

    $sql = "INSERT INTO usage_logs (appliance_id, hours_used) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("id", $app_id, $hours);

    if ($stmt->execute()) {
        $success = "Usage logged successfully!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log Usage - PowerVision</title>
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
        <h2>Log Daily Usage</h2>

        <?php if($success): ?>
            <div class="alert" style="background-color: #e8f5e9; color: #2e7d32;"><?php echo $success; ?></div>
        <?php endif; ?>

        <form action="log_usage.php" method="POST">
            <div class="form-group">
                <label>Select Appliance</label>
                <select name="appliance_id" required style="width: 100%; padding: 0.8rem; border-radius: 4px; border: 1px solid #ddd;">
                    <option value="">-- Choose Appliance --</option>
                    <?php while($app = $appliances->fetch_assoc()): ?>
                        <option value="<?php echo $app['id']; ?>"><?php echo htmlspecialchars($app['name'] ?? $app['NAME'] ?? ''); ?> (<?php echo $app['watts']; ?>W)</option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="form-group">
                <label>Hours Used Today</label>
                <input type="number" step="0.1" name="hours" required placeholder="e.g. 5.5">
            </div>
            <button type="submit" class="btn btn-secondary">Record Usage</button>
        </form>
        <p><a href="dashboard.php">Back to Dashboard</a></p>
    </div>
</body>
</html>
