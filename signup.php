<?php
session_start();

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "explormor";

$conn = new mysqli($servername, $username, $password, $dbname);

// Initialize error/success message variables
$errorMessage = null;
$successMessage = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    // Validate that passwords match
    if ($password !== $confirmPassword) {
        $errorMessage = "Passwords do not match!";
    } else {
        // Hash the password for security
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insert user into the database using prepared statements
        $stmt = $conn->prepare("INSERT INTO users (username, password, email) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $hashedPassword, $email);

        if ($stmt->execute()) {
            $successMessage = "Account created successfully! <a href='login.php'>Login here</a>";
        } else {
            $errorMessage = "Error: Could not create account. Username or email might already exist.";
        }

        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Page</title>
    <style>
        /* Basic Reset */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: linear-gradient(120deg, #f6d365 0%, #fda085 100%);
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    padding: 20px;
}

.login-container {
    background-color: #ffffff;
    padding: 40px 30px;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
    width: 100%;
    max-width: 400px;
    text-align: center;
}

.login-container h2 {
    color: #333;
    margin-bottom: 25px;
    font-weight: 600;
}

.form-group {
    margin-bottom: 20px;
    text-align: left;
}

.form-group label {
    display: block;
    font-size: 0.9em;
    color: #555;
    margin-bottom: 8px;
    font-weight: 500;
}

.form-group input[type="text"],
.form-group input[type="email"],
.form-group input[type="password"] {
    width: 100%;
    padding: 12px 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 1em;
    transition: border-color 0.3s ease;
}

.form-group input[type="text"]:focus,
.form-group input[type="email"]:focus,
.form-group input[type="password"]:focus {
    border-color: #fda085;
    outline: none;
}

.login-button {
    width: 100%;
    padding: 12px;
    background: linear-gradient(120deg, #fda085 0%, #f6d365 100%);
    border: none;
    border-radius: 5px;
    color: white;
    font-size: 1.1em;
    font-weight: bold;
    cursor: pointer;
    transition: opacity 0.3s ease;
    margin-bottom: 20px;
}

.login-button:hover {
    opacity: 0.9;
}

.signup-link {
    font-size: 0.9em;
    color: #555;
}

.signup-link a {
    color: #007bff;
    text-decoration: none;
    font-weight: 600;
}

.signup-link a:hover {
    text-decoration: underline;
}

.error-message,
.success-message {
    padding: 10px 15px;
    border-radius: 5px;
    margin-bottom: 20px;
    font-size: 0.9em;
    text-align: left;
}

.error-message {
    background-color: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}

.success-message {
    background-color: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}

    </style>
</head>
<body>
    <div class="login-container">
        <h2>Sign Up</h2>
        <?php if (!empty($errorMessage)): ?>
            <div class="error-message"><?php echo htmlspecialchars($errorMessage); ?></div>
        <?php endif; ?>
        <?php if (!empty($successMessage)): ?>
            <div class="success-message"><?php echo $successMessage; ?></div>
        <?php endif; ?>
        <form action="signup.php" method="POST">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Enter your username" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm your password" required>
            </div>
            <button type="submit" class="login-button">Sign Up</button>
        </form>
        <div class="signup-link">
            Already have an account? <a href="login.php">Login here</a>
        </div>
    </div>
</body>
</html>
