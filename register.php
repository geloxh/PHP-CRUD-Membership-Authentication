<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Register Page - PHP CRUD Membership Authentication</title>
        <link rel="stylesheet" href="">
    </head>

    <body>
        <h2>Create Account</h2>
        <a href="index.php">Return to Main page<br/><br/>
        <form action="register.php" method="POST">
            Username: <input type="text"
            name="username" required="required" /><br/>
            Password: <input type="password"
            name="password" required="required" /><br/>
            <input type="submit" value="Register" />
        </form>
    </body>
</html>

<?php
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['password']);
        
        echo "Username entered is: " . $username . "<br/>";
        echo "Password entered is: " . $password;
     }
?>

