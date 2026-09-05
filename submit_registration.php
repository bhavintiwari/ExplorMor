<?php
// Database connection settings
$servername = "localhost"; // Your database server, typically "localhost"
$username = "root"; // MySQL username (for XAMPP, usually root)
$password = ""; // MySQL password (empty for XAMPP)
$dbname = "explormor"; // Replace with your actual database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables
$user_name = $email = $password_hash = $first_name = $last_name = $phone_number = $date_of_birth = "";
$success_message = "";
$error_message = "";

// Process the form when it is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data and sanitize it
    $user_name = $_POST['user_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_hash = password_hash($password, PASSWORD_DEFAULT); // Hash the password for security
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $phone_number = $_POST['phone_number'];
    $date_of_birth = $_POST['date_of_birth'];

    // Get the current timestamp for created_at and updated_at
    $created_at = date('Y-m-d H:i:s');
    $updated_at = date('Y-m-d H:i:s');

    // Prepare and bind the SQL query to insert data into user_registration
    $stmt = $conn->prepare("INSERT INTO user_registration (user_name, email, password_hash, first_name, last_name, phone_number, date_of_birth, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    if ($stmt === false) {
        die('Prepare failed: ' . $conn->error);
    }

    $stmt->bind_param("sssssssss", $user_name, $email, $password_hash, $first_name, $last_name, $phone_number, $date_of_birth, $created_at, $updated_at);

    // Execute the query and check if it's successful
    if ($stmt->execute()) {
        $success_message = "Registration successful! Your data has been saved.";
    } else {
        $error_message = "Error: " . $stmt->error;
    }

    // Close the prepared statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <link rel="stylesheet" href="registration.css">
</head>
<body>
    <h2>Register</h2>

    <form action="submit_registration.php" method="POST">
        <label for="user_name">User Name:</label><br>
        <input type="text" id="user_name" name="user_name" required><br><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>

        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br><br>

        <label for="first_name">First Name:</label><br>
        <input type="text" id="first_name" name="first_name" required><br><br>

        <label for="last_name">Last Name:</label><br>
        <input type="text" id="last_name" name="last_name" required><br><br>

        <label for="phone_number">Phone Number:</label><br>
        <input type="text" id="phone_number" name="phone_number" required><br><br>

        <label for="date_of_birth">Date of Birth:</label><br>
        <input type="date" id="date_of_birth" name="date_of_birth" required><br><br>

        <input type="submit" value="Register">
    </form>

    <?php
    // Display success or error message
    if (!empty($success_message)) {
        echo "<p class='success'>$success_message</p>";
    }
    if (!empty($error_message)) {
        echo "<p class='error'>$error_message</p>";
    }
    ?>
</body>
</html>
