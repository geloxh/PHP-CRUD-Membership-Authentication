<?php
    session_start();
    // Redirect user to index page if not logged in
    if(!isset($_SESSION['user'])) {
        header("location: index.php");
        exit(); // Stop script execution
    }

    // Check if the form was submitted
    if($_SERVER['REQUEST_METHOD'] == "POST") {
        $username = $_SESSION['user']; // Get username from session
        $details = $_POST['details'];

        // Use modern date/time functions
        $date = date("F d, Y"); // date
        $time = date("h:i:s A"); // time

        // Determine if the post is public. Default to 'no'.
        $is_public = "no";
        if (isset($_POST['public']) && $_POST['public'][0] == 'yes') {
            $is_public = "yes";
        }

        // Establish a secure database connection
        $conn = mysqli_connect("localhost", "root", "", "simple_db");
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Use a prepared statment to prevent SQL injection
        // This assumes the 'list' table has 'username' columns to associate the post with a user
        $stmt = mysqli_prepare($conn, "INSERT INTO `list` (`details`, `date_posted`, `time_posted`, `is_public`, `username`) VALUES (?, ?, ?, ?, ?");
        mysqli_stmt_bind_param($stmt, "sssss", $details, $date, $time, $is_public, $username);

        // Execute the statement and redirect
        if (mysqli_stmt_execute($stmt)) {
            header("location: home.php");
            exit(); // Good pratice to exit after redirect
        } else {
            // For debugging, you might want to see the error
            echo "ERROR: Could not execute query " . mysqli_error($stmt);
        }

        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    }  else {
        // Redirect if accessed directly without POST method
        header("location: home.php");
        exit();
    }
?>