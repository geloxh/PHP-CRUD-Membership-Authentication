<?php
    session_start();
    session_destroy(); // ends the session
    header("location: index.php"); // Redirect to the main page
?>