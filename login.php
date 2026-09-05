<?php
session_start();

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "explormor";

// Connect to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize error message variable
$errorMessage = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Sanitize input
    $username = trim($username);

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Verify hashed password
        if (password_verify($password, $row['password'])) {
            $_SESSION['logged_in'] = true;
            $_SESSION['user_id'] = $row['id']; // Store the user ID in session
            header("Location: home.php");
            exit();
        } else {
            $errorMessage = "Invalid username or password!";
        }
    } else {
        $errorMessage = "Invalid username or password!";
    }
    $stmt->close();
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>
        /* Basic Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(120deg, #f6d365 0%, #fda085 100%); /* Example gradient background */
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh; /* Full viewport height */
            padding: 20px; /* Add padding for smaller screens */
        }

        .login-container {
            background-color: #ffffff;
            padding: 40px 30px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
            width: 100%;
            max-width: 400px; /* Limit width */
            text-align: center;
        }

        .login-container h2 {
            color: #333;
            margin-bottom: 25px;
            font-weight: 600;
        }

        .form-group {
            margin-bottom: 20px;
            text-align: left; /* Align labels and inputs left */
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
            border-color: #fda085; /* Highlight focus */
            outline: none;
        }

        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            font-size: 0.85em;
        }

        .form-options .remember-me {
            display: flex;
            align-items: center;
            color: #555;
        }

        .form-options .remember-me input[type="checkbox"] {
            margin-right: 8px;
            accent-color: #fda085; /* Style checkbox color */
        }

        .form-options a {
            color: #007bff;
            text-decoration: none;
            transition: text-decoration 0.3s ease;
        }

        .form-options a:hover {
            text-decoration: underline;
        }

        .login-button {
            width: 100%;
            padding: 12px;
            background: linear-gradient(120deg, #fda085 0%, #f6d365 100%); /* Match gradient */
            border: none;
            border-radius: 5px;
            color: white;
            font-size: 1.1em;
            font-weight: bold;
            cursor: pointer;
            transition: opacity 0.3s ease;
            margin-bottom: 20px; /* Space below button */
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

        .error-message {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
            padding: 10px 15px; /* Adjusted padding */
            border-radius: 5px;
            margin-bottom: 20px;
            font-size: 0.9em;
            text-align: left; /* Align text left */
        }

    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <?php if (!empty($errorMessage)): ?>
            <div class="error-message"><?php echo htmlspecialchars($errorMessage); ?></div>
        <?php endif; ?>
        <form action="login.php" method="POST">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Enter your username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
            </div>
            <button type="submit" class="login-button">Login</button>
        </form>
        <div class="signup-link">
            Don't have an account? <a href="signup.php">Sign Up</a>
        </div>
    </div>
</body>
</html>
