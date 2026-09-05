<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "explormor";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to get unique states (or their ids) from the packages table
$sql = "SELECT DISTINCT s_id FROM packages";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>States - ExplorMor</title>
</head>
<body>

<h1>Select a State</h1>

<ul>
    <?php
    if ($result->num_rows > 0) {
        // Display each state as a clickable link
        while ($row = $result->fetch_assoc()) {
            $s_id = $row['s_id'];
            echo "<li><a href='packages.php?s_id=$s_id'>State $s_id</a></li>";
        }
    } else {
        echo "<p>No states available.</p>";
    }
    ?>
</ul>

</body>
</html>

<?php
// Close connection
$conn->close();
?>
