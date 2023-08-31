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
        <link rel="stylesheet" href="../css/main.css" />
        <link rel="stylesheet" href="../css/index.css">
        <link href="../css/main.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
        <link href="../css/index.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
    </head>

    <body>
        <div class="container">
            <div class="header">
                <h1 id="title">Αρχική Σελιδα</h1>
            </div>
            <div class="navigation">
                <?php
                include('../utils/navigation.html');
                ?>
            </div>
            <div class="main">
                <ul class="homeMainText">
                    <li>Καλωσορίσατε στον ιστοχώρο εκμάθησης Βασικών Αρχών Δημιουργίας ιστοσελίδων.</li>
                    <li>Στην σελίδα Ανακοινώσεις βρίσκονται όλα τα νεα σχετικά με το μάθημα.</li>
                    <li>Στην σελίδα Επικοινωνία βρίσκονται τα στοιχεία επικοινωνίας του διδάσκοντα.</li>
                    <li>Στην σελίδα Έγγραφα Μαθήματος βρίσκεται το περιεχόμενο του μαθήματος.</li>
                    <li>Στην σελίδα Εργασίες αναρτώνται οι εργασίες του μαθήματος.</li>
                </ul>
            </div>
            <div class="footer">
                <img src="../images/html_head.jpg" alt="html header code">
            </div>
        </div>
    </body>
<?php } ?>

</html>