<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login Page - PHP CRUD Memebership Aunthentication</title>
        <link rel="stylesheet" href="">
    </head>

    <body>
        <h2>Login Page</h2>
        <a href="index.php">Return to Main Page<br/><br/>
        <form action="checklogin.php" method="POST">
            Username: <input type="text"
            name="username" required="required" /><br/>
            Password: <input type="password"
            name="password" required="required" /><br/>
            <input type="submit" value="Login" />
        </form>
    </body>
</html>
