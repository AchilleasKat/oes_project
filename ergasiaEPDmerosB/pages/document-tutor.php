<!DOCTYPE html>
<html lang="gr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title> 'Εγγραφα Μαθήματος</title>
    <link rel="stylesheet" href="../ergasiaEPDmerosB/css/main.css" />
    <link rel="stylesheet" href="../ergasiaEPDmerosB/css/content.css" />
    <link rel="stylesheet" href="../ergasiaEPDmerosB/css/documents.css" />
    <link href="../ergasiaEPDmerosB/css/main.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
    <link href="../ergasiaEPDmerosB/css/content.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
    <link href="../ergasiaEPDmerosB/css/documents.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
</head>

<body>
    <div class="container">
        <div class="header">
            <h1 id="title">
                Έγγραφα Tutor
            </h1>
        </div>
        <div class="navigation">
            <?php
            include(__DIR__ . '/../utils/navigation.html');
            ?>
        </div>
        <div class="main">
            <div id="topDiv"></div>
            <div class="formContainer">
                <div class="formLink">
                    <?php
                    if (!isset($_GET['show_form']) || $_GET['show_form'] == 0) {
                        echo '<a href="?show_form=document">Προσθήκη νέου εγγράφου</a>';
                    } else {
                        echo '<a href="?show_form=0">Κλείσιμο Φόρμας</a>';
                    }
                    ?>
                </div>
                <?php
                if (isset($_GET['show_form']) && $_GET['show_form'] == 'document') {
                    echo '<div class="mainForm">';
                    require(__DIR__ . '/../utils/documentForms.php');
                    echo '</div>';
                }
                ?>
            </div>
            <div class="contentContainer" method="GET">
                <?php
                require(__DIR__ . '/../database/documentDB.php');
                ?>
            </div>
            <div class="footer">
                <a href="#topDiv"> top </a>
            </div>
        </div>
    </div>
</body>

</html>