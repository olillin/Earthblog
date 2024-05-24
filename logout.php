<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Du loggas ut...</title>
    <link rel="stylesheet" href="/style.css">
    <?php require_once './config.php' ?>
</head>

<body>
    <span>Loggar ut dig...</span>
    <?php
    session_start();
    unset($_SESSION['user']);
    header('Location: ' . '/index.php');
    ?>
</body>

</html>