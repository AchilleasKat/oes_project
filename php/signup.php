

<!DOCTYPE html>
<html lang="gr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title>Εγγραφή</title>
    <link rel="stylesheet" href="../css/main.css" />
    <link rel="stylesheet" href="../css/login-signup.css" />
    <link href="../css/main.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
    <link href="../css/login-signup.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
</head>

<?php 
    include("database.php");
    function transform_post($field){
        if(isset($_POST[$field])) 
            return htmlspecialchars(stripslashes($_POST[$field])); 
    }
                        
    if(!isset($_POST['username']) || strlen($_POST['username']) == 0){
        $error['username'] = "Πληκτρολογήστε ένα όνομα χρήστη.";
    } elseif (isset($_POST['username']) && (strlen($_POST['username']) < 2 || strlen($_POST['username']) > 15)){
        $error['username'] = "Το όνομα χρήστη πρέπει να έχει από 2 έως 15 χαρακτήρες";
    }else{
        $username=transform_post($_POST['username']);
    }
                                            
    if (isset($_POST['password']) && strlen($_POST['password']) < 8){
        $error['password'] = "Ο κωδικός πρέπει να είναι τουλάχιστον 8 χαρακτήρες και να περιέχει τουλαχιστον ένα αριθμό ένα κεφαλαίο και ενα πεζό γράμμα και ένα σύμβολο";
    }else{
        $password=transform_post($_POST['password']);
    }
    
    
    mysqli_close($conn);
?> 

<body>
    <div class="login-signup-conatainer">
        <div class="maincontent">
            <div class="headeritems">
                <h3>Δημιουργία Λογαριασμού</h3>
            </div>
            <form class="submitbox" method="POST">
                <div class="textfields" >
                <label class="label">Όνομα</label>
                <input class="userInput" type="text" name="firstname">
            </div>
            <div class="textfields" >
                <label class="label">Επίθετο</label>
                <input class="userInput" type="text" name="lastname"/>
            </div>
                <!-- <div class="textfields">
                    <label class="label">Όνομα Χρήστη</label>
                    <input class="userInput" type="text" name="username" />
                    <span>
                        <?php
                        if(isset($error['username'])) echo $error['username'];
                        ?>
                     </span>
                </div> -->
                <div class="textfields">
                    <label class="label">Email</label>
                    <input class="userInput" type="email" required name="email"/>   
                </div>
                <div class="textfields">
                    <label class="label">Κωδικός</label>
                    <input class="userInput" type="password" required name="password"  pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,16}" />
                    <span>
                        <?php
                        if(isset($error['password'])) echo $error['password'];
                        ?>
                    </span>
                </div>
                <div class="textfields">
                    <label class="label">Επιβεβαίωση Κωδικού</label>
                    <input class="userInput" type="password" name="confirmpassword" />
                </div> 
               <button class="submitButton" type="submit">Εγγραφή</button>
                <div class="boxfooter">
                    <h5>Έχετε ήδη Λογαριασμό <a href="login.php">  Συνδεθείτε </a>
                </h5>
            </form>
        </div>
    </div>
</body>
</html>

