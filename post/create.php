<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nytt inlägg</title>
    <link rel="stylesheet" href="/style.css">
    <?php require_once '../config.php' ?>
</head>

<body>
    <?php
    require_once '../checkLogin.php';

    // Validate input
    if (!isset($_POST['bloggtext']) || empty($_POST['bloggtext'])) {
        echo <<<ERROR
        <span class="error">Du kan inte skapa ett tomt blogginlägg.</span>

        <a href="/blogg.php">Tillbaka till hemskärmen</a>
        ERROR;
        die();
    }
    // Get input
    $bloggtext = $_POST['bloggtext'];
    $sanitized = trim($bloggtext);
    $authorId = $_SESSION['user'];
    $datetime = date("Y-m-d H:i:s");
    // Post to DB
    $result = queryDB(
        'INSERT INTO bloggtext (userId, bloggtext, datetime) VALUES (:userId, :bloggtext, :datetime)',
        array(
            'userId' => $authorId,
            'bloggtext' => urlencode($bloggtext),
            'datetime' => $datetime,
        )
    );
    if ($result === null) {
        // Failed post to DB
        echo <<<ERROR
        <span class="error">Något gick fel, försök igen senare.</span>

        <a href="/blogg.php">Tillbaka till hemskärmen</a>
        ERROR;
    } else {
        echo <<<SUCCESS
        <span class="success">Skapade blogginlägg, omdirigerar till hemskärmen...</span>

        <a href="/blogg.php">Omdirigeras inte automatiskt? Klicka här</a>
        SUCCESS;
        header('Location: ' . '/blogg.php');
    }
    ?>
</body>

</html>