<?php
$jsonString = file_get_contents('../db-properties.json');
$databaseProperties = json_decode($jsonString, true);

$hostname = $databaseProperties["hostname"];
$username = $databaseProperties["username"];
$password = $databaseProperties["password"];
$database = $databaseProperties["database"];

try {
    $conn = mysqli_connect(
        $hostname,
        $username,
        $password,
        $database
    );
} catch (mysqli_sql_exception) {
    echo "Database connection failed!";
}
?>