<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="../projectFiles/css/form.css">
</head>

<?php
if ($_GET['show_form'] == 'homework') { ?>

    <body>
        <form method="post" action="../projectFiles/database/homeworkDB.php" class="form">
            <div class="formItem">
                <label for="goals">Στόχοι <br> (χωρίστε τους στόχους με κόμμα):</label>
                <textarea name="goals" required></textarea>
            </div>

            <div class="formItem">
                <label for="docs">Παραδοτέα Αρχεία <br> (χωρίστε τα αρχεία με κόμμα):</label>
                <input type="text" name="docs" required>
            </div>

            <div class="formItem">
                <label for="deadline">Προθεσμία:</label>
                <input type="date" name="deadline" required>
            </div>

            <div class="formItem">
                <label for="path">Θέση Αρχείου:</label>
                <input type="file" name="path" required>
            </div>

            <input class="submitButton" type="submit" value="Submit">
        </form>
    </body>
    <?php
}
?>

<?php
if ($_GET['show_form'] == 'edit' && isset($_GET['id'])) {
    $homeworkId = $_GET['id'];
    ?>

    <body>
        <form method="POST" action="update.php">
            <input type="text" name="subject" value="<?php echo $subject; ?>">
            <textarea name="body"><?php echo $body; ?></textarea>
            <!-- other input fields -->
            <input type="submit" value="Update">
        </form>
    </body>
    <?php
}
?>

</html>