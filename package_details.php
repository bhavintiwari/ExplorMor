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
$itinerary_sql = "SELECT DISTINCT * FROM itinerary WHERE package_id = $package_id ORDER BY day_number";
$itinerary_result = $conn->query($itinerary_sql);

// Fetch itinerary data and filter duplicates
$itinerary = [];
$seen = [];
if ($itinerary_result->num_rows > 0) {
    while ($row = $itinerary_result->fetch_assoc()) {
        // Create a unique identifier for each day
        $key = $row['day_number'];
        
        // If the day has already been added, skip it
        if (!isset($seen[$key])) {
            $seen[$key] = true;
            $itinerary[] = $row;  // Add unique entries to the itinerary
        }
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
</head><style>
    /* Reset some default browser styles */
/* Reset some default browser styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Global Styles */
body {
    font-family: 'Arial', sans-serif;
    line-height: 1.6;
    background-color: #f9f9f9;
    color: #333;
}

/* Header Styles */
header {
    background-color: #2c3e50;
    color: white;
    padding: 1.5rem 0;
    text-align: center;
}
header h1 {
    font-size: 2.5rem;
}

/* Package Detail Section */
.package-detail {
    text-align: center;
    padding: 4rem 0;
}
.package-card {
    background-color: white;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    border-radius: 10px;
    max-width: 900px;
    margin: 0 auto;
    padding: 2rem;
}
.package-card img {
    width: 100%;
    height: 300px;
    object-fit: cover;
    border-radius: 5px;
    margin-bottom: 1.5rem;
}
.package-card h2 {
    font-size: 2.5rem;
    color: #2c3e50;
    margin: 1rem 0;
}
.package-card p {
    font-size: 1.1rem;
    color: #7f8c8d;
    margin: 0.8rem 0;
}

/* Itinerary Section */
.itinerary-section {
    background-color: #f4f4f4;
    padding: 3rem 0;
}
.itinerary-section h2 {
    font-size: 2.5rem;
    color: #34495e;
    margin-bottom: 2rem;
    text-align: center;
}
.itinerary-list {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}
.itinerary-day {
    background-color: white;
    padding: 1.5rem;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
    margin-bottom: 1.5rem;
    border-radius: 8px;
}
.itinerary-day h3 {
    font-size: 1.8rem;
    color: #2c3e50;
}
.itinerary-day p {
    font-size: 1rem;
    color: #7f8c8d;
    margin-top: 0.5rem;
}

/* Book Now Button */
.book-now-section {
    text-align: center;
    margin-top: 2rem;
}
.book-now-btn {
    background-color: #e74c3c;
    color: white;
    padding: 1rem 2rem;
    text-decoration: none;
    font-size: 1.3rem;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}
.book-now-btn:hover {
    background-color: #c0392b;
}

/* Footer Styles */
footer {
    background-color: #2c3e50;
    color: white;
    text-align: center;
    padding: 1.5rem 0;
    margin-top: 3rem;
}

/* Media Queries for responsiveness */
@media (max-width: 768px) {
    .package-card {
        padding: 1.5rem;
    }
    .package-card h2 {
        font-size: 2rem;
    }
    .itinerary-day h3 {
        font-size: 1.6rem;
    }
    .book-now-btn {
        font-size: 1.1rem;
        padding: 0.8rem 1.8rem;
    }
    header h1 {
        font-size: 2rem;
    }
    .itinerary-section h2 {
        font-size: 2rem;
    }
}


</style>
<body>

<header>
    <!-- Removed the repeated package title -->
    <h1>Package Details</h1>
</header>

<section class="package-detail">
    <div class="package-card">
        <img src="<?php echo $package['image']; ?>" alt="<?php echo $package['title']; ?>" class="package-image">
        <h2><?php echo $package['title']; ?></h2>
    </div>
</section>

<section class="itinerary-section">
    <h2>Itinerary</h2>
    <div class="itinerary-list">
        <?php
        // Display the filtered itinerary
        foreach ($itinerary as $day) { ?>
            <div class="itinerary-day">
                <h3>Day <?php echo $day['day_number']; ?></h3>
                <p><strong>Activity:</strong> <?php echo $day['activity_description']; ?></p>
            </div>
        <?php } ?>
    </div>
</section>

<!-- Now placing the "Book Now" button after the itinerary section -->
<section class="book-now-section">
    <a href="booking_page.php?package_id=<?php echo $package['package_id']; ?>" class="book-now-btn">Book Now</a>
</section>

</body>
</html>
