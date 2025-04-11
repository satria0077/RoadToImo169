<?php
// PHP code for handling login
session_start();

// Example user credentials (in a real application, this would be fetched from a database)
$valid_username = "admin";
$valid_password = "password123"; // Always hash passwords in real applications for security

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Simple authentication check
    if ($username == $valid_username && $password == $valid_password) {
        // Successful login, redirect to another page or dashboard
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        header("Location: dashboard.php"); // Redirect to the dashboard page
        exit;
    } else {
        $error_message = "Invalid username or password!";
    }
}
?>

<html>
<head>
    <title>Login Page</title>
    <link rel="stylesheet" href="styles.css">
    <link rel
</head>
<body>
    <h1>Login to Your Account</h1>

    <!-- Display error message if login fails -->
    <?php if (isset($error_message)) { echo "<p style='color: red;'>$error_message</p>"; } ?>

    <!-- Login form -->
    <form action="" method="POST">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required><br><br>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required><br><br>

        <input type="submit" value="Login">
    </form>

    <p>Don't have an account? <a href="register.php">Register here</a></p>
</body>
</html>
