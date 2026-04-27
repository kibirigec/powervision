<?php
/**
 * register.php - User Registration
 * 
 * Allows new users to create an account.
 * Passwords are encrypted before being stored for security.
 */

require 'db.php';

$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert user into database
    $sql = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $name, $email, $hashed_password);

    try {
        if ($stmt->execute()) {
            $success = "Registration successful! <a href='index.php'>Login here</a>";
        }
    } catch (Exception $e) {
        $error = "Registration failed. Email might already exist.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - PowerVision</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="form-container">
        <h2>Register</h2>
        
        <?php if($error): ?>
            <div class="alert"><?php echo $error; ?></div>
        <?php endif; ?>

        <?php if($success): ?>
            <div class="alert" style="background-color: #e8f5e9; color: #2e7d32; border: 1px solid #c8e6c9;">
                <?php echo $success; ?>
            </div>
        <?php endif; ?>

        <form action="register.php" method="POST">
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" name="name" required placeholder="Enter your name">
            </div>
            <div class="form-group">
                <label>Email Address</label>
                <input type="email" name="email" required placeholder="Enter your email">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required placeholder="Create a password">
            </div>
            <button type="submit" class="btn btn-secondary">Register</button>
        </form>
        
        <p class="mt-1 text-center">
            Already have an account? <a href="index.php">Login here</a>
        </p>
        <p class="text-center"><a href="home.php">Back to Home</a></p>
    </div>
</body>
</html>
