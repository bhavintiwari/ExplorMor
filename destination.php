<?php
session_start(); // Start the session at the top
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explore Destinations - ExplorMor</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css"> <!-- Optional external stylesheet -->
</head>
<style>
        /* --- Global Styles & Reset --- */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f4f4f4;
        }

        html {
            scroll-behavior: smooth;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        h1, h2, h3 {
            margin-bottom: 0.75rem;
            color: #0056b3; /* Primary heading color */
        }

        p {
            margin-bottom: 1rem;
        }

        img {
            max-width: 100%;
            height: auto;
            display: block;
        }

        /* --- Header & Navigation (Consistent with home page) --- */
        header {
            background-color: #fff;
            padding: 1rem 5%;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
            width: 100%;
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
        }

        .logo h1 {
            color: #0056b3;
            margin: 0;
            font-size: 1.8rem;
        }

        .nav-links {
            list-style: none;
            display: flex;
            padding-left: 0; /* Reset list padding */
        }

        .nav-links li {
            margin-left: 2rem;
        }

        .nav-links a {
            text-decoration: none;
            color: #333;
            font-weight: bold;
            padding-bottom: 0.3rem;
            border-bottom: 2px solid transparent;
            transition: color 0.3s ease, border-color 0.3s ease;
        }

        .nav-links a:hover,
        .nav-links a.active { /* Style for active link */
            color: #0056b3;
            border-bottom-color: #0056b3;
        }

        /* --- Destination Page Specific Styles --- */
        .destination-page {
            max-width: 1200px; /* Limit content width */
            margin: 2rem auto; /* Center content and add vertical space */
            padding: 0 2rem; /* Padding on the sides */
        }

        .destination-page > h2 { /* Style the main heading */
            text-align: center;
            margin-bottom: 2.5rem;
            font-size: 2.5rem;
            color: #333; /* Slightly darker color for main title */
        }

        /* --- Search Container --- */
        .search-container {
            margin-bottom: 3rem;
            text-align: center;
        }

        .search-container form {
            display: inline-flex; /* Align input and button horizontally */
            align-items: center; /* Vertically align items */
            border: 1px solid #ccc;
            border-radius: 25px; /* Rounded search bar */
            overflow: hidden; /* Keep button within rounded corners */
            background-color: #fff;
            box-shadow: 0 1px 4px rgba(0,0,0,0.1);
        }

        .search-container input[type="text"] {
            padding: 0.8rem 1.2rem;
            border: none;
            outline: none;
            font-size: 1rem;
            min-width: 300px; /* Adjust width as needed */
            border-radius: 25px 0 0 25px; /* Match rounding */
        }

        .search-container button {
            padding: 0.8rem 1.5rem;
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
            font-size: 1rem;
            font-weight: bold;
            transition: background-color 0.3s ease;
            height: 100%; /* Match input height potentially */
             border-radius: 0 25px 25px 0; /* Match rounding */
        }

        .search-container button:hover {
            background-color: #0056b3;
        }

        /* --- Destination Grid --- */
        .destination-grid {
            display: grid;
            /* Creates responsive columns: each column is at least 280px wide,
               and they share the available space (1fr). The browser fits as many as possible. */
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem; /* Space between grid items (cards) */
        }

        /* --- Destination Card --- */
        .destination-card {
            background-color: #fff;
            border-radius: 8px;
            overflow: hidden; /* Ensures image corners are rounded */
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            display: flex; /* Use flexbox for better content control */
            flex-direction: column; /* Stack content vertically */
        }

        .destination-card:hover {
            transform: translateY(-5px); /* Subtle lift effect on hover */
            box-shadow: 0 6px 12px rgba(0,0,0,0.15);
        }

        .destination-card img {
            width: 100%;
            height: 200px; /* Fixed height for images */
            object-fit: cover; /* Scales and crops image to fit */
        }

        .destination-card h3 {
            margin: 1rem 1rem 0.5rem 1rem; /* Spacing inside card */
            font-size: 1.4rem;
             color: #0056b3; /* Match other headings */
        }

        .destination-card p {
            margin: 0 1rem 1rem 1rem; /* Spacing inside card */
            font-size: 0.95rem;
            color: #555; /* Slightly lighter text color */
            flex-grow: 1; /* Allows description to push button down */
            line-height: 1.5;
             /* Optional: Limit description lines */
             /*
             display: -webkit-box;
             -webkit-line-clamp: 4; / Number of lines /
             -webkit-box-orient: vertical;
             overflow: hidden;
             text-overflow: ellipsis;
             */
        }

        .destination-card .destination { /* Style the 'View Packages' link */
            display: block;
            background-color: #28a745; /* Green button */
            color: #fff;
            text-align: center;
            padding: 0.8rem 1rem;
            margin: 1rem; /* Margin provides spacing from text above */
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.3s ease;
            margin-top: auto; /* Pushes button to the bottom */
        }

        .destination-card .destination:hover {
            background-color: #218838; /* Darker green on hover */
            text-decoration: none;
        }

        /* --- Footer (Consistent with home page) --- */
        footer {
            text-align: center;
            margin-top: 3rem;
            padding: 1.5rem;
            background-color: #333;
            color: #ccc;
            font-size: 0.9rem;
        }

        footer a {
            color: #00aaff;
        }

        footer a:hover {
            color: #fff;
        }

        /* --- Responsive Design --- */
        @media (max-width: 768px) {
            /* Adjust header/nav styles if using mobile menu toggle */
            .destination-page {
                padding: 0 1rem; /* Less padding on smaller screens */
                margin-top: 1.5rem;
            }
            .destination-page > h2 {
                font-size: 2rem;
            }
            .search-container input[type="text"] {
                min-width: 200px; /* Smaller search input */
            }
            .destination-grid {
                gap: 1.5rem; /* Slightly smaller gap */
            }
        }

        @media (max-width: 480px) {
            .destination-page > h2 {
                font-size: 1.8rem;
            }
            /* Stack search bar elements */
            .search-container form {
                display: flex;
                flex-direction: column;
                width: 90%;
                margin-left: auto;
                margin-right: auto;
                border: none;
                box-shadow: none;
                background-color: transparent;
                align-items: stretch; /* Make children full width */
            }
            .search-container input[type="text"] {
                width: 100%;
                border: 1px solid #ccc;
                border-radius: 5px; /* Square off corners for stacking */
                margin-bottom: 0.5rem;
                min-width: auto; /* Reset min-width */
            }
            .search-container button {
                width: 100%;
                border-radius: 5px; /* Square off corners */
            }
            .destination-grid {
                grid-template-columns: 1fr; /* Single column layout */
                gap: 1rem;
            }
            .destination-card img {
                height: 180px; /* Slightly smaller image height */
            }
            .destination-card h3 {
                font-size: 1.2rem;
            }
            .destination-card p {
                font-size: 0.9rem;
            }
            .destination-card .destination {
                padding: 0.7rem;
            }
        }
</style>
<body>

<header>
    <nav>
        <div class="logo">
            <h1>ExplorMor</h1>
        </div>
        <ul class="nav-links">
            <li><a href="home.php">Home</a></li>
            <li><a href="destination.php" class="active">Destinations</a></li>
            <li><a href="submit_contact.php">Contact Us</a></li>
            <!-- Dynamically display login or logout based on session status -->
            <?php
                if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
                    echo '<li><a href="logout.php">Logout</a></li>';
                } else {
                    echo '<li><a href="login.php">Login</a></li>';
                }
            ?>
        </ul>
    </nav>
