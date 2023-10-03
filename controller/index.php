<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header('Location: ../controller/login.php');
    exit;
} else {
    $_SESSION["login_redirect"] = $_SERVER["PHP_SELF"];
    ?>
    <!-- if user is logged in display the page  -->
    <!DOCTYPE html>
    <html lang="gr">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width initial-scale=1.0">
        <title>Δημιουργία Ιστοσελίδων-Αρχική Σελίδα</title>
        <link rel="stylesheet" href="../ergasiaEPDmerosB/css/main.css" />
        <link rel="stylesheet" href="../ergasiaEPDmerosB/css/index.css">
        <link href="../ergasiaEPDmerosB/css/main.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
        <link href="../ergasiaEPDmerosB/css/index.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
    </head>

    <body>
        <div class="container">
            <div class="header">
                <h1 id="title">Αρχική Σελιδα</h1>
            </div>
            <nav class="navigation">
                <?php
                include('../ergasiaEPDmerosB/utils/navigation.html');
                ?>
            </nav>
            <div class="main">
                <ul class="homeMainText">
                    <li>Καλωσορίσατε στον ιστοχώρο εκμάθησης <strong>Βασικών Αρχών Δημιουργίας ιστοσελίδων</strong>.</li>
                    <li>Στην σελίδα <strong><a class="index-link" href="announcement.php">Ανακοινώσεις</a></strong>
                        βρίσκονται όλα τα νεα σχετικά με το μάθημα.</li>
                    <li>Στην σελίδα <strong><a class="index-link" href="communication.php">Επικοινωνία</a></strong>
                        βρίσκονται τα στοιχεία επικοινωνίας του διδάσκοντα.</li>
                    <li>Στην σελίδα <strong><a class="index-link" href="document.php">Έγγραφα
                                Μαθήματος</a></strong>
                        Μαθήματος βρίσκεται το περιεχόμενο του μαθήματος.</li>
                    <li>Στην σελίδα <strong><a class="index-link" href="homework.php">Εργασίες</a></strong>
                        αναρτώνται οι
                        εργασίες του μαθήματος.</li>
                </ul>
            </div>
            <div class="footer">
                <img src="../ergasiaEPDmerosB/images/html_head.jpg" alt="html header code">
            </div>
        </div>
    </body>
<?php } ?>

</html>