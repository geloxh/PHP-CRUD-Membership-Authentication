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
        <a href="index.php">Return to Home page<br/><br/>
        
        <form action="register.php" method="POST">
            Username: <input type="text"
            name="username" required="required" /><br/>
            Password: <input type="password"
            name="password" required="required" /><br/>
            Re-Enter Password: <input type="re-en-password"
            name="re-en-password" required="required" /><br/>
            <input type="submit" value="Register" />
        </form>
    </body>
</html>


