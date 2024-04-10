<?php
session_start(); // Start session

require 'config.php';
require 'database.php';

// Function to authenticate user
function authenticateUser($email, $pass) {
    list($mysqli, $connect_error) = create_database_connection();
    
    if ($connect_error) {
        return "Database connection error";
    }
    
    // Prevent SQL Injection by using prepared statements
    $stmt = $mysqli->prepare("SELECT user_email, user_pass FROM users WHERE user_email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        $stmt->bind_result($db_email, $db_password);
        $stmt->fetch();

        if (password_verify($pass, $db_password)) {
            $_SESSION['user_email'] = $db_email; // Store user email in session
            return true; 
        } else {
            return "Incorrect password";
        }
    } else {
        return "User not found";
    }
}

$error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['username'];
    $pass = $_POST['password'];

    if (!empty($email) && !empty($pass)) {
        $authentication_result = authenticateUser($email, $pass);
        if ($authentication_result === true) {
            header('Location: ./index.php'); // Redirect to dashboard upon successful login
            exit();
        } else {
            $error_message = $authentication_result;
        }
    } else {
        $error_message = "Please fill in all fields";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
</head>
<body>

<div class="login-container">
    <h2>Login</h2>
    <form action="./login.php" method="POST">
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <button type="submit" class="btn-login">Login</button>
    </form>
    <?php if (!empty($error_message)) { ?>
        <div class="error-message"><?php echo $error_message; ?></div>
    <?php } ?>
</div>

</body>
</html>
