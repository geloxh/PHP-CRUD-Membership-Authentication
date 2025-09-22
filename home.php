<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Home Page - PHP CRUD Membership Authentication</title>
        <link rel="stylesheet" href="css/styles.css">
    </head>

    <?php
    session_start(); // Starts the session
    if($_SESSION['user']) { // Checks if the users is Logged in
    } else {
        header("location: index.php"); // Redirects if user is not Logged in
    }
    $user = $_SESSION['user']; // Assigns user value
    ?>

    <body>
        <h2>PHP CRUD Membership Authentication</h2>
        <p>Hello <?php print "$user"?>!</p> <!-- Displays user's name -->
        <a href="logout.php">Signout</a><br/><br/>
        <form action="add.php" method="POST">
            Add more to list: <input type="text" name="details" /> <br/>
            Public post? <input type="checkbox" name="public[]" value="yes" /> <br/>
            <input type="submit" value="Add to list"/>
        </form>
        <h2 align="center">All list</h2>
        <table border="ipx" width="100%">
        <tr>
            <th>Id</th>
            <th>Details</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </body>
    <script src="js/main.js"></script>
</html>