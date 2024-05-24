<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loggar in...</title>
    <link rel="stylesheet" href="/style.css">
    <?php require_once './config.php' ?>
</head>

<body>
    <p>Försöker logga in...</p>
    <?php
    if (!isset($_POST['username']) || empty($_POST['username'])) {
        echo Component('LoginError', message: 'Du har inte angett ett användarnamn');
    } else if (!isset($_POST['password']) || empty($_POST['password'])) {
        echo Component('LoginError', message: 'Du har inte angett ett lösenord');
    } else {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $rows = queryDB(
            "SELECT userId, password FROM users WHERE loginName=:username",
            array('username' => $username)
        );

        if ($rows == null) {
            echo Component('LoginError', message: 'Kunde inte kontakta databas');
        } else if (empty($rows)) {
            // User does not exist
            echo Component('LoginError', message: 'Fel användarnamn eller lösenord');
        } else if (count($rows) > 1) {
            // Multiple users exist
            echo Component('LoginError', message: 'Fick ogiltigt svar från databas, flera användare med samma användarnamn');
        } else {
            // One user returned
            $user = $rows[0];

            $db_password = $user['password'];

            if ($db_password === $password) {
                // Login success
                session_start();
                $_SESSION['user'] = $user['userId'];
                header('Location: ' . '/blogg.php');
                exit();
            } else {
                echo Component('LoginError', message: 'Fel användarnamn eller lösenord');
            }
        }
    }
    ?>
</body>

</html>