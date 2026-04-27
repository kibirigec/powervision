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
$sql_logs = "SELECT a.name, l.hours_used, l.log_date, ((a.watts * l.hours_used) / 1000) as kwh_used 
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
            padding: 3rem;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 3rem;
            margin-bottom: 2rem;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
        .dark-card-header h3 {
            font-size: 2.2rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: white;
        }
        .dark-card-header p { color: #999; }
        .dark-stats { display: flex; flex-direction: column; justify-content: center; }
        .stat-large { margin-bottom: 2rem; }
        .stat-large h4 {
            font-size: 3rem;
            color: #22c55e;
            line-height: 1;
            margin-bottom: 0.5rem;
        }
        .stat-large p { color: #999; font-size: 0.9rem; }
        .stat-row { display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; }
        .stat-small h4 { font-size: 1.8rem; margin-bottom: 0.5rem; color: white; }
        .stat-small p { color: #999; font-size: 0.85rem; }
        
        .bottom-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
        }
        .box-light {
            background: white;
            border-radius: 16px;
            padding: 2rem;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            border: 1px solid #eee;
        }
        .box-light h3 {
            font-size: 1.3rem;
            margin-bottom: 1.5rem;
            color: #111;
        }
        .pill-outline-dark {
            display: inline-block;
            border: 1px solid #ccc;
            padding: 0.5rem 1.2rem;
            border-radius: 50px;
            font-size: 0.85rem;
            color: #111;
            text-decoration: none;
            transition: all 0.2s;
            margin-top: 1rem;
        }
        .pill-outline-dark:hover {
            background: #f4f4f4;
        }
        
        @media(max-width: 768px) {
            .dark-card { grid-template-columns: 1fr; gap: 2rem; padding: 2rem; }
            .bottom-grid { grid-template-columns: 1fr; }
            .stat-row { grid-template-columns: 1fr; gap: 1.5rem; }
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
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($app = $appliances->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($app['name'] ?? $app['NAME'] ?? ''); ?></td>
                                <td><?php echo $app['watts']; ?> W</td>
                            </tr>
                        <?php endwhile; ?>
                        <?php if($appliances->num_rows == 0): ?>
                            <tr><td colspan="2" style="color: var(--muted); padding-top: 1rem;">No appliances added yet.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
                <a href="add_appliance.php" class="pill-outline-dark mt-1">Add New Appliance →</a>
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
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($log = $logs->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($log['name'] ?? $log['NAME'] ?? ''); ?></td>
                                <td><?php echo $log['hours_used']; ?>h</td>
                                <td><?php echo number_format($log['kwh_used'], 2); ?></td>
                            </tr>
                        <?php endwhile; ?>
                        <?php if($logs->num_rows == 0): ?>
                            <tr><td colspan="3" style="color: var(--muted); padding-top: 1rem;">No logs found.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
                <a href="log_usage.php" class="pill-outline-dark mt-1">Log Daily Usage →</a>
            </div>
        </div>
    </div>
</body>
</html>
