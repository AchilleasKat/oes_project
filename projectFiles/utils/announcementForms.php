<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="../projectFiles/css/form.css">
</head>

<?php
if ($_GET['show_form'] == 'announcement') { ?>

    <body>
        <form method="post" action="../projectFiles/database/announcementDB.php" class="form">
            <div class="formItem">
                <label for="subject">Θέμα:</label>
                <input type="text" name="subject" required>
            </div>

            <div class="formItem">
                <label for="body">Σώμα:</label>
                <textarea name="body" required></textarea>
            </div>

            <input class="submitButton" type="submit" value="Submit">
        </form>
    </body>
    <?php
}
?>

<?php
if ($_GET['show_form'] == 'edit' && isset($_GET['edit_form'])) {
    $announcementId = $_GET['edit_form'];

    ?>

    <body>
        <form method="post" action="../projectFiles/database/announcementDB.php" class="form">
            <div class="formItem">
                <label for="subject">Θέμα:</label>
                <input type="text" name="subject" required>
            </div>

            <div class="formItem">
                <label for="body">Σώμα:</label>
                <textarea name="body" required></textarea>
            </div>

            <input class="submitButton" type="submit" value="Submit">
        </form>
    </body>
    <?php
}
?>

</html>