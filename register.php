<?php
require 'config.php';
require 'database.php';
$g_title = BLOG_NAME . ' - Index';
$g_page = 'register';
require 'header.php';
require 'menu.php';

$error_message = '';
function newUser($email, $pass, $pass2) {
    list($mysqli, $connect_error) = create_database_connection();
    
    if ($connect_error) {
        return "Database connection error";
    }
    if($pass == $pass2){
        $hashedpass = password_hash($pass, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (user_email, user_pass) VALUES ('$email', '$hashedpass')";
        $result = $mysqli->query($sql);
    
        if ($result) {
            header('Location: ./login.php');
            exit();
        } 
    }
    $error_message = 'Password did not match';

}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['username'];
    $pass = $_POST['password'];
    $pass2 = $_POST['password_2'];

    if (!empty($email) && !empty($pass) && !empty($pass2)) {
        $error_message = newUser($email, $pass, $pass2);
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
    <title>Registration Page</title>
    <style>
        /* Your CSS styles here */
    </style>
</head>
<body>

<div class="login-container">
    <h2>Register</h2>
    <form action="./register.php" method="POST">
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div class="form-group">
            <label for="password_2">Password:</label>
            <input type="password_2" id="password_2" name="password_2" required>
        </div>
        <button type="submit" class="btn-login">Register</button>
    </form>
    <?php if (!empty($error_message)) { ?>
        <div class="error-message"><?php echo $error_message; ?></div>
    <?php } ?>
</div>

</body>
</html>
