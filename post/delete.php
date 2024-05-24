<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Raderar inlägg</title>
    <link rel="stylesheet" href="/style.css">
    <?php require_once '../config.php' ?>
</head>

<body>
    <?php
    require_once '../checkLogin.php';

    // Validate input
    if (!isset($_POST['datetime']) || empty($_POST['datetime'])) {
        echo <<<ERROR
        <span class="error">Du har inte valt något blogginlägg.</span>

        <a href="/blogg.php">Tillbaka till hemskärmen</a>
        ERROR;
        die();
    }
    // Get input
    $datetime = $_POST['datetime'];
    // Check how many bloggposts match
    $count = queryDB(
        'SELECT COUNT(*) FROM bloggtext WHERE datetime=:datetime',
        array(
            'datetime' => $datetime,
        )
    );
    if ($count === null) {
        // Failed check
        echo <<<ERROR
        <span class="error">Något gick fel, försök igen senare.</span>

        <a href="/blogg.php">Tillbaka till hemskärmen</a>
        ERROR;
    } else {
        if ($count[0]['COUNT(*)'] != 1) {
            echo <<<ERROR
            <span class="error">Detta inlägg går inte att radera.</span>

            <a href="/blogg.php">Tillbaka till hemskärmen</a>
            ERROR;
        } else {
            $result = queryDB(
                'DELETE FROM bloggtext WHERE datetime=:datetime',
                array(
                    'datetime' => $datetime
                )
            );
            if ($result === null) {
                // Failed check
                echo <<<ERROR
                <span class="error">Något gick fel, försök igen senare.</span>

                <a href="/blogg.php">Tillbaka till hemskärmen</a>
                ERROR;
            } else {
                echo <<<SUCCESS
                <span class="success">Raderade blogginlägg, omdirigerar till hemskärmen...</span>

                <a href="/blogg.php">Omdirigeras inte automatiskt? Klicka här</a>
                SUCCESS;
                header('Location: ' . '/blogg.php');
            }
        }
    }
    ?>
</body>

</html>