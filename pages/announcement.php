<?php
    // Start the session
    session_start();
    
    // Check if the user is logged in
    if (!isset($_SESSION['username'])) {
        $_SESSION["login_redirect"] = $_SERVER["PHP_SELF"];
        header('Location: ../php/login.php');
        exit;
    }else{
        ?>
        <!DOCTYPE html>
        <html lang="gr">
        
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width initial-scale=1.0">
            <title>Ανακοινώσεις</title>
            <link rel="stylesheet" href="../css/main.css" />
            <link rel="stylesheet" href="../css/content.css" />
            <link rel="stylesheet" href="../css/announcements.css">
            <link href="../css/main.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
            <link href="../css/content.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
            <link href="../css/announcements.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
        </head>
        
        <body>
            <div class="container">
                <div class="header">
                    <h1 id="title">
                        Ανακοινώσεις
                    </h1>
                </div>
                <div class="navigation">
                    <?php
                        include('../php/navigation.php');
                    ?>
                </div>
                <div class="main">
                     <div class="mainContent" id="topDiv">
                        <h2 class="contentHeader" > Ανακοίνωση 1</h2>
                        <div class="contentBody"> 
                            <ul> 
                                <li><b>Ημερομηνία</b>: 19/09/2022 </li>
                                <li><b>Θέμα</b>: Έναρξη μαθημάτων </li>
                                <li>Τα μαθήματα αρχίζουν την Δευτέρα 2/10/2022</li>
                            </ul>
                        </div>
                    </div>
                    <div class="mainContent">
                        <h2 class="contentHeader"> Ανακοίνωση 2</h2>
                        <div class="contentBody"> 
                                <ul> 
                                    <li><b>Ημερομηνία</b>: 18/10/2022 </li>
                                    <li><b>Θέμα</b>: Ανάρτηση εργασίας </li>
                                    <li>Η 1η εργασία έχει ανακοινωθεί στην ιστοσελίδα <a class="announcement-link" href="homework.html" title="Εργασίες"> <<Εργασίες>> </a>. </li>
                                </ul>
                        </div>
                    </div>
                    <div class="mainContent">
                        <h2 class="contentHeader"> Ανακοίνωση 3</h2>
                        <div class="contentBody"> 
                                <ul> 
                                    <li><b>Ημερομηνία</b>: 19/10/2022 </li>
                                    <li><b>Θέμα</b>: Ερωτήσεις για εργασία </li>
                                    <li>Για ερωτήσεις για την εργασία μπορείτε να επικοινωνήσετε μεσω τον τρόπων που αναφέρονται στην σελίδα <a class="announcement-link" href="communication.html">Επικοινωνία</a>.  </li>      
                                </ul>
                        </div>
                    </div>
                    <div class="mainContent">
                        <h2 class="contentHeader"> Ανακοίνωση 4</h2>
                        <div class="contentBody"> 
                                <ul> 
                                    <li><b>Ημερομηνία</b>: 25/11/2022 </li>
                                    <li><b>Θέμα</b>: Ανάρτηση εργασίας </li>
                                    <li>Η 2η εργασία έχει ανακοινωθεί στην ιστοσελίδα <a class="announcement-link" href="homework.html" title="Εργασίες"> <<Εργασίες>> </a>. </li>
                                </ul>
                        </div>
                    </div>
                    <div class="mainContent">
                        <h2 class="contentHeader"> Ανακοίνωση 5</h2>
                        <div class="contentBody"> 
                                <ul> 
                                    <li><b>Ημερομηνία</b>: 24/12/2022 </li>
                                    <li><b>Θέμα</b>: Ευχές  </li>
                                    <li>Σας ευχομαι καλα Χριστούγεννα και ευτυχισμένο το καινουργιο έτος. </li>
                                </ul>
                        </div>
                    </div>
                    <div class="footer">
                        <a href="#topDiv"> top </a>
                    </div>
                </div>
                </div>
        </body>
        
<?php }?>
</html>