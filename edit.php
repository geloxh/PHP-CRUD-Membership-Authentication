<?php
    session_start();
    if(!isset($_SESSION['user'])) {
        header("location: index.php");
        exit();
    }

    $conn = mysqli_connect("localhost", "root", "", "simple_db");
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    if($_SERVER['REQUEST_METHOD'] == "GET") {

        $id = $_GET['id'];
        $user = $_SESSION['user'];

        $stmt = mysqli_prepare($conn, "SELECT details, is_public FROM list WHERE id = ? AND username = ?");
        mysql_stmt_bind_param($stmt, "is", $id, $user);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if(mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $details = $row['details'];
            $is_public = $row['is_public'];
        } else {
            header("location: home.php");
            exit();
        }
        mysqli_stmt_close($stmt);
    }

    if($_SERVER['REQUEST_METHOD'] == "POST") {
        $id = $_GET['id'];
        $details = $_POST['details'];
        $is_public = "no";
        if(isset($_POST['public']) && is_array($_POST['public']) && in_array("yes", $_POST['public'])) {
            $is_public = "yes";
        }
        $user = $_SESSION['user'];

        $stmt = mysqli_prepare($conn, "UPDATE list SET details = ?, is_public = ? WHERE id = ? AND username = ?");
        mysqli_stmt_bind_param($stmt, "ssis", $details, $is_public, $id, $user);
        mysqli_stmt_close($stmt);

        header("location: home.php");
        exit();
    }
    mysqli_close($conn);

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
        <form action="edit.php?id=<?php echo htmlspecialchars($_GET['id']); ?>" method="POST">
            <textarea name="details" required><?php echo htmlspecialchars($details); ?></textarea><br/>
            Public post? <input type="checkbox" name="public[]" value="yes" <?php if($is_public == 'yes') { echo "checked";} ?> /><br/>
            <input type="submit" value="Update List" />
        </form>
    </body>
</html>

<?php
    if($_SERVER['REQUEST_METHOD'] == "POST") {
        $conn = mysqli_connect("localhost", "root", "", "simple_db");
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $id = mysqli_real_escape_string($conn, $_GET['id']);
        $details = mysqli_real_escape_string($conn, $_POST['details']);
        $is_public = "no";
        if(isset($_POST['public']) && is_array($_POST['public']) && in_array("yes", $_POST['public'])) {
            $is_public = "yes";
        }

        $user = mysqli_real_escape_string_string($conn, $_SESSION['user']);

        mysqli_query($conn, "UPDATE list SET details = '$details', is_public = '$is_public' WHERE id = '$id' AND username = '$user'");

        mysqli_close($conn);

        header("location: home.php");

        exit();
    }
?>