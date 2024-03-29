<!DOCTYPE html>
<html lang="gr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title>Ανακοινώσεις</title>
    <link rel="stylesheet" href="../projectFiles/css/main.css" />
    <link rel="stylesheet" href="../projectFiles/css/content.css" />
    <link rel="stylesheet" href="../projectFiles/css/announcement.css">
    <link href="../projectFiles/css/main.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
    <link href="../projectFiles/css/content.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
    <link href="../projectFiles/css/announcement.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
</head>

<body>
    <div class="container">
        <div class="header">
            <h1 id="title">
                Ανακοινώσεις
            </h1>
        </div>
        <nav class="navigation">
            <?php
            include(__DIR__ . '/../utils/navigation.html');
            ?>
        </nav>
        <div class="main">
            <div id="topDiv"></div>
            <div class="announcementBody" method="GET">
                <?php
                require(__DIR__ . '/../database/announcementDB.php');
                ?>
            </div>
            <div class="footer">
                <a href="#topDiv"> top </a>
            </div>
        </div>
    </div>
</body>

</html>