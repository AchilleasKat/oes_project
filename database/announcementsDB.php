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
    $date = date("Y/m/d");

    $cleanSubject = sanitizeInput($subject);
    $cleanBody = sanitizeInput($body);
    $body = addLinkFunctionality($cleanBody);

    $sql = "INSERT INTO announcements(date,subject,body) VALUES ('$date','$cleanSubject','$body')";
    if ($conn->query($sql) === TRUE) {
        echo "Record inserted successfully";
    } else {
        echo "Error: " . $sql . "<br>";
    }
}

//This function removes potentially harmful characters from the input.
function sanitizeInput($input)
{
    $cleanInput = filter_var($input, FILTER_SANITIZE_STRING);
    $cleanInput = htmlspecialchars($cleanInput, ENT_QUOTES, 'UTF-8');

    return $cleanInput;
}
//This function replaces the string that the user has submited as url with an <a> tag so that the link can be displayed.
//The strings that will be replaced are of this form [url=https://www.example.com]Visit Example[/url].
function addLinkFunctionality($input)
{
    return preg_replace('/\[url=([^\]]+)\](.*?)\[\/url\]/', '<a href="$1" class="announcement-link">$2</a>', $input);
}

mysqli_close($conn);
?>