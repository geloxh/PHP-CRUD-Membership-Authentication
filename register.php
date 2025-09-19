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
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        $conn = mysqli_connect("localhost", "root", "", "simple_db");
        if (!$conn) {
            die("Connection failed: Couldn't connect to database " . mysqli_connect_error());
        }

        // Check if username already exists using prepared statements
        $stmt  = mysqli_prepare($conn, "SELECT username FROM users WHERE username = ?");
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        if (mysqli_stmt_num_rows($stmt) > 0) {
            print '<script>alert("Username has been taken!");</script>'; // Prompts the user
            print '<script>window.location.assign("register.php");</script>'; // Redirects to register.php
        } else {
            // Hash the password for security
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Insert new user using prepared statements
            $insert_stmt = mysqli_prepare($conn, "INSERT INTO users (username, password) VALUES (?, ?)");
            mysqli_stmt_bind_param($insert_stmt, "ss", $username, $hashed_password);

            if(mysqli_stmt_execute($insert_stmt)) {
                print '<script>alert("Successfully Registered!");</script>';
                print '<script>window.location.assign("login.php");</script>'; // Redirect to login page
            } else {
                print '<script>alert("Error in Registration.");</script>';
            }
            mysqli_stmt_close($insert_stmt);
        }
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    }
?>