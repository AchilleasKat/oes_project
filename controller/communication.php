<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header('Location: ./login.php');
    exit;
} else {
    $_SESSION["login_redirect"] = $_SERVER["PHP_SELF"];
    include("../projectFiles/pages/communication.php");
}
?>