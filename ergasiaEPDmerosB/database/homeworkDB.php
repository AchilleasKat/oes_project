<?php
require(__DIR__ . '/database.php');

if ($_SERVER["REQUEST_METHOD"] == "GET") {

    $sql = "SELECT * FROM homework ORDER BY id";
    $result = $conn->query($sql);

    $counter = 0;
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $counter++;

            $editButton = "";
            $deleteButton = "";

            $homework_id = $row["id"];
            if ($_SESSION['role'] == 'tutor') {
                $deleteButton = "<form class=\"deleteForm\" method=\"post\" action=\"../ergasiaEPDmerosB/database/homeworkDB.php\">
                                        <input type=\"hidden\" name=\"homework_id\" value= $homework_id >
                                        <input type=\"submit\" name=\"delete\" value=\"διαγραφή\">
                                </form>";

                if (!isset($_GET['show_form']) || $_GET['show_form'] == 0) {
                    $editButton = "<a href='../ergasiaEPDmerosB/database/homeworkDB.php?showForm=edit&edit_form={$row["id"]}'>επεξεργασία</a>";
                } else if ($_GET['show_form'] == 'edit' && $_GET['edit_form'] == $row['id']) {
                    $editButton = '<a href="?show_form=0">Κλείσιμο Φόρμας</a>';
                    edithomework($conn, $_GET['edit_form']);
                }

                if (isset($_GET['show_form']) && $_GET['show_form'] == 'homework') {
                    $form = file_get_contents(__DIR__ . '/../utils/homeworkForms.php');
                }
            }

            $goalsField = $row["goals"];
            $docsField = $row["docs"];

            $goalsArray = explode(",", $goalsField);
            $docsArray = explode(",", $docsField);

            $goalsList = "";
            $docsList = "";

            foreach ($goalsArray as $goal) {
                $goalsList .= "<li>$goal</li>";
            }
            foreach ($docsArray as $doc) {
                $docsList .= "<li>$doc</li>";
            }
            $deadline = date("d/m/Y", strtotime($row['deadline']));


            $html = <<<HTML
                <div class="mainContent">
                    <div class="headerContainer">
                        <h2 class="contentHeader"> Εργασία $counter</h2>
                        $deleteButton
                        $editButton
                    </div>
                    <div class="contentBody">

                    Στόχοι:Οι στόχοι της εργασίας είναι

                    <div class="orderedList">
                        <ol>
                            $goalsList
                        </ol>
                    </div>
                    Εκφώνηση:
                    <div class="indented">
                        Κατεβάστε την εκφώνηση από <a href="../ergasiaEPDmerosB/files/{$row['path']}">εδώ</a>
                    </div>
                    Παραδοτέα:
                    <div class="orderedList">
                        <ol>
                            $docsList
                        </ol>
                    </div>
                    <div class="deadline">
                        Ημερομηνία Παράδοσης: $deadline
                    </div>
                </div>
HTML;

            echo $html;
        }
    } else {
        echo "Δεν υπάρχουν εργασίες.";
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST['delete'])) {
        $goals = $_POST["goals"];
        $path = $_POST["path"];
        $docs = $_POST["docs"];
        $deadline = $_POST["deadline"];

        $cleanGoals = sanitizeInput($goals);
        $cleanPath = sanitizeInput($path);
        $cleanDocs = sanitizeInput($docs);
        $cleanDeadline = sanitizeInput($deadline);

        postHomework($conn, $cleanGoals, $cleanPath, $cleanDocs, $cleanDeadline);

    } elseif (isset($_POST['delete'])) {
        $homework_id = $_POST['homework_id'];
        deleteHomework($conn, $homework_id);

    }
}

function postHomework($conn, $goals, $path, $docs, $deadline)
{
    $sql = "INSERT INTO homework(goals, path, docs, deadline) VALUES ('$goals', '$path', '$docs' ,'$deadline')";
    if ($conn->query($sql) === TRUE) {
        $redirect_url = "../../2941merosB/homework.php";

        $seconds = 3;

        echo "<html>";
        echo "<head>";
        echo "<meta http-equiv='refresh' content='{$seconds};url={$redirect_url}'>";
        echo "</head>";
        echo "<body>";
        echo "Η εργασία ανέβηκε με επιτυχία <br>";
        echo "Ανακατεύθυνση σε {$seconds} δευτερόλεπτα...";
        echo "</body>";
        echo "</html>";
    } else {
        echo "Error: " . $sql . "<br>";
    }
}

function deleteHomework($conn, $homework_id)
{
    $sql = "DELETE FROM homework WHERE id = '$homework_id'";
    if ($conn->query($sql) === TRUE) {
        echo "Homework deleted successfully!";
    } else {
        echo "Error deleting homework: " . mysqli_error($conn);
    }
    unset($_POST['delete']);

    header("Location: ../../2941merosB/homework.php");
    exit();
}

function edithomework($conn, $homeworkId)
{
    require(__DIR__ . '/../utils/homeworkForms.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $title = $_POST["title"];
        $description = $_POST["description"];
        $path = $_POST["path"];

        $cleanSubject = sanitizeInput($subject);
        $cleanBody = sanitizeInput($body);
        $body = addLinkFunctionality($cleanBody);

        $sql = "INSERT INTO homework(title,description,path) VALUES ('$title','$description','$path')";
        if ($conn->query($sql) === TRUE) {
            echo "Homework inserted successfully";
        } else {
            echo "Error: " . $sql . "<br>";
        }
        header("Location: display_homeworks.php");
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
    return preg_replace('/\[url=([^\]]+)\](.*?)\[\/url\]/', '<a href="$1" class="homework-link">$2</a>', $input);
}

mysqli_close($conn);
?>