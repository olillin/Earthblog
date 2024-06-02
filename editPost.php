<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redigera inlägg</title>
    <link rel="stylesheet" href="/style/common.css">
    <link rel="stylesheet" href="/style/blogg.css">
    <?php require_once './phpDefaults.php' ?>
</head>

<body>
    <?php require_once './checkLogin.php' ?>

    <?= Component('Header') ?>
    <main>
        <?php
        if (!isset($_GET['datetime'])) {
            echo Component('Error', message: 'Inget blogginlägg har valts.');
        }
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
        }
        if (count($result) != 1) {
            echo Component('Error', message: 'Detta inlägg går inte att redigera.');
        }
        $bloggpost = $result[0];
        $bloggtext = $bloggpost['bloggtext'];
        ?>
        <h1>Redigera inlägg</h1>
        <?= Component(
            'EditBlogPostForm',
            text: urldecode($bloggtext),
            placeholder: urldecode($bloggtext),
            datetime: $datetime,
        ) ?>
    </main>

    <?= Component('Footer') ?>
</body>

</html>