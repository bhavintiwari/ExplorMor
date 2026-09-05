<?php
// Database connection details
$servername = "localhost";
$username = "root"; // Your MySQL username
$password = ""; // Your MySQL password
$dbname = "explormor"; // Database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the package ID from the URL
$package_id = isset($_GET['id']) ? $_GET['id'] : 0;

// SQL query to fetch the package details
$sql = "SELECT * FROM packages WHERE package_id = $package_id";
$result = $conn->query($sql);

// Fetch the package data
if ($result->num_rows > 0) {
    $package = $result->fetch_assoc();
} else {
    echo "Package not found!";
    exit;
}

// SQL query to fetch the itinerary details for the package
$itinerary_sql = "SELECT * FROM itinerary WHERE package_id = $package_id ORDER BY day_number";
$itinerary_result = $conn->query($itinerary_sql);

// Fetch itinerary data
$itinerary = [];
if ($itinerary_result->num_rows > 0) {
    while ($row = $itinerary_result->fetch_assoc()) {
        $itinerary[] = $row;
    }
} else {
    echo "Itinerary not found!";
    exit;
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Package Details - <?php echo htmlspecialchars($package['title']); ?> - ExplorMor</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<header>
    <h1><?php echo htmlspecialchars($package['title']); ?> - Package Details</h1>
</header>

<section class="package-detail">
    <div class="package-card">
        <img src="<?php echo $package['image']; ?>" alt="<?php echo $package['title']; ?>" class="package-image">
        <h2><?php echo $package['title']; ?></h2>
        <p><strong>Package Type:</strong> <?php echo $package['package_type']; ?></p>
        <p><strong>Description:</strong> <?php echo $package['description']; ?></p>
        <p><strong>Duration:</strong> <?php echo $package['number_of_days']; ?> days</p>
        <p><strong>Price:</strong> ₹<?php echo $package['price']; ?></p>
        <button>Book Now</button>
    </div>
</section>

<section class="itinerary-section">
    <h2>Itinerary</h2>
    <div class="itinerary-list">
        <?php foreach ($itinerary as $day) { ?>
            <div class="itinerary-day">
                <h3>Day <?php echo $day['day_number']; ?></h3>
                <p><strong>Activity:</strong> <?php echo nl2br(htmlspecialchars($day['activity_description'])); ?></p>
            </div>
        <?php } ?>
    </div>
</section>

</body>
</html>
