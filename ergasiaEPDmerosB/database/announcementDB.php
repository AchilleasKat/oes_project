<?php
require(__DIR__ . '/database.php');

if ($_SERVER["REQUEST_METHOD"] == "GET") {

    $sql = "SELECT * FROM announcements ORDER BY date DESC";
    $result = $conn->query($sql);

    $counter = 0;
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $counter++;

            $editButton = "";
            $deleteButton = "";

            if ($_SESSION['role'] == 'tutor') {
                $deleteButton = "<a href='?delete={$row["id"]}'>διαγραφή</a>";
                $editButton = "<a href='?edit_form={$row["id"]}'>επεξεργασία</a>";
            }

            $html = <<<HTML
                <div class="mainContent">
                    <div class="headerContainer">
                        <h2 class="contentHeader"> Ανακοίνωση $counter </h2>
                        $deleteButton
                        $editButton
                    </div>
                    <div class="contentBody">
                        <?php
                            if(isset(edit_form) && edit_form==$row[id]){

                            }
                        ?>
                        <ul>
                            <li><b>Ημερομηνία</b>: {$row["date"]}</li>
                            <li><b>Θέμα</b>: {$row["subject"]}</li>
                            <li>{$row["body"]}</li>
                        </ul>
                    </div>
                </div>
HTML;

            echo $html;
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

function deleteAnnouncement($announcementId)
{
    // Implement the delete operation in the database
    // ...

    // Redirect back to the page displaying announcements
    header("Location: display_announcements.php");
    exit;
}

function editAnnouncement($conn, $announcementId)
{
    // Retrieve announcement details from the database based on $announcementId
    // ...

    // Display an edit form pre-populated with the announcement data
    // ...

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
        header("Location: display_announcements.php");
        exit;
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
//The strings that will be replaced are of this form: [url=https://www.example.com]Visit Example[/url] .
function addLinkFunctionality($input)
{
    return preg_replace('/\[url=([^\]]+)\](.*?)\[\/url\]/', '<a href="$1" class="announcement-link">$2</a>', $input);
}

mysqli_close($conn);
?>