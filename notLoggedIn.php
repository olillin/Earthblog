<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Not logged in</title>
    <link rel="stylesheet" href="/style/common.css">
    <?php require_once './phpDefaults.php' ?>
</head>

<body>
    <main>
        <h1 class="error">Du måste vara inloggad för att använda bloggen.</h1>

        <a href="/" class="button primary">Logga in</a>
    </main>

    <?= Component('Footer') ?>
</body>

</html>