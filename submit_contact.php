<?php
session_start(); // Start the session at the very beginning
// Database connection settings
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "explormor"; // Replace with your actual database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    error_log("Database Connection failed: " . $conn->connect_error);
    $error_message = "Could not process request due to a server issue. Please try again later.";
}

$name = $email = $subject = $message = "";
$success_message = "";
$error_message = $error_message ?? "";

// Process the form if POST request
if ($conn && !$conn->connect_error && $_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    $created_at = date('Y-m-d H:i:s');

    $stmt = $conn->prepare("INSERT INTO contactus (name, email, subject, message, created_at) VALUES (?, ?, ?, ?, ?)");

    if ($stmt === false) {
        error_log('Prepare failed: ' . $conn->error);
        $error_message = "An error occurred while preparing your message. Please try again.";
    } else {
        $stmt->bind_param("sssss", $name, $email, $subject, $message, $created_at);

        if ($stmt->execute()) {
            $success_message = "Thank you for contacting us! Your message has been received.";
            $name = $email = $subject = $message = "";
        } else {
            error_log("Execute failed: " . $stmt->error);
            $error_message = "An error occurred while sending your message. Please try again.";
        }

        $stmt->close();
    }
}

if ($conn && !$conn->connect_error) {
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - ExplorMor</title>
    <link rel="icon" href="Img/EM_logo.jpg" type="image/x-icon">
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
            display: flex; /* Use flexbox for sticky footer */
            flex-direction: column; /* Stack elements vertically */
            min-height: 100vh; /* Ensure body takes full viewport height */
        }

        html {
            scroll-behavior: smooth;
        }

        main {
            flex-grow: 1; /* Allow main content to grow and push footer down */
             padding: 2rem 0; /* Add some padding top/bottom */
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

        /* --- Header & Navigation (Consistent) --- */
        header {
            background-color: #fff;
            padding: 1rem 5%;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            /* position: sticky; Optional: make header sticky */
            /* top: 0; */
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

        /* Specific active style for Contact Us */
        .nav-links a[href="submit_contact.php"], /* Target link by href */
        .nav-links a.active /* Or if you manually add class="active" */
         {
            color: #0056b3;
            border-bottom-color: #0056b3;
        }
         /* Hover styles */
        .nav-links a:not(.active):hover {
            color: #0056b3;
            border-bottom-color: #ccc; /* Subtle underline on hover for non-active */
        }


        /* --- Contact Form Section --- */
        .contact-form-section {
            max-width: 700px;
            margin: 1rem auto 3rem auto; /* Centered with vertical margin */
            padding: 2.5rem 3rem;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .contact-form-section h2 {
            text-align: center;
            margin-bottom: 2rem;
            font-size: 2.2rem;
            color: #0056b3;
        }

        /* --- Form Grouping & Labels --- */
        .form-group {
            margin-bottom: 1.5rem; /* Spacing between fields */
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: bold;
            color: #444;
            font-size: 1rem;
        }

        /* --- Input Fields & Textarea --- */
        .form-group input[type="text"],
        .form-group input[type="email"],
        .form-group textarea {
            width: 100%;
            padding: 0.8rem 1rem;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
            line-height: 1.4;
            background-color: #fdfdfd;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
            font-family: inherit; /* Ensure form fields use body font */
        }

        .form-group textarea {
            min-height: 120px;
            resize: vertical;
        }

        /* Input Focus Styles */
        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #007bff;
            box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.2);
            background-color: #fff;
        }

        /* --- Submit Button Styling --- */
        /* Style input[type="submit"] like a button */
        .contact-form-section input[type="submit"] {
            display: block;
            width: 100%;
            padding: 0.9rem 1.5rem;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 1.1rem;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
            margin-top: 1rem;
            -webkit-appearance: none; /* Remove default browser styling */
            appearance: none;
        }

        .contact-form-section input[type="submit"]:hover {
            background-color: #0056b3;
            transform: translateY(-2px);
        }

         /* --- Message Area Styling --- */
        .message-area {
             margin: 1.5rem auto 0 auto; /* Position below form */
             text-align: center;
             max-width: 640px; /* Match form width */
             padding: 0 1rem; /* Add padding for messages */
        }
        .message-area .success,
        .message-area .error {
             padding: 1rem 1.5rem; /* More padding */
             border-radius: 5px;
             font-weight: 500; /* Medium weight */
             margin-bottom: 1rem; /* Space below message */
             border: 1px solid transparent; /* Base border */
             font-size: 1rem;
        }
        .message-area .success {
             background-color: #d1e7dd; /* Softer green */
             color: #0a3622; /* Darker green text */
             border-color: #a3cfbb;
        }
        .message-area .error {
             background-color: #f8d7da; /* Standard light red */
             color: #58151c; /* Darker red text */
             border-color: #f1aeb5;
        }

        /* --- Footer (Consistent) --- */
        footer {
            text-align: center;
            /* margin-top: auto; Pushed down by flex-grow on main */
            padding: 1.5rem;
            background-color: #333;
            color: #ccc;
            font-size: 0.9rem;
            width: 100%; /* Ensure footer spans width */
        }

        footer p {
            margin-bottom: 0;
        }

        footer a {
            color: #00aaff;
        }

        footer a:hover {
            color: #fff;
        }

        /* --- Responsive Design --- */
        @media (max-width: 768px) {
             nav { flex-direction: column; align-items: flex-start; }
             .logo h1 { margin-bottom: 0.5rem;}
             .nav-links { flex-direction: column; width: 100%;}
             .nav-links li { margin: 0.5rem 0; text-align: center;}
              .nav-links a { display: block; padding: 0.5rem; border-bottom: none;}
             .nav-links a:hover, .nav-links a.active { background-color: #f0f0f0; border-radius: 4px;}

            .contact-form-section {
                padding: 2rem 1.5rem;
                max-width: 90%;
                margin-top: 1.5rem;
            }
            .contact-form-section h2 {
                font-size: 1.9rem;
            }
             .message-area {
                 max-width: 85%;
             }
        }

        @media (max-width: 480px) {
            main { padding: 1rem 0; }
            .contact-form-section {
                padding: 1.5rem 1rem;
                 margin-top: 1rem;
                 max-width: 95%;
            }
            .contact-form-section h2 {
                font-size: 1.7rem;
                margin-bottom: 1.5rem;
            }
             .form-group {
                 margin-bottom: 1.2rem;
             }
            .form-group label {
                font-size: 0.9rem;
            }
            .form-group input,
            .form-group textarea {
                padding: 0.7rem 0.8rem;
                font-size: 0.95rem;
            }
            .contact-form-section input[type="submit"] {
                 padding: 0.8rem 1rem;
                 font-size: 1rem;
             }
             .message-area .success, .message-area .error {
                 padding: 0.8rem 1rem;
                 font-size: 0.95rem;
             }
             footer { padding: 1rem; font-size: 0.85rem;}
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
                <li><a href="destination.php">Destinations</a></li>
                <li><a href="submit_contact.php" class="active">Contact Us</a></li>
                <!-- Dynamically display login/logout -->
                <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true): ?>
                    <li><a href="logout.php">Logout</a></li>
                <?php else: ?>
                    <li><a href="login.php">Login</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>

    <main>
        <section class="contact-form-section">
            <h2>Contact Us</h2>
            <p style="text-align: center; margin-top: -1.5rem; margin-bottom: 2rem; color: #666;">Have questions? Fill out the form below to get in touch!</p>

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                <div class="form-group">
                    <label for="name">Your Name:</label>
                    <input type="text" id="name" name="name" required value="<?php echo htmlspecialchars($name); ?>" placeholder="Enter your full name">
                </div>

                <div class="form-group">
                    <label for="email">Your Email:</label>
                    <input type="email" id="email" name="email" required value="<?php echo htmlspecialchars($email); ?>" placeholder="your.email@example.com">
                </div>

                <div class="form-group">
                    <label for="subject">Subject:</label>
                    <input type="text" id="subject" name="subject" required value="<?php echo htmlspecialchars($subject); ?>" placeholder="Reason for contacting us">
                </div>

                <div class="form-group">
                    <label for="message">Message:</label>
                    <textarea id="message" name="message" rows="5" required placeholder="Enter your message here..."><?php echo htmlspecialchars($message); ?></textarea>
                </div>

                <input type="submit" value="Send Message">
            </form>

            <div class="message-area">
                <?php
                if (!empty($success_message)) {
                    echo "<p class='success'>" . htmlspecialchars($success_message) . "</p>";
                }
                if (!empty($error_message)) {
                    echo "<p class='error'>" . htmlspecialchars($error_message) . "</p>";
                }
                ?>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> ExplorMor. All rights reserved.</p>
    </footer>
</body>
</html>
