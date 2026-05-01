<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$error = "";
$success = "";

// Fetch user details
$sql = "SELECT name, email FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['update_profile'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];

        if (!empty($name) && !empty($email)) {
            $update_sql = "UPDATE users SET name = ?, email = ? WHERE id = ?";
            $update_stmt = $conn->prepare($update_sql);
            $update_stmt->bind_param("ssi", $name, $email, $user_id);
            
            if ($update_stmt->execute()) {
                $_SESSION['user_name'] = $name;
                $success = "Profile updated successfully!";
                $user['name'] = $name;
                $user['email'] = $email;
            } else {
                $error = "Error updating profile. Email might already be in use.";
            }
        }
    } elseif (isset($_POST['delete_account'])) {
        // Double confirmation is handled by JS onclick, so we delete here
        $delete_sql = "DELETE FROM users WHERE id = ?";
        $delete_stmt = $conn->prepare($delete_sql);
        $delete_stmt->bind_param("i", $user_id);
        
        if ($delete_stmt->execute()) {
            session_destroy();
            header("Location: index.php?msg=Account deleted");
            exit();
        } else {
            $error = "Error deleting account.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - PowerVision</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav>
        <h1>PowerVision</h1>
        <div>
            <a href="dashboard.php">Dashboard</a>
            <a href="profile.php" style="color: var(--primary);">Profile</a>
            <a href="logout.php">Logout</a>
        </div>
    </nav>

    <div class="form-container">
        <h2>Your Profile</h2>
        
        <?php if($error): ?>
            <div class="alert"><?php echo $error; ?></div>
        <?php endif; ?>

        <?php if($success): ?>
            <div class="alert" style="background-color: #e8f5e9; color: #2e7d32; border-color: #c8e6c9;"><?php echo $success; ?></div>
        <?php endif; ?>

        <form action="profile.php" method="POST">
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required>
            </div>
            <div class="form-group">
                <label>Email Address</label>
                <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
            </div>
            <button type="submit" name="update_profile" class="btn">Update Profile</button>
        </form>

        <hr style="margin: 2rem 0; border: none; border-top: 1px solid #eee;">

        <div style="text-align: center;">
            <h3 style="color: #ef4444; margin-bottom: 1rem;">Danger Zone</h3>
            <p style="font-size: 0.85rem; color: #666; margin-bottom: 1.5rem;">Once you delete your account, all your data will be permanently removed.</p>
            <form action="profile.php" method="POST" onsubmit="return confirm('Are you absolutely sure? This will delete your account and all your appliance data.')">
                <button type="submit" name="delete_account" class="btn" style="background-color: #ef4444;">Delete My Account</button>
            </form>
        </div>

        <p><a href="dashboard.php">Back to Dashboard</a></p>
    </div>
</body>
</html>
