<?php
    session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Main Page - PHP CRUD Membership Authentication</title>
        <link rel="stylesheet" href="css/styles.css">
    </head>

    <body>
        <?php
            if(isset($_SESSION['user'])) {
                echo "Hello " . $_SESSION['user'] . "<br/>";
                echo "<a href='logout.php'>Signout</a>";
            } else {
                echo "<a href='login.php'>Sign-in</a><br/>";
                echo "<a href='register.php'>Register</a>";
            }
        ?>
    </body>
    <script src="js/main.js"></script>
</html>