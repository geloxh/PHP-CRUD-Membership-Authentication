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
        <div class="container">
            <h1>Welcome to PHP CRUD Membership Authentication</h1>
            <?php
                if(isset($_SESSION['user'])) {
                    echo "Hello " . $_SESSION['user'] . "<br/>";
                    echo '<a href="home.php" class="button">Go to Home</a>';
                    echo "<a href='logout.php' class='button'>Sign-out</a>";
                } else {
                    echo "<p>Please sign-in or register to continue.</p>";
                    echo "<a href='login.php' class='button'>Sign-in</a>";
                    echo "<a href='register.php' class='button'>Register</a>";
                }
            ?>
        </div>
    </body>
</html>