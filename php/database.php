<?php
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $database = "oes_project_db";

    try {
        $conn = mysqli_connect( $hostname, 
                                $username, 
                                $password, 
                                $database);
    } catch (mysqli_sql_exception) {
        echo "Database connection failed!";
    }
?>