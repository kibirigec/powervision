<?php
/**
 * dashboard.php - User Dashboard
 * 
 * Displays total usage, estimated costs, and lists appliances and recent logs.
 */

session_start();
require 'db.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$tariff = 750; // UGX per kWh

// 1. Calculate Total Energy Usage (kWh)
// Formula: SUM( (Watts * Hours) / 1000 )
$sql_usage = "SELECT SUM((a.watts * l.hours_used) / 1000) as total_kwh 
              FROM usage_logs l 
              JOIN appliances a ON l.appliance_id = a.id 
              WHERE a.user_id = ?";
$stmt = $conn->prepare($sql_usage);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result_usage = $stmt->get_result();
$row_usage = $result_usage->fetch_assoc();
$total_kwh = $row_usage['total_kwh'] ?? 0;
$total_cost = $total_kwh * $tariff;

// 2. Get list of user's appliances
$sql_apps = "SELECT * FROM appliances WHERE user_id = ?";
$stmt_apps = $conn->prepare($sql_apps);
$stmt_apps->bind_param("i", $user_id);
$stmt_apps->execute();
$appliances = $stmt_apps->get_result();

// 3. Get recent usage logs
$sql_logs = "SELECT l.id, a.name, l.hours_used, l.log_date, ((a.watts * l.hours_used) / 1000) as kwh_used 
             FROM usage_logs l 
             JOIN appliances a ON l.appliance_id = a.id 
             WHERE a.user_id = ? 
             ORDER BY l.id DESC LIMIT 5";
$stmt_logs = $conn->prepare($sql_logs);
$stmt_logs->bind_param("i", $user_id);
$stmt_logs->execute();
$logs = $stmt_logs->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - PowerVision</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Dashboard specific Voltz-style components */
        .dark-card {
            background: #111;
            color: white;
            border-radius: 24px;
            padding: 48px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 48px;
            margin-bottom: 32px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
        .dark-card-header h3 {
            font-size: 35px;
            font-weight: 600;
            margin-bottom: 8px;
            color: white;
        }
        .dark-card-header p { color: #999; }
        .dark-stats { display: flex; flex-direction: column; justify-content: center; }
        .stat-large { margin-bottom: 32px; }
        .stat-large h4 {
            font-size: 48px;
            color: #22c55e;
            line-height: 1;
            margin-bottom: 8px;
        }
        .stat-large p { color: #999; font-size: 14px; }
        .stat-row { display: grid; grid-template-columns: 1fr 1fr; gap: 32px; }
        .stat-small h4 { font-size: 29px; margin-bottom: 8px; color: white; }
        .stat-small p { color: #999; font-size: 14px; }
        
        .bottom-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
        }
        .box-light {
            background: white;
            border-radius: 16px;
            padding: 32px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            border: 1px solid #eee;
        }
        .box-light h3 {
            font-size: 21px;
            margin-bottom: 24px;
            color: #111;
        }
        .box-light a {
            margin-top: 16px;
        }
        .pill-outline-dark {
            display: inline-block;
            border: 1px solid #ccc;
            padding: 8px 19px;
            border-radius: 50px;
            font-size: 14px;
            color: #111;
            text-decoration: none;
            transition: all 0.2s;
            margin-top: 16px;
        }
        .pill-outline-dark:hover {
            background: #f4f4f4;
        }
        
        @media(max-width: 768px) {
            .dark-card { grid-template-columns: 1fr; gap: 32px; padding: 32px; }
            .bottom-grid { grid-template-columns: 1fr; }
            .stat-row { grid-template-columns: 1fr; gap: 24px; }
        }
    </style>
</head>
<body>
    <nav>
        <h1>PowerVision</h1>
        <div>
            <a href="dashboard.php" style="color: var(--primary);">Dashboard</a>
            <a href="add_appliance.php">Appliances</a>
            <a href="log_usage.php">Log Usage</a>
            <a href="profile.php">Profile</a>
            <a href="logout.php">Logout (<?php echo htmlspecialchars($_SESSION['user_name']); ?>)</a>
        </div>
    </nav>

    <div class="container">
        <!-- Energy Summary Dark Card -->
        <div class="dark-card">
            <div class="dark-card-header">
                <h3>Energy Summary</h3>
                <p>Track your real-time consumption and costs.</p>
            </div>
            <div class="dark-stats">
                <div class="stat-large">
                    <h4><?php echo number_format($total_kwh, 2); ?> kWh</h4>
                    <p>Total Usage</p>
                </div>
                <div class="stat-row">
                    <div class="stat-small">
                        <h4>UGX <?php echo number_format($total_cost, 0); ?></h4>
                        <p>Estimated Cost</p>
                    </div>
                    <div class="stat-small">
                        <h4><?php echo $appliances->num_rows; ?></h4>
                        <p>Active Appliances</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="bottom-grid">
            <!-- Appliances List -->
            <div class="box-light">
                <h3>Your Appliances</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Watts</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($app = $appliances->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($app['name'] ?? $app['NAME'] ?? ''); ?></td>
                                <td><?php echo $app['watts']; ?> W</td>
                                <td>
                                    <a href="edit_appliance.php?id=<?php echo $app['id']; ?>" style="color: var(--muted); font-size: 0.8rem; margin-right: 0.5rem;">Edit</a>
                                    <a href="delete_appliance.php?id=<?php echo $app['id']; ?>" style="color: #ef4444; font-size: 0.8rem;" onclick="return confirm('Delete this appliance and all its logs?')">Delete</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                        <?php if($appliances->num_rows == 0): ?>
                            <tr><td colspan="2" style="color: var(--muted); padding-top: 1rem;">No appliances added yet.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
                <a href="add_appliance.php" style="margin-top: 16px;">Add New Appliance →</a>
            </div>

            <!-- Recent Logs -->
            <div class="box-light">
                <h3>Recent Usage</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Appliance</th>
                            <th>Hours</th>
                            <th>kWh</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($log = $logs->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($log['name'] ?? $log['NAME'] ?? ''); ?></td>
                                <td><?php echo $log['hours_used']; ?>h</td>
                                <td><?php echo number_format($log['kwh_used'], 2); ?></td>
                                <td>
                                    <a href="delete_log.php?id=<?php echo $log['id']; ?>" style="color: #ef4444; font-size: 0.8rem;" onclick="return confirm('Delete this usage log?')">Delete</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                        <?php if($logs->num_rows == 0): ?>
                            <tr><td colspan="3" style="color: var(--muted); padding-top: 1rem;">No logs found.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
                <a href="log_usage.php" style="margin-top: 16px;">Log Daily Usage →</a>
            </div>
        </div>
    </div>
</body>
</html>
