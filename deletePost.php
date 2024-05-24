<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/style.css">
    <title>Radera inlägg?</title>
    <?= require_once 'config.php' ?>
</head>

<body>
    <?php require_once './checkLogin.php' ?>

    <?php
    if (!isset($_GET['datetime'])) {
        echo <<<ERROR
        <span class="error">Inget blogginlägg har valts.</span>
        ERROR;
        die();
    }
    $datetime = $_GET['datetime'];
    echo $datetime;
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
    ?>
    <main>
        <form action="/post/delete.php" method="POST">
            <p>Är du säker att du vill radera detta inlägg?</p>
            <?= Component(
                'SqlBlogPost',
                row: $bloggpost,
                myPost: false,
            ) ?>
            <input type="hidden" name="datetime" value="<?= $datetime ?>">
            <button type="submit">Ja, radera det</button>
            <a href="/blogg.php">Nej, gå tillbaka</a>
        </form>
    </main>
</body>

</html>