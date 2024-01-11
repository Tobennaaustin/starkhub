<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Personal Page</title>
</head>
<body>
    <?php
    // Get the username from the URL parameter
    $username = $_GET["username"];

    // Connect to the database (replace these values with your actual database credentials)
    $servername = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbName = "user_auth";

    $conn = new mysqli($servername, $dbUsername, $dbPassword, $dbName);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve user information based on the provided username
    $stmt = $conn->prepare("SELECT id, username FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $retrievedUsername);
        $stmt->fetch();

        // Display user information
        // echo "<h2>Welcome, $retrievedUsername!</h2>";
        // echo "<p>Your personal information goes here.</p>";
    } else {
        echo "User not found";
    }

    $stmt->close();
    $conn->close();
    ?>
    <p><?php echo "<h2>Welcome, $retrievedUsername!</h2>"; ?></p>
</body>
</html>
