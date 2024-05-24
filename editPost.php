<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/style.css">
    <title>Redigera inlägg</title>
    <?= require_once './config.php' ?>
</head>

<body>
    <?php
    require_once './checkLogin.php';

    if (!isset($_GET['datetime'])) {
        echo <<<ERROR
        <span class="error">Inget blogginlägg har valts.</span>
        ERROR;
        die();
    }
    $datetime = $_GET['datetime'];
    $userId = $_SESSION['user'];
    $result = queryDB(
        'SELECT * FROM bloggtext WHERE userId=:userId AND datetime=:datetime',
        array(
            'userId' => $userId,
            'datetime' => $datetime,
        )
    );
    if ($result === null) {
        echo <<<ERROR
        <span class="error">Något gick fel, försök igen senare.</span>
        ERROR;
        die();
    }
    if (count($result) != 1) {
        echo <<<ERROR
        <span class="error">Detta inlägg går inte att radera.</span>
        ERROR;
        die();
    }
    $bloggpost = $result[0];
    $bloggtext = $bloggpost['bloggtext'];
    ?>
    <main>
        <h1>Redigera inlägg</h1>
        <form action="/post/update.php" method="POST">
            <?= Component(
                'Blogtext',
                value: $bloggtext,
                placeholder: $bloggtext,
            ) ?>
            <input type="hidden" name="datetime" value="<?= $datetime ?>">
            <button type="submit">Spara</button>
            <a href="/blogg.php">Avbryt</a>
        </form>
    </main>
</body>

</html>