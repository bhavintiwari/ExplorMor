<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "explormor";  // Replace with your actual database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted via POST method
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Retrieve form data
    $user_id = $_POST['user_id'];
    $package_id = $_POST['package_id'];
    $payment_amount = $_POST['payment_amount'];
    $payment_method = $_POST['payment_method'];
    $transaction_reference = $_POST['transaction_reference'];
    $user_email = $_POST['user_email'];

    // // Get the current timestamp for payment_date
    // $payment_date = date('Y-m-d H:i:s');

    // Prepare the SQL statement to insert data into the payments table
    $stmt = $conn->prepare("INSERT INTO payments (user_id, package_id, payment_amount, payment_method, transaction_reference, user_email) 
                            VALUES (?, ?, ?, ?, ?, ?)");

    // Check if prepare() failed
    if ($stmt === false) {
        // Output the error if query preparation failed
        die('MySQL prepare error: ' . $conn->error);
    }

    // Bind parameters
    $stmt->bind_param("iissss", $user_id, $package_id, $payment_amount, $payment_method, $transaction_reference, $user_email);

    // Execute the query and check if it was successful
    if ($stmt->execute()) {
        echo "Payment details have been successfully saved!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
