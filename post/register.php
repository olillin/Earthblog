<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrera</title>
    <link rel="stylesheet" href="/style/common.css">
    <?php require_once '../phpDefaults.php' ?>
</head>

<body>
    <main>
        <?php
        // Validate input
        if (!isset($_POST['fullName']) || empty($_POST['fullName'])) {
            echo Component('RegisterError', message: 'Du har inte angett ditt namn.');
        } else if (!isset($_POST['username']) || empty($_POST['username'])) {
            echo Component('RegisterError', message: 'Du har inte angett ditt användarnamn.');
        } else if (preg_match('/^[a-z0-9_-]+$/', strtolower($_POST['username'])) == 0) {
            echo Component('RegisterError', message: 'Ogiltigt användarnamn.');
        } else if (!isset($_POST['password']) || empty($_POST['password'])) {
            echo Component('RegisterError', message: 'Du har inte angett ditt lösenord.');
        } else {
            // Get input
            $fullName = $_POST['fullName'];
            $sanitized = trim($fullName);
            $username = $_POST['username'];
            $password = $_POST['password'];
            // Check if exists
            $count = queryDB(
                'SELECT COUNT(*) FROM users WHERE loginName=:username',
                array(
                    'username' => $username,
                )
            );
            if ($count === null) {
                // Failed check
                echo Component('RegisterError', message: 'Något gick fel, försök igen senare.');
            } else if ($count[0]['COUNT(*)'] > 0) {
                echo Component('RegisterError', message: 'Användarnamnet är upptaget.');
            } else {
                // Post to DB
                $result = queryDB(
                    'INSERT INTO users (loginName, userFullName, password) VALUES (:username, :fullName, :password)',
                    array(
                        'username' => strtolower($username),
                        'fullName' => urlencode($fullName),
                        'password' => $password,
                    )
                );
                if ($result === null) {
                    // Failed post to DB
                    echo Component('RegisterError', message: 'Något gick fel, försök igen senare.');
                } else {
                    echo <<<SUCCESS
                    <span class="success">Du är registrerad, omdirigerar till inloggningsskärm...</span>

                    <a href="/" class="button primary">Omdirigeras inte automatiskt? Klicka här</a>
                    SUCCESS;
                    header('Location: /');
                }
            }
        }
        ?>
    </main>

    <?= Component('Footer') ?>
</body>

</html>