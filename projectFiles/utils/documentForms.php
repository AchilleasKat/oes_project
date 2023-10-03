<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="../projectFiles/css/form.css">
</head>

<?php
if ($_GET['show_form'] == 'document') { ?>

    <body>
        <form method="post" action="../projectFiles/database/documentDB.php" class="form">
            <div class="formItem">
                <label for="title">Τιτλος:</label>
                <input type="text" name="title" required>
            </div>

            <div class="formItem">
                <label for="description">Περιγραφή:</label>
                <textarea name="description" required></textarea>
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
    $documentId = $_GET['id'];

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