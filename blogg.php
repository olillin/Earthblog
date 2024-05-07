<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blogg</title>
    <?php require_once './config.php' ?>
</head>

<body>
    <?php
    session_start();
    if (!isset($_SESSION['user'])) {
        echo <<<ERROR
        <span class="text-red-500">Du måste vara inloggad för att använda bloggen.</span>
        <a href="/index.php">Logga in</a>
        ERROR;
        die();
    }
    echo 'Välkommen till bloggen!'
        ?>
</body>

</html>