<?php
    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Connect to the database
        $conn = mysqli_connect("localhost", "root", "", "simple_db");
        if (!$conn) {
            die("Connection problem: Cannot connect to database " . mysqli_connect_error());
        }

        // Prepare a statement to prevent SQL injection
        $stmt = mysqli_prepare($conn, "SELECT password FROM users WHERE username = ?");
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        if (mysqli_stmt_num_rows($stmt) > 0) {
            mysqli_stmt_bind_result($stmt, $hashed_password);
            mysqli_stmt_fetch($stmt);

            // Verify the password
            if (password_verify($password, $hashed_password)) {
                $_SESSION['user'] = $username;
                header("location: home.php"); // Redirect to a welcome page
            } else {
                // Incorrect password
                print '<script>alert("Incorrect Password!");</script>';
                print '<script>window.location.assign("login.php");</script>';
            }
        } else {
            // Incorrect username
            print '<script>alert("Incorrect Username!");</script>';
            print '<script>window.location.assign("login.php");</script>';
        }

        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    }
?>