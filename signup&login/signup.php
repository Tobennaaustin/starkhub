<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Hash the password (always use password_hash in production)
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

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

    // Check if the user already exists
    $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "Username already exists";
    } else {
        // Insert a new user
        $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $username, $hashedPassword);
        $stmt->execute();

        // Redirect to the personal page after successful signup
        header("Location: personal.php?username=" . $username);
        exit();
    }

    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Sign Up</title>
</head>
<body>
    <h2>Sign Up</h2>
    <form action="signup.php" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <button type="submit">Sign Up</button>
        <p>Already have an account? <span><a href="login.php">Login</a></span></p>
    </form>
</body>
</html>
