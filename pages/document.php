<!DOCTYPE html>
<html lang="gr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title> 'Εγγραφα Μαθήματος</title>
    <link rel="stylesheet" href="../css/main.css" />
    <link rel="stylesheet" href="../css/content.css" />
    <link rel="stylesheet" href="../css/documents.css" />
    <link href="../css/main.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
    <link href="../css/content.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
    <link href="../css/documents.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
</head>

<body>
    <div class="container">
        <div class="header">
            <h1 id="title">
                Έγγραφα
            </h1>
        </div>
        <div class="navigation">
            <?php
            include('../utils/navigation.html');
            ?>
        </div>
        <div class="main">
            <div class="mainContent" id="topDiv">
                <h2 class="contentHeader"> HTML 1 </h2>
                <div class="contentBody">
                    <p>Βασικά στοιχεία HTML</p>
                    <a href="../files/basicHTML.docx">Download</a>
                </div>
            </div>
            <div class="mainContent" id="topDiv">
                <h2 class="contentHeader"> HTML 2 </h2>
                <div class="contentBody">
                    <p> Εμβάθυνση στην HTML </p>
                    <a href="../files/advancedHTML.docx">Download</a>
                </div>
            </div>
            <div class="mainContent" id="topDiv">
                <h2 class="contentHeader"> CSS 1 </h2>
                <div class="contentBody">
                    <p>Βασικά στοιχεία CSS</p>
                    <a href="../files/basicCSS.docx">Download</a>
                </div>
            </div>
            <div class="mainContent" id="topDiv">
                <h2 class="contentHeader"> CSS 2 </h2>
                <div class="contentBody">
                    <p>Εμβάθυνση στην CSS</p>
                    <a href="../files/advancedCSS.docx">Download</a>
                </div>
            </div>
            <div class="mainContent" id="topDiv">
                <h2 class="contentHeader"> JavaScript </h2>
                <div class="contentBody">
                    <p>Διαφάνειες JavaScript</p>
                    <a href="../files/Javascript.docx">Download</a>
                </div>
            </div>
            <div class="mainContent" id="topDiv">
                <h2 class="contentHeader">PHP</h2>
                <div class="contentBody">
                    <p>Διαφάνειες PHP</p>
                    <a href="../files/PHP.docx">Download</a>
                </div>
            </div>
            <div class="mainContent" id="topDiv">
                <h2 class="contentHeader"> MySQL </h2>
                <div class="contentBody">
                    <p>Διαφάνειες MySQL</p>
                    <a href="../files/my.docx">Download</a>
                </div>
            </div>
            <div class="footer">
                <a href="#topDiv"> top </a>
            </div>
        </div>
    </div>
</body>

</html>