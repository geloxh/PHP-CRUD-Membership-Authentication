<?php
    session_start();
    if(!isset($_SESSION['user'])) {
        header("location: index.php");
        exit();
    }

    if($_SERVER['REQUEST_METHOD'] == "GET") {
        $conn = mysqli_connect("localhost", "root", "", "simple_db");
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $id = mysqli_real_escape_string($conn, $_GET['id']);
        $user = mysqli_real_escape_string($conn, $_SESSION['user']);

        $query = mysqli_query($conn, "SELECT * FROM list WHERE id = '$id' AND username = '$user'");
        $count = mysqli_num_rows($query);

        if($count > 0) {
            $row = mysqli_fetch_array($query);
            $details = $row['details'];
            $is_public = $row['is_public'];
        } else {
            header("location: home.php");
            exit();
        }
        mysqli_close($conn);
    } else {
        header("location: home.php");
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edit Page - PHP CRUD Membership Authentication</title>
        <link rel="stylesheet" href="css/styles.css">
    </head>

    <body>
        <h2>Edit Item</h2>
        <a href="home.php">Home</a><br/><br/>
        <form action="edit.php?id=<?php echo $id; ?>" method="POST">
            <textarea name="details" required><?php echo htmlspecialchars($details); ?></textarea