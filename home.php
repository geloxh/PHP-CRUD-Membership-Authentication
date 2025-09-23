<?php
    session_start();
    if(!isset($_SESSION['user'])) { // Checks if the users is logged in
        header("location: index.php"); // Redirects if user is not logged in
        exit();
    }
    $user = $_SESSION['user']; // Assigns user value
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Home Page - PHP CRUD Membership Authentication</title>
        <link rel="stylesheet" href="css/styles.css">
    </head>
    
    <body>
        <h2>PHP CRUD Membership Authentication</h2>
        <p>Hello <?php echo htmlspecialchars($user); ?>!</p> <!-- Displays user's name -->
        <a href="logout.php">Sign-out</a><br/><br/>

        <form action="add.php" method="POST">
            <h3>Add more to list: </h3>
            <textarea name="details" required></textarea><br/>
            Public post? <input type="checkbox" name="public[]" value="yes" /><br/>
            <input type="submit" value="Add to list" />
        </form>

        <h2 align="center">All list</h2>
        <table border="ipx" width="100%">
            <tr>
                <th>Id</th>
                <th>Details</th>
                <th>Post Time</th>
                <th>Edit</th>
                <th>Delete</th>
                <th>Public</th>
            </tr>
            <?php
                $conn = mysqli_connect("localhost", "root", "", "simple_db");
                if (!conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }

                // Prepare and execute the query to fetch items for the logged-in user
                $stmt = mysqli_prepare($conn, "SELECT `id`, `details`, `date_posted`, `time_posted`, `is_public` FROM `list` WHERE `username`=?");
                mysqli_stmt_bind_param($stmt, "s", $user);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);

                if(mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        $id = $row['id'];
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['details']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['date_posted']) . " - " . htmlspecialchars($row['time_posted']) . "</td>";
                        echo "<td><a href='edit.php?id=$id'>Edit</a></td>";
                        echo "<td><a href='delete.php?id=$id'>Delete</a></td>";
                        echo "<td>" . htmlspecialchars($row['is_public']) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>You have no items in your list.</td></tr>";
                }
                mysqli_stmt_close($stmt);
                mysqli_close($conn);
            ?>
        </table>
    </body>
    <script src="js/main.js"></script>
</html>