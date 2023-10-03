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
            $form = "";

            $announcement_id = $row["id"];
            if ($_SESSION['role'] == 'tutor') {
                $deleteButton = "<form class=\"deleteForm\" method=\"post\" action=\"../projectFiles/database/announcementDB.php\">
                                        <input type=\"hidden\" name=\"announcement_id\" value= $announcement_id >
                                        <input type=\"submit\" name=\"delete\" value=\"διαγραφή\">
                                </form>";

                if (!isset($_GET['show_form']) || $_GET['show_form'] == 0) {
                    $editButton = "<a href='?showForm=edit&edit_form={$row["id"]}'>επεξεργασία</a>";
                } else if ($_GET['show_form'] == 'edit' && $_GET['edit_form'] == $row['id']) {
                    $editButton = '<a href="?show_form=0">Κλείσιμο Φόρμας</a>';
                    editAnnouncement($conn, $_GET['edit_form']);
                }
                if (isset($_GET['show_form']) && $_GET['show_form'] == 'edit') {
                    ob_start();
                    require(__DIR__ . '/../utils/announcementForms.php');
                    $form = ob_get_clean();
                }

            }

            $html = <<<HTML
                <div class="mainContent">
                    <div class="headerContainer">
                        <h2 class="contentHeader"> Ανακοίνωση $counter </h2>
                        $deleteButton
                        $editButton
                    </div>
                    <div class="contentBody">
                        $form
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
        echo "Δεν βρέθηκαν ανακοινώσεις.";
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST['delete'])) {
        $subject = $_POST["subject"];
        $body = $_POST["body"];
        $date = date("Y/m/d");

        $cleanSubject = sanitizeInput($subject);
        $cleanBody = sanitizeInput($body);
        $body = addLinkFunctionality($cleanBody);

        postAnnouncement($conn, $date, $cleanSubject, $body);

    } elseif (isset($_POST['delete'])) {
        $announcement_id = $_POST['announcement_id'];
        deleteAnnouncement($conn, $announcement_id);

    }
}

function postAnnouncement($conn, $date, $subject, $body)
{
    $sql = "INSERT INTO announcements(date,subject,body) VALUES ('$date','$subject','$body')";
    if ($conn->query($sql) === TRUE) {
        $redirect_url = "../../controller/announcement.php";

        $seconds = 3;

        echo "<html>";
        echo "<head>";
        echo "<meta http-equiv='refresh' content='{$seconds};url={$redirect_url}'>";
        echo "</head>";
        echo "<body>";
        echo "Η ανακοίνωση ανέβηκε με επιτυχία. <br>";
        echo "Ανακατεύθυνση σε {$seconds} δευτερόλεπτα...";
        echo "</body>";
        echo "</html>";
    } else {
        echo "Error: " . $sql . "<br>";
    }
}

function deleteAnnouncement($conn, $announcement_id)
{
    $sql = "DELETE FROM announcements WHERE id = '$announcement_id'";
    if ($conn->query($sql) === TRUE) {
        echo "Announcement deleted successfully!";
    } else {
        echo "Error deleting announcement: " . mysqli_error($conn);
    }
    unset($_POST['delete']);

    header("Location: ../../controller/announcement.php");
    exit();
}

function editAnnouncement($conn, $announcementId)
{
    ob_start();
    require(__DIR__ . '/../utils/announcementForms.php');
    $form = ob_get_clean();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $subject = $_POST["subject"];
        $body = $_POST["body"];
        $date = date("Y/m/d");

        $cleanSubject = sanitizeInput($subject);
        $cleanBody = sanitizeInput($body);
        $body = addLinkFunctionality($cleanBody);

        $sql = "INSERT INTO announcements(date,subject,body) VALUES ('$date','$cleanSubject','$body') WHERE id=$announcementId";
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