<?php
// Database connection details
$servername = "localhost";  // Change this to your database host if different
$username = "root";         // Your MySQL username
$password = "";             // Your MySQL password (empty for default on localhost)
$dbname = "explormor";      // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the state ID (s_id) from the URL query parameter
$state = isset($_GET['s_id']) ? $_GET['s_id'] : '';

// Validate if state is provided
if (empty($state)) {
    die("State ID is missing.");
}

// Prepare SQL query to fetch packages related to the state (using state)
$sql = "SELECT * FROM packages WHERE s_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $state); // "i" stands for integer (for s_id)
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tour Packages for State <?php echo htmlspecialchars($state); ?> - ExplorMor</title>
    <link rel="stylesheet" href="p.css">
</head>
<body>

<header>
    <nav>
        <div class="logo">
            <h1>ExplorMor</h1>
        </div>
        <ul class="nav-links">
            <li><a href="home.php">Home</a></li>
            <li><a href="destination.php">Destinations</a></li>
            <li><a href="submit_contact.php">Contact Us</a></li>
        </ul>
    </nav>
</header>

<section class="packages-page">
    <h2>Tour Packages for State <?php echo htmlspecialchars($state); ?></h2>

    <div class="packages-grid">
        <?php
        if ($result->num_rows > 0) {
            // Loop through the results and display each package
            while ($row = $result->fetch_assoc()) {
                // Assume that the 'image' field in the database has only the image name, e.g., "image.jpg"
                $imagePath = "imgs/" . htmlspecialchars($row['image']); // Assuming images are stored in the "imgs" folder
                echo "<div class='package-card'>";
                echo "<img src='" . $imagePath . "' alt='" . htmlspecialchars($row['title']) . "' class='package-image'>";
                echo "<h3>" . htmlspecialchars($row['title']) . "</h3>";
                echo "<p><strong>Package Type:</strong> " . htmlspecialchars($row['package_type']) . "</p>";
                echo "<p><strong>Price:</strong> ₹" . htmlspecialchars($row['price']) . "</p>";
                echo "<p>" . htmlspecialchars($row['description']) . "</p>";
                echo "<a href='package_details.php?id=" . urlencode($row['package_id']) . "' class='view-details'>View Details</a>";
                echo "</div>";
            }
        } else {
            echo "<p>No tour packages available for this state.</p>";
        }
        ?>
    </div>
</section>

<footer>
    <p>&copy; 2025 Travel with Us. All rights reserved.</p>
</footer>

</body>
</html>

<?php
// Close connection
$stmt->close();
$conn->close();
?>
