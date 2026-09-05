<?php
session_start();
$backgroundImage = "https://globalgrasshopper.com/wp-content/uploads/2011/01/Mumbai-India-scaled.jpg";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ExplorMor - Home</title>
  <link rel="icon" href="Img/EM_logo.jpg" type="image/x-icon">
  <link rel="stylesheet" href="styles.css"> <!-- External CSS -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
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
      background-color: #f4f4f4; /* Light background for contrast */
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

    ul {
        list-style: none;
        padding-left: 0;
    }

    /* --- Header & Navigation --- */
    header {
      background-color: #fff;
      padding: 1rem 5%; /* Use percentage for responsive padding */
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
      position: sticky; /* Make header stick to top */
      top: 0;
      z-index: 1000; /* Ensure it stays above other content */
      width: 100%;
    }

    nav {
      display: flex;
      justify-content: space-between;
      align-items: center;
      max-width: 1200px; /* Limit nav width */
      margin: 0 auto; /* Center nav */
    }

    .logo h1 {
      color: #0056b3; /* Match heading color */
      margin: 0; /* Remove default margin */
      font-size: 1.8rem;
    }

    .nav-links {
      list-style: none;
      display: flex;
    }

    .nav-links li {
      margin-left: 2rem;
    }

    .nav-links a {
      text-decoration: none;
      color: #333;
      font-weight: bold;
      padding-bottom: 0.3rem;
      border-bottom: 2px solid transparent; /* Prepare for active/hover underline */
      transition: color 0.3s ease, border-color 0.3s ease;
    }

    .nav-links a:hover,
    .nav-links a.active {
      color: #0056b3; /* Highlight color */
      border-bottom-color: #0056b3; /* Underline */
    }

    /* --- Hero Section --- */
    .hero {
      /* Added linear gradient overlay for better text contrast */
      background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),
                  url('<?php echo $backgroundImage; ?>') no-repeat center center/cover;
      height: 90vh; /* Slightly less than full viewport */
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
      color: #fff;
      padding: 0 20px; /* Padding for content on small screens */
    }

    .hero-content h1 {
      font-size: 3rem; /* Larger heading */
      margin-bottom: 1rem;
      font-weight: 600;
      color: #fff; /* Override default heading color */
    }

    .hero-content p {
      font-size: 1.2rem;
      margin-bottom: 2rem;
      color: #eee; /* Lighter paragraph color */
    }

    .btn { /* General button styling */
      display: inline-block;
      background-color: #007bff;
      color: #fff;
      padding: 0.8rem 1.8rem;
      text-decoration: none;
      border-radius: 5px;
      font-size: 1rem;
      font-weight: bold;
      transition: background-color 0.3s ease, transform 0.2s ease;
      border: none;
      cursor: pointer;
    }

    .btn:hover {
      background-color: #0056b3; /* Darker shade on hover */
      transform: translateY(-2px); /* Slight lift effect */
      text-decoration: none; /* Remove underline on hover */
    }

    /* --- About Us Section --- */
    .about-box {
      max-width: 900px; /* Readable width */
      margin: 3rem auto; /* Center section and add space */
      padding: 2.5rem; /* More internal spacing */
      background-color: #fff;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1); /* Subtle shadow */
      border-radius: 8px; /* Rounded corners */
    }

    .about-box h1 {
        text-align: center; /* Center main heading */
        margin-bottom: 1.5rem;
    }

    .about-box h2 {
      margin-top: 2rem; /* Space before sub-heading */
      margin-bottom: 1rem;
      border-bottom: 1px solid #eee; /* Separator */
      padding-bottom: 0.5rem;
    }

    .about-box p {
      line-height: 1.7; /* Improve readability */
    }

    .about-box ul {
      list-style: none; /* Remove default bullets */
      padding-left: 0;
      margin-top: 1rem;
    }

    .about-box ul li {
      margin-bottom: 1rem; /* Space between list items */
      padding-left: 1.8rem; /* Indentation for custom bullet */
      position: relative; /* For positioning the pseudo-element */
    }

    /* Custom bullet style for features */
    .about-box ul li::before {
        content: '✓'; /* Checkmark icon */
        position: absolute;
        left: 0;
        top: 1px; /* Adjust vertical alignment */
        color: #28a745; /* Green color for checkmark */
        font-weight: bold;
        font-size: 1.1rem;
    }

    .about-box ul li strong {
        color: #333; /* Ensure strong text is dark */
    }

    /* --- Footer Section --- */
    footer {
      text-align: center;
      margin-top: 3rem; /* Space above footer */
      padding: 1.5rem;
      background-color: #333; /* Dark background */
      color: #ccc; /* Light text color */
      font-size: 0.9rem;
    }

    footer a {
      color: #00aaff; /* Brighter link color for dark background */
    }

    footer a:hover {
      color: #fff;
    }

    #termsLink { /* Style the specific link for Terms */
        cursor: pointer;
        text-decoration: underline;
        font-weight: bold;
    }

    /* --- Modal Styles --- */
    .modal {
      display: none;
      position: fixed;
      z-index: 1001; /* Above header */
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      overflow: auto;
      background-color: rgba(0, 0, 0, 0.6); /* Darker overlay */
      padding-top: 5vh; /* Use viewport height for padding */
      animation: fadeIn 0.3s ease-out; /* Fade in animation */
    }

    .modal-content {
      background-color: #fefefe;
      margin: 5% auto;
      padding: 30px; /* Increased padding */
      border: none; /* Remove default border */
      border-radius: 8px; /* Rounded corners */
      width: 85%; /* Responsive width */
      max-width: 650px; /* Max width */
      box-shadow: 0 5px 15px rgba(0,0,0,0.2); /* More prominent shadow */
      animation: slideIn 0.3s ease-out; /* Slide in animation */
      position: relative; /* Needed for absolute positioning of close button */
    }

    .modal-content h2 {
        margin-top: 0; /* Remove default top margin */
        color: #0056b3; /* Brand color */
        border-bottom: 1px solid #eee; /* Separator line */
        padding-bottom: 0.75rem;
        margin-bottom: 1.5rem;
    }

    .modal-content ul {
        list-style-type: disc; /* Use standard bullets inside modal */
        padding-left: 25px; /* Indent list items */
        margin-bottom: 1.5rem;
    }

    .modal-content ul li {
        margin-bottom: 0.75rem; /* Space between modal list items */
    }
     .modal-content p {
        line-height: 1.7;
    }


    .close {
      color: #aaa;
      position: absolute; /* Position relative to modal-content */
      top: 10px; /* Position from top */
      right: 20px; /* Position from right */
      font-size: 32px; /* Larger close icon */
      font-weight: bold;
      line-height: 1; /* Prevent extra spacing */
      transition: color 0.2s ease;
    }

    .close:hover,
    .close:focus {
      color: #333; /* Darker on hover */
      text-decoration: none;
      cursor: pointer;
    }

    /* --- Modal Animations --- */
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes slideIn {
        from { transform: translateY(-30px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }

    /* --- Responsive Design --- */
    @media (max-width: 768px) {
      .nav-links {
         /* Uncomment and add JS for a burger menu if needed */
        /* display: none; */

        /* Basic stacking for simple menus: */
         flex-direction: column;
         position: absolute; /* Or adjust layout */
         top: 70px; /* Adjust based on header height */
         left: 0;
         background: #fff;
         width: 100%;
         padding: 1rem 0;
         box-shadow: 0 2px 5px rgba(0,0,0,0.1);
         display: none; /* Initially hidden - requires JS to toggle */
      }
       .nav-links li {
           margin: 0;
           text-align: center;
           padding: 0.8rem 0;
       }
        .nav-links a {
            border-bottom: none; /* Remove bottom border */
            padding: 0.5rem 1rem;
            display: block; /* Make links take full width */
        }
         .nav-links a.active, .nav-links a:hover {
             background-color: #f0f0f0; /* Highlight background on hover */
             color: #0056b3;
             border-bottom: none;
         }

      .hero-content h1 {
        font-size: 2.2rem;
      }
      .hero-content p {
        font-size: 1rem;
      }
      .about-box {
         margin: 2rem 5%; /* Adjust margin for smaller screens */
         padding: 1.5rem;
      }
      .modal-content {
        width: 90%;
        margin: 10% auto; /* Adjust vertical margin */
      }
    }

    @media (max-width: 480px) {
        header {
            padding: 0.8rem 5%;
        }
         nav {
             /* Optional: Stack logo and nav toggle button */
         }
         .logo h1 {
             font-size: 1.5rem;
         }

        .hero {
            height: 70vh; /* Shorter hero on small screens */
        }
        .hero-content h1 {
            font-size: 1.8rem;
        }
         .hero-content p {
            font-size: 0.9rem;
            margin-bottom: 1.5rem;
        }
        .btn {
            padding: 0.6rem 1.2rem;
            font-size: 0.9rem;
        }
        .about-box h1, .about-box h2 {
            font-size: 1.5rem;
        }
         .about-box {
             padding: 1rem;
         }
        footer {
            padding: 1rem;
            font-size: 0.8rem;
        }
        .modal-content {
            padding: 20px;
        }
        .close {
            font-size: 28px;
            top: 8px;
            right: 15px;
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
        <li><a href="home.php" class="active">Home</a></li>
        <li><a href="destination.php">Destinations</a></li>
        <li><a href="submit_contact.php">Contact-Us</a></li>
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

  <section class="hero">
    <div class="hero-content">
      <h1>ExplorMor Travels</h1>
      <p>Choose your dream destination and travel with us.</p>
      <a href="booktour.php" class="btn">Book Your Tour</a>
    </div>
  </section>

  <main>
    <section class="about-box">
      <h1>About Us</h1>
      <p>Welcome to ExplorMor, your ultimate travel partner for unforgettable journeys around the globe.
        We specialize in providing personalized tours, guided excursions, and seamless travel experiences. Whether you're
        looking for a relaxing beach holiday or an adventurous trekking expedition, we’ve got you covered.</p>

      <h2>Why Choose Us?</h2>
      <ul>
        <li><strong>Expert Guides:</strong> Our experienced and knowledgeable guides ensure you get the best out of every destination.</li>
        <li><strong>Tailored Packages:</strong> We offer custom travel packages to suit your personal preferences and budget.</li>
        <li><strong>24/7 Support:</strong> Our customer support team is available round the clock to assist with any travel queries or emergencies.</li>
        <li><strong>Wide Range of Destinations:</strong> From hidden gems to popular tourist spots, we cover it all.</li>
        <li><strong>Sustainable Travel:</strong> We are committed to responsible tourism and minimizing our environmental impact.</li>
        <li><strong>Customer Satisfaction:</strong> Your satisfaction is our priority, and we go the extra mile to ensure a memorable trip.</li>
      </ul>
    </section>
  </main>

  <footer>
    <p>&copy; 2025 Travel with Us. All rights reserved. <a href="#" id="termsLink">Terms and Conditions</a></p>
  </footer>

  <div id="termsModal" class="modal">
    <div class="modal-content">
      <span class="close" id="closeModal">&times;</span>
      <h2>Terms and Conditions</h2>
      <p>Welcome to ExplorMor! By using our services, you agree to the following terms and conditions:</p>
      <ul>
        <li><strong>Booking Policy:</strong> All bookings must be made in advance and confirmed by our team.</li>
        <li><strong>Payment Terms:</strong> Payments should be made prior to the trip as per the agreed schedule.</li>
        <li><strong>Cancellation Policy:</strong> Cancellations made less than 24 hours before the scheduled trip may incur a fee.</li>
        <li><strong>Liability:</strong> ExplorMor is not responsible for any injuries or losses incurred during travel.</li>
        <li><strong>Refund Policy:</strong> Refunds will be processed according to the nature of the cancellation.</li>
      </ul>
      <p>By proceeding with the booking, you acknowledge that you have read, understood, and agreed to the terms above.</p>
    </div>
  </div>

  <script>
    // Modal functionality remains the same
    const termsLink = document.getElementById("termsLink");
    const termsModal = document.getElementById("termsModal");
    const closeModal = document.getElementById("closeModal");

    if (termsLink && termsModal && closeModal) {
        termsLink.addEventListener("click", function(event) {
            event.preventDefault();
            termsModal.style.display = "block";
        });

        closeModal.addEventListener("click", function() {
            termsModal.style.display = "none";
        });

        window.addEventListener("click", function(event) {
            if (event.target == termsModal) {
                termsModal.style.display = "none";
            }
        });

        window.addEventListener('keydown', function (event) {
            if (event.key === 'Escape') {
                if (termsModal.style.display === 'block') {
                    termsModal.style.display = 'none';
                }
            }
        });
    }
  </script>
</body>
</html>
