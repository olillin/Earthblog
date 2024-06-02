<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loggar in...</title>
    <link rel="stylesheet" href="/style/common.css">
    <?php require_once '../phpDefaults.php' ?>
</head>

<body>
    <main>
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

            if ($rows == null || empty($rows)) {
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
                    echo <<<SUCCESS
                    <span class="success">Du har loggats in, omdirigerar till hemskärmen...</span>

                    <a href="/blogg.php" class="button primary">Omdirigeras inte automatiskt? Klicka här</a>
                    SUCCESS;
                    session_start();
                    $_SESSION['user'] = $user['userId'];
                    header('Location: /blogg.php');
                    exit();
                } else {
                    echo Component('LoginError', message: 'Fel användarnamn eller lösenord');
                }
            }
        }
        ?>
    </main>

    <?= Component('Footer') ?>
</body>

</html>