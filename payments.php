<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Form</title>
</head><style>
    /* Global Styles */
body {
    font-family: 'Arial', sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f9;
    color: #333;
}

/* Header */
header {
    background-color: #2575fc;
    color: #fff;
    padding: 10px 20px;
    text-align: center;
    font-size: 1.5rem;
}

header h1 {
    margin: 0;
}

/* Form Styles */
form {
    background-color: #fff;
    padding: 20px;
    margin: 40px auto;
    width: 80%;
    max-width: 600px;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

/* Input Fields and Labels */
label {
    font-size: 1rem;
    margin-bottom: 5px;
    display: block;
    color: #333;
}

input[type="text"],
input[type="email"],
textarea {
    width: 100%;
    padding: 10px;
    margin: 10px 0;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 1rem;
}

textarea {
    resize: vertical;
}

/* Submit Button */
input[type="submit"] {
    background-color: #2575fc;
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 5px;
    font-size: 1rem;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

input[type="submit"]:hover {
    background-color: #1e60d2;
}

/* Responsiveness */
@media (max-width: 768px) {
    form {
        width: 90%;
        margin: 20px auto;
    }

    header {
        font-size: 1.2rem;
    }
}

/* Form Heading */
h2 {
    text-align: center;
    color: #2575fc;
    margin-bottom: 20px;
}

</style>
<body>

    <h2>Payment Form</h2>

    <form action="process_payment.php" method="POST">
        <label for="user_id">User ID:</label><br>
        <input type="text" id="user_id" name="user_id" required><br><br>

        <label for="package_id">Package ID:</label><br>
        <input type="text" id="package_id" name="package_id" required><br><br>

        <label for="payment_amount">Amount:</label><br>
        <input type="text" id="payment_amount" name="payment_amount" required><br><br>

        <label for="payment_method">Payment Method:</label><br>
        <input type="text" id="payment_method" name="payment_method" required><br><br>

        <label for="transaction_reference">Transaction Reference:</label><br>
        <input type="text" id="transaction_reference" name="transaction_reference" required><br><br>

        <label for="user_email">User Email:</label><br>
        <input type="email" id="user_email" name="user_email" required><br><br>

        <input type="submit" value="Submit Payment">
    </form>

</body>
</html>
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

    // Retrieve form data and check if keys exist
    $user_id = isset($_POST['user_id']) ? $_POST['user_id'] : '';
    $package_id = isset($_POST['package_id']) ? $_POST['package_id'] : '';
    $payment_amount = isset($_POST['payment_amount']) ? $_POST['payment_amount'] : '';
    $payment_method = isset($_POST['payment_method']) ? $_POST['payment_method'] : '';
    $transaction_reference = isset($_POST['transaction_reference']) ? $_POST['transaction_reference'] : '';
    $user_email = isset($_POST['user_email']) ? $_POST['user_email'] : '';
    
    // Ensure that all fields are filled
    if (empty($user_id) || empty($package_id) || empty($payment_amount) || empty($payment_method) || empty($transaction_reference) || empty($user_email)) {
        echo "All fields are required!";
        exit;
    }

    // Prepare the SQL statement to insert data into the payments table
    $stmt = $conn->prepare("INSERT INTO payments (user_id, package_id, payment_amount, payment_method, payment_status, transaction_reference, user_email) 
                            VALUES (?, ?, ?, ?, ?, ?, ?)");

    // Check if the statement is prepared successfully
    if ($stmt === false) {
        die("Error preparing the SQL statement: " . $conn->error);
    }

    // Bind parameters: "i" for integers, "s" for strings
    $payment_status = 'Pending';  // Default status
    $stmt->bind_param("iisssss", $user_id, $package_id, $payment_amount, $payment_method, $payment_status, $transaction_reference, $user_email);

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
