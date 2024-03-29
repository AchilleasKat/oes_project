<!DOCTYPE html>
<html lang="gr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title>Σύνδεση</title>
    <link rel="stylesheet" href="../projectFiles/css/main.css" />
    <link rel="stylesheet" href="../projectFiles/css/login-signup.css" />
    <link href="../projectFiles/css/main.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
    <link href="../projectFiles/css/login-signup.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
</head>



<?php
session_start();
include("../projectFiles/database/database.php");
if (isset($_SESSION['username'])) { //If already logged in redirect to previous page
    if (isset($_SESSION["login_redirect"]) == true) {
        header("Location:" . $_SESSION["login_redirect"]); //Redirect to previous page saved in variable $_SESSION["login_redirect"]
        unset($_SESSION["login_redirect"]);
    } else {
        header('Location:  __DIR__ . /../index.php');
    }
    exit;
}

$errorCounter = 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM users";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            if ($username == $row["email"] && $password == $row["password"]) {
                $_SESSION['username'] = $username;
                $_SESSION['role'] = $row['role'];
                $errorCounter = 0;
                header('Location: __DIR__ . /../index.php');
                exit;
            } else {
                $errorCounter = 1;
            }
        }
    } else {
        echo "No records found";
    }

    if ($username == 'myusername' && $password == 'mypassword') {
        $_SESSION['username'] = $username;
        $errorCounter = 0;
        header('Location:  __DIR__ . /../index.php');
        exit;
    } else {
        $errorCounter = 1;
    }
}
mysqli_close($conn);
?>


<body>
    <div class="login-signup-conatainer">
        <div class="maincontent">
            <div class="headeritems">
                <h4>Σύνδεση</h4>
                <?php
                if ($errorCounter == 1) {
                    echo '<div class="errorMessage">  Invalid username or password </div>';
                }
                ?>
            </div>
            <form class="submitbox" method="POST">
                <div class="textfields">
                    <label class="label">Email</label>
                    <input class="userInput" type="email" required placeholder="username" name="username" />
                </div>
                <div class="textfields">
                    <label class="label">Κωδικός</label>
                    <input class="userInput" type="password" required placeholder="password" name="password" />
                </div>
                <button class="submitButton" type="submit">Σύνδεση</button>
            </form>
        </div>
    </div>
</body>

</html>