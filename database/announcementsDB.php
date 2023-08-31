<?php
require('database.php');

if ($_SERVER["REQUEST_METHOD"] == "GET") {

    $sql = "SELECT * FROM announcements ORDER BY date DESC";
    $result = $conn->query($sql);

    $counter = 0;
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $counter++;
            echo "<div class=\"mainContent\">
                    <h2 class=\"contentHeader\"> Ανακοίνωση $counter </h2>
                    <div class=\"contentBody\">
                        <ul>
                            <li><b>Ημερομηνία</b>:" . $row["date"] . "  </li>
                            <li><b>Θέμα</b>: " . $row["subject"] . " </li>
                            <li>" . $row["body"] . "</li>
                        </ul>
                    </div>
                </div>";
        }
    } else {
        echo "No results found.";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $subject = $_POST["subject"];
    $body = $_POST["body"];
    $date = $_POST["date"];
    //$date = date("Y/m/d");

    $cleanSubject = sanitizeInput($subject);
    $cleanBody = sanitizeInput($body);

    $sql = "INSERT INTO announcements(date,subject,body) VALUES ('$date','$cleanSubject','$cleanBody')";
    if ($conn->query($sql) === TRUE) {
        echo "Record inserted successfully";
    } else {
        echo "Error: " . $sql . "<br>";
    }
}

function sanitizeInput($input)
{
    $cleanInput = filter_var($input, FILTER_SANITIZE_STRING);

    $allowedTags = array(
        'a' => array('href' => true),
        'br' => array(),
    );

    $cleanInput = strip_tags($cleanInput, '<' . implode('><', array_keys($allowedTags)) . '>');
    $cleanInput = htmlspecialchars($cleanInput, ENT_QUOTES, 'UTF-8');

    return $cleanInput;
}

mysqli_close($conn);
?>