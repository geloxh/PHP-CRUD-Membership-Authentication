<?php
    session_start();
    // Redirect user to index page if not logged in
    if(!isset($_SESSION['user'])) {
        header("location: index.php");
        exit();
    }

    // Check if 'id' is set in the GET request
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        $user = $_SESSION['user'];

        // Establish database connection
        $conn = mysqli_connect("localhost", "root", "", "simple_db");
        if(!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Use a prepared statement to prevent SQL injection
        // This ensures users can only delete their own items
        $stmt = mysqli_prepare($conn, "DELETE FROM list WHERE id = ? AND username = ?");
        mysqli_stmt_bind_param($stmt, "is", $id, $user);

        // Execute the statement and redirect
        if(mysqli_stmt_execute($stmt)) {
            header("location: home.php");
            exit();
        } else {
            echo "Error deleting record: " . mysqli_error($conn);
        }

        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    } else {
        // Redirect if 'id' is not provided
        header("location: home.php");
        exit();
    }
?>