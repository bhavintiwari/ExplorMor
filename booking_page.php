<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Form</title>
    <style>
        /* Internal CSS starts here */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
            display: flex;
            flex-direction: column; /* Stack elements vertically */
            align-items: center; /* Center horizontally */
            min-height: 100vh; /* Ensure body takes full viewport height */
        }

        h2 {
            color: #333;
            text-align: center;
            margin-bottom: 25px;
        }

        form {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px; /* Limit form width */
            box-sizing: border-box; /* Include padding in width calculation */
            margin-bottom: 20px; /* Space below the form */
        }

        label {
            display: block; /* Each label on its own line */
            margin-bottom: 8px;
            font-weight: bold;
            color: #555;
        }

        input[type="text"],
        input[type="email"],
        input[type="number"] {
            width: 100%; /* Full width of the container */
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box; /* Include padding and border in element's total width/height */
            font-size: 16px;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="number"]:focus {
            border-color: #007bff; /* Highlight focus */
            outline: none; /* Remove default outline */
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.25);
        }

        input[type="submit"] {
            background-color: #28a745; /* Green color */
            color: white;
            padding: 14px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%; /* Full width */
            font-size: 16px;
            font-weight: bold;
            transition: background-color 0.3s ease; /* Smooth transition on hover */
            margin-top: 10px;
        }

        input[type="submit"]:hover {
            background-color: #218838; /* Darker green on hover */
        }

        /* Styles for success and error messages */
        .success, .error {
            padding: 15px;
            margin: 20px auto; /* Centered horizontally */
            border-radius: 5px;
            text-align: center;
            font-weight: bold;
            width: 100%;
            max-width: 500px; /* Match form width */
            box-sizing: border-box;
        }

        .success {
            color: #155724;
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
        }

        .error {
            color: #721c24;
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
        }

        /* Style for the "Go to Payment" link to look like a button */
        .button {
            display: inline-block; /* Allow padding and centering */
            background-color: #007bff; /* Blue color */
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none; /* Remove underline */
            font-size: 16px;
            font-weight: bold;
            text-align: center;
            transition: background-color 0.3s ease;
            margin-top: 10px; /* Space above the button */
        }

        .button:hover {
            background-color: #0056b3; /* Darker blue on hover */
            color: white; /* Keep text color white on hover */
        }

        /* Center the payment button/link if it appears */
        /* The PHP code generates this link outside the form, so style it relative to body/container */
        /* We can wrap the PHP output in a div if more control is needed, but centering the button itself works */
        body > a.button { /* Target button directly under body */
            display: block; /* Make it a block to center with margin */
            width: fit-content; /* Size button to content */
            margin: 15px auto 0 auto; /* Center horizontally, add top margin */
        }

        /* Optional: Adjust spacing for smaller screens */
        @media (max-width: 600px) {
            form {
                padding: 20px;
            }
            h2 {
                font-size: 1.5em;
            }
        }
        /* Internal CSS ends here */
    </style>
</head>
<body>
    <h2>Booking Form</h2>

    <form action="payments.php" method="POST">
        <label for="package_id">Package ID:</label><br>
        <input type="number" id="package_id" name="package_id" required><br>
        <label for="package_name">Package Name:</label><br>
        <input type="text" id="package_name" name="package_name" required><br>

        <label for="price">Price:</label><br>
        <input type="number" id="price" name="price" step="0.01" required><br>

        <label for="user_name">Your Name:</label><br>
        <input type="text" id="user_name" name="user_name" required><br>

        <label for="user_email">Your Email:</label><br>
        <input type="email" id="user_email" name="user_email" required><br>

        <label for="user_phone">Your Phone Number:</label><br>
        <input type="text" id="user_phone" name="user_phone" required><br>

        <label for="state_name">State:</label><br>
        <input type="text" id="state_name" name="state_name" required><br>

        <input type="submit" value="Submit Booking">
    </form>

    <?php
    // --- PHP Database connection and form processing code goes here ---
    // --- Make sure this PHP block is correctly placed relative to HTML ---
    // --- Example PHP block structure (replace with your actual code) ---
    
    // Initialize variables (do this *before* the HTML output if possible,
    // but for this example, we keep it close to where it's used)
    $success_message = "";
    $error_message = "";
    $booking_id = null;
    $user_name_for_link = "";
    $price_for_link = "";
    
    // Check if form was submitted (this logic needs to run before the closing </body> tag)
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Database connection settings
        $servername = "localhost"; 
        $username = "root";
        $password = "";
        $dbname = "explormor"; 

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            // Use the error class for connection errors too
            $error_message = "Database Connection failed: " . $conn->connect_error;
        } else {
            // Get form data (sanitize/validate these inputs in a real application!)
            $package_id = $_POST['package_id'];
            $package_name = $_POST['package_name'];
            $price = $_POST['price'];
            $user_name = $_POST['user_name'];
            $user_email = $_POST['user_email'];
            $user_phone = $_POST['user_phone'];
            $state_name = $_POST['state_name'];

            // Prepare user name and price for the link later
            $user_name_for_link = $user_name;
            $price_for_link = $price;

            // Get the current timestamp for booking_date
            $booking_date = date('Y-m-d H:i:s');

            // Prepare and bind the SQL query
            // Assuming s_id should be an integer, using 0 as placeholder
            $stmt = $conn->prepare("INSERT INTO bookings (package_id, package_name, price, user_name, user_email, user_phone, booking_date, s_id, state_name) 
                                     VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            
            // Check if statement prepared correctly
            if ($stmt) {
                $s_id_placeholder = 0; // Placeholder for s_id
                // Bind parameters: i=integer, s=string, d=double
                $stmt->bind_param("isdssssis", $package_id, $package_name, $price, $user_name, $user_email, $user_phone, $booking_date, $s_id_placeholder, $state_name);

                // Execute the query
                if ($stmt->execute()) {
                    $success_message = "Booking successful! Your booking has been saved.";
                    $booking_id = $stmt->insert_id; // Get the last inserted booking_id
                } else {
                    $error_message = "Error saving booking: " . $stmt->error;
                }
                // Close the statement
                $stmt->close();
            } else {
                 $error_message = "Error preparing statement: " . $conn->error;
            }
            // Close the connection
            $conn->close();
        }
    } // end of POST check

    // Display success or error messages (outside the form)
    if (!empty($success_message)) {
        echo "<p class='success'>$success_message</p>";
        // Display the link only on success and if booking_id is set
        if ($booking_id !== null) {
             echo "<a href='payments.php?booking_id=$booking_id&user_name=" . urlencode($user_name_for_link) . "&price=$price_for_link' class='button'>Go to Payment</a>";
        }
    }
    if (!empty($error_message)) {
        echo "<p class='error'>$error_message</p>";
    }
    ?>
    
</body>
</html>
