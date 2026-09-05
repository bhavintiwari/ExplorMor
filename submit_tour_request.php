<?php
// Database connection details
$servername = "localhost";  // Replace with your MySQL server (often 'localhost')
$username = "root";         // Replace with your MySQL username
$password = "";             // Replace with your MySQL password
$dbname = "explormor";      // Replace with your database name

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the connection is successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);  // Show error message
}

// Check if the form is submitted via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data and sanitize it
    $full_name = isset($_POST['full_name']) ? htmlspecialchars($_POST['full_name']) : '';
    $email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '';
    $phone_number = isset($_POST['phone_number']) ? htmlspecialchars($_POST['phone_number']) : '';
    $destination = isset($_POST['destination']) ? htmlspecialchars($_POST['destination']) : '';
    $tour_state_date = isset($_POST['tour_state_date']) ? htmlspecialchars($_POST['tour_state_date']) : '';
    $tour_end_date = isset($_POST['tour_end_date']) ? htmlspecialchars($_POST['tour_end_date']) : '';
    $number_of_people = isset($_POST['number_of_people']) ? htmlspecialchars($_POST['number_of_people']) : '';
    $tour_type = isset($_POST['tour_type']) ? htmlspecialchars($_POST['tour_type']) : '';
    $special_request = isset($_POST['special_request']) ? htmlspecialchars($_POST['special_request']) : '';
    $budget = isset($_POST['budget']) ? htmlspecialchars($_POST['budget']) : '';

    // Prepare the SQL query to insert data into the table (corrected table name)
    $stmt = $conn->prepare("INSERT INTO customized_tour (full_name, email, phone_number, tour_destination, tour_state_date, tour_end_date, number_of_people, tour_type, special_request, budget) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    // Check if statement preparation was successful
    if ($stmt === false) {
        die("Error preparing the SQL statement: " . $conn->error);
    }

    // Bind the parameters to the query
    $stmt->bind_param("ssssssssss", $full_name, $email, $phone_number, $destination, $tour_state_date, $tour_end_date, $number_of_people, $tour_type, $special_request, $budget);

    // Execute the query
    if ($stmt->execute()) {
        echo "<h2>Your Custom Tour Request Has Been Submitted Successfully!</h2>";

        // Add "Thanks for choosing us" message
        echo "<h3>Thanks for choosing us! We look forward to making your tour memorable.</h3>";
    } else {
        // If execution fails, show error
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
    