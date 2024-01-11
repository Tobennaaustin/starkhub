<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

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

    // Retrieve the hashed password for the given username
    $stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $hashedPassword);
        $stmt->fetch();

        // Verify the password
        if (password_verify($password, $hashedPassword)) {
            header("Location: personal.php?username=" . $username);
            exit();
        } else {
            echo "Invalid credentials";
        }
    } else {
        echo "Invalid credentials";
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
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <form action="login.php" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <button type="submit">Login</button>
        <p>Don't have an account? <span><a href="signup.php">signup</a></span></p>
    </form>
</body>
</html>
