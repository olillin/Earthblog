<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Radera inlägg</title>
    <link rel="stylesheet" href="/style/common.css">
    <link rel="stylesheet" href="/style/blogg.css">
    <?php require_once 'phpDefaults.php' ?>
</head>

<body>
    <?php require_once './checkLogin.php' ?>

    <?= Component('Header') ?>

    <main>
        <?php
        if (!isset($_GET['datetime'])) {
            echo Component('Error', message: 'Inget blogginlägg har valts.');
        } else {
            $datetime = $_GET['datetime'];
            $authorId = $_SESSION['user'];
            $result = queryDB(
                'SELECT * FROM bloggtext WHERE userId=:userId AND datetime=:datetime',
                array(
                    'userId' => $authorId,
                    'datetime' => $datetime,
                )
            );
            if ($result === null) {
                echo Component('Error', message: 'Något gick fel, försök igen senare.');
            } else if (count($result) != 1) {
                echo Component('Error', message: 'Detta inlägg går inte att radera.');
            } else {
                $bloggpost = $result[0];

                echo <<<MAIN
            <h1>Radera inlägg</h1>
                <form action="/post/delete.php" method="POST">
                    <p>Är du säker att du vill radera detta inlägg?</p>
            MAIN . Component(
                    'SqlBlogPost',
                    row: $bloggpost,
                    myPost: false,
                    profileLink: false,
                ) . <<<MAIN
                    <input type="hidden" name="datetime" value="$datetime">
                    <span class="buttonRow">
                        <button type="submit" class="button">Ja, radera det</button>
                        <a href="/blogg.php" class="button primary">Nej, gå tillbaka</a>
                    </span>
                </form>
            </main>
            MAIN;
            }
        }
        ?>
    </main>

    <?= Component('Footer') ?>
</body>

</html>