</header>

<main class="destination-page">
    <h2>Explore Our Destinations</h2>

    <div class="search-container">
        <form id="searchForm">
            <input type="text" name="searchQuery" id="searchQuery" placeholder="Search for a state..." aria-label="Search for a state">
            <button type="submit">Search</button>
        </form>
    </div>

    <div class="destination-grid" id="destination-grid">
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
            error_log("Database Connection failed: " . $conn->connect_error);
            echo '<p style="text-align: center; color: red;">Sorry, we couldn\'t load the destinations right now. Please try again later.</p>';
        } else {
            // Fetch destinations
            $sql = "SELECT s_id, state_name, state_description, state_image FROM states ORDER BY state_name ASC";
            $result = $conn->query($sql);

            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $stateName = htmlspecialchars($row["state_name"]);
                    $stateDescription = htmlspecialchars($row["state_description"]);
                    $imageSrc = 'imgs/' . htmlspecialchars($row["state_image"]);
                    $stateId = htmlspecialchars($row["s_id"]);

                    echo '<div class="destination-card">';
                    echo '<img src="' . $imageSrc . '" alt="Image of ' . $stateName . '">';
                    echo '<h3>' . $stateName . '</h3>';
                    echo '<p>' . $stateDescription . '</p>';
                    echo '<a href="package.php?s_id=' . $stateId . '" class="destination">View Packages</a>';
                    echo '</div>';
                }
            } else {
                echo '<p style="text-align: center; grid-column: 1 / -1;">No destinations found.</p>';
            }

            $conn->close();
        }
        ?>
    </div>
</main>

<footer>
    <p>&copy; <?php echo date("Y"); ?> Travel with Us. All rights reserved.</p>
</footer>

<script>
    const searchForm = document.getElementById('searchForm');
    const searchQueryInput = document.getElementById('searchQuery');
    const destinationGrid = document.getElementById('destination-grid');
    const destinations = destinationGrid ? destinationGrid.querySelectorAll('.destination-card') : [];

    function filterDestinations() {
        const searchQuery = searchQueryInput.value.toLowerCase().trim();
        let foundMatch = false;

        destinations.forEach(function(card) {
            const destinationNameElement = card.querySelector('h3');
            if (destinationNameElement) {
                const destinationName = destinationNameElement.textContent.toLowerCase();
                if (destinationName.includes(searchQuery)) {
                    card.style.display = 'flex';
                    foundMatch = true;
                } else {
                    card.style.display = 'none';
                }
            }
        });

        // Optional: Show a "no results" message
        const noResultsMessage = document.getElementById('noResultsMessage');
        if (noResultsMessage) {
            noResultsMessage.style.display = foundMatch ? 'none' : 'block';
        }
    }

    if (searchForm && searchQueryInput) {
        searchForm.addEventListener('submit', function(event) {
            event.preventDefault();
            filterDestinations();
        });

        searchQueryInput.addEventListener('keyup', filterDestinations);
    }
</script>

</body>
</html>
