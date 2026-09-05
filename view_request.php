<?php
// Database credentials
$host = 'localhost'; // Your host
$dbname = 'explormor'; // Your database name
$username = 'root'; // Your username
$password = ''; // Your password

// Create a connection
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    die();
}

// Fetch the contact requests from the database
$stmt = $pdo->query("SELECT * FROM contactus ORDER BY created_at DESC");
$requests = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Requests</title>
    <link rel="stylesheet" href="contactus.css">
</head>
<body>

<h2>Contact Us Requests</h2>

<table border="1">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Subject</th>
            <th>Message</th>
            <th>Created At</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($requests as $request): ?>
        <tr>
            <td><?php echo $request['id']; ?></td>
            <td><?php echo $request['name']; ?></td>
            <td><?php echo $request['email']; ?></td>
            <td><?php echo $request['subject']; ?></td>
            <td><?php echo nl2br($request['message']); ?></td>
            <td><?php echo $request['created_at']; ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

</body>
</html>
