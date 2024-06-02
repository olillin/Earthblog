<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Du loggas ut...</title>
    <link rel="stylesheet" href="/style/common.css">
    <?php require_once '../phpDefaults.php' ?>
</head>

<body>
    <?php
    session_start();
    session_unset();
    session_destroy();
    header('Location: /');
    ?>
    <main>
        <h1>Du har loggats ut</h1>
        <span class="success">Omdirigerar till inloggningsskärmen...</span>

        <a href="/" class="button primary">Omdirigeras inte automatiskt? Klicka här</a>
    </main>

    <?= Component('Footer') ?>
</body>

</html>