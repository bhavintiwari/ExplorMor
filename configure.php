<?php
$servername = "localhost"; // Server Name
$username = "root";        // Username
$password = "";            // Password (empty by default)
//$dbname = "explormor";   // Database Name

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
