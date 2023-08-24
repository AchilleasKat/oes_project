<!DOCTYPE html>
<html lang="gr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title>Σύνδεση</title>
    <link rel="stylesheet" href="../css/main.css" />
    <link rel="stylesheet" href="../css/login-signup.css" />
    <link href="../css/main.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
    <link href="../css/login-signup.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
</head>



<?php
    session_start();
    include("database.php");
    if(isset($_SESSION['username']))
    {
        header('Location: ../pages/index.php');
        exit;
    }
    $errorCounter=0;
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];


        if ($username == 'myusername' && $password == 'mypassword') {
            $_SESSION['username'] = $username;
            $errorCounter=0;
            if (isset($_SESSION["login_redirect"])==true) {
                header("Location:" . $_SESSION["login_redirect"]);
                unset($_SESSION["login_redirect"]);
            }
            else {
                header('Location: ../pages/inedex.php');
            }
            exit;
        } else {
                $errorCounter=1;
            }
    }
?>
        

<body>
    <div class="login-signup-conatainer">
        <div class="maincontent">
            <div class="headeritems">
                <h4>Σύνδεση</h4>
            <?php 
                    if($errorCounter==1){
                        echo '<div class="errorMessage">  Invalid username or password </div>';
                    }
                ?>
            </div>      
            <form class="submitbox" method="POST">
                <div class="textfields">
                    <label class="label">Όνομα Χρήστη ή Email</label>
                    <input class="userInput" type="text" required placeholder="username" name="username" pattern=".{2,15}"/>
                </div>
                <div class="textfields">
                    <label class="label">Κωδικός</label>
                    <input class="userInput" type="password" required placeholder="password" name="password"  />
                </div>
            <button class="submitButton" type="submit">Σύνδεση</button>
                <div class="boxfooter">
                    <h5>Δεν έχετε Λογαριασμό<a href="signup.php"> Εγγραφή </a></h5>
                </div>
            </form>
        </div>
    </div>
</body>
</html>

