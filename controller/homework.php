<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header('Location: ./login.php');
    exit;
} else {
    $_SESSION["login_redirect"] = $_SERVER["PHP_SELF"];
    if ($_SESSION['role'] == 'tutor') {
        include("../pages/homework-tutor.php");
    } else {
        include("../pages/homework.php");
    }
}
?>