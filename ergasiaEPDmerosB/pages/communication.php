<!DOCTYPE html>
<html lang="gr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title>Επικοινωνία</title>
    <link rel="stylesheet" href="../ergasiaEPDmerosB/css/main.css" />
    <link rel="stylesheet" href="../ergasiaEPDmerosB/css/communication.css" />
    <link href="../ergasiaEPDmerosB/css/main.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
    <link href="../ergasiaEPDmerosB/css/communication.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
</head>

<body>
    <div class="container">
        <div class="header">
            <h1 id="title">
                Επικοινωνία
            </h1>
        </div>
        <div class="navigation">
            <?php
            include(__DIR__ . '/../utils/navigation.html');
            ?>
        </div>
        <div class="main">
            <div class="description">
                Η συγκεκριμένη ιστοσελίδα περιέχει δύο δυνατότητες
                για την αποστολή e-mail στον καθηγητή:
                <ul>
                    <li>Μέσω web φόρμας</li>
                    <li>Με χρήση e-mail διεύθυνσης</li>
                </ul>
            </div>
            <div class="emailFormContainer">
                <h2 class="formTitle"> Αποστολή e-mail μέσω web φόρμας </h2>
                <form class="emailForm">
                    <div class="emailFormObject">
                        <label for="sender">Αποστολέας </label>
                        <input type="text" id="sender" name="Αποστολέας"> </label>
                    </div>
                    <div class="emailFormObject">
                        <label for="subject">Θέμα </label>
                        <input type="text" id="subject" name="Θέμα"> </label>
                    </div>
                    <div class="emailFormObject">
                        <label for="mail">Κείμενο </label>
                        <input type="text" Id="mail" name="Κείμενο"> </label>
                    </div>
                    <input type="submit">
                </form>
            </div>
            <div class="footer">
                <div class="emailAddress">
                    <h2 class="formTitle"> Αποστολή e-mail με χρήση e-mail διεύθυνσης </h2>
                    <p>Εναλλακτικά μπορείτε να αποστείλετε e-mail στην παρακάτω διεύθυνση ηλεκτρονικού ταχυδρομείου <a
                            class="mailto" href="mailto:tutor@csd.auth.test.gr">tutor@csd.auth.test.gr</a> </p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>