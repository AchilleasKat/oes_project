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
            include('../utils/navigation.html');
            ?>
        </div>
        <div class="main">
            <div id="topDiv"></div>
            <div class="formContainer">
                <div class="formLink">
                    <?php
                    if (!isset($_GET['show_form']) || $_GET['show_form'] == 0) {
                        echo '<a href="?show_form=1">Προσθήκη νέας ανακοίνωσης</a>';
                    } else {
                        echo '<a href="?show_form=0">Κλείσιμο Φόρμας</a>';
                    }
                    ?>
                </div>
                <?php
                if (isset($_GET['show_form']) && $_GET['show_form'] == 1) {
                    echo '<div class="mainForm">';
                    require('../utils/announcementForm.html');
                    echo '</div>';
                }
                ?>
            </div>
            <form class="announcementBody" method="GET">
                <?php
                require('../database/announcementsDB.php');
                ?>
            </form>
            <div class="footer">
                <a href="#topDiv"> top </a>
            </div>
        </div>
    </div>
</body>

</html>