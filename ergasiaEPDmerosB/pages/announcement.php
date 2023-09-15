<!DOCTYPE html>
<html lang="gr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title>Ανακοινώσεις</title>
    <link rel="stylesheet" href="../css/main.css" />
    <link rel="stylesheet" href="../css/content.css" />
    <link rel="stylesheet" href="../css/announcement.css">
    <link href="../css/main.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
    <link href="../css/content.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
    <link href="../css/announcement.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
</head>

<body>
    <div class="container">
        <div id="topDiv"></div>
        <div class="header">
            <h1 id="title">
                Ανακοινώσεις
            </h1>
        </div>
        <div class="navigation">
            <?php
            include(__DIR__ . '/../utils/navigation.html');
            ?>
        </div>
        <div class="main">
            <form class="announcementBody" method="GET">
                <?php
                require(__DIR__ . '/../database/announcementDB.php');
                ?>
            </form>
            <div class="footer">
                <a href="#topDiv"> top </a>
            </div>
        </div>
    </div>
</body>

</html>