<?php
require(__DIR__ . '/database.php');

if ($_SERVER["REQUEST_METHOD"] == "GET") {

    $sql = "SELECT * FROM documents ORDER BY id";
    $result = $conn->query($sql);

    $counter = 0;
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $counter++;

            $editButton = "";
            $deleteButton = "";

            $document_id = $row["id"];
            if ($_SESSION['role'] == 'tutor') {
                $deleteButton = "<form class=\"deleteForm\" method=\"post\" action=\"../ergasiaEPDmerosB/database/documentDB.php\">
                                        <input type=\"hidden\" name=\"document_id\" value= $document_id >
                                        <input type=\"submit\" name=\"delete\" value=\"διαγραφή\">
                                </form>";

                if (!isset($_GET['show_form']) || $_GET['show_form'] == 0) {
                    $editButton = "<a href='../ergasiaEPDmerosB/database/documentDB.php?showForm=edit&edit_form={$row["id"]}'>επεξεργασία</a>";
                } else if ($_GET['show_form'] == 'edit' && $_GET['edit_form'] == $row['id']) {
                    $editButton = '<a href="?show_form=0">Κλείσιμο Φόρμας</a>';
                    editdocument($conn, $_GET['edit_form']);
                }

            }

            $html = <<<HTML
                <div class="mainContent">
                    <div class="headerContainer">
                        <h2 class="contentHeader"> {$row['title']} </h2>
                        $deleteButton
                        $editButton
                    </div>
                <div class="contentBody">
                    <p>{$row['description']}</p>
                    <a href="../ergasiaEPDmerosB/files/{$row['path']}">Download</a>
                </div>
                </div>
HTML;

            echo $html;
        }
    } else {
        echo "Δεν υπάρχουν αρχεία.";
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST['delete'])) {
        $title = $_POST["title"];
        $description = $_POST["description"];
        $path = $_POST["path"];

        $cleanTitle = sanitizeInput($title);
        $cleandescription = sanitizeInput($description);
        $description = addLinkFunctionality($cleandescription);

        postDocument($conn, $title, $description, $path);

    } elseif (isset($_POST['delete'])) {
        $document_id = $_POST['document_id'];
        deletedocument($conn, $document_id);

    }
}

function postDocument($conn, $title, $description, $path)
{
    $sql = "INSERT INTO documents(title,description,path) VALUES ('$title','$description','$path')";
    if ($conn->query($sql) === TRUE) {
        $redirect_url = "../../2941merosB/document.php";

        $seconds = 3;

        echo "<html>";
        echo "<head>";
        echo "<meta http-equiv='refresh' content='{$seconds};url={$redirect_url}'>";
        echo "</head>";
        echo "<body>";
        echo "Το αρχείο ανέβηκε με επιτυχία <br>";
        echo "Ανακατεύθυνση σε {$seconds} δευτερόλεπτα...";
        echo "</body>";
        echo "</html>";
    } else {
        echo "Error: " . $sql . "<br>";
    }
}

function deleteDocument($conn, $document_id)
{
    $sql = "DELETE FROM documents WHERE id = '$document_id'";
    if ($conn->query($sql) === TRUE) {
        echo "document deleted successfully!";
    } else {
        echo "Error deleting document: " . mysqli_error($conn);
    }
    unset($_POST['delete']);

    header("Location: ../../2941merosB/document.php");
    exit();
}

function editDocument($conn, $documentId)
{
    require(__DIR__ . '/../utils/documentForms.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $title = $_POST["title"];
        $description = $_POST["description"];
        $path = $_POST["path"];

        $cleanSubject = sanitizeInput($subject);
        $cleanBody = sanitizeInput($body);
        $body = addLinkFunctionality($cleanBody);

        $sql = "INSERT INTO documents(title,description,path) VALUES ('$title','$description','$path')";
        if ($conn->query($sql) === TRUE) {
            echo "Document inserted successfully";
        } else {
            echo "Error: " . $sql . "<br>";
        }
        header("Location: display_documents.php");
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
    return preg_replace('/\[url=([^\]]+)\](.*?)\[\/url\]/', '<a href="$1" class="document-link">$2</a>', $input);
}

mysqli_close($conn);
?>