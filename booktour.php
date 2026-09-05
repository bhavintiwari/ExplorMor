<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tour Booking Request - ExplorMor</title>
    <link rel="icon" href="Img/EM logo.jpg" type="image/x-icon"> <style>
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

        /* --- Header & Navigation (Consistent with other pages) --- */
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
            padding-left: 0;
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
        .nav-links a.active {
            color: #0056b3;
            border-bottom-color: #0056b3;
        }

        /* --- Tour Request Form Section --- */
        .tour-request-form {
            max-width: 700px; /* Sensible max-width for a form */
            margin: 3rem auto; /* Center the form vertically and horizontally */
            padding: 2.5rem 3rem; /* Generous padding inside the form card */
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1); /* Soft shadow */
        }

        .tour-request-form h2 {
            text-align: center;
            margin-bottom: 2.5rem; /* More space below heading */
            font-size: 2.2rem;
            color: #0056b3;
        }

        /* --- Form Grouping & Labels --- */
        .form-group {
            margin-bottom: 1.75rem; /* Consistent spacing between fields */
        }

        .form-group label {
            display: block; /* Label on its own line */
            margin-bottom: 0.6rem; /* Space below label */
            font-weight: bold;
            color: #444; /* Slightly darker label */
            font-size: 1rem;
        }

        /* --- Input Fields & Textarea --- */
        .form-group input[type="text"],
        .form-group input[type="email"],
        .form-group input[type="date"],
        .form-group input[type="number"],
        .form-group textarea {
            width: 100%; /* Full width */
            padding: 0.9rem 1.1rem; /* Comfortable padding */
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
            line-height: 1.4;
            background-color: #fdfdfd; /* Slightly off-white background */
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .form-group textarea {
            min-height: 120px; /* Default height for textarea */
            resize: vertical; /* Allow only vertical resizing */
        }

        /* Input Focus Styles */
        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #007bff; /* Highlight border */
            box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.2); /* Soft glow effect */
            background-color: #fff; /* White background on focus */
        }

        /* --- Submit Button --- */
        .tour-request-form button[type="submit"] {
            display: block; /* Block level */
            width: 100%; /* Full width */
            padding: 0.9rem 1.5rem; /* Button padding */
            background-color: #007bff; /* Primary button color */
            color: #fff; /* White text */
            border: none;
            border-radius: 5px;
            font-size: 1.1rem;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
            margin-top: 1.5rem; /* Space above the button */
        }

        .tour-request-form button[type="submit"]:hover {
            background-color: #0056b3; /* Darker shade on hover */
            transform: translateY(-2px); /* Slight lift effect */
        }

        /* --- Footer (Consistent with other pages) --- */
        footer {
            text-align: center;
            margin-top: 4rem; /* More space above footer */
            padding: 1.5rem;
            background-color: #333;
            color: #ccc;
            font-size: 0.9rem;
        }

        footer p {
            margin-bottom: 0; /* Remove default paragraph margin */
        }

        footer a {
            color: #00aaff;
        }

        footer a:hover {
            color: #fff;
        }

        /* --- Responsive Design --- */
        @media (max-width: 768px) {
            .tour-request-form {
                margin: 2rem auto;
                padding: 2rem;
                max-width: 90%; /* Allow form to use more width */
            }
            .tour-request-form h2 {
                font-size: 1.9rem;
            }
        }

        @media (max-width: 480px) {
            .tour-request-form {
                padding: 1.5rem 1.2rem;
                 margin: 1.5rem auto;
                 max-width: 95%;
            }
            .tour-request-form h2 {
                font-size: 1.7rem;
                margin-bottom: 2rem;
            }
            .form-group {
                margin-bottom: 1.25rem;
            }
            .form-group label {
                font-size: 0.9rem;
                margin-bottom: 0.4rem;
            }
            .form-group input,
            .form-group textarea {
                padding: 0.8rem 0.9rem;
                font-size: 0.95rem;
            }
            .tour-request-form button[type="submit"] {
                 padding: 0.8rem 1rem;
                 font-size: 1rem;
            }
             footer {
                 margin-top: 2.5rem;
             }
        }
    </style>
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
            <li><a href="login.php">Contact Us</a></li>
            </ul>
    </nav>
</header>

<main> <section class="tour-request-form">
        <h2>Submit Your Tour Request</h2>
        <p style="text-align: center; margin-top: -1.5rem; margin-bottom: 2rem; color: #666;">Fill out the details below, and we'll get back to you soon!</p> <form action="submit_tour_request.php" method="POST">
            <div class="form-group">
                <label for="full_name">Full Name:</label>
                <input type="text" id="full_name" name="full_name" required placeholder="Enter your full name">
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required placeholder="your.email@example.com">
            </div>

            <div class="form-group">
                <label for="phone_number">Phone Number:</label>
                <input type="tel" id="phone_number" name="phone_number" required placeholder="e.g., +91 98765 43210"> </div>

            <div class="form-group">
                <label for="tour_destination">Preferred Destination(s):</label>
                <input type="text" id="tour_destination" name="tour_destination" required placeholder="e.g., Kerala, Ladakh, Rajasthan">
            </div>

            <div class="form-group">
                <label for="tour_start_date">Preferred Tour Start Date:</label> <input type="date" id="tour_start_date" name="tour_start_date" required> </div>

            <div class="form-group">
                <label for="tour_end_date">Preferred Tour End Date:</label> <input type="date" id="tour_end_date" name="tour_end_date" required>
            </div>

            <div class="form-group">
                <label for="number_of_people">Number of People:</label>
                <input type="number" id="number_of_people" name="number_of_people" required min="1" placeholder="e.g., 2"> </div>

            <div class="form-group">
                <label for="tour_type">Type of Tour:</label> <input type="text" id="tour_type" name="tour_type" required placeholder="e.g., Adventure, Leisure, Cultural, Family">
            </div>

            <div class="form-group">
                <label for="special_request">Special Requests / Interests:</label> <textarea id="special_request" name="special_request" placeholder="Any specific requirements like dietary needs, accessibility, activities..."></textarea>
            </div>

            <div class="form-group">
                <label for="budget">Approximate Budget (per person, if applicable):</label> <input type="number" id="budget" name="budget" required min="0" placeholder="e.g., 50000 (Specify currency if needed)"> </div>

            <button type="submit">Submit Request</button>
        </form>
    </section>
</main>

<footer>
    <p>&copy; <?php echo date("Y"); ?> ExplorMor. All rights reserved.</p>
</footer>

</body>
</html>