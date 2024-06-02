<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nytt inlägg</title>
    <link rel="stylesheet" href="/style/common.css">
    <?php require_once '../phpDefaults.php' ?>
</head>

<body>
    <main>
        <?php
        require_once '../checkLogin.php';

        // Validate input
        if (!isset($_POST['bloggtext']) || empty($_POST['bloggtext'])) {
            echo Component('Error', message: 'Du kan inte skapa ett tomt blogginlägg.');
        } else {
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
                echo Component('Error', message: 'Något gick fel, försök igen senare.');
            } else {
                echo <<<SUCCESS
                <span class="success">Skapade blogginlägg, omdirigerar till hemskärmen...</span>
        
                <a href="/blogg.php" class="button primary">Omdirigeras inte automatiskt? Klicka här</a>
                SUCCESS;
                header('Location: /blogg.php');
            }
        }
        ?>
    </main>

    <?= Component('Footer') ?>
</body>

</html